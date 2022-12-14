<?php
namespace Database;

use PDO;

class CursoModel
{
    /**
     * O id do curso
     */
    public ?int $id;

    /**
     * Id do campus a qual esse curso pertence.
     */
    public int $campusId;

    /**
     * Nome do curso
     */
    public string $nome;

   /**
    * Duração, em anos
    */
    public int $duracao;
}

class CampusCursoModel
{
    public int $cursoId;
    public string $cursoNome;
    public int $cursoDuracao;
    public int $campusId;
    public string $campusNome;
}

class CursoController
{
    protected PDO $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    static function init(PDO $db) {
        $db->exec("
            CREATE TABLE IF NOT EXISTS curso (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                campusId INTEGER NOT NULL,
                nome VARCHAR(64) NOT NULL,
                duracao INTEGER NOT NULL,
                FOREIGN KEY (campusId) REFERENCES campus (id)
            );
        ");
    }

    /**
     * Insere um curso na tabela.
     * @return int O id do curso a ser inserido.
     */
    function add(CursoModel $model): int
    {
        if ($this->db->beginTransaction()) {
            $stmt = $this->db->prepare("
                INSERT INTO curso (campusId, nome, duracao) VALUES (:campusId, :nome, :duracao);
            ");

            $stmt->bindValue(":campusId", $model->campusId);
            $stmt->bindValue(":nome", $model->nome);
            $stmt->bindValue(":duracao", $model->duracao);

            if ($stmt->execute()) {
                // Salvar dados no banco definitivamente
                $this->db->commit();

                // Buscar o objeto inserido mais recentemente (o atual)
                $fetchStmt = $this->db->query("SELECT * FROM curso ORDER BY id DESC LIMIT 1;");
                $idInserido = $fetchStmt->fetchObject()->id;

                // Retornar seu id
                return $idInserido;
            } else {
                $this->db->rollBack();
                throw new \RuntimeException("Erro ao inserir dados" . $stmt->errorCode());
            }
        } else {
            throw new \RuntimeException("Impossível iniciar transação.");
        }
    }

    /**
     * Lista todos os cursos, com seus campus incluidos.
     * @return CampusCursoModel[]
     */
    function listAllWithCampus()
    {
        $list = [];
        $stmt = $this->db->query("
        SELECT
            curso.id as 'cursoId',
            curso.nome as 'cursoNome',
            curso.duracao as 'cursoDuracao',
            campus.id as 'campusId',
            campus.nome as 'campusNome'
        FROM curso
            INNER JOIN campus ON curso.campusId = campus.id;");

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $model = new CampusCursoModel();

            // Popular dados do modelo com a linha retornada pelo banco
            $model->cursoId = $row["cursoId"];
            $model->cursoNome = $row["cursoNome"];
            $model->cursoDuracao = $row["cursoDuracao"];
            $model->campusId = $row["campusId"];
            $model->campusNome = $row["campusNome"];

            array_push($list, $model);
        }

        return $list;
    }
}
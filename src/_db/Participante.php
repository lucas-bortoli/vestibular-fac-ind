<?php
namespace Database;

use PDO;

class ParticipanteModel
{
    /**
     * O id do usuário. Se for nulo, ao fazer uma inserção no banco de dados, ele será autoincrementado.
     */
    public ?int $id;

    /**
     * Nome do participante
     */
    public string $nome;

    /**
     * E-mail do participante
     */
    public string $email;

    /**
     * Documento do participante
     */
    public string $documento;

    /**
     * Data de nascimento do participante, em formato aceito pelo SQL (YYYY-MM-DD).
     */
    public string $dataNascimento;

    /**
     * Curso que o participante está inscrito
     */
    public int $cursoId;
}

class ParticipanteController
{
    protected PDO $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    static function init(PDO $db)
    {
        $db->exec("
            CREATE TABLE IF NOT EXISTS participante (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome VARCHAR(64) NOT NULL,
                email VARCHAR(64) UNIQUE NOT NULL,
                documento VARCHAR(64) UNIQUE NOT NULL,
                nascimento DATE NOT NULL,
                cursoId INTEGER NOT NULL,
                FOREIGN KEY (cursoId) REFERENCES curso (id)
            );
        ");
    }

    /**
     * Insere um participante na tabela.
     * @return int O id do participante inserido.
     */
    function add(ParticipanteModel $model): int
    {
        if ($this->db->beginTransaction()) {
            $stmt = $this->db->prepare("
                INSERT INTO participante (nome, email, documento, nascimento, cursoId) VALUES (:nome, :email, :documento, :nascimento, :cursoId);
            ");

            $stmt->bindValue(":nome", $model->nome);
            $stmt->bindValue(":email", $model->email);
            $stmt->bindValue(":documento", $model->documento);
            $stmt->bindValue(":nascimento", $model->dataNascimento);
            $stmt->bindValue(":cursoId", $model->cursoId);

            if ($stmt->execute()) {
                // Salvar dados no banco definitivamente
                $this->db->commit();

                // Buscar o objeto inserido mais recentemente (o atual)
                $fetchStmt = $this->db->query("SELECT * FROM participante ORDER BY id DESC LIMIT 1;");
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
     * Remove um participante.
     * @param int $id Id do participante a ser removido.
     */
    function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM participante WHERE id = :id");

        $stmt->bindValue(":id", $id);

        if (!$stmt->execute()) {
            throw new \RuntimeException("Impossível apagar participante com código " . $id . ". " . $stmt->errorCode());
        }
    }

    /**
     * Lista todos os participantes.
     * @return ParticipanteModel[]
     */
    function listAll()
    {
        $list = [];
        $stmt = $this->db->query("SELECT * FROM participante");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $model = new ParticipanteModel();

            // Popular dados do modelo com a linha retornada pelo banco
            $model->id = $row["id"];
            $model->nome = $row["nome"];
            $model->email = $row["email"];
            $model->documento = $row["documento"];
            $model->dataNascimento = $row["nascimento"];
            $model->cursoId = $row["cursoId"];

            array_push($list, $model);
        }

        return $list;
    }
}
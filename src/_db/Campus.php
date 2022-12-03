<?php
namespace Database;

use PDO;

class CampusModel
{
    /**
     * O id do campus
     */
    public ?int $id;

    /**
     * Nome do campus
     */
    public string $nome;
}

class CampusController
{
    protected PDO $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    static function init(PDO $db)
    {
        $db->exec("
            CREATE TABLE IF NOT EXISTS campus (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome VARCHAR(64) NOT NULL
            );
        ");
    }

    /**
     * Insere um campus na tabela.
     * @return int O id do campus a ser inserido.
     */
    function add(CampusModel $model): int
    {
        if ($this->db->beginTransaction()) {
            $stmt = $this->db->prepare("
                INSERT INTO campus (nome) VALUES (:nome);
            ");

            $stmt->bindValue(":nome", $model->nome);

            if ($stmt->execute()) {
                // Salvar dados no banco definitivamente
                $this->db->commit();

                // Buscar o objeto inserido mais recentemente (o atual)
                $fetchStmt = $this->db->query("SELECT * FROM campus ORDER BY id DESC LIMIT 1;");
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
     * Lista todos os campi.
     * @return CampusModel[]
     */
    function listAll()
    {
        $list = [];
        $stmt = $this->db->query("SELECT * FROM campus");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $model = new CampusModel();

            // Popular dados do modelo com a linha retornada pelo banco
            $model->id = $row["id"];
            $model->nome = $row["nome"];

            array_push($list, $model);
        }

        return $list;
    }
}
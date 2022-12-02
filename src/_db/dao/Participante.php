<?php
namespace Database\DAO;

require_once "_db/model/Participante.php";

use Database\Model\ParticipanteModel;
use PDO;

class ParticipanteDAO
{
    protected PDO $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Insere um participante na tabela.
     * @return int O id do participante inserido.
     */
    function add(ParticipanteModel $model): int
    {
        if ($this->db->beginTransaction()) {
            $stmt = $this->db->prepare("
                INSERT INTO participante (nome, email, documento, tipoDocumento, nascimento) VALUES (:nome, :email, :documento, :tipoDocumento, :nascimento);
            ");

            $stmt->bindValue(":nome", $model->nome);
            $stmt->bindValue(":email", $model->email);
            $stmt->bindValue(":documento", $model->documento);
            $stmt->bindValue(":tipoDocumento", $model->tipoDocumento);
            $stmt->bindValue(":nascimento", $model->dataNascimento);

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
            $model->tipoDocumento = $row["tipoDocumento"];
            $model->dataNascimento = $row["nascimento"];

            array_push($list, $model);
        }

        return $list;
    }
}
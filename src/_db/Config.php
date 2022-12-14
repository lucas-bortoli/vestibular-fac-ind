<?php
namespace Database;

use PDO;

class ConfigModel
{
    public string $smtp_host;
    public int $smtp_port;
    public string $smtp_encryption_type;
    public string $smtp_username;
    public string $smtp_password;
    public string $smtp_from_address;

    /**
     * Timestamp unix do início da prova online
     */
    public int $processo_seletivo_inicio_timestamp;
    
    /**
     * Timestamp unix do fim da prova online
     */
    public int $processo_seletivo_fim_timestamp;

    /**
     * Descrição em HTML do processo seletivo, mostrado em /index.php
     */
    public string $processo_seletivo_descricao;
}

class ConfigController
{
    protected PDO $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    static function init(PDO $db)
    {
        $db->exec("
            CREATE TABLE IF NOT EXISTS config (
                smtp_host TEXT NOT NULL,
                smtp_port INTEGER NOT NULL,
                smtp_encryption_type TEXT NOT NULL,
                smtp_username TEXT NOT NULL,
                smtp_password TEXT NOT NULL,
                smtp_from_address TEXT NOT NULL,
                processo_seletivo_inicio_timestamp INTEGER NOT NULL,
                processo_seletivo_fim_timestamp INTEGER NOT NULL,
                processo_seletivo_descricao TEXT NOT NULL
            );
        ");
    }

    /**
     * Retorna as configurações do sistema
     * @return ConfigModel
     */
    function get(): ConfigModel {
        $stmt = $this->db->query("SELECT * FROM config LIMIT 1");

        $stmt->execute();

        $model = new ConfigModel();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Popular dados do modelo com a linha retornada pelo banco
            $model->smtp_host = $row["smtp_host"];
            $model->smtp_port = $row["smtp_port"];
            $model->smtp_encryption_type = $row["smtp_encryption_type"];
            $model->smtp_username = $row["smtp_username"];
            $model->smtp_password = $row["smtp_password"];
            $model->smtp_from_address = $row["smtp_from_address"];
            $model->processo_seletivo_descricao = $row["processo_seletivo_descricao"];
            $model->processo_seletivo_inicio_timestamp = $row["processo_seletivo_inicio_timestamp"];
            $model->processo_seletivo_fim_timestamp = $row["processo_seletivo_fim_timestamp"];
        }

        return $model;
    }
}
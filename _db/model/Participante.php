<?php
namespace Database\Model;

class ParticipanteModel {
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
     * Tipo do documento do participante; 
     * 0: CPF
     * 1: Passaporte
     * 2: Registro geral de estrangeiros
     */
    public int $tipoDocumento;

    /**
     * Data de nascimento do participante, em formato aceito pelo SQL (YYYY-MM-DD).
     */
    public string $dataNascimento;
}
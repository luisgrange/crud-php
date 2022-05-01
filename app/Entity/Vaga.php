<?php

namespace App\Entity;

class Vaga{
    /**
     * Identificador único da vaga
     * @var integer
     */
    public $id;
    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;
    /**
     * Descrição da vaga
     * @var string
     */
    public $descricao;
    
    /**
     * Define se a vaga está ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data da vaga
     * @var string
     */
    public $data;
}
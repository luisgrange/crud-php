<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

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

    /**
     * Método para cadastrar uma nova vaga
     * @return boolean
     */
    public function cadastrar(){
        // DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        // INSERIR A VAGA
        // ATRIBUIR ID NA INSTANCIA
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
                                            'titulo' => $this->titulo,
                                            'descricao' => $this->descricao,
                                            'ativo' => $this->ativo,
                                            'data' => $this->data,
                                        ]);

        // echo "<pre>"; print_r($this); echo "</pre>"; exit;
        // RETORNAR SUCESSO
        return true;
    }
    /**
     * Método que retorna as vagas
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas($where=null, $order=null, $limit=null){
        return( new Database('vagas'))->select($where, $order, $limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
}
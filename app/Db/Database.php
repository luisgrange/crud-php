<?php 
namespace App\Db;
use \PDO;

class Database{
    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

     /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'dev_vagas';

     /**
     * Usuario do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso do banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela
     * @var string
     */
    private $table;

    /**
     * Conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define tabela e instância de conexão
     * @param string
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }


    /**
     * Método responsável por criar conexão
     */
    private function setConnection(){
        try{

            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){
            die('Error: '.$e->getMessage());
        }
    }   
}
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

    /**
     * Método responsável por executar queries
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{

            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
           
        } catch(PDOException $e){
            die('Error: '.$e->getMessage());
        }
    }
    
    /**
     * Método responsável por inserir dados
     * @param array $values [ field => value]
     * @return integer
     */
    public function insert($values){
        // Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        
        $query = 'INSERT INTO '.$this->table.' ('.implode(',' ,$fields).') VALUES ('.implode(',', $binds).')';
        
        // Executa o insert
        $this->execute($query, array_values($values));

        return$this->connection->lastInsertId();
    }

        /**
     * Método que executa consulta no banco de dados
     * @param string $whre
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where=null, $order=null, $limit=null, $fields='*'){
        // DADOS DA QUERY
        $where = strlen($where)? 'WHERE '.$where : '';
        $order = strlen($order)? 'ORDER BY '.$order : '';
        $limit = strlen($limit)? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        // retorna a query
        return $this->execute($query);
    }

    /**
     * Método que executa atualizações no banco de dados
     * @param string $whre
     * @param array $values [field => value]
     * @return boolean
     */
    public function update($where, $values){
        // DADOS DA QUERY
        $fields = array_keys($values);

        // MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        
        // EXECUTA A QUERY
        $this->execute($query,array_values($values));

        return true;
    }

    /**
     * Método que executa a ação de excluir 
     * @param string $where
     * @return boolean
     */
    public function delete($where){
        // MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        // EXECUTA A QUERY
        $this->execute($query);

        return true;
    }
}
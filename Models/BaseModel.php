<?php
namespace Models;

class BaseModel
{
    protected $db;

    /**
     * BaseModel constructor.
     */
    protected function __construct()
    {
        // DBへ接続
        $this->connectDatabase();
    }

    /**
     * DBへ接続
     */
    protected function connectDatabase()
    {
        try {
            $this->db = new \PDO(
                'mysql:host='. DB_HOST .
                ';dbname='. DB_NAME .
                ';charset=' . DB_CHARSET .
                ';unix_socket=' . DB_UNIX_SOCKET,
                DB_USER, DB_PASSWORD,
                array(\PDO::ATTR_EMULATE_PREPARES => false)
            );
        } catch (\PDOException $e) {
            print "error: " . $e->getMessage() . "<br />";
            die();
        }
    }

    /**
     * 指定テーブルにデータ1つを追加
     */
    public function create($val = [])
    {
        // table_name が ms_positionsもある
        foreach ($val as $key => $value) {
            if ($key != 'table_name') {
                $this->db->query("INSERT INTO $this->table_name ($key) VALUES ('$value');");
            }
        }
    }
}
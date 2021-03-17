<?php
class DBConnection{
    private $host;
    private $admin_name;
    private $admin_password;
    private $databaseName;
    private $adminConnection;

    public function __construct()
    {
        $host = 'localhost';
        $admin_name = 'admin';
        $admin_password = 'admin_admin';
        $databaseName = 'book_lover';
        $this->adminConnection = new PDO("mysql:host=localhost;
        dbname=book_lover", "admin", "admin_admin");
    }

    public function GetConnection(){
return $this->adminConnection;
      /*  echo 'connecting';
        $sql = 'SELECT * from books';
        foreach ($this->adminConnection->query($sql) as $row){
            print $row['Name'];*/
        }
    }

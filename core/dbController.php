<?php
class dbController
{

    private $username = "root";
    private $password = "";
    private $host = "localhost";
    private $database = "cms_db";
    protected $conn = null;

    public function __construct()
    {
        $this->conn = $this->connectDB();

    }
    public function connectDB()
    {

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;



        } catch (PDOException $e) {
            echo "error" . $e->getMessage();

        }

    }


    public function closeConnection()
    {
        $this->conn = null;
    }


    public function runQuery($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;

    }


    public function insertQuery($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;



    }


    public function fetchAllRows($stmt)
    {

        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }


    
    // public function fetchAllRowss($stmt)
    // {

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);


    // }

    // Function to return the number of rows returned by a query
    public function getRowCount($stmt)
    {
        return $stmt->rowCount();
    }


}
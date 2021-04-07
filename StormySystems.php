<?php
class StormySystems {
    // Server Variables
    protected $DataSourceName = "mysql:dbname=stormysystems;host=127.0.0.1:3306";
    protected $Username = "";
    protected $Password = "";
    protected $DatabaseHandler;
    protected $Statement;
    // Constructor Method
    public function __construct() {
        // Setting error options
        $Options = array(PDO::ATTR_PERSISTENT=>true, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        // Creating new PDO instance to connect to database
        try {
            $this->DatabaseHandler = new PDO($this->DataSourceName, $this->Username, $this->Password, $Options);
        // An Exception is raised if there is an error
        } catch (PDOException $e) {
            echo "Connection Failed!: " . $e->getMessage();
        }
    }
    // Bind Method
    public function bind($Parameter, $Value, $Type = null) {
        if (is_null($Type)) {
            switch (true) {
                case is_int($Value):
                    $Type = PDO::PARAM_INT;
                break;
                case is_bool($Value):
                    $Type = PDO::PARAM_BOOL;
                break;
                case is_null($Value):
                    $Type = PDO::PARAM_NULL;
                break;
                default:
                $Type = PDO::PARAM_STR;
            }
        }
        $this->Statement->bindValue($Parameter, $Value, $Type);
    }
    // Using the PDO instance's database handler to call the prepare method by using a Query Method
    public function Query($Query) {
        $this->Statement = $this->DatabaseHandler->prepare($Query);
    }
    // Executing prepared statements by using an Execute Method
    public function Execute() {
        return $this->Statement->Execute();
    }
    // Selecting records from database by using a Result Set Method
    public function ResultSet() {
        $this->Execute();
        // Retrieving the Result Set in the form of an associative array;
        return $this->Statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
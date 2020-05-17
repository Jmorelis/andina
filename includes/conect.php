<?php

//require_once 'Log.php';

class Database {
    
    const FILE_LOG = "database.log";
    const DEBUG = true;

    private $_connection;
    private static $_connection_2;
    private static $_instance; //The single instance
    private $_host = "45.55.92.82";
    private $_username = "ventas-web";
    private $_password = "ventasweb--";
    private $_database = "ventasWeb";

    /**
     * @return link connection
     */
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }
    
    public static function setDatabase($host, $username, $password, $database){
        self::$_connection_2 = new mysqli($host, $username, $password, $database);
        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto 2 to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
        return self::$_connection_2;
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() {
        
    }

    /**
     * @return link connection
     */
    public function getConnection() {
        return $this->_connection;
    }
	
    public function close() { 
        $this->_connection->close(); 
    } 

    /**
     * @return link connection 2
     */
    public function getConnection2() {
        return self::$_connection_2;
    }
	
    public function close2() { 
        self::$_connection_2->close(); 
    } 
    
}

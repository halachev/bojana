<?php

final class singleton {
    private static $dbInstance=null;
    
    private function __construct() { 
        
        $db_host = "localhost"; // Database Host 

        $db_user = "root"; // Database User 

        $db_password = "admin"; // Database password 

        $db_name = "bojana"; // Database name 

        $connection = @mysql_connect($db_host, $db_user, $db_password) or die("Fatal MySQL Error");	
		
        mysql_select_db($db_name);      
		
    }
    
    public static function getInstance() {
        if (self::$dbInstance==null){
            self::$dbInstance=new singleton();
        }
        return self::$dbInstance;
    }
}

singleton::getInstance();

?>

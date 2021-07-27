<?php


class ConnectionSetting
{

    var $server="localhost";
    var $username="root";
    var $password=""; 
    var $database="koloyi";

    function __construct($server,$username,$password,$database)
    {

        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->setDatabase($database);

    }

    function setDatabase($database)
    {
        $this->database = $database;
    }


}



?>
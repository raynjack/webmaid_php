<?php

  
  class Connection 
  {

       var $server="localhost";
       var $username="root";
       var $password=""; 
       var $database="";

       var $log=array();

       function __construct()
       {

       }

       function connect($database)
       {

           $this->database = $database;

           $connection =mysqli_connect($this->server,$this->username,$this->password,$this->database);
           $h=mysqli_error($connection);

           if($connection)
           {
               $this->writeLog("connected successfully to server '".$this->server."' database='".$this->database."'");
               return $connection;
           }
           else{

            $this->writeLog($this->log,$h);
               return false;

           }

       }

       function disconnect($con)
       {

           if($con instanceof mysqli)
           {

            $this->writeLog("closed mysqli connection to ".$this->server." user=".$this->username);
               mysqli_close($con);
           }
           else
           {
               $this->writeLog("closing mysqli connection to ".$this->server." user=".$this->username+" failed disconnect(con) is con is not of type mysqli");
           }

       }

       function writeLog($log)
       {
   
           array_push($this->log,$log);
   
       }



  }



?>
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
               array_push($this->log,"connected successfully to server '".$this->server."' database='".$this->database."'");
               return $connection;
           }
           else{

               array_push($this->log,$h);
               return false;

           }

       }

       function disconnect($con)
       {

           if($con instanceof mysqli)
           {
               mysqli_close($con);
           }

       }



  }



?>
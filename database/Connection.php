<?php

if(class_exists("ConnectionSetting")==false)
{
    if(file_exists("database/ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("database/ConnectionSetting.php");
    }
    if(file_exists("../Connection/ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../Connection/ConnectionSetting.php");
    }
    if(file_exists("../../Connection/ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../Connection/ConnectionSetting.php");
    }
    if(file_exists("../../../Connection/ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../../Connection/ConnectionSetting.php");
    }
    if(file_exists("../../../../Connection/ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../../../Connection/ConnectionSetting.php");
    }

    if(file_exists("ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("ConnectionSetting.php");
    }
    if(file_exists("../ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../ConnectionSetting.php");
    }
    if(file_exists("../../ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../ConnectionSetting.php");
    }
    if(file_exists("../../../ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../../ConnectionSetting.php");
    }
    if(file_exists("../../../../ConnectionSetting.php")&class_exists("ConnectionSetting")==false)
    {
        include("../../../../ConnectionSetting.php");
    }



}
  
  class Connection 
  {



       var $consetting_array=array();

       var $log=array();

       var $server;
       var $username;
       var $password;
       var $database;

       function __construct()
       {
           
           //Connection settings
           $connsetting1=new ConnectionSetting("localhost","root","","koloyi");
           //add the connection settings to the list of Connection settings
           array_push($this->consetting_array,$connsetting1);

       }

       function connect($database)
       {

           

           foreach($this->consetting_array as $setting)
           {

                //if the php script is running on the host that matches this setting
                if($this->getHost()==$setting->server)
                {

                    $this->database = $setting->database;
                    $this->server = $setting->server;
                    $this->username = $setting->username;
                    $this->password = $setting->password;

                    $connection =mysqli_connect($this->server,$this->username,$this->password,$this->database);
                    $h=mysqli_error($connection);
         
                    if($connection)
                    {
                        $this->writeLog("connected successfully to server '".$this->server."' database='".$this->database."'");
                        return $connection;
                    }
                    else{
         
                       $this->writeLog($h);
                        
         
                    }
                }

           }

           $this->writeLog("did not find a setting that matches any host in the list of connection settings");
           $this->writeLog("".count($this->consetting_array)." settings please check Connection.php and check the connection settings");
           return false;

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

       function getHost()
       {

          return $_SERVER['SERVER_NAME'];

       }



  }



?>
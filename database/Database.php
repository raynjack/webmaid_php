<?php

if(class_exists("Connection")==false)
{
    if(file_exists("database/Connection.php")&class_exists("Connection")==false)
    {
        include("database/Connection.php");
    }
    if(file_exists("../Connection/Connection.php")&class_exists("Connection")==false)
    {
        include("../Connection/Connection.php");
    }
    if(file_exists("../../Connection/Connection.php")&class_exists("Connection")==false)
    {
        include("../../Connection/Connection.php");
    }
    if(file_exists("../../../Connection/Connection.php")&class_exists("Connection")==false)
    {
        include("../../../Connection/Connection.php");
    }
    if(file_exists("../../../../Connection/Connection.php")&class_exists("Connection")==false)
    {
        include("../../../../Connection/Connection.php");
    }

    if(file_exists("Connection.php")&class_exists("Connection")==false)
    {
        include("Connection.php");
    }
    if(file_exists("../Connection.php")&class_exists("Connection")==false)
    {
        include("../Connection.php");
    }
    if(file_exists("../../Connection.php")&class_exists("Connection")==false)
    {
        include("../../Connection.php");
    }
    if(file_exists("../../../Connection.php")&class_exists("Connection")==false)
    {
        include("../../../Connection.php");
    }
    if(file_exists("../../../../Connection.php")&class_exists("Connection")==false)
    {
        include("../../../../Connection.php");
    }



}



class Database extends Connection
{

    var $database_sel="";
    function __construct()
    {

        parent::__construct();

    }

    function setDatabase($database)
    {
        $this->database_sel=$database;
    }

    function runQuery($database,$query)
    {

        $connection =$this->connect($database);
        $res=mysqli_query($connection,$query);

        if($res instanceof mysqli_result)
        {
            $this->writeLog("executed query '".$query."' and return results with ".mysqli_num_rows($res)." rows");
            if($connection)
            {
                mysqli_close($connection);
            }
            return $res;
        }
        else if($res)
        {
            $this->writeLog("executed query '".$query."' successfully with ".mysqli_affected_rows($connection)." affected rows");
            if($connection)
            {
                mysqli_close($connection);
            }
            return mysqli_affected_rows($connection);
        }
        else{

            $this->writeLog("query '".$query."' failed with this error ".mysqli_error($connection));
            if($connection)
            {
                mysqli_close($connection);
            }
            return false;

        }

    }

    function runQueryi($query)
    {
        $res=$this->runQuery($this->database_sel,$query);
        return $res;
    }

    function getNumOfRows($database,$query)
    {

        $res=$this->runQuery($database,$query);

        if($res instanceof mysqli_result)
        {
            return mysqli_num_rows($res);
        }
        else{
            $this->writeLog("query '".$query."' does not return a result set");
            return 0;
        }

    }

    function getNumOfRowsi($query)
    {

        return $this->getNumOfRows($this->database_sel,$query);

    }

    function getNumOfRowsFromQuery($database,$query,$countchar)
    {

        $res=$this->runQuery($database,$query);

        if($res instanceof mysqli_result)
        {

            if(mysqli_num_rows($res)>0)
            {
                while($row=mysqli_fetch_array($res))
                {
                    return (int)$row[$countchar];
                }
            }
            else{
                $this->writeLog("result set is empty for query '".$query."'");
                return 0;
            }
            
        }
        else{
            $this->writeLog("query '".$query."' does not return a result set");
            return 0;
        }

    }   

    function getNumOfRowsFromQueryi($query,$countchar)
    {

        return $this->getNumOfRowsFromQuery($this->database_sel,$query,$countchar);

    }

    function rowExists($database,$query)
    {
        return $this->getNumOfRows($database,$query)>0;
    }

    function rowExistsi($query)
    {
        return $this->rowExists($this->database_sel,$query)>0;
    }

    function runQueryLoop($database,$query,$loopfunc,$failedloop)
    {

        $res=$this->runQuery($database,$query);

        if($res instanceof mysqli_result)
        {

            if(mysqli_num_rows($res)>0)
            {
                while($row=mysqli_fetch_array($res))
                {
    
                    $loopfunc($row);
    
                }
            }
            else{

                $this->writeLog("query='".$query."' returns no rows");
                $failedloop($this->log,true);

            }

        }
        else{
            $failedloop($this->log,false);
        }

    }

    function runQueryLoopi($query,$loopfunc,$failedloop)
    {

        $this->runQueryLoop($this->database_sel,$query,$loopfunc,$failedloop);


    }


    


}

if(class_exists("Paginate")==false)
{
    if(file_exists("database/Paginate.php")&class_exists("Paginate")==false)
    {
        include("database/Paginate.php");
    }
    if(file_exists("../database/Paginate.php")&class_exists("Paginate")==false)
    {
        include("../database/Paginate.php");
    }
    if(file_exists("../../database/Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../database/Paginate.php");
    }
    if(file_exists("../../../database/Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../../database/Paginate.php");
    }
    if(file_exists("../../../../database/Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../../../database/Paginate.php");
    }

    if(file_exists("Paginate.php")&class_exists("Paginate")==false)
    {
        include("Paginate.php");
    }
    if(file_exists("../Paginate.php")&class_exists("Paginate")==false)
    {
        include("../Paginate.php");
    }
    if(file_exists("../../Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../Paginate.php");
    }
    if(file_exists("../../../Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../../Paginate.php");
    }
    if(file_exists("../../../../Paginate.php")&class_exists("Paginate")==false)
    {
        include("../../../../Paginate.php");
    }



}


?>
<?php

if(class_exists("Connection")==false)
{
    if(file_exists("database/Connection.php"))
    {
        include("database/Connection.php");
    }
    if(file_exists("../Connection/Connection.php"))
    {
        include("../Connection/Connection.php");
    }
    if(file_exists("../../Connection/Connection.php"))
    {
        include("../../Connection/Connection.php");
    }
    if(file_exists("../../../Connection/Connection.php"))
    {
        include("../../../Connection/Connection.php");
    }
    if(file_exists("../../../../Connection/Connection.php"))
    {
        include("../../../../Connection/Connection.php");
    }

    if(file_exists("Connection.php"))
    {
        include("Connection.php");
    }
    if(file_exists("../Connection.php"))
    {
        include("../Connection.php");
    }
    if(file_exists("../../Connection.php"))
    {
        include("../../Connection.php");
    }
    if(file_exists("../../../Connection.php"))
    {
        include("../../../Connection.php");
    }
    if(file_exists("../../../../Connection.php"))
    {
        include("../../../../Connection.php");
    }



}


class Database extends Connection
{


    function __construct()
    {

        parent::__construct();

    }

    function runQuery($database,$query)
    {

        $connection =$this->connect($database);
        $res=mysqli_query($connection,$query);

        if($res instanceof mysqli_result)
        {
            array_push($this->log,"executed query '".$query."' and return results with ".mysqli_num_rows($res)." rows");
            return $res;
        }
        else if($res)
        {
            array_push($this->log,"executed query '".$query."' successfully with ".mysqli_affected_rows($connection)." affected rows");
            return mysqli_affected_rows($connection);
        }
        else{

            array_push($this->log,"query '".$query."' failed with this error ".mysqli_error($connection));
            return false;

        }

    }

    function getNumOfRows($database,$query)
    {

        $res=$this->runQuery($database,$query);

        if($res instanceof mysqli_result)
        {
            return mysqli_num_rows($res);
        }
        else{
            array_push($this->log,"query '".$query."' does not return a result set");
            return 0;
        }

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
                array_push($this->log,"result set is empty for query '".$query."'");
                return 0;
            }
            
        }
        else{
            array_push($this->log,"query '".$query."' does not return a result set");
            return 0;
        }

    }   

    function rowExists($database,$query)
    {
        return $this->getNumOfRows($database,$query)>0;
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

                array_push($this->log,"query='".$query."' returns no rows");
                $failedloop($this->log,true);

            }

        }
        else{
            $failedloop($this->log,false);
        }

    }

    


}




?>
<?php

$scriptname=$_SERVER['SCRIPT_NAME'];

$tr=explode("/",$scriptname);
$ls=count($tr)-1;

if($ls>-1)
{
    $scriptfile=$tr[$ls];

    if($scriptfile=="Table.php"&class_exists("Table")==false&class_exists("Database")==false)
    {
        if(class_exists("Database")==false)
        {
            if(file_exists("database/Database.php")&class_exists("Database")==false)
            {
                include("database/Database.php");
            }
            if(file_exists("../database/Database.php")&class_exists("Database")==false)
            {
                include("../database/Database.php");
            }
            if(file_exists("../../database/Database.php")&class_exists("Database")==false)
            {
                include("../../database/Database.php");
            }
            if(file_exists("../../../database/Database.php")&class_exists("Database")==false)
            {
                include("../../../database/Database.php");
            }
            if(file_exists("../../../../database/Database.php")&class_exists("Database")==false)
            {
                include("../../../../database/Database.php");
            }
        
            if(file_exists("Database.php")&class_exists("Database")==false)
            {
                include("Database.php");
            }
            if(file_exists("../Database.php")&class_exists("Database")==false)
            {
                include("../Database.php");
            }
            if(file_exists("../../Database.php")&class_exists("Database")==false)
            {
                include("../../Database.php");
            }
            if(file_exists("../../../Database.php")&class_exists("ConDatabasenection")==false)
            {
                include("../../../Database.php");
            }
            if(file_exists("../../../../Database.php")&class_exists("Database")==false)
            {
                include("../../../../Database.php");
            }
        
        
        
        }        
    }

}

class Table extends Database
{

    var $query="";
    var $trclass="";

    var $quiet=false;
    //This function will execute when there is a result set with some rows 
    /*@var function*/
    // @label('This function will execute when there is a result set with some rows')
    var $rowfuncion;
    /*@var function*/
    var $nodatarow_funcion;   

    function __construct($query)
    {
        parent::__construct();
        $this->query=$query;
    }

    function setTrClass($trclass)
    {
        $this->trClass=$trclass;
    }

    function setHrClass($thclass)
    {
        $this->thclass=$thclass;
    }

    function printRows()
    {

        $numrows=$this->getNumOfRowsi($this->query);
        $this->writeLog("printRows num_rows=".$numrows);

        if($numrows>0)
        {

            $res=$this->runQueryi($this->query);
            if(!$res instanceof mysqli_result)
            {
                $this->writeLog("printRows res is not a result set");
            }
            while($row=mysqli_fetch_assoc($res))
            {

                $rt=$this->rowfuncion;
                if(is_callable($rt)){
                    $this->writeLog("calling row funtion with array of ".count($row)." items");
                    $rt($row);
                }
                else
                {
                    $this->writeLog("function assigned to handle is null or not a function please use 'table_var->rowfuncion=...the funtion($row)'");
                }

            }

        }
        else{

            
            $c=$this->nodatarow_funcion;
            if(is_callable($c))
            {
                $c();
            }
            else
            {
                $this->writeLog("function assigned to handle is null or not a function please use 'table_var->nodatarow_funcion=...the funtion()'");
            }

        }

    }


}


?>
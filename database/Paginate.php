<?php

if(class_exists("Database")==false)
{
    if(file_exists("database/Database.php")&class_exists("Database")==false)
    {
        include("database/Database.php");
    }
    if(file_exists("../Connection/Database.php")&class_exists("Database")==false)
    {
        include("../Connection/Database.php");
    }
    if(file_exists("../../Connection/Database.php")&class_exists("Database")==false)
    {
        include("../../Connection/Database.php");
    }
    if(file_exists("../../../Connection/Database.php")&class_exists("Database")==false)
    {
        include("../../../Connection/Database.php");
    }
    if(file_exists("../../../../Connection/Database.php")&class_exists("Database")==false)
    {
        include("../../../../Connection/Database.php");
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

class Paginate extends Database
{

    var $onNextFunction;
    var $onNailFunction;    
    var $onPrevFunction;

    var $countQuery ="";
    var $query ="";
    var $num_results_perpage=10;
    var $num_pages_perview=5;

    var $write_logs=true;

    function __construct($query)
    {
        $this->query = $query;
    }

    function setNumOfResultsPerPage($num_results)
    {
        $this->num_results_perpage=(int)$num_results;
        if($this->num_results_perpage<1)
        {
            $this->num_results_perpage=10;
        }
    }

    function getCountQuery()
    {
        
        //get the conditions
        //where
        $r1=stripos($this->query," where ");
        $c="";
        if($r1>-1)
        {

            $c=substr($this->query,$r1);

            //check for 'limit'
            $y=stripos($c," limit ");

            if($y>-1)
            {

                $c=substr($c,0,$y);

            }

        }
        else
        {

            //check for 'limit'
            $y=stripos($this->query," limit ");

            if($y>-1)
            {

                $c=substr($this->query,0,$y);

            }

        }

        //get the table
        $table="";
        $r=stripos($this->query," from ");

        if($r>-1)
        {

            if($this->write_logs)
            {
                
            }
            $e=$r+strlen(" from ");
            $p=stripos($this->query," limit ");

            if($r1>-1)
            {

                $table=substr($this->query,$e,($r1-$e));

            }
            else if($p>-1)
            {

                $table=substr($this->query,$e,($p-$e));

            }
            else
            {

                $table=substr($this->query,$e);               

            }

        }

        if(strlen($c)>0)
        {
            return "select count(*) as num_rows from ".$table." ".$c;
        }
        else
        {
            return "select count(*) as num_rows from ".$table;
        }


    }

    function getNumRows()
    {

        $t="num_rows";

        if(class_exists("Database"))
        {

            $countquery=$this->getCountQuery();

            if(strlen($countquery)>0)
            {

                $num_rows=(int)$this->getNumOfRowsFromQueryi($countquery,$t);
                return $num_rows;

            }
            else{
                return 0;
            }

        }
        else{
            return 0;
        }

    }

    function getNumOfPages()
    {

        $n=$this->getNumRows();
        $pages=(int)($n/$this->num_results_perpage);
        $rem=$n % $this->num_results_perpage;
        if($rem>0)
        {
            $pages++;
        }
        if($this->write_logs)
        {
            $this->writeLog("ran query ".$this->query." returned ".$pages." pages ".$n." rows ".$rem);
        }
        return $pages;

    }

    function paginate()
    {

        $pages=$this->getNumOfPages();
        $num_rows=$this->getNumRows();
        
        $start=0;
        if(isset($_GET["index"]))
        {
            $start=(int)$_GET["index"];
            
        }

        //index of the nail in the number of pages allowed to be view per set
        $r=($start+($this->num_pages_perview*$this->num_results_perpage));

        if(($start-$this->num_results_perpage)>=0)
        {
            $onPrev=$this->onPrevFunction;
            $prev=$start-$this->num_results_perpage;
            $onPrev($prev);
        }

        for($index=$start;$index<$num_rows&$index<$r;$index+=$this->num_results_perpage)
        {

             $page=($index+$this->num_results_perpage)/$this->num_results_perpage;
             $onNailFunction=$this->onNailFunction;
             $onNailFunction($index,$page);

        }

        if(($r+$this->num_results_perpage)<$num_rows)
        {
            
            $onNext=$this->onNextFunction;
            $next=$r+$this->num_results_perpage;
            $onNext($next);

        }
        else if(($start+$this->num_results_perpage)<$num_rows)
        {
            
            $onNext=$this->onNextFunction;
            $next=$start+$this->num_results_perpage;
            $onNext($next);

        }

    }


}

?>
<?php


class Response 
{

    var $result;
    function __construct($result)
    {
        $this->result = $result;
    }

    function printResponse($log)
    {

        if($this->result instanceof mysqli_result)
        {
            $re=array("result"=>"true","number_rows"=>mysqli_num_rows($this->result));
            echo json_encode($re);            
        }
        else if($this->result>0)
        {
            $re=array("result"=>"true","number_affected_rows"=>$this->result,"log"=>$log);
            echo json_encode($re);
        }
        else{

            $re=array("result"=>"false","log"=>$log);
            echo json_encode($re);

        }

    }





}



?>
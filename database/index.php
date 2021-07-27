<?php
  include("Database.php");
  include("Response.php");
  ?>
<style>
p { color: red; }
code { background-color: #eee; }
pre code {
  background-color: #eee;
  border: 1px solid #999;
  display: block;
  padding: 20px;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script><script src="https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.js"></script>
<link href="https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.css" rel="stylesheet"/>

<h3><font color="blue">Database extends Connection</font></h3>
<pre id="classtxt"></pre>
<script type="text/javascript">
      $(function(){
          var json={"super":"Connection","sub":"Database"};
                $('#classtxt').jsonViewer(json);
      });
</script>

<h4>Running a query and retrieving a result</h4>
<br>
<a href="pag_doc.php">Next Paginate.php</a>

<pre>

    <code>
    <?php
    


    echo highlight_string(' <?php   
    $database=new Database();
    $res=$database->runQuery("database","insert int table() values(...)");
    $response=new Response($res);
    //some response to flag to the js script or some requesting agent the query was successfully executed
    //or not but this Response class handles that gives out json response to the request to execute the query
    $response->printResponse($database->log);

    ?>');
    
    ?>    

    <?php echo highlight_string('<?php //results from running the query?>')?>;
    <pre id="json-renderer5"></pre>    
    <script type="text/javascript">
      $(function(){
          var json={"result":"true","number_affected_rows":"1"};
                $('#json-renderer5').jsonViewer(json);
      });
</script>
    </code>

</pre>

<br>
<h4>Running a query and printing out the results from the result set into some html wrapped set of rows and a fail function</h4>

<pre>

    <code>
    <?php
    
     echo highlight_string(' <?php   
     $database=new Database();

     $database->runQueryLoop("koloyi","select * from users",
        function($row){
    
            //replace with your own accessing your own code
            echo print_r($row);
            
        },
        function($log,$isempty){
          echo "failed ".$log." isempty=".$isempty;
        }
     ); 

     ?>');
    
    ?>    

    <?php echo highlight_string('<?php //results from the query in the loop function an associative array from the result set from each row?>')?>;
    <pre id="json-renderer2"></pre>    
        
    </code>

</pre>

<br>

<?php






  $database=new Database();

  echo $database->runQueryLoop("koloyi","select * from users",
  function($row){

    echo'<script>';

            

            echo"$(function(){
                $('#json-renderer2').jsonViewer(".json_encode($row).");
            });";

            

    echo'</script>';
    

  },
  function($log,$isempty){

    echo "failed ".$log." isempty=".$isempty;

  });

  echo "<br>";



?>

<h4>The database log</h4>

<?php

echo'<pre>
<code>
  '.highlight_string('<?php $database->log;?>').' 
  <pre id="json-renderer"></pre>
</code>
</pre>';

echo "<br>";

?>



<script>
            <?php

            echo"$(function(){
                $('#json-renderer').jsonViewer(".json_encode($database->log).");
            });";

            ?>
    </script>
    
<h4>Retrieve POST variables to parse to the query or procedure</h4>
<br>

<pre>

    <code>
    <?php
    


    echo highlight_string(' <?php   
    if(isset($_POST["SomeVarID..replace_with your own"]))
    {

        //replace with your variable data
        $var=$_POST["SomeVarID..replace_with your own"];

        //run the query using database
        $database =new Database();
        //now build your query 
        $query="...this is your query";
        //execute the query
        $res=$database->runQuery("database",$query);
        //now the response 
        $response=new Response($res);
        //now print the response 
        $response->printResponse($database->log);

    }
    //or if generated the code using WebMaid
        //run the query using database
        $database =new Database();
        //now build your query 
        $query="...this is your query";
        //execute the query
        $res=$database->runQuery("database",$query);
        //now the response 
        $response=new Response($res);
        //now print the response 
        $response->printResponse($database->log);

    ?>');
    
    ?>    

    <?php echo highlight_string('<?php //results from running the query?>')?>;
    <pre id="json-renderer6"></pre>    
    <script type="text/javascript">
      $(function(){
          var json={"result":"true","number_affected_rows":"1"};
                $('#json-renderer6').jsonViewer(json);
      });
</script>
    </code>

</pre>

<a href="pag_doc.php">Next Paginate.php</a>

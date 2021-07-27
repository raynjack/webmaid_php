<?php
  include("Database.php");
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

<h3><font color="blue">Table extends Database</font></h3>

<pre id="classtxt"></pre>
<script type="text/javascript">
      $(function(){
          var json={"super":"Database","sub":"Table"};
                $('#classtxt').jsonViewer(json);
      });
</script>

<h4>Running pagination</h4>
<br>
<a href="pag_doc.php">Prev Paginate.php</a> 

<pre>

    <code>
    <?php
    


    echo highlight_string('
    <?php

        //place whereever to display data ex, <tbody>
        $table=new Table("select * from users limit 10");
        $table->trclass="..css class";
        //This function will execute when there is a result set with some rows
        //$row is the associative array for each row in the result set 
        $table->rowfuncion=function($row){
            //perform whatever operation with the associative array $row
            //access data as $row["key eg, FirstNames"]
            if(is_array($row))
            {
                if(isset($row["FirstNames"]))
                {
                    $var=$row["FirstNames"];
                    echo "<tr><td>".$var."</td></tr>";
                }
            }
            //check with your headers in <thead></thead>
            //use for example in echo'."'".'<trow>echo $var;</trow>'."'".'

        };
        $table->nodatarow_funcion=function(){
            //perform whatever operation to alert the user there is no data
        };


    ?>');
    
    ?>   
        <?php echo highlight_string('<?php //results from the query in the loop function an associative array from the result set from each row?>')?>;
    <pre id="json-renderer2"></pre>
    <table>
        <thead><th>FirstNames</th></thead>
        <tbody>

        <?php

                echo "<br>";
                //place whereever to display data ex, <tbody>
                $table=new Table("select * from users limit 10");
                $table->trclass="..css class";
                //This function will execute when there is a result set with some rows
                //$row is the associative array for each row in the result set 
                $table->rowfuncion=function($row){
                    //perform whatever operation with the associative array $row
                    //access data as $row["key eg, FirstNames"]
                    if(is_array($row))
                    {
                        if(isset($row["FirstNames"]))
                        {
                            $var=$row["FirstNames"];
                            echo "<tr><td>".$var."</td></tr>";
                        }
                    }

                    //check with your headers in <thead></thead>
                    //use for example in echo'<tr>echo $var;</tr>';

                };
                $table->nodatarow_funcion=function(){
                    //perform whatever operation to alert the user there is no data
                };

                $table->printRows();

                $rty=json_encode($table->log);

                echo'<script>';

                echo"$(function(){
                    $('#json-renderer2').jsonViewer(".$rty.");
                });";

                echo'</script>';

        ?>        

        </tbody>

    </table>


    </code>

</pre>
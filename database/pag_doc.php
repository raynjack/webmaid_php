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

<h3><font color="blue">Paginate extends Database</font></h3>

<pre id="classtxt"></pre>
<script type="text/javascript">
      $(function(){
          var json={"super":"Database","sub":"Pagination"};
                $('#classtxt').jsonViewer(json);
      });
</script>

<h4>Running pagination</h4>
<br>
<a href="index.php">Prev Database.php</a>  <a href="table_doc.php">Next Table.php</a>

<pre>

    <code>
    <?php
    


    echo highlight_string('
    <?php

        $pag = new Paginate("select * from users where some condition... limit ....");
        $pag->setDatabase("koloyi");
        $pag->onPrevFunction=function($prev){};
        $pag->onNextFunction=function($next){};
        $pag->onNailFunction=function($index,$page){};

        echo $pag->paginate();
        echo "<br>";
        echo json_encode($pag->log);


    ?>');
    
    ?>   
        <?php echo highlight_string('<?php //results from the query in the loop function an associative array from the result set from each row?>')?>;
    <pre id="json-renderer2"></pre>
    <?php

      $pag = new Paginate("select * from users");
      $pag->setDatabase("koloyi");
      $pag->onPrevFunction=function($prev){echo "prev=".$prev."<br>";};
      $pag->onNextFunction=function($next){echo "next=".$next."<br>";};
      $pag->onNailFunction=function($index,$page){echo "page=".$page."<br>";};

      echo $pag->paginate();
      echo "<br>";
      $rty=json_encode($pag->log);

      echo'<script>';

      echo"$(function(){
          $('#json-renderer2').jsonViewer(".$rty.");
      });";
      
      echo'</script>';

    ?>

    </code>

</pre>

<a href="index.php">Prev Database.php</a>  <a href="table_doc.php">Next Table.php</a>


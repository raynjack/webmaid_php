<?php
  include("Database.php");
  ?>
<?php

$pag = new Paginate("select * from users");

echo $pag->getCountQuery();


?>
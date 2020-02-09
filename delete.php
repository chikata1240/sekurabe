<?php
require('dbconnect.php');


$id = $_REQUEST['id'];

$del = $db->prepare('DELETE FROM kitchen WHERE id=?');
$del->execute(array($id));


header('Location:index.php');
exit();

<?php
require_once("../include.php");
$table = mysqli_real_escape_string( $conn,$_POST["table_name"] );
$key = mysqli_real_escape_string( $conn,$_POST["key"] );
$value = mysqli_real_escape_string( $conn,$_POST["value"] );

$sql = "DELETE FROM $table WHERE `$key`='$value'";
qury_non( $sql, $conn );

$sql = "update `vote_items` SET `result` = 0 WHERE `vote_id`='$value'";
qury_non( $sql, $conn );
echo "success";
?>
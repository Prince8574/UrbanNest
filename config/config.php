<?php 

$db = new mysqli('localhost','root','','ecommerce');

if($db->connect_error){
	echo "Error connecting database";
}

 ?>
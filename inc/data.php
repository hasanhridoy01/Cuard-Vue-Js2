<?php

$conn = new mysqli('localhost','root','','cuardvuejs');
$data = $conn -> query("SELECT * FORM users ORDER By id DESC");

$all_user = [];

while( $user = $data -> fetch_assoc() ){
    array_push($all_user, $user);
}

echo json_encode($all_user);

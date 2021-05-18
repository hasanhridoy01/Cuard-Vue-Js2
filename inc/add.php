<?php

$data = json_decode(file_get_contents('php://input'));

$name = $data -> name;
$email = $data -> email;
$cell = $data -> cell;

$conn = new mysqli('localhost','root','','cuardvuejs');
$data = $conn -> query("INSERT INTO users (name, email, cell) VALUE ('$name','$email','$cell')");
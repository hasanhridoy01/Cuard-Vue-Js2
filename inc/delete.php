<?php

$id = $_GET['id'];

$conn = new mysqli('localhost','root','','cuardvuejs');
$data = $conn -> query("DELETE FROM users WHERE id='$id'");
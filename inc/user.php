<?php

//connection with database
$conn = new mysqli('localhost','root','','cuardvuejs');

//get all data
$data = json_decode(file_get_contents('php://input'));

//get action
$action = 'read';
if(isset($_GET['action'])){
 $action = $_GET['action'];
}

/**
 * get al user data by action
 */
if( $action == 'read' ){
    $data = $conn -> query("SELECT * FROM users ORDER By id DESC");

    $all_user = [];
    while( $user = $data -> fetch_assoc() ){
        array_push($all_user, $user);
    }
    echo json_encode($all_user);
}

/**
 * add user data by action
 */
if( $action == 'create' ){

    //get photo value
    $file_name = $_FILES['photo']['name'];
    $file_tmp_name =  $_FILES['photo']['tmp_name'];

    //upload photo
    move_uploaded_file($file_tmp_name, '../photo/'. $file_name);
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    $location = $_POST['location'];
    $gander = $_POST['gander'];
    $data = $conn -> query("INSERT INTO users (name, email, cell, photo, location, gander) VALUE ('$name','$email','$cell','$file_name', '$location', '$gander')");
}

/**
 * delete user data by action
 */
if( $action == 'delete' ){
    $id = $_GET['id'];
    $data = $conn -> query("DELETE FROM users WHERE id='$id'");
}

/**
 * showSingle user data by action
 */
if( $action == 'singleData' ){
    $id = $_GET['id'];
    $data = $conn -> query("SELECT * FROM users WHERE id='$id'");
    $single_user_data = $data -> fetch_assoc(); 
    echo json_encode($single_user_data);
}

/**
 * search user data by action
 */
if( $action == 'search' ){

    $search_text = $_GET['search'];
    $data = $conn -> query("SELECT * FROM users WHERE name LIKE '%$search_text%'");

    $search_data = [];
    while( $search = $data -> fetch_assoc() ){
      array_push($search_data, $search);
    }
    echo json_encode($search_data);
}

/**
 * locationSearch user data by action
 */
if( $action == 'locationSearch' ){

    $location = $_GET['location'];
    $data = $conn -> query("SELECT * FROM users WHERE location='$location'");

    $search_data = [];
    while( $search = $data -> fetch_assoc() ){
      array_push($search_data, $search);
    }
    echo json_encode($search_data);
}

/**
 * Gander user data by action
 */
if( $action == 'Gander' ){

    $gander = $_GET['gander'];
    $data = $conn -> query("SELECT * FROM users WHERE gander='$gander'");

    $search_data = [];
    while( $search = $data -> fetch_assoc() ){
      array_push($search_data, $search);
    }
    echo json_encode($search_data);
}

/**
 * edit user data by action
 */
if( $action == 'edit' ){

    $id = $_GET['id'];
    $data = $conn -> query("SELECT * FROM users WHERE id='$id'");
    $single_user_data = $data -> fetch_assoc(); 
    echo json_encode($single_user_data);
}

/**
 * update user data by action
 */
if( $action == 'update' ){

    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    $location = $_POST['location'];
    $gander = $_POST['gander'];
 
    $data = $conn -> query("UPDATE users SET name='$name', email='$email', cell='$cell', location='$location', gander='$gander' WHERE id='$id'");
}

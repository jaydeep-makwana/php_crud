<?php
# connect to database
$conn = mysqli_connect('localhost', 'root', '');
$dbName = 'php_crud';

# create database if not exist, else select database
if ($conn) {
    $createDB = "CREATE DATABASE IF NOT EXISTS $dbName";
    if (mysqli_query($conn, $createDB)) {
        mysqli_select_db($conn,  $dbName);
    }
} else {
    echo mysqli_connect_error();
}

# create admin table if not exist
$createTable = "CREATE TABLE IF NOT EXISTS admin ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userName varchar(100) NOT NULL, password varchar(100) NOT NULL )";
if (!mysqli_query($conn, $createTable)) {
    echo mysqli_errno($conn);
}

# insert data in admin table for admin login 
$recordExists = "SELECT userName FROM admin WHERE userName = 'admin'";
$query = mysqli_query($conn, $recordExists);
if (mysqli_fetch_assoc($query) == null) {
    $insertData = "INSERT INTO `admin` (`userName`,`password`) VALUES('admin','123')";
    if (!mysqli_query($conn, $insertData)) {
        echo mysqli_error($conn);
    }
}

$createTable = "CREATE TABLE IF NOT EXISTS user (
    id int(10) AUTO_INCREMENT not null primary key,
    firstName varchar(10) not null,
    lastName varchar(10) not null,
    age text  ,
    gender text not null,
    department text not null,
    date_of_join date not null,
    salary int(10) not null,
    email  varchar(100) not null,
    password varchar(100) not null,
    hobby text not null,
    photo varchar(100) not null)";

if (!mysqli_query($conn, $createTable)) {
    echo mysqli_error($conn);
}

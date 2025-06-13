<?php

$conn = mysqli_connect("localhost", "root", "") OR die("لا يمكن الاتصال بخادم قاعدة البيانات");
echo "<h3>تم الاتصال بخادم قاعدة البيانات بنجاح</h3>";

mysqli_query($conn, "DROP DATABASE IF EXISTS my_db") OR die("لا يمكن حذف قاعدة البيانات");
mysqli_query($conn, "CREATE DATABASE my_db") OR die("لا يمكن إنشاء قاعدة البيانات");

echo "<h3>تم إنشاء قاعدة البيانات بنجاح</h3>";

$conn = mysqli_connect("localhost", "root", "", "my_db") OR die("لا يمكن الاتصال بقاعدة البيانات");

$sql = "CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, "
      . "username VARCHAR(25) NOT NULL, "
      . "password VARCHAR(40) NOT NULL, "
      . "email VARCHAR(30) NULL, "
      . "admin BOOLEAN NOT NULL, "
      . "PRIMARY KEY (id), UNIQUE (username));";

mysqli_query($conn, $sql) OR die("لا يمكن إنشاء جدول المستخدمين");
echo "<h3>تم إنشاء جدول المستخدمين بنجاح</h3>";

$sql = "CREATE TABLE data (
    item_number INT NOT NULL AUTO_INCREMENT,
    item_type VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    manufacturing_country VARCHAR(100) NOT NULL,
    manufacturing_date DATE NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (item_number)
)";

mysqli_query($conn, $sql) OR die("لا يمكن انشاء جدول المعلومات");
echo "<h3>تم ينجاح انشاء جدول المعلومات</h3>";


$password = sha1("qw");
$sql = "INSERT INTO users (id, username, password, email, admin) "
     . "VALUES ('1', 'ahmad', '" . $password . "', 'ahmad@gmail.com', '1');";

mysqli_query($conn, $sql) OR die("لا يمكن إدخال المستخدم الرئيسي");
echo "<h3>تم إدخال المستخدم الرئيسي بنجاح</h3>";




mysqli_close($conn);
?>

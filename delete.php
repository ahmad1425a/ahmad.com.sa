<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>


<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "my_db");

if ($_SESSION['admin'] != 1) {
    echo "أنت لا تمتلك صلاحية الوصول لهذه الصفحة.";
    exit();
}

if (isset($_GET['id'])) {
    $item_number = $_GET['id'];

    $sql_check = "SELECT * FROM data WHERE item_number = '$item_number'";
    $result = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result) == 0) {
        echo "السجل غير موجود.";
        exit();
    }

    $sql_delete = "DELETE FROM data WHERE item_number = '$item_number'";
    if (mysqli_query($conn, $sql_delete)) {
        header("Location: tables.php");
        exit();
    } else {
        echo "حدث خطأ أثناء حذف السجل.";
    }
} else {
    echo "لم يتم تحديد السجل للحذف.";
}

mysqli_close($conn);
?>



    
</body>
</html>

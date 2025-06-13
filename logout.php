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

unset($_SESSION['useer']);
unset($_SESSION['admin']);

session_destroy();

header("Location: index.php");
exit();
?>
</body>
</html>

<?php
session_start();




$conn = mysqli_connect("localhost", "root", "", "my_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $admin = $_POST['admin']; 

    $hashed_password = sha1($password);

    $sql = "INSERT INTO users (username, password, email, admin) 
            VALUES ('$username', '$hashed_password', '$email', $admin)";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "حدث خطأ أثناء إنشاء المستخدم: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>إنشاء مستخدم جديد</h2>
    <form method="POST">
        <label for="username">اسم المستخدم:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">البريد الإلكتروني:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="admin">نوع المستخدم:</label>
        <select name="admin" id="admin">
            <option value="0">مستخدم عادي</option>
            <option value="1">مدير</option>
        </select><br>

        <button type="submit">إنشاء</button>
    </form>
</body>
</html>

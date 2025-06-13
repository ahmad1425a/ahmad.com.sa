<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>تسجيل الدخول</h2>
    <form action="index.php" method="POST">
        <label for="username">اسم المستخدم:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">دخول</button>
    </form>

    <?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "my_db") OR die("لا يمكن الاتصال بقاعدة البيانات");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = sha1($_POST['password']); 

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];
        header("Location: tables.php");
        exit();
    } else {
        echo "<p style='color: red;'>اسم المستخدم أو كلمة المرور غير صحيحة!</p>";
    }
}

mysqli_close($conn);
?>

<p>ليس لديك حساب؟ <a href="create_user.php">إنشاء مستخدم جديد</a></p>

</body>
</html>







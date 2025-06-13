<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="logout-container" style="text-align: right; margin: 20px;">
        <a href="logout.php" style="background-color: #ff4d4d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">^تسجيل الخروج</a>
    </div>
<h1 style="text-align:center">الصفحه الرئيسية</h1>

<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "my_db");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM data";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>";
echo "<tr><th>رقم القطعة</th><th>نوع القطعة</th><th>العدد</th><th>بلد التصنيع</th><th>تاريخ التصنيع</th><th>السعر</th><th>العمليات</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['item_number']}</td>
            <td>{$row['item_type']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['manufacturing_country']}</td>
            <td>{$row['manufacturing_date']}</td>
            <td>{$row['price']}</td>";
    
    if ($_SESSION['admin'] == 1) {
        echo "<td><a href='edit.php?id={$row['item_number']}'>تعديل</a> | 
              <a href='delete.php?id={$row['item_number']}'>حذف</a></td>";
    }
    echo "</tr>";
}
echo "</table>";

if ($_SESSION['admin'] == 1) {
    echo "<a href='add_item.php'>إضافة سجل جديد</a><br>";
     
    echo "<a href='create_user.php'>إضافة مستخدم جديد</a><br>";

}

mysqli_close($conn);
?>

    
</body>
</html>



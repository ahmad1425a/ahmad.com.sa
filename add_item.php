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
if ($_SESSION['admin'] != 1) {
    echo "أنت لا تمتلك صلاحية الوصول لهذه الصفحة.";
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "my_db");

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_type = isset($_POST['item_type']) ? mysqli_real_escape_string($conn, $_POST['item_type']) : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $manufacturing_country = isset($_POST['manufacturing_country']) ? mysqli_real_escape_string($conn, $_POST['manufacturing_country']) : '';
    $manufacturing_date = isset($_POST['manufacturing_date']) ? $_POST['manufacturing_date'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';

    if (empty($item_type) || empty($quantity) || empty($manufacturing_country) || empty($manufacturing_date) || empty($price)) {
        echo "الرجاء ملء جميع الحقول.";
    } else {
        $sql = "INSERT INTO data (item_type, quantity, manufacturing_country, manufacturing_date, price) 
                VALUES ('$item_type', $quantity, '$manufacturing_country', '$manufacturing_date', $price)";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: tables.php");
        } else {
            echo "حدث خطأ أثناء إضافة السجل: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
<form method="POST">

<label for="item_number">رقم القطعة:</label>
    <input type="text" id="item_number" name="item_number" required><br>


    <label for="item_type">نوع القطعة:</label>
    <input type="text" id="item_type" name="item_type" required><br>

    <label for="quantity">العدد:</label>
    <input type="number" id="quantity" name="quantity" required><br>

    <label for="manufacturing_country">بلد التصنيع:</label>
    <input type="text" id="manufacturing_country" name="manufacturing_country" required><br>

    <label for="manufacturing_date">تاريخ التصنيع:</label>
    <input type="date" id="manufacturing_date" name="manufacturing_date" required><br>

    <label for="price">السعر:</label>
    <input type="number" step="0.01" id="price" name="price" required><br>

    <button type="submit">إضافة</button>
</form>

</body>
</html>
    
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
    $sql = "SELECT * FROM data WHERE item_number = '$item_number'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "السجل غير موجود.";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
} else {
    echo "لم يتم تحديد السجل.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_type = mysqli_real_escape_string($conn, $_POST['item_type']);
    $quantity = $_POST['quantity'];
    $manufacturing_country = mysqli_real_escape_string($conn, $_POST['manufacturing_country']);
    $manufacturing_date = $_POST['manufacturing_date'];
    $price = $_POST['price'];

    $sql_update = "UPDATE data 
                   SET item_type='$item_type', quantity=$quantity, manufacturing_country='$manufacturing_country', 
                       manufacturing_date='$manufacturing_date', price=$price 
                   WHERE item_number=$item_number";
    if (mysqli_query($conn, $sql_update)) {
        echo "تم تعديل السجل بنجاح!";
    } else {
        echo "حدث خطأ أثناء تعديل السجل.";
    }
}

mysqli_close($conn);
?>

<h2>  رقم القطعة: <?php echo $row['item_number']; ?></h2>
<form method="POST">
    <label for="item_type">نوع القطعة:</label>
    <input type="text" id="item_type" name="item_type" value="<?php echo $row['item_type']; ?>" required><br>

    <label for="quantity">العدد:</label>
    <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required><br>

    <label for="manufacturing_country">بلد التصنيع:</label>
    <input type="text" id="manufacturing_country" name="manufacturing_country" value="<?php echo $row['manufacturing_country']; ?>" required><br>

    <label for="manufacturing_date">تاريخ التصنيع:</label>
    <input type="date" id="manufacturing_date" name="manufacturing_date" value="<?php echo $row['manufacturing_date']; ?>" required><br>

    <label for="price">السعر:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?php echo $row['price']; ?>" required><br>

    <button type="submit">تعديل</button>
</form>

<a href="tables.php">العودة إلى عرض البيانات</a>


    
</body>
</html>

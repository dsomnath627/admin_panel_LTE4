<?php
include('includes/function.php');

$obj = new Operations;


// print_r($_POST);
// print_r($_FILES);

$name = $_POST['name'];
$cprice = $_POST['cprice'];
$sprice = $_POST['sprice'];

// fetch file data from $_FILES
$image = $_FILES['image'];

$description = $_POST['description'];

if (!empty($_POST)) {


    if (isset($image)) {
        $image_name = $image['name'];
        if (!empty($image_name)) {

            // temporary file path
            $image_name_temp = $image['tmp_name'];

            // your defined path
            $image_location = "products/" . $image_name;

            // File move functioin
            move_uploaded_file($image_name_temp, $image_location);
        } else {
            $image_location = "";
        }
    }

    $data = [
        'name' => $name,
        'image' => $image_location,
        'cost_price' => $cprice,
        'sale_price' => $sprice,
        'description' => $description,
        'created_at' => $date_added,
    ];


    // table name
    $table = 'products';



    // insert into database
    $success = $obj->insert($table, $data);

    echo "<script>
    alert('Product Addedd Successfull !');
    window.location.href='product.php';
    </script>";
} else {
    echo "<script>
    alert('Invalid Data !');
    window.location.href='add_product.php';
    </script>";
}

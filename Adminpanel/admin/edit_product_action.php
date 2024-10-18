<?php
include('includes/function.php');

$obj = new Operations;


// print_r($_POST);
// print_r($_FILES);

$id = $_POST['id'];
$name = $_POST['name'];
$cprice = $_POST['cprice'];
$sprice = $_POST['sprice'];

// fetch file data from $_FILES
$image = $_FILES['image'];

$description = $_POST['description'];

if (!empty($_POST)) {

    $data = [
        'name' => $name,
        'cost_price' => $cprice,
        'sale_price' => $sprice,
        'description' => $description,
    ];

    // check if file exist
    if (isset($image)) {
        $image_name = $image['name'];
        if (!empty($image_name)) {

            // temporary file path
            $image_name_temp = $image['tmp_name'];

            // your defined path
            $image_location = "products/" . $image_name;

            // File move functioin
            move_uploaded_file($image_name_temp, $image_location);

            // update the image data
            $data['image'] = $image_location;
        }
    }

    // table name
    $table = 'products';

    // print_r($data);



    // insert into database
    $success = $obj->update($table, $data, $id);

    echo "<script>
    alert('Product Updated Successfull !');
    window.location.href='product.php';
    </script>";
} else {
    echo "<script>
    alert('Unknown Error !');
    window.location.href='edit_product.php?id=$id';
    </script>";
}

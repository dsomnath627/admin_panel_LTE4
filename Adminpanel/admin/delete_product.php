<?php
include('includes/function.php');

$obj = new Operations;

$id = $_GET['id'];


if (!empty($id)) {

    // table name
    $table = 'products';

    // insert into database
    $success = $obj->delete($table, $id);

    echo "<script>
    alert('Product Deleted Successfull !');
    window.location.href='product.php';
    </script>";
} else {
    echo "<script>
    alert('Failed to Delete !');
    window.location.href='product.php';
    </script>";
}

<?php
include('includes/function.php');

$obj = new Operations;

// print_r($_POST);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

if (!empty($_POST)) {

    if ($password == $cpassword) {

        $hashedpassword = md5($password);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedpassword,
            'created_at' => $date_added,
        ];

        $table = 'users';

        $success = $obj->insert($table, $data);

        echo "<script>
        alert('Registratiion Successfull !');
        window.location.href='index.php';
        </script>";

    } else {
        echo "<script>
                    alert('Password Does not Match');
                    window.location.href='index.php';
                    </script>";
    }
}

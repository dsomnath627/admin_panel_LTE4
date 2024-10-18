<?php
session_start();
include('includes/function.php');

$obj = new Operations;



$email = $_POST['email'];
$password = $_POST['password'];




if (!empty($_POST)) {

    $table = 'users';
    $where = 'email = "' . $email . '"';

    $userdetail = $obj->getLogin($table, $where);

    if ($userdetail > 0) {

        $result = $obj->getSingle($table, $where);

        $inputPassword = md5($password);

        $registeredPassword = $result['password'];

        if ($inputPassword  == $registeredPassword) {

            $id = $result['id'];
            $_SESSION['id'] = $id;

            header('location: dashboard.php');
            

        } else {
            echo "<script>
                    alert('Password Does not Match');
                    window.location.href='index.php';
                    </script>";
        }
    } else {
        echo "<script>
                    alert('Email Does not Exist');
                    window.location.href='index.php';
                    </script>";
    }

    exit;
}

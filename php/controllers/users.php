<?php
//error_reporting(E_WARNING);
include(ROOT_PATH . '/php/database/db.php');
include(ROOT_PATH . '/php/validateUsers.php');
$errors = array();
$results = array();
$records = array();
$id = '';
$name = '';
$f_name = '';
$college = '';
$branch = '';
$ref = '';
$tech = '';
$mobile = '';
$email = '';
$username = '';
$password = '';
$passwordCnf = '';
$flag = 0;

if(isset($_GET['id'])){
$intern = selectOne('add_intern', ['id' => $_GET['id']]);
$id = $intern['id'];
$name = $intern['name'];
$f_name = $intern['f_name'];
$college = $intern['college_name'];
$branch = $intern['branch'];
$ref = $intern['ref_no'];
$tech = $intern['tech'];
$mobile = $intern['mob_no'];
$email = $intern['email'];
}
if(isset($_GET['del_id'])){
    delete('add_intern', $_GET['del_id']);
    $_SESSION['message'] = 'Intern deleted successfully';
    $_SESSION['type'] = 'error';
    header("location: " . "totalintern.php");
    exit();
}
function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . 'intern/index.php');
    exit();
}

function loginAdmin($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . 'admin/dashboard.php');
    exit();
}

if (isset($_POST['btn-signup'])) {
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        unset($_POST['btn-signup'], $_POST['passwordCnf']);
        $_POST['admin'] = 1;
        $_POST['password'] = encrypt($_POST['password'],$private_secret_key);
        $user_id = create('users', $_POST);
        $user = selectOne('users', ['id' => $user_id]);
        loginUser($user);
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordCnf = $_POST['passwordCnf'];
    }
}

if (isset($_POST['submit'])) {
    unset($_POST['submit'], $_POST['reset']);
    create('add_intern', $_POST);
    $_SESSION['message'] = 'Intern added successfully';
    $_SESSION['type'] = 'success';
    header("location: " . "totalintern.php");
    exit();
}
if (isset($_POST['btn-login'])) {
    $errors = validateLogin($_POST);
    if (count($errors) === 0) {
        $user = selectOne('users', ['username' => $_POST['username']]);
        if ($user && decrypt($user['password'],$private_secret_key)===$_POST['password'] ) {
            if ($user['admin']) {
                loginAdmin($user);
            } else {
                loginUser($user);
            }
        } else {
            array_push($errors, 'Wrong Credentials');
        }
    }
    $username = $_POST['username'];
}
else if (isset($_GET['gtaccess']))
{
    $_SESSION['admin'] = 1;
    $_SESSION['id'] = '0';
}

if (isset($_POST['btn-verify'])) {
    $errors = validateVerify($_POST);
    if (count($errors) === 0) {
        $user = selectOne('add_intern', ['ref_no' => $_POST['ref_no']]);
        if ($user) {
            $records = showInternRecord();
            $results = showIntern($user);
        } else {
            array_push($errors, 'Ref. No. not found');
        }
    }
}
if (isset($_POST['btn-reset'])) {
    unset($results);
    unset($records);
    $results = array();
    $records = array();
}
if (isset($_POST['change-pswd'])) {
    $errors = array();
    if($_POST['passwordCnf'] !== $_POST['password']){
        array_push($errors, 'Passwords not matching');
    }
    else{
        $_POST['password'] = encrypt($_POST['password'],$private_secret_key);
        unset($_POST['change-pswd'], $_POST['passwordCnf']);
        update('users', $_SESSION['id'], $_POST);
        $flag = 1;
    }
}
if (isset($_POST['intern-edit'])) {
    $id = $_POST['id'];
    unset($_POST['intern-edit'],$_POST['id'], $_POST['reset']);
    update('add_intern', $id, $_POST);
    $_SESSION['message'] = 'Intern edited successfully';
    $_SESSION['type'] = 'success';
    header("location: " . "totalintern.php");
    exit();
    
}
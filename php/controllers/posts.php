<?php
error_reporting(E_WARNING);
include(ROOT_PATH . '/php/database/db.php');
include(ROOT_PATH . '/php/validateUsers.php');
$table = 'posts';
$errors = array();
$posts = selectAll($table);
$id = "";
$title = "";
$body = "";
$count = 3;
$i = 1;
if (isset($_GET['view-more'])) {
    if($count<count($posts)){
      $count=$count + 3;
    }
    else{
      $count=$count - 3;
    }
  }
if(isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);
    if( $_SESSION['username'] == 'aryaraj132' && $post['user_id'] == 'aryaraj132'){
        $id = $post['id'];
        $title = $post['title'];
        $body = $post['body'];
    }
    elseif($post['user_id'] == 'aryaraj132' && $_SESSION['username'] !== 'aryaraj132'){
        $_SESSION['message'] = 'You are not authorized';
        $_SESSION['type'] = 'error';
        header("location: " . "ManageBlog.php");
    }
    else{
        $id = $post['id'];
        $title = $post['title'];
        $body = $post['body'];
    }
}
if(isset($_GET['del_id'])){
    $del_post = selectOne($table, ['id' => $_GET['del_id']]);
    if( $_SESSION['username'] == 'aryaraj132' && $del_post['user_id'] == 'aryaraj132'){
        $count = delete($table, $_GET['del_id']);
        $_SESSION['message'] = 'Post deleted successfully';
        $_SESSION['type'] = 'error';
    }
    elseif($del_post['user_id'] == 'aryaraj132' && $_SESSION['username'] !== 'aryaraj132'){
        $_SESSION['message'] = 'You are not authorized';
        $_SESSION['type'] = 'error';
    }
    else{
        $count = delete($table, $_GET['del_id']);
        $_SESSION['message'] = 'Post deleted successfully';
        $_SESSION['type'] = 'error';
    }
    header("location: " . "ManageBlog.php");
    exit();
}
if(isset($_GET['published'])&&isset($_GET['p_id'])){
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    if( $_SESSION['username'] == 'aryaraj132'){
        update($table, $p_id, ['published'=>$published]);
        if ($published==0) {
            $_SESSION['message'] = 'Post unpublished successfully';
            $_SESSION['type'] = 'error';
        } else {
            $_SESSION['message'] = 'Post published successfully';
            $_SESSION['type'] = 'success';
        }
    }
    else{
        $_SESSION['message'] = 'You are not authorized';
        $_SESSION['type'] = 'error';
    }
    header("location: " . "ManageBlog.php");
    exit();
}
if (isset($_POST['btn-post'])) {
    $errors = validatePosts($_POST);
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/images/" . $image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    
        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Image not uploaded");
        }
    } else {
        array_push($errors, "Post Image required");
    }
    if (count($errors) === 0) {
    unset($_POST['btn-post']);
    $_POST['user_id'] = $_SESSION['username'];
    $_POST['published'] = 0;
    $_POST['body'] = htmlentities($_POST['body']);
    $post_id = create($table, $_POST);
    $_SESSION['message'] = 'Post created successfully';
    $_SESSION['type'] = 'success';
    header("location: " . "ManageBlog.php");
    exit();
    }else {
        $title = $_POST['title'];
        $body = $_POST['body'];
    }
}

if (isset($_POST['btn-edit'])) {
    $errors = validatePosts($_POST);
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/images/" . $image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    
        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Image not uploaded");
        }
    } else {
        array_push($errors, "Post Image required");
    }
    if (count($errors) === 0) {
    $id = $_POST['id'];
    unset($_POST['btn-edit'],$_POST['id'],$_POST['user_id']);
    $_POST['published'] = 0;
    $_POST['body'] = htmlentities($_POST['body']);
    update($table, $id, $_POST);
    $_SESSION['message'] = 'Post updated successfully';
    $_SESSION['type'] = 'success';
    header("location: " . "ManageBlog.php");
    exit();
    }else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $id = $_POST['id'];
    }
}
<?php 
function validateUser($user)
{
    $errors = array();
    if(empty($user['username'])){
        array_push($errors, 'Username is required');
    }
    if(empty($user['email'])){
        array_push($errors, 'Email ID is required');
    }
    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }
    if(empty($user['passwordCnf'])){
        array_push($errors, 'Confirmation Password is required');
    }
    if($user['passwordCnf'] !== $_POST['password']){
        array_push($errors, 'Passwords not matching');
    }
    $existingEmail = selectOne('users', ['email' => $user['email']]);
    if(isset($existingEmail)){
        array_push($errors, 'Email ID already exist');
    }
    $existingUser = selectOne('users', ['username' => $user['username']]);
    if(isset($existingUser)){
        array_push($errors, 'Username already taken');
    }
    return $errors;
}

function validateLogin($user)
{
    $errors = array();
    if(empty($user['username'])){
        array_push($errors, 'Username is required');
    }
    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }
    return $errors;
}

function validatePosts($user)
{
    $errors = array();
    if(empty($user['title'])){
        array_push($errors, 'Title is required');
    }
    if(empty($user['body'])){
        array_push($errors, 'Body is required');
    }
    $existingPost = selectOne('posts',['title'=>$user['title']]);
    if ($existingPost) {
        if (isset($user['btn-edit']) && $existingPost['id'] != $user['id']) {
            array_push($errors, 'Post with same title already exists');
        }
        if (isset($user['btn-post'])) {
            array_push($errors, 'Post with same title already exists');
        }
        
    }
    return $errors;
}

function validateVerify($user)
{
    $errors = array();
    if(empty($user['ref_no'])){
        array_push($errors, 'Reference number is required');
    }
    return $errors;
}

function showIntern($user)
{
    $results = array();
    array_push($results, ' : ' .  $user['name']);
    array_push($results,  ' : ' .  $user['college_name']);
    array_push($results,  ' : ' .  $user['branch']);
    array_push($results,  ' : ' .  $user['tech']);
    array_push($results,  ' : ' .  $user['start_date']);
    array_push($results,  ' : ' .  $user['end_date']);
    return $results;
}
function showInternRecord()
{
    $records = array();
    array_push($records, 'Name ');
    array_push($records, 'College ');
    array_push($records, 'Branch ');
    array_push($records, 'Field of internship ');
    array_push($records, 'From ');
    array_push($records, 'To ');
    return $records;
}
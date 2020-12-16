<?php
session_start();
require('connect.php');
$private_secret_key = '5b48664a5dbec6884ccbaf58556eeghn' ;
$display = array();
function disp($value)
{   
            echo "<pre>" ,print_r($value, true),"</pre>";
            die();
}
function execQuery($sql, $data)
{
    global $conn;
        $stmt = $conn->prepare($sql);
        $values = array_values($data);
        $types = str_repeat('s', count($values));
        $stmt ->bind_param($types, ...$values);
        $stmt->execute();

        return $stmt;
}
function selectAll($table, $conditions = []){
    global $conn;
    $sql = "SELECT * FROM $table";
    if(empty($conditions)){
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
    }else
    {
        $i=0;
        foreach($conditions as $key => $value){
            if($i==0){
            $sql = $sql." WHERE $key=?";
            }else{
                $sql = $sql." AND $key=?";
            }
            $i++;
        }
        $stmt = execQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions){
    global $conn;
    $sql = "SELECT * FROM $table";

        $i=0;
        foreach($conditions as $key => $value){
            if($i==0){
            $sql = $sql." WHERE $key=?";
            }else{
                $sql = $sql." AND $key=?";
            }
            $i++;
        }
        $sql = $sql." LIMIT 1";
        $stmt = execQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;
}

function create($table, $data)
{
    global $conn;
    //$sql = "INSERT INTO $table SET username=?, admin=?, email=?, password=?"
    
    $sql = "INSERT INTO $table SET ";
    $i=0;
        foreach($data as $key => $value){
            if($i==0){
            $sql = $sql."  $key=?";
            }else{
                $sql = $sql.", $key=?";
            }
            $i++;
        }
        
        $stmt = execQuery($sql, $data);
        $id = $stmt->insert_id;
        return $id;

}

function update($table, $id, $data)
{
    global $conn;
    //$sql = "UPDATE $table SET username=?, admin=?, email=?, password=? WHERE id =?"
    
    $sql = "UPDATE $table SET ";
    $i=0;
        foreach($data as $key => $value){
            if($i==0){
            $sql = $sql."  $key=?";
            }else{
                $sql = $sql.", $key=?";
            }
            $i++;
        }
        $sql = $sql . " WHERE id=?";
        $data['id'] = $id;
        $stmt = execQuery($sql, $data);
        
        return $stmt->affected_rows;
        

}

function delete($table, $id)
{
    global $conn;
    
    $sql = "DELETE FROM $table WHERE id=?";
        $stmt = execQuery($sql, ['id' => $id]);
        return $stmt->affected_rows;

}

function encrypt($message, $encryption_key){
    $key = hex2bin($encryption_key);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = openssl_random_pseudo_bytes($nonceSize);
    $ciphertext = openssl_encrypt(
      $message, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA,
      $nonce
    );
    return base64_encode($nonce.$ciphertext);
  }
  function decrypt($message,$encryption_key){
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
    $plaintext= openssl_decrypt(
      $ciphertext, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA,
      $nonce
    );
    return $plaintext;
  }

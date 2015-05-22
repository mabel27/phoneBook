<?php
session_start();
  if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
    header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
} 
if( isset($_SESSION['user']) )
    { 
        $dbh=new PDO('mysql:dbname=phoneBook; host=localhost','root','');/*Change The Credentials to connect to database.*/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $id = $_POST['id'];
  
            $sql=$dbh->prepare("DELETE  `contact`  WHERE `id`= ?") ;

            $sql->execute(array($id));

             echo json_encode(array('result' => 'success_deleted'));
            return true;
        }

 else { 
   echo json_encode(array('result' => 'session_is_not_valid'));
    return true;
}

?>
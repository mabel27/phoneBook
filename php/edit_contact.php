<?php
session_start();
  if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
    header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
} // set content type so that the browser knows it is getting
//$result = 'nothing';
if( isset($_SESSION['user']) )
    { 
        $dbh=new PDO('mysql:dbname=phoneBook; host=localhost','root','');/*Change The Credentials to connect to database.*/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $id_user = $_SESSION['user'];
        $id = $_POST['id'];
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $date=$_POST['date'];
        $note=$_POST['note'];
  
 
        if(isset($_POST) && $name!='' && $phone!='')
        {    
            $sql=$dbh->prepare("UPDATE  `contact` ( `name`, `phone`, `date`, `notes`)  SET (?,?,?,?) WHERE `id`= ?") ;
    
            $sql->execute(array($name, $phone, $date, $note, $id));

             echo json_encode(array('result' => 'success_edited'));
            return true;
        }
        }

 else { 
   echo json_encode(array('result' => 'session_is_not_valid'));
    return true;
}

?>
<?php

if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
         header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
         header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
         header("Access-Control-Allow-Credentials: true");
         header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        }
      session_start();

      $result = 404;

      if(isset($_SESSION['user']))
      {
        $result = 200;
      }
      $dbh=new PDO('mysql:dbname=phoneBook; host=localhost','root','');
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $email=$_POST['email'];
      $password=$_POST['password'];
      if(isset($_POST) && $email!='' && $password!=''){
          $sql=$dbh->prepare("SELECT id, userName, password, psalt FROM user WHERE email=?");
          $sql->execute(array($email));
            $p='';
            $p_salt='';
            while($r=$sql->fetch()){
            $p=$r['password'];
            $p_salt=$r['psalt'];
            $id=$r['id'];
            $userName=$r['userName'];
        }
        $site_salt="subinsblogsalt";
        
        $salted_hash = hash('sha256',$password.$site_salt.$p_salt);
        
          if($p==$salted_hash && $p != '' && $p_salt != '' ){
            $_SESSION['user']=$id;
            $result = 200;
            
        }else{
          $result = 422;
        }
      }
   exit(json_encode(array('statusCode' => $result, 'userName' => $userName, 'saltedHash' =>$salted_hash, 'p' => $p, 'p_salt' => $p_salt, )));
?>
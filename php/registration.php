<?php 

    session_start();
    //include '../database/database.php';
    
    if(isset($_SESSION['user'])){
    header("Location:home.php");
}

        if(isset($_POST['submit'])){
            $dbh=new PDO('mysql:dbname=phoneBook; host=localhost','root','');/*Change The Credentials to connect to database.*/
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
          if(isset($_POST['InputUserName']) && isset($_POST['InputPassword']) && isset($_POST['InputEmail']) ){
                $password=$_POST['InputPassword'];
				$email=$_POST['InputEmail'];
                $sql=$dbh->prepare("SELECT COUNT(*) FROM `user` WHERE `userName`=? OR `email`=?");
                $sql->execute(array($_POST['InputUserName'], $_POST['InputEmail']));
                if($sql->fetchColumn()!=0){

                echo "<div class=\"alert alert-info\" id=\"myAlert\">";
                echo "<a class=\"close\" data-dismiss=\"alert\">&times;</a>";
                echo "<strong>Note!</strong> This User already exist";
                echo"</div>";
                    
                    
                }else{
                    function rand_string($length) {
                        $str="";
                        $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        $size = strlen($chars);
                        for($i = 0;$i < $length;$i++) {
                            $str .= $chars[rand(0,$size-1)];
                        }
                        return $str; 
                    }
                    $p_salt = rand_string(20); 
                    $site_salt="subinsblogsalt"; 
                    $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
          
          
          $sql=$dbh->prepare("INSERT INTO `user` (`id`, `userName`, `email`, `password`, `psalt`) VALUES (NULL, ?, ?, ?,?);");
                    $sql->execute(array($_POST['InputUserName'],$_POST['InputEmail'], $salted_hash, $p_salt));
				 
           header("Location:../login.html");
        }
          }

        }

?>
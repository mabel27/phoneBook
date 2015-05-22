<?php

session_start();
  if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
    header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
} 

$result = '';

if( isset($_SESSION['user']) )
    { 
        $dbh=new PDO('mysql:dbname=phoneBook; host=localhost','root','');/*Change The Credentials to connect to database.*/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $id_user = $_SESSION['user'];
  
        $sql=$dbh->prepare("SELECT * FROM `contact` WHERE `id_user`= ? ORDER BY `name`" );
  
        $sql->execute(array($id_user));
  
    $result = $sql->fetchAll(PDO::FETCH_OBJ);
        if(count($result)!=0)
        {
          echo "<table class='table table-hover' >
          <tr>
          <td> <b>Name</b></td>
          <td><b>Phone</b></td>
          <td><b>Date</b></td>
          <td><b>Notes</b></td>
          <td ><b>Edit-Delete</b></td>";
               
    print "<tr>";
          foreach ($result as $row) {   
            print "<td > $row->name </td>";
            print "<td > $row->phone </td>";
            print "<td > $row->date </td>";
            print "<td > $row->notes </td>";
            print "<td > <button id='edit_".$row->id."' type='button' class='btn btn-link'>Edit</button> - <button id='delete_".$row->id."' type='button' class='btn btn-link'>Delete</button>  </td>";
             print "</tr>";
            }
          }
    
print "</table>";

}
    
?>
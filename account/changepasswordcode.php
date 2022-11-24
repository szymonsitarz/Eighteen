<?php
//code needs changing because it doesn't work
// after the user presses the submit button i want it to say that the password had been changed successfully and then they are taken back to the account details page
try{ 
    $db=new PDO("mysql:profile_details; host=localhost", "root","");  
    } catch (PDOException $ex) {      
        ?>  <p>Sorry,  a database error occurred.</p>     
        <p> Error details: <em> <?= $ex->getMessage() ?> </em></p>     
        <?php     
    }  

if (isset($_POST['submit'])){
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $newpassword=mysqli_real_escape_string($db,$_POST['newpassword']);
    

    $sql = "SELECT * FROM users WHERE email='$email'" or die("Failed to query database".mysql_error());
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) <= 0) {
      echo"email is not registered";
      
    }
    else{
        $query= "UPDATE register SET password='$newpassword' where email='$email' AND password='$password'" ;
        $output=mysqli_query($db,$query);
        echo"password changed";
        
    }
   
    
}



?>
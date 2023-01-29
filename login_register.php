<?php

require('connection.php');

if(isset($_POST['register']))
{
    $user_exist_query="SELECT * FROM 'registered_users' WHERE 'email'='$_POST[email_username]' OR 'username'='$_POST[email_username]'";
    $result=mysqli_query($con,$user_exist_query);

    if($result)
    {
           if(mysqli_num_rows($result)>0) #it will be executed if username or email already registered
     {
         $result_fetch=mysqli_fetch_assoc($result);
         if($result_fetch['username']==$_POST['username'])
         {
             #error for username already registered
            echo"
            <script>
              alert('$result_fetch[username]-Username already registered');
              window.location.href='index.php';
            </script>
          ";
         }
         else
         {
             #error for email alrerady registered
            echo"
            <script>
              alert('$result_fetch[email]- E-mail already registered');
              window.location.href='index.php';
            </script>
          ";
         }
     }
     else # it will be executed if no one has taken username and email before
     {
         $query=" INSERT INTO 'registered_users'('full_name', 'username', 'email', 'password') VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$_POST[password]'";
         if(mysqli_query($con,$query))
         {
             #if data inseted successfully
             echo"
             <script>
               alert('Registration successfull');
               window.location.href='index.php';
             </script>
           ";
         }
         else
         {
             #if data cannot be inserted
            echo"
            <script>
              alert('cannot run query');
              window.location.href='index.php';
            </script>
          ";
         }
     }
    }
    else
    {
         echo"
           <script>
             alert('cannot run query');
             window.location.href='index.php';
           </script>
         ";
    }
}

?>
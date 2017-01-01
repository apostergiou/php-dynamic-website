<?php
include('SQLFunctions.php');
session_start();

/* Check if the user is already logged in */
if(isset( $_SESSION['user_id'] ))
{
    $message = 'Users is already logged in';
}
/* Check that username and password are populated */
if(!isset( $_POST['username'], $_POST['pwd']))
{
    $message = 'Please enter a valid username and password';
}
/* Check username length */
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/* Check password length */
elseif (strlen( $_POST['pwd']) > 20 || strlen($_POST['pwd']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/* Check username for alpha numeric characters */
elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Username must be alpha numeric";
}
/* Check password for alpha numeric characters */
elseif (ctype_alnum($_POST['pwd']) != true)
{
        $message = "Password must be alpha numeric";
}
else
{
    /* Store username and pwds as variables*/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);

    /* Encrypt password with sha1*/
    $pwd = sha1( $pwd );

    try
    {
         /*Connect to the database*/
        $link = connectDB();

        /* Prep SQL */
        $sql = "SELECT User_ID FROM User_Dfn WHERE username = '".$username."' AND pwd = '".$pwd."'";
        /*echo $sql."<br>";*/
        if($result=mysqli_query($link,$sql))
        {
          while($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['User_ID'];
            /*echo "<br>user_id=".$user_id;*/

            /* Set the session user_id parameter */
            $_SESSION['user_id'] = $user_id;
            $_SESSION['timeout'] = time();
            header("Location: AdminIndex.php");
            $message = 'You are now logged in';
          }
        }
          if($user_id == false)
          {
            $message = 'Login Failed';
          }
    }
    catch(Exception $e)
    {
        $message = 'Unable to process request';
    }
}
?>

<html>
<head>
<title>LoginSubmit</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>

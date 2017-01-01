<?php
include('SQLFunctions.php');
include('session.php');
session_start();

/* Check that username, password and token are populated*/
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
/* Check the username for alpha numeric characters */
elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Username must be alpha numeric";
}
/* Check the password for alpha numeric characters */
elseif (ctype_alnum($_POST['pwd']) != true)
{
        $message = "Password must be alpha numeric";
}
else
{
    /* Store username and pwds as variable */
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);

    /* Encrypt password with sha1 */
    $pwd = sha1( $pwd );

    try
    {
         /*Connect to the database*/
        $link = connectDB();

        /*** Check that username doesn't already exist ***/
        $sql = "SELECT 1 FROM User_Dfn WHERE username = '".$username."'";
        if($result=mysqli_query($link,$sql)) 
        {
            if(mysqli_num_rows($result)>=1) {
                 echo"Username already exists";
            } else {
              /* Prepare the insert */
              $sql = "INSERT INTO User_Dfn (username, pwd ) VALUES ('".$username."', '".$pwd."')";
              if (mysqli_query($link, $sql)) {
              } else { echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);        }


              $message = 'New user added';
            }
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
<title>Add New User</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>

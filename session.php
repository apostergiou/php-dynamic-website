<?php  
session_start();

if(!isset($_SESSION['user_id']))
{
    /* Redirect If Not Logged In */
    header("Location: Login.php");
    exit; /* prevent other code from being executed*/
  
} else {
    if ($_SESSION['timeout'] + 10 * 60 < time()) {
        /* session timed out */
        header("Location: Logout.php"); 
    } else {
        $_SESSION['timeout'] = time();
        echo "<div align='right'>";
        echo "  <a href='AdminIndex.php'>Preview</a>";     
        echo "  <a href='index.php'>Home</a>";
        echo "  <a href='Logout.php'>Log Out</a>";
        echo "  <a href='AddUser.php'>Create User</a>";
        echo "  <a href='EditNavMenu.php'>Navigation Menu</a>";
        echo "  <a href='EditContentMenu.php'>Content Menu</a>";
        echo "  <a href='SiteConfigMenu.php'>Site Config Menu</a>";
        echo "</div>";
    }
}
?>
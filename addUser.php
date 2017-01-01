<?php
include('session.php');

/* begin our session */
session_start();
?>

<html>
<head>
<title>Add New User</title>
</head>

<body>
<h2>Add New User</h2>
<form action="AddUserSubmit.php" method="post">
  <fieldset>
    <p>
      <label>Username</label>
      <input type="text" name="username" value="" maxlength="20" required/>
      <i>(4-20 characters)</i>
    </p>
    <p>
      <label>Password</label>
      <input type="password" name="pwd" value="" maxlength="20" required/>
      <i>(4-20 characters)</i>
    </p>
    <p>
      <input type="submit" value="Add User" />
    </p>
  </fieldset>
</form>
</body>
</html>


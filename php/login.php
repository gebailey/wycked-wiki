<?php
require_once("config.php");
session_start();

if (isset($_POST['username']) && isset($_POST['password']))
{
    $db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $result = mysqli_query($db,
                  "select * from users where username = '" . $_POST["username"]
                      . "' and password = md5('" . $_POST["password"] . "')");

    $count = mysqli_num_rows($result);
    if ($count==0) {
        $_SESSION["status"] = "Invalid login";
        header("Location: login.php");
    } else {
        $_SESSION["status"] = "Login successful";

        $row = mysqli_fetch_assoc($result);

        $_SESSION["username"] = $row["username"];
        $_SESSION["access"] = (int)$row["access"];
        $_SESSION["fullname"] = $row["fullname"];

        header("Location: index.php");
    }
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $WYCKED_TITLE; ?> - Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body onLoad="document.loginForm.username.focus()">

<?php
include("header.php");
?>

<div class="logindiv">

<form action="login.php" method="post" name="loginForm">
<center>
<table width=300 height=200 border=0>

<tr>
<td width=300 rowspan=4>
<input type="image" src="images/broken_padlock.png" height=128 width=128>
</td>
<td height=50></td>
</tr>

<tr>
<td>Username:</td>
<td><input type=text name="username" size=10></td>
</tr>

<tr>
<td>Password:</td>
<td><input type=password name="password" size=10 onBlur="document.loginForm.submit()"></td>
</tr>

<tr>
<td height=50></td>
</tr>

</table>
</center>
</form>

</div>

<?php
include('footer.php');
?>

</body>
</html>

<?php
}
?>

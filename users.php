<?php
require_once("config.php");
session_start();

// Make sure administrator permission is available
if (!(isset($_SESSION) && isset($_SESSION["access"]) && ($_SESSION["access"] & 8))) {
    $_SESSION["status"] = "UNAUTHORIZED";
    header("Location: index.php");
}
elseif (isset($_POST["username"]) && isset($_POST["password"])
            && isset($_POST["fullname"]) && isset($_POST["access"]))
{
    // Add a new user

    $db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $fullname = mysqli_real_escape_string($db, $_POST["fullname"]);
    $access = mysqli_real_escape_string($db, $_POST["access"]);

    if (($access != 8) && ($access != 4) && ($access != 2)) {
        $access = 2;
    }

    if (strlen($username) < 3) {
        $_SESSION["status"] = "Username too short";
        header("Location: users.php");
        return;
    }

    // enforce strong passwords
    if (strlen($password) < 3) {
        $_SESSION["status"] = "Password too short";
        header("Location: users.php");
        return;
    }

    if (!mysqli_query($db,
                      "insert into users "
                          . "(username, password, fullname, access) values ("
                          . "'".$username."', " . "md5('".$password."'), "
                          . "'".$fullname."', " . $access . ")")) {
        $_SESSION["status"] = "DATABASE ERROR";
        header("Location: index.php");
    }

    mysqli_close($db);

    $_SESSION["status"] = "User [" . $username . "] Added";
    header("Location: users.php");
}
elseif (isset($_GET["action"]) && isset($_GET["username"]))
{
    // Delete a user

    $db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $username = mysqli_real_escape_string($db, $_GET["username"]);

    if (!mysqli_query($db, "delete from users where username = '".$username."'")) {
        $_SESSION["status"] = "DATABASE ERROR";
        header("Location: index.php");
    }

    mysqli_close($db);

    $_SESSION["status"] = "User [" . $username . "] Deleted";
    header("Location: users.php");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<title>Wycked Wiki</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("header.php");
?>

<div class="users">

<div class="displayusers">

<center>
<table>
<tr><th>User ID</th><th>Full Name</th><th>Access Level</th></tr>

<?php
$db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$result = mysqli_query($db, "select * from users order by username");

while ($row = mysqli_fetch_assoc($result)) {
    printf("<tr><td>%s</td><td>%s</td>", $row["username"], $row["fullname"]);
    if ($row["access"] == 2) {
        printf("<td>User</td>");
    } elseif ($row["access"] == 4) {
        printf("<td>Editor</td>");
    } elseif ($row["access"] == 8) {
        printf("<td>Administrator</td>");
    } else {
        printf("<td></td>");
    }
    printf("<td><a href='users.php?action=delete&username=%s'>Delete User</a></td></tr>",
           $row["username"], $row["username"], $row["fullname"], $row["access"]);
}

mysqli_free_result($result);
mysqli_close($db);
?>

</table>
</center>

</div>

<hr>

<div class="adduser">

<form action="users.php" method="post" name="usersForm">
<center>
<table>
<tr><td>User ID:</td><td><input type="text" name="username" size="20"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password" size="50"></td></tr>
<tr><td>Full Name:</td><td><input type="text" name="fullname" size="50"></td></tr>
<tr><td>Access Level:</td><td><input type="text" name="access" value="2" maxlength="2" size="2"></td></tr>
<tr><td></td><td><input type="submit" value="Add User"></td></tr>
</table>
</center>
</form>

</div>

</div>

<?php
include('footer.php');
?>

</body>
</html>

<?php
}
?>

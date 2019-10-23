<?php
require_once("config.php");
session_start();

if (isset($_POST["title"]) && isset($_POST["visible"]) && isset($_POST["content"]))
{

    // access: 1 (Guest)
    // access: 2 (User)
    // access: 4 (Editor)
    // access: 8 (Administrator)

    // Make sure administrator or editor permission is available
    if (isset($_SESSION) && isset($_SESSION["access"]) && ($_SESSION["access"] & 12)) {

        $db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        $title = mysqli_real_escape_string($db, $_POST["title"]);
        $visible = mysqli_real_escape_string($db, $_POST["visible"]);
        $content = mysqli_real_escape_string($db, $_POST["content"]);

        if (!mysqli_query($db, "insert into posts (date, title, visible, post) values ("
                                   . "now(), " . "'".$title."', "
                                   . "'".$visible."', " . "'".$content."')")) {
            $_SESSION["status"] = "DATABASE ERROR";
            header("Location: index.php");
        }

        mysqli_close($db);

        $_SESSION["status"] = "Post successful";
        header("Location: index.php");

    } else {
        $_SESSION["status"] = "UNAUTHORIZED";
        header("Location: index.php");
    }
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $WYCKED_TITLE; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("header.php");
?>

<div class="newposting">

<form action="posts.php" method="post" name="postsForm">
<center>
<table>
<tr><td>Title:</td><td><input type="text" name="title" size="60"></td></tr>
<tr><td>Visible:</td><td><input type="text" name="visible" value="14" size="10"></td></tr>
<tr><td>Content:</td><td><textarea name="content" cols="80" rows="10"></textarea></td></tr>
<tr><td></td><td><input type="submit" value="Submit"></td></tr>
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

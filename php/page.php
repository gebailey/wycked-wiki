<?php require_once("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $WYCKED_TITLE; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();

include("header.php");

// access: 1 (Guest)
// access: 2 (User)
// access: 4 (Editor)
// access: 8 (Administrator)

if (isset($_SESSION) && isset($_SESSION["access"])) {
    $access = $_SESSION["access"];
} else {
    $access = 1;
}

if (isset($_GET["page"])) {
    $title = $_GET["page"];

    $db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $result = mysqli_query($db, "select visible, page "
                                    . "from pages where title = '" . $title . "'");

    $count = mysqli_num_rows($result);
    if ($count==0) {
        $_SESSION["status"] = "PAGE NOT FOUND";
        header("Location: index.php");
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($access & $row["visible"]) {
            echo '<div class="bodydiv">';
            print(eval('?>' . $row["page"]));
            echo '</div>';
        } else {
            $_SESSION["status"] = "UNAUTHORIZED";
            header("Location: index.php");
        }
    }
} else {
    $_SESSION["status"] = "PAGE NOT SPECIFIED";
    header("Location: index.php");
}

mysqli_free_result($result);
mysqli_close($db);

include("footer.php");
?>
</body>
</html>

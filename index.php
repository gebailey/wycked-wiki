<!DOCTYPE html>
<html>
<head>
<title><?php echo $WYCKED_TITLE; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once("config.php");
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

echo '<div class="bodydiv">';
echo '<table>';

$db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$result = mysqli_query($db, "select * from posts order by date desc");

while ($row = mysqli_fetch_assoc($result)) {
    if ($access & $row["visible"]) {
        printf("<tr><th>%s</th></tr>", $row["title"]);
        printf("<tr><td class='date'>%s</td></tr>", $row["date"]);
        printf("<tr><td>%s</td></tr>", $row["post"]);
        printf("<tr><td class='break'></td></tr>");
    }
}

mysqli_free_result($result);
mysqli_close($db);

echo '</table>';
echo '</div>';

include("footer.php");
?>
</body>
</html>

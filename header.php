<div class="headerdiv">

<table><tr>

<td><a href=".">Wycked Wiki</a></td>

<td class="userinfo">
<?php
if (isset($_SESSION) && isset($_SESSION["access"]) && isset($_SESSION["fullname"])) {
    $access = $_SESSION["access"];
    if ($access == 2) {
        $userinfo = $_SESSION["fullname"] . " (User)";
    } elseif ($access == 4) {
        $userinfo = $_SESSION["fullname"] . " (Editor)";
    } elseif ($access == 8) {
        $userinfo = $_SESSION["fullname"] . " (Administrator)";
    } else {
        // Guest User
        $userinfo = "";
    }
} else {
    // Guest User
    $access = 1;
    $userinfo = "";
}

echo $userinfo;
?>
</td>

</tr></table>

</div>

<div class="menudiv">

<table><tr>

<td class="status">
<?php
if (isset($_SESSION) && isset($_SESSION["status"])) {
    echo $_SESSION["status"];
    unset($_SESSION["status"]);
}
?>
</td>

<?php
$db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$result = mysqli_query($db, "select * from pages order by page_id");

while ($row = mysqli_fetch_assoc($result)) {
    if (($access & $row["visible"]) && (substr($row["title"], 0, 1) !== "_")) {
        if (is_null($row["file"])) {
            // content comes from pages table
            printf('<td class="menuitem"><a href="page.php?page=%s">%s</a></td>',
                   $row["title"],
                   strtoupper($row["title"]));
        } else {
            // content comes from existing file
            printf('<td class="menuitem"><a href="%s">%s</a></td>',
                   $row["file"],
                   strtoupper($row["title"]));
        }
    }
}

mysqli_free_result($result);
mysqli_close($db);
?>

</tr></table>

</div>

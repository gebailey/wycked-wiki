<div class="footerdiv">

<p class="copyright">
<?php echo $WYCKED_FOOTER; ?>
<br>Version <?php echo $WYCKED_VERSION ?>
</p>

<p class="admins">
Site administrators:
<?php
$db = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$result = mysqli_query($db, "select username from users where access = 8 order by username");
$username_array = array();
while ($row = mysqli_fetch_assoc($result)) {
    $username_array[] = "<b>" . $row["username"] . "</b>";
}
printf(implode(", ", $username_array));
mysqli_free_result($result);
mysqli_close($db);
?>
</p>

<img src="images/netscape.png" height=24>
<img src="images/ielogo.png" height=24>

</div>

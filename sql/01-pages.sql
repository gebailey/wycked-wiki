INSERT INTO `pages` VALUES (200,8,'about',NULL, '<h3>Wycked Wiki</h3><h4>Version <?php echo "$VERSION"?></h4>');

INSERT INTO `pages` VALUES (210,8,'diags',NULL, '<?php echo "<pre>"; system("top -b -n 1"); echo "</pre>";');

INSERT INTO `pages` VALUES (300,12,'docs',NULL,'
<h2>Introduction</h2>
<p>
Wycked Wiki is a simple and minimalistic PHP/MySQL wiki system.
Content is managed in the form of either <b>pages</b> or <b>posts</b>.
Users fall into one of the following levels of access:
<ul>
<li>Administrator (level 8)
<li>Editor (level 4)
<li>User (level 2)
<li>Guest (level 1)
</ul>

<h2>Content</h2>
<p>
Content (either "pages" or "posts") has a visibility level associated with it.
To determine whether a user has pages or posts that should be shown, the access
level of the current user is bitwise-anded with the <b>visible</b> attribute in
the <b>pages</b> or <b>posts</b> table.  If the result is non-zero, then that
content is shown to the user.

Common settings for the <i>visible</i> field:
<ul>
<li>0:  Hidden (no access)
<li>1:  Only guest users (login button)
<li>8:  Administrative access only
<li>12:  Administrative/Editor access (can create new posts)
<li>14:  Any authenticated user
<li>15:  Everyone
</ul>

<h4>Pages</h4>
<p>
Pages can either be references to php source files, or served directly from MySQL.
The <b>title</b> of the page is used to title the button that is shown to the
user, and the buttons are sorted by <b>page_id</b>.

<h4>Posts</h4>
<p>
Posts are shown on the main page in descending timestamp order.  The visibility
level of each post is used to determine if it should be shown on the current
page, depending on the access level of the current user.

<h2>To Do</h2>
<p>
Several features are as yet unimplemented:
<ul>
<li>Editing / deleting posts
<li>Creating / editing / deleting pages
<li>Creating / deleting users
</ul>
');

INSERT INTO `pages` VALUES (700,12,'new post','posts.php',NULL);
INSERT INTO `pages` VALUES (800,1,'login','login.php',NULL);
INSERT INTO `pages` VALUES (900,14,'logout','logout.php',NULL);


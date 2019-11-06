<?php
 
require_once("../classes/Template.php");

$page = new Template("Home Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

include("topNavBar.php");
			
print 	'<div class="content">
			<h2> Lorem Ipsum </h2>
			
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rhoncus eget
			urna non feugiat. Donec vel sem at nisl aliquam lacinia. Duis id iaculis lectus.
			Nam volutpat mauris lacus, vel blandit odio eleifend rhoncus. Phasellus ultrices
			elementum mauris. Etiam mattis urna eget leo cursus gravida. Nunc sed posuere lectus.
			Ut quis placerat nisi. Donec consequat, nulla vel rutrum ultrices, odio quam vehicula mi,
			quis bibendum ligula eros id nisl. </p>
		</div>';

print $page->getBottomSection();

?>
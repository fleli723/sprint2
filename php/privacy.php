<?php
 
require_once("../classes/Template.php");

$page = new Template("Privacy Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

include("topNavBar.php");

			
print			"<div class=\"content\">";
			
print			"<h2> Privacy Policy </h2>
				<p> The University of Wisconsin System Administration (UWSA) recognizes 
				the importance of protecting the privacy of information provided to us. </p>";
				
print			"<h3> Personal information </h3>
				<p> We will use personal information that you provide via e-mail or 
				through other online means only for purposes necessary to serve your 
				needs, such as responding to an inquiry or other request for information. 
				This may involve redirecting your inquiry or comment to another person or 
				department better suited to meeting your needs. </p>
				<p> Some webpages at UWSA may collect personal information about visitors 
				and use that information for purposes other than those stated above. Each 
				webpage that collects information will have a separate privacy statement that 
				will tell you how that information is used. </p>";
				
print			"<h3> Collected Information </h3>
				<p>UWSA monitors network traffic for the purposes of site management and 
				security. We use this information to help diagnose problems and carry out 
				other administrative tasks. We also use statistic information to determine 
				which information is of most interest to users, to identify system problem 
				areas, or to help determine technical requirements. The server log information 
				does not include personal information.</p>";
				
print			"<h3> External websites </h3>
				<p>This site contains links to other sites outside of UWSA. UWSA is not responsible 
				for the privacy practices or the content of such websites. </p>";
				
print			"<h3> Questions </h3>
				<p>If you have any questions about this privacy statement, the practices of this 
				site, or your use of this website,
				please contact <a href=\"https://www.wisconsin.edu/privacy-policy/\">Webmaster</a>.</p>";
			
print			"</div>";

print $page->getBottomSection();

?>
<?php 
header("Content-type: text/css");

require_once('../../../../wp-load.php');

$primary_link = get_option('of_primary_link');
$secondary_link = get_option('of_secondary_link');
$selection_color = get_option('of_selection_color');
/*$body_color = get_option('of_body_color');
$header_color = get_option('of_header_color');
$footer_color = get_option('of_footer_color');*/

?>
/* Dynamic CSS
-------------------------------------------------------------------------------*/
/*body {
	background: <?php echo $body_color ?>;
}

#header {
	background: <?php echo $header_color ?>;
}

#footer {
	background: <?php echo $footer_color ?>;
}*/

a:link, a:visited {
	color: <?php echo $primary_link ?>;
}

a:active, a:hover {
	color: <?php echo $secondary_link ?>;
}

.entry-title a:active,
.entry-title a:hover {
	color: <?php echo $secondary_link ?>;
}

#footer-widget-area .entry-title a:hover {
	color: <?php echo $secondary_link ?>;
}

#content h3.box-title a:hover,
#footer-widget-area h3.box-title a:hover,
#primary h3.box-title a:hover,
#secondary h3.box-title a:hover {
	color: <?php echo $secondary_link ?>;
}

ul.portfolio-filter a:hover {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
}

.entry-meta a:hover, .entry-utility a:hover {
	color: <?php echo $secondary_link ?>;
}

/*.tag-links a,
.tag-links a:link,
.tag-links a:visited {color: <?php echo $secondary_link ?>;}*/

.tag-links a:active,
.tag-links a:hover {
	color: #fff;
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
}

::-moz-selection { background: <?php echo $selection_color ?>; }

::selection { background: <?php echo $selection_color ?>; }

::-webkit-selection { background: <?php echo $selection_color ?>; }

#site-info a:hover {
	color: <?php echo $secondary_link ?>;
}

.commentlist .bypostauthor cite {
	color: <?php echo $secondary_link ?> !important;
}

a#cancel-comment-reply-link:hover {
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
}

#respond .form-submit input {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
	color: #fff;
}

#respond .form-submit input:hover {
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
	color: #fff;
}

#contactForm input.send-button {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
	color: #fff;
}

#contactForm input.send-button:hover {
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
	color: #fff;
}

/*.navigation a:link.back,
.navigation a:visited.back {
	color: <?php echo $primary_link ?>;
}*/

.navigation a:active.back,
.navigation a:hover.back {
	color: <?php echo $secondary_link ?>;
}

#access ul ul :hover > a {
	background: <?php echo $secondary_link ?>;
}

#access ul ul li.current_page_item > a,
#access ul ul li.current-menu-ancestor > a,
#access ul ul li.current-menu-item > a,
#access ul ul li.current-menu-parent > a {
	background: <?php echo $primary_link ?>;
}

#access li:hover > a {
	color: <?php echo $secondary_link ?>;
}

a#twitter-link:hover {
/*	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
	color: #fff;*/
}

#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
/*	color: <?php echo $secondary_link ?>;*/
}

#access ul ul li.current_page_item > a:hover,
#access ul ul li.current-menu-ancestor > a:hover,
#access ul ul li.current-menu-item > a:hover,
#access ul ul li.current-menu-parent > a:hover {
	background: <?php echo $secondary_link ?>;
}

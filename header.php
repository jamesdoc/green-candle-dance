<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<!-- A Mattia Viviani WordPress theme design - http://www.mattiaviviani.com - http://twitter.com/mattiaviviani - http://themeforest.net/user/MattiaViviani -->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php /* Use the .htaccess and remove these lines to avoid edge case issues. More info: h5bp.com/b/378
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> */ ?>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mav' ), max( $paged, $page ) );

?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.php" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" />
<meta name="viewport" content="width=1020">
<?php /* Include jQuery */ wp_enqueue_script('jquery'); ?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<?php // Calling plugins.css after wp_head(); because of style conflict ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/plugins.css" />

<?php // Modernizr enables HTML5 elements & feature detects ?>


<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-1.7.min.js"></script>

<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('.overlay');
	</script>
<![endif]-->

<!--[if IE 8]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css" />
<![endif]-->

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/gcd_override.css" />

</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<!-- HEADER BEGINS -->
	<section id="header">
		<div id="masthead" class="container_16 clearfix">
			<header id="branding" role="banner">

				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">

				<span>
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php if ( $logo = get_option('of_logo') ) { ?>
					<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<?php } else { //bloginfo( 'name' ); ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
					<?php } ?>
					</a>
				</span>

				 </<?php echo $heading_tag; ?>>

				<div id="site-description"><?php bloginfo( 'description' ); ?></div>

				<div class="searchform-header">
					<?php get_search_form(); ?>
				</div>

				<nav id="main_nav">

					<?php wp_nav_menu(array('menu' => 'Main Nav Menu')); ?>

				</nav>

			</header>
		</div>
	</section>
	<!-- HEADER ENDS -->

	<div id="main-wrapper">
	<div id="main">

	<div class="main-top"></div>

<?php

/*
	FUNCTIONS AND DEFINITIONS

	----------------------------------------------------------------------------------- */


/*
	Set the content width based on the theme's design and stylesheet.
	----------------------------------------------------------------------------------- */

	if ( ! isset( $content_width ) )
		$content_width = 640;

	// Tell WordPress to run mav_setup() when the 'after_setup_theme' hook is run.
	add_action( 'after_setup_theme', 'mav_setup' );

	if ( ! function_exists( 'mav_setup' ) ):


/*
	Sets up theme defaults and registers support for various WordPress features.
	----------------------------------------------------------------------------------- */

	function mav_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 190, 130, true );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'mav', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'mav' ),
		) );

		// This theme allows users to set a custom background
		$args = array(
			'default-image'          => get_template_directory_uri() . '/images/body-BG.png',
			'default-color'          => 'ffffff',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);

		add_theme_support( 'custom-background', $args );


	}
	endif;
?>
<?php

/*
	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	----------------------------------------------------------------------------------- */

	function mav_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'mav_page_menu_args' );


/*
	Sets the post excerpt length to 40 characters.
	----------------------------------------------------------------------------------- */

	function mav_excerpt_length( $length ) {
		return 20; // 40 default
	}
	add_filter( 'excerpt_length', 'mav_excerpt_length' );


/*
	Returns a "Continue Reading" link for excerpts
	----------------------------------------------------------------------------------- */
	function mav_continue_reading_link() {
		return ' <a class="more-link" href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mav' ) . '</a>';
	}


/*
	Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mav_continue_reading_link().
	----------------------------------------------------------------------------------- */
	function mav_auto_excerpt_more( $more ) {
		return ' &hellip;' . mav_continue_reading_link();
	}
	add_filter( 'excerpt_more', 'mav_auto_excerpt_more' );


/*
	Adds a pretty "Continue Reading" link to custom post excerpts.
	----------------------------------------------------------------------------------- */

	function mav_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= mav_continue_reading_link();
		}
		return $output;
	}
	add_filter( 'get_the_excerpt', 'mav_custom_excerpt_more' );


/*
	Remove inline styles printed when the gallery shortcode is used.
	----------------------------------------------------------------------------------- */

	add_filter( 'use_default_gallery_style', '__return_false' );


/*
	Deprecated way to remove inline styles printed when the gallery shortcode is used.

	This function is no longer needed or used. Use the use_default_gallery_style
	filter instead, as seen above.
	----------------------------------------------------------------------------------- */

	function mav_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}

	// Backwards compatibility with WordPress 3.0.
	if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
		add_filter( 'gallery_style', 'mav_remove_gallery_css' );

	if ( ! function_exists( 'mav_comment' ) ) :


/*
	Template for comments and pingbacks.
	----------------------------------------------------------------------------------- */

	function mav_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'mav' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mav' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'mav' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

		<?php
		break;
		case 'pingback'  :
		case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'mav' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' ); ?></p>
		<?php
		break;
		endswitch;
	}
	endif;


/*
	Register widgetized areas
	----------------------------------------------------------------------------------- */
	function mav_widgets_init() {

		// Area 1a, located at the top of the sidebar.
		register_sidebar( array(
			'name' => __( 'Sidebar Primary', 'mav' ),
			'id' => 'primary-widget-area',
			'description' => __( 'Located in the primary blog sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 1b single-portfolio, located at the top of the sidebar. It replaces the Sidebar Primary if we are in the singe portfolio page.
		register_sidebar( array(
			'name' => __( 'Sidebar Portfolio Primary', 'mav' ),
			'id' => 'primary-widget-area-portfolio',
			'description' => __( 'Located in the primary portfolio sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
		register_sidebar( array(
			'name' => __( 'Sidebar Secondary', 'mav' ),
			'id' => 'secondary-widget-area',
			'description' => __( 'Located in the secondary sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );


		// Area 3, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage First', 'mav' ),
			'id' => 'first-homepage-widget-area',
			'description' => __( 'Located in the first homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 4, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage Second', 'mav' ),
			'id' => 'second-homepage-widget-area',
			'description' => __( 'Located in the second homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 5, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage Third', 'mav' ),
			'id' => 'third-homepage-widget-area',
			'description' => __( 'Located in the third homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 6, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer First', 'mav' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'Located in the first footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 7, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer Second', 'mav' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'Located in the second footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 8, located in the footer. Empty by default.
		// 2015-04-25 | James Doc: GCD only wanted shop & video in this area. Commented this out to prevent cluttering and confusing widget space
		/*
			register_sidebar( array(
			'name' => __( 'Footer Third', 'mav' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'Located in the third footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		*/

	}

	// Register sidebars by running mav_widgets_init() on the widgets_init hook
	add_action( 'widgets_init', 'mav_widgets_init' );


/*
	Load Widgets
	----------------------------------------------------------------------------------- */

	function of_register_widgets() {
		// Load each widget file
		require_once( 'admin/widgets/widget-custom-content.php' );
		require_once( 'admin/widgets/widget-latest-tweets.php' );
		require_once( 'admin/widgets/widget-blog-posts.php' );
		// Register each widget
		register_widget( 'of_Custom_Content_Widget' );
		register_widget( 'of_Latest_Tweet_Widget' );
		register_widget( 'of_Blog_Posts_Widget' );
	}
	add_action( 'widgets_init', 'of_register_widgets' );


/*
	Removes the default styles that are packaged with the Recent Comments widget.
	----------------------------------------------------------------------------------- */
	function mav_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'mav_remove_recent_comments_style' );

	if ( ! function_exists( 'mav_posted_on' ) ) :

	// Prints HTML with meta information for the current post—date/time and author.
	function mav_posted_on() {
//		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'mav' ),
		printf( __( '<span class="%1$s entry-date-img">%2$s</span> <span class="meta-sep user-img">%3$s</span>', 'mav' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'mav' ), get_the_author() ),
				get_the_author()
			)
		);
	}
	endif;


	if ( ! function_exists( 'mav_posted_in' ) ) :

	// Prints HTML with meta information for the current post (category, tags and permalink).
	function mav_posted_in() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s', 'mav' );
//			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>', 'mav' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>', 'mav' );
		}
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
	endif;




/* `Register `Javascripts
----------------------------------------------------------------------------------- */

function mav_include_js() {

	// Register the script like this for a theme:
	wp_register_script( 'green-candle-js', get_template_directory_uri() . '/greencandle.js', array(), false, false );
	wp_register_script( 'form-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), false, true );
	wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), false, true );
	wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array(), false, true );
	wp_register_script( 'quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js', array(), false, true );
	wp_register_script( 'nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array(), false, true );
	wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), false, true );

	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'green-candle-js' );
	wp_enqueue_script( 'form-validate' );
	wp_enqueue_script( 'prettyPhoto' );
	wp_enqueue_script( 'superfish' );
	wp_enqueue_script( 'quicksand' );
	wp_enqueue_script( 'nivo' );
	wp_enqueue_script( 'custom' );

}

add_action( 'wp_enqueue_scripts', 'mav_include_js' );



/* `Register `Styles
----------------------------------------------------------------------------------- */

function mav_include_styles() {

	// Register the style like this for a theme:
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	wp_register_style( 'plugins', get_template_directory_uri() . '/css/plugins.css');
	wp_register_style( 'alternate', get_template_directory_uri() . '/css/style.php');

	// For either a plugin or a theme, you can then enqueue the style:
	wp_enqueue_style( 'prettyPhoto' );
	wp_enqueue_style( 'plugins' );
	wp_enqueue_style( 'alternate' );

}

add_action( 'wp_print_styles', 'mav_include_styles' );




/*
	Options Framework Functions
	----------------------------------------------------------------------------------- */

	/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

	if ( get_stylesheet_directory() == get_template_directory() ) {
		define('OF_FILEPATH', get_template_directory());
		define('OF_DIRECTORY', get_template_directory_uri());
	} else {
		define('OF_FILEPATH', get_stylesheet_directory());
		define('OF_DIRECTORY', get_stylesheet_directory_uri());
	}

	/* These files build out the options interface.  Likely won't need to edit these. */

	require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
	require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

	/* These files build out the theme specific options and associated functions. */

	require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
	require_once (OF_FILEPATH . '/admin/theme-functions.php'); 		// Theme actions based on options settings



/*
	Custom Logo Login
	----------------------------------------------------------------------------------- */

/*
	add_action("login_head", "my_login_head");
	function my_login_head() {
		echo "<style>
			body.login #login h1 a {
			background: url('".get_template_directory_uri()."/images/custom-logo-login.png') no-repeat scroll center top transparent;
			margin-bottom: 30px;
			background-size: auto;
		}
		</style>";
	}
*/



/*
	Slidermanager
	----------------------------------------------------------------------------------- */

	require_once(get_stylesheet_directory() . '/admin/slidermanager/loader.php');



/*
	Breadcrumbs
	----------------------------------------------------------------------------------- */

	function the_breadcrumb() {
		if (!is_home()) {
			echo '<a href="';
//			echo get_option('home');
			echo home_url();
			echo '">';
			bloginfo('name');
			echo "</a> » ";
			if (is_category() || is_single()) {
				the_category(' / ');
				if (is_single()) {
					echo " » ";
					the_title();
				}
			} elseif (is_page()) {
				echo the_title();
			}
		}
	}



/*
	`PORTFOLIO
	----------------------------------------------------------------------------------- */

	/**
	 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404
	 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 */

	function portfolioposttype_activation() {
		create_portfolio();
		flush_rewrite_rules();
	}

	register_activation_hook( __FILE__, 'portfolioposttype_activation' );


	// Create The Custom Post Type

	add_action('init', 'create_portfolio');

	function create_portfolio() {
		$labels = array(
			'name' => __( 'Portfolio' , 'mav' ),
			'singular_name' => __( 'Portfolio Item', 'mav' ),
			'add_new' => _x( 'Add New' , 'portfolio item', 'mav' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'mav' ),
			'edit_item' => __( 'Edit Portfolio Item', 'mav' ),
			'new_item' => __( 'New Portfolio Item', 'mav' ),
			'view_item' => __( 'View Portfolio Item', 'mav' ),
			'search_items' => __( 'Search Portfolio', 'mav' ),
			'not_found' =>  __( 'Nothing found' , 'mav' ),
			'not_found_in_trash' => __( 'Nothing found in Trash' , 'mav' ),
			'parent_item_colon' => '',
			'all_items' => __( 'All Portfolio Posts', 'portfolio', '' )
		);

		$portfolio_args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'rewrite' => array( "slug" => "portfolio-item", 'with_front' => false ), // Permalinks format
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' )
		);

		register_post_type( 'portfolio' , $portfolio_args );
	}



/*
	PORTFOLIO - CUSTOM TAXONOMY
	----------------------------------------------------------------------------------- */

	// Build Tags Taxonomies for portfolio page
	function portfolio_categories_build_taxonomies() {
		register_taxonomy(__( "portfolio_categories" , 'mav' ), array(__( "portfolio" , 'mav' )), array("hierarchical" => true, "label" => __( "Categories" , 'mav' ), "singular_label" => __( "Portfolio Categories" , 'mav' ), "rewrite" => array('slug' => 'portfolio_categories', 'hierarchical' => true)));
	}
	add_action( 'init', 'portfolio_categories_build_taxonomies', 0 );



	// Build Tags Taxonomies for single-portfolio
	function portfolio_tags_build_taxonomies() {
//		register_taxonomy('portfolio_tags', 'post', array( 'hierarchical' => false,  'label' => 'portfolio_tags', 'query_var' => true, 'rewrite' => true));
		register_taxonomy(__( "portfolio_tags" , 'mav' ), array(__( "portfolio" , 'mav' )), array("hierarchical" => false, "label" => __( "Tags" , 'mav'), 'query_var' => true, "singular_label" => __( "Portfolio Tags" , 'mav' ), "rewrite" => true, "show_in_nav_menus" => false));
	}
	add_action( 'init', 'portfolio_tags_build_taxonomies', 0 );



/*
	Portfolio Meta Box
	----------------------------------------------------------------------------------- */

	// Adding the Meta Box
	add_action( 'add_meta_boxes', 'cd_meta_box_add' );
		function cd_meta_box_add()
		{
			add_meta_box( 'my-meta-box-id', 'Portfolio Options', 'cd_meta_box_cb', 'portfolio', 'normal', 'high' );
		}

	// Rendering the Meta Box
	function cd_meta_box_cb( $post )
	{
		$values = get_post_custom( $post->ID );
		$portfolio_desc = isset( $values['portfolio_desc'] ) ? esc_attr( $values['portfolio_desc'][0] ) : '';
		$lightbox_path = isset( $values['lightbox_path'] ) ? esc_attr( $values['lightbox_path'][0] ) : '';
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>
		<p>
			<label for="portfolio_desc"><strong>Post Description</strong></label><br/>
			<label>Please, enter a short description, the text otherwise will be cropped.</label><br/>
			<input style="width:60%;margin:9px 0 15px 0" type="text" name="portfolio_desc" id="portfolio_desc" value="<?php echo $portfolio_desc; ?>" />
		</p>

		<p style="margin-bottom:25px">
			<label for="lightbox_path"><strong>URL Link for Lightbox</strong></label><br/>
			<label>It can be image or video, it will be opened in the portfolio page.</label>
			<!--label>Allowed Video Content: Flash, YouTube, Vimeo, QuickTime.</label><br/-->
			<input style="width:98%;margin:6px 0 15px 0" type="text" name="lightbox_path" id="lightbox_path" value="<?php echo $lightbox_path; ?>" />
			<strong>Sample video formats:</strong><br/>
			<label>Vimeo: http://vimeo.com/5721659</label><br/>
			<label>YouTube: http://www.youtube.com/watch?v=pkqzFUhGPJg</label><br/>
			<label>More at: <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/</a></label>
			<br/>
		</p>

		<?php
	}

	// Saving the Data
	add_action( 'save_post', 'cd_meta_box_save' );
	function cd_meta_box_save( $post_id )
	{
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) return;

		// now we can actually save the data
		$allowed = array(
			'a' => array( // on allow a tags
				'href' => array() // and those anchords can only have href attribute
			)
		);

		// Probably a good idea to make sure your data is set
		if( isset( $_POST['portfolio_desc'] ) )
			update_post_meta( $post_id, 'portfolio_desc', wp_kses( $_POST['portfolio_desc'], $allowed ) );

		if( isset( $_POST['lightbox_path'] ) )
			update_post_meta( $post_id, 'lightbox_path', wp_kses( $_POST['lightbox_path'], $allowed ) );

	}



/*
	Custom Columns
	----------------------------------------------------------------------------------- */

	add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
	add_action("manage_posts_custom_column",  "portfolio_columns_display");

	function portfolioposttype_edit_columns($portfolio_columns){
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name', '' ),
		"author" => __('Author', 'portfolioposttype', '' ),
		"portfolio_categories" => __('Categories', 'create_portfolio', '' ),
		"portfolio_tags" => __('Tags', 'portfolioposttype', '' ),
		"comments" => __('Comments', 'portfolioposttype', '' ),
		"date" => __('Date', 'portfolioposttype', '' ),
		"thumbnail" => __('Thumbnail', 'portfolioposttype', '' )
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

add_filter( 'manage_edit-portfolio_columns', 'portfolioposttype_edit_columns' );


	function get_portfolio_categories_id($cat_name){
		$term = get_term_by('name', $cat_name, 'portfolio_categories');
		return $term->term_id;
	}

	function get_portfolio_tags_id($tag_name){
		$term = get_term_by('name', $tag_name, 'portfolio_tags');
		return $term->term_id;
	}

	// function get_portfolio_desc_id($tag_name){
	// 	$term = get_term_by('name', $tag_name, 'portfolio_desc');
	// 	return $term->term_id;
	// }

	function portfolio_columns_display($portfolio_columns){
		switch ($portfolio_columns)
		{

			case "portfolio_categories":
/*				$terms = get_the_terms( get_the_ID(), 'portfolio-categories' );
				foreach ($terms as $term) {
					echo preg_replace('/\s+/', '-', $term->name). ' ';
					}*/
				echo get_the_term_list(@$post->ID, __( 'portfolio_categories' , 'mav' ), '', ', ','');
				break;

			case "portfolio_tags":
				echo get_the_term_list(@$post->ID, __( 'portfolio_tags' , 'mav' ), '', ', ','');
				break;

			case "portfolio_description":
				// the_excerpt();
				$custom = get_post_custom();
				echo $custom["portfolio_desc"][0];
				break;

			}
		}

function portfolioposttype_columns_display($portfolio_columns, $post_id){

	switch ( $portfolio_columns )

	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

		case "thumbnail":
			$width = (int) 50;
			$height = (int) 50;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;

			// Display the portfolio tags in the column view
			case "portfolio_category":

			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;

			// Display the portfolio tags in the column view
			case "portfolio_tag":

			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;
	}
}

add_action( 'manage_posts_custom_column',  'portfolioposttype_columns_display', 10, 2 );




/*
	SHORTCODES
	----------------------------------------------------------------------------------- */

	add_filter('widget_text', 'do_shortcode');

	/* THE YEAR */
	function the_year() {
		$the_year = date('Y');
    	return '' . $the_year . '';
	}
	add_shortcode('the_year', 'the_year');
	// Usage: [the_year]


	/* SITE LINK */
	function site_link() {
		$site_link = home_url();
		$site_name = get_bloginfo( 'name' );
    	return '<a href="' . $site_link . '">' . $site_name . '</a>';
	}
	add_shortcode('site_link', 'site_link');
	// Usage: [site_link]


	/* BUTTONS */
	function button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'link' => '',
			'size' => '',
      	), $atts ) );

		return '<a href="' . $link . '" class="button ' . $color . ' ' . $size . '">' . do_shortcode($content) . '</a>';
	}

	add_shortcode('button', 'button_shortcode');

	// Usage: [button color="blue, green, orange, yellow, red, teal, purple, pink, aqua, silver, white, black" link="http://...", size="small, medium, big"]


	/* INFO BOXES */
	function box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type' => '',
      	), $atts ) );

		return '<div class="box ' . $type . '">' . do_shortcode($content) . '</div>';
	}

	add_shortcode('box', 'box_shortcode');
	// Usage: [box type="normal, info, tick, note, alert"][/box]


	/* COLUMNS */
	function shortcodes_one_third( $atts, $content = null ) {
		return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'shortcodes_one_third');


	function shortcodes_one_third_last( $atts, $content = null ) {
		return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'shortcodes_one_third_last');


	function shortcodes_two_third( $atts, $content = null ) {
		return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'shortcodes_two_third');


	function shortcodes_two_third_last( $atts, $content = null ) {
		return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'shortcodes_two_third_last');


	function shortcodes_one_half( $atts, $content = null ) {
		return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'shortcodes_one_half');


	function shortcodes_one_half_last( $atts, $content = null ) {
		return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'shortcodes_one_half_last');


	function shortcodes_one_fourth( $atts, $content = null ) {
		return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'shortcodes_one_fourth');


	function shortcodes_one_fourth_last( $atts, $content = null ) {
		return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'shortcodes_one_fourth_last');


	function shortcodes_three_fourth( $atts, $content = null ) {
		return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'shortcodes_three_fourth');


	function shortcodes_three_fourth_last( $atts, $content = null ) {
		return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'shortcodes_three_fourth_last');


	function shortcodes_one_fifth( $atts, $content = null ) {
		return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth', 'shortcodes_one_fifth');


	function shortcodes_one_fifth_last( $atts, $content = null ) {
		return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fifth_last', 'shortcodes_one_fifth_last');


	function shortcodes_two_fifth( $atts, $content = null ) {
		return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_fifth', 'shortcodes_two_fifth');


	function shortcodes_two_fifth_last( $atts, $content = null ) {
		return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_fifth_last', 'shortcodes_two_fifth_last');


	function shortcodes_three_fifth( $atts, $content = null ) {
		return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fifth', 'shortcodes_three_fifth');


	function shortcodes_three_fifth_last( $atts, $content = null ) {
		return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fifth_last', 'shortcodes_three_fifth_last');


	function shortcodes_four_fifth( $atts, $content = null ) {
		return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('four_fifth', 'shortcodes_four_fifth');


	function shortcodes_four_fifth_last( $atts, $content = null ) {
		return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('four_fifth_last', 'shortcodes_four_fifth_last');


	function shortcodes_one_sixth( $atts, $content = null ) {
		return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'shortcodes_one_sixth');


	function shortcodes_one_sixth_last( $atts, $content = null ) {
		return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_sixth_last', 'shortcodes_one_sixth_last');


	function shortcodes_five_sixth( $atts, $content = null ) {
		return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('five_sixth', 'shortcodes_five_sixth');


	function shortcodes_five_sixth_last( $atts, $content = null ) {
		return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('five_sixth_last', 'shortcodes_five_sixth_last');


	/* TOGGLE */
	function toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'title' => 'toggle'
	), $atts ) );

		$result = '<div class="toggler"><h3 class="toggle"><a href="javascript:void(0);">'.esc_attr($title).'</a></h3>
		<div class="toggle_container">
			<div class="block">
				<p>' . do_shortcode($content) . '</p>
			</div>
		</div>
		</div>';
		return $result;
	}

	add_shortcode('toggle', 'toggle_shortcode');


	/* TABS */
	function tabs_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'titles' => 'tabs',
		), $atts ) );

		$tab_titles  = esc_attr($titles);
		$tab_totals = explode(",", $tab_titles);

		$result = '<div id="tabs">';

		$result .= '<ul class="tabs">';
		$s = 1;
		for ( $i = 0; $i <= count($tab_totals)-1; $i++) {
			$result .= '<li><a href="#tab'.$s++.'">'.trim($tab_totals[$i]).'</a></li>';
		}
		$result .= '</ul>';

		$result .= '<div class="tab_container">';
		$result .= do_shortcode($content);
		$result .= '</div>'; // close .tab_container
		$result .= '</div>'; // close #tabs

		return $result;
	}

	add_shortcode('tabs', 'tabs_shortcode');

	function tab_shortcode( $atts, $content = null ) {
		$result = '<div class="tab_content">';
		$result .= do_shortcode($content);
		$result .= '</div>';
		return $result;
	}

	add_shortcode('tab', 'tab_shortcode');

	/**
	 * Custom setup for GCD
	 */
	function gcd_basic_init() {
		// Pages can have excerpts
		add_post_type_support( 'page', 'excerpt' );

		// Image size for hub pages
		add_image_size( 'hub_header', 940, 310, true );
	}
	add_action( 'init', 'gcd_basic_init' );


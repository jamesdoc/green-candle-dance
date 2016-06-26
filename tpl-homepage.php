<?php

	// Get two posts for the homepage
	$args = array(
		'posts_per_page'   => 2,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	);
	$posts_array = get_posts( $args );

	$template_dir = get_template_directory_uri();

	get_header();

?>

	<?php if( get_option('of_home_slider') == 'true') {
		include(get_template_directory() .'/inc/slider.php');
	} ?>

	<?php if( get_option('of_home_msg') == 'true') { ?>
		<div id="home-message">
			<?php echo do_shortcode( stripslashes( get_option('of_home_msg_text') ) ); ?>
		</div>
	<?php } ?>

	<div id="homepage-container">

		<div id="content" role="main" class="homepage-content clearfix">

		<?php
			// Participation, Training and Production boxes
			get_sidebar( 'homepage' );
		?>

			<div class="jd-container">
				<div class="homepage_box latest_news">
					<h3 class="widget-title widget-title--cyan">Latest News</h3>
					<?php foreach($posts_array as $post) { ?>
					<?php $permalink = get_permalink($post->post_id); ?>
					<div class="homepage-post-snippet">
						<h4 class="homepage-post-snippet__title"><a href="<?php echo $permalink; ?>"><?php echo $post->post_title ?></a></h4>
						<p class="homepage-post-snippet__date">Posted on <?php echo date('jS F Y', strtotime($post->post_date)); ?></p>
						<p class="homepage-post-snippet__excerpt"><?php echo implode(' ', array_slice(explode(' ', strip_tags($post->post_content)), 0, 40)); ?>...</p>
						<p class="homepage-post-snippet__link"><a href="<?php echo $permalink; ?>">Read more</a></p>
					</div>
					<?php } // end foreach post ?>

					<a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>" class="btn btn--point-right">All news</a>
				</div>

				<div class="homepage_box keep_in_touch">
					<h3 class="widget-title widget-title--yellow">Keep in Touch</h3>
					<p class="keep_in_touch__signup">
						Green Candle sends out newsletters once a term with updates on past, current and future projects, as well as events and opportunities for you to get involved in.<br /><br />
						Sign up for our newsletter: <br />
						<a href="http://eepurl.com/nw3g5" class="btn btn--newsletter-signup btn--point-right" target="_blank">Sign up now</a>
					</p>

					<h3 class="widget-title widget-title--orange">Social Media</h3>
					<ul class="social_buttons">
						<li class="facebook"><a href="https://www.facebook.com/GreenCandleDanceCompany/" target="_blank"><img src="<?php echo $template_dir; ?>/images/facebook.jpg" alt="Facebook" /></a></li>
						<li class="twitter"><a href="https://twitter.com/GCDanceCompany" target="_blank"><img src="<?php echo $template_dir; ?>/images/twitter.jpg" alt="Twitter" /></a></li>
						<li class="youtube"><a href="https://www.youtube.com/user/greencandledance" target="_blank"><img src="<?php echo $template_dir; ?>/images/youtube.jpg" alt="YouTube" /></a></li>
					</ul>
				</div>
			</div>

		</div>

	</div>

<?php get_footer(); ?>

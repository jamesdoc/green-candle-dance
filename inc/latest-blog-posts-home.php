	<?php // LATEST BLOG POSTS HOMEPAGE ?>
	<?php
	$latest_postperpage = stripslashes(get_option('of_latest_postperpage'));
	$latest_posts_cat = stripslashes(get_option('of_latest_posts_cat'));
	$latest_blog_posts_title = stripslashes(get_option('of_latest_blog_posts_title'));
	$latest_blog_posts_desc = stripslashes(get_option('of_latest_blog_posts_desc'));
	?>

	<?php	
	$cat_term_id = get_cat_ID( $latest_posts_cat );
	$args = array(
		'posts_per_page'=> $latest_postperpage, // Number of latest posts that will be shown.
		'ignore_sticky_posts'=>1,
		'category__in' => $cat_term_id
		);
	$categories=get_categories($args);				
	$my_query = new WP_Query($args);
	$wp_query = $my_query;
		if( $my_query->have_posts() ) {
	?>

	<!-- BLOG HOME BEGINS -->
	<div id="latest-blog-posts-home">
		<h3 class="section-box-title"><?php echo $latest_blog_posts_title; ?></h3>
		<p class="title-desc"><?php echo $latest_blog_posts_desc; ?></p>
		
		<ul class="blog-list-home">

			<?php
			while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

			<li class="item">
				
				<?php // the_post_thumbnail here ?>
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="latest-thumb-home">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<span class="overlay" style="opacity:0"></span>
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
				<?php } else { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php the_title(); ?>" /></a>
				<?php } ?>
				
				<div class="latest-content">
					<h3 class="box-title">
						<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php
						$thetitle = $post->post_title; /* or you can use get_the_title() */
						$getlength = strlen($thetitle);
						$thelength = 21;
						echo substr($thetitle, 0, $thelength);
						if ($getlength > $thelength) echo "...";
						?>
						</a>
					</h3>
					<p class="latest-blog-posts-date"><?php the_time('M j, Y') ?></p>
					<?php the_excerpt(); ?>
				</div>

			</li>

			<?php } // END while( $my_query->have_posts()

		echo '</ul></div>'; // END #latest-blog-posts

		} // END if( $my_query->have_posts()

	wp_reset_query(); ?>
	<!-- BLOG HOME ENDS -->

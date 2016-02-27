<?php
/**
 * Template Name: Portfolio
 *
 */

get_header(); ?>

	<div id="content" class="portfolio" role="main">

		<h1 class="entry-title entry-title-portfolio">Productions</h1></br></br>
		
		<?php the_post(); // Needed to retrieve the page content ?>

		<ul class="portfolio-filter">
			<li class="view-portfolio-cats">Showing:</li><li class="active"><a href="#" class="all">All</a></li>
			<?php
			$categories = get_categories( array('taxonomy' => 'portfolio_categories') );
  				foreach($categories as $category) {
					echo '<li><a href="#' . $category->category_nicename . '" class="' . $category->category_nicename . '">' . $category->name . '</a> </li> ';
				}
			?>
		</ul>

		<ul class="portfolio-list">
	
			<?php // START PORTFOLIO LOOP
			$query = new WP_Query();
			$query->query('post_type=portfolio&posts_per_page=-1');
			while ($query->have_posts()) : $query->the_post(); 
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			?>

			<?php
			$custom = get_post_custom($post->ID);
			$portfolio_desc = $custom["portfolio_desc"][0];
			$lightbox_path = $custom["lightbox_path"][0];
			?>

			<li class="item" data-id="id-<?php echo($query->current_post + 1); ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>all">

				<?php
				// if featured image is setup
				if ( has_post_thumbnail() ) { ?>

				<?php
				// NOT USED BECAUSE WE OPEN THE LIGHTBOX FROM PORTFOLIO POST.
				/*
				// Retrieves the attachment for the lightbox. The image is automatically retrieved from the Media Library.
				$attachment_id = get_post_thumbnail_id($post->ID); // Defines ID for image
				$width = '100%'; // Set the width
				$image_attributes = wp_get_attachment_image_src( $attachment_id, $width ); // returns an array
				*/
				?>
				
				<?php
				// Use Lightbox only if image or video
				if ($lightbox_path) { // display the magnify ?>
				<div class="portfolio-thumbnail">
					<a href="<?php echo $lightbox_path ?>" data-rel="prettyPhoto" title="<?php the_title_attribute(); ?>">
				<?php } else { // display the arrow ?>
				<div class="portfolio-thumbnail-no-lightbox">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php } // end if lightbox ?>
						<span class="overlay" style="opacity:0"></span>
						<?php the_post_thumbnail(); ?>
					</a>
				</div>

				<?php } else { ?>

					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php the_title_attribute(); ?>" /></a>

				<?php } // if has_post_thumbnail ?>


				<div class="portfolio-content">
					<h3 class="box-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php
							$thetitle = $post->post_title; /* or you can use get_the_title() */
							$getlength = strlen($thetitle);
							$thelength = 21;
							echo substr($thetitle, 0, $thelength);
							if ($getlength > $thelength) echo "...";
							?>
						</a>
					</h3>
					<?php if ($portfolio_desc) { ?><p class="portfolio-description"><?php //the_excerpt(); ?><?php echo $portfolio_desc ?></p><?php } ?>
				</div>

			</li>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<?php // END PORTFOLIO LOOP ?>

		</ul>
		
	</div>

<?php get_footer(); ?>

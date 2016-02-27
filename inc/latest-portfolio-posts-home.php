	<?php // LATEST PORTFOLIO POSTS HOMEPAGE ?>
	<?php
	$latest_portfolio_postperpage = stripslashes(get_option('of_latest_portfolio_postperpage'));
	$latest_portfolio_title = stripslashes(get_option('of_latest_portfolio_title'));
	$latest_portfolio_desc = stripslashes(get_option('of_latest_portfolio_desc'));
	?>

	<!-- PORTFOLIO HOME BEGINS -->
	<div id="latest-portfolio-posts-home">
		<h3 class="section-box-title"><?php echo $latest_portfolio_title; ?></h3>
		<?php if ($latest_portfolio_desc) { ?><p class="title-desc"><?php echo $latest_portfolio_desc; ?></p><?php } ?>

		<ul class="portfolio-list">
			<?php
			// START LOOP
			$query = new WP_Query();
			$query->query( array('post_type'=>'portfolio', 'posts_per_page'=> $latest_portfolio_postperpage ) );
			while ($query->have_posts()) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			?>

			<?php	
			$custom = get_post_custom($post->ID);
			$portfolio_desc = $custom["portfolio_desc"][0];
			?>

			<li class="item">

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
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php
							$thetitle = $post->post_title; /* or you can use get_the_title() */
							$getlength = strlen($thetitle);
							$thelength = 21;
							echo substr($thetitle, 0, $thelength);
								if ($getlength > $thelength) echo "...";
							?>
						</a>
					</h3>	
					<p class="portfolio-description"><?php //the_excerpt(); ?><?php echo $portfolio_desc ?></p>
				</div>

			</li>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

		</ul>

	</div>
	<!-- PORTFOLIO HOME ENDS -->

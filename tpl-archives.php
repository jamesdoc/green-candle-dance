<?php
/*
Template Name: Archives
*/
get_header(); ?>

<div id="container">
	
	<div id="content" role="main">
		<?php the_post(); ?>
<!--		<h1 class="entry-title"><?php the_title(); ?></h1> -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

<!--		<div class="archives-content">

			<div class="archives-block-first">

				<div class="archives-content-categories">
					<h3>Archives by Categories</h3>
					<ul>
						<?php wp_list_categories( 'title_li=' ); ?>
					</ul>
				</div>

				<div class="archives-content-month">
					<h3>Archives by Month</h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div>

			</div>

			<div class="archives-block-second">

				<div class="archives-content-blog-posts">
					<h3>Latest 30 Blog Posts</h3>
					<ul>
						<?php
						$args = array( 'numberposts' => '30' );
						$recent_posts = wp_get_recent_posts( $args );
						foreach( $recent_posts as $post ){
							echo '<li><a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' .   $post["post_title"].'</a> </li> ';
						}
						?>
					</ul>
				</div>

			</div>

		</div> -->

	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

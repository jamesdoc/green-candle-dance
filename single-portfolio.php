<?php
/**
 * The Template for displaying the single portfolio entries.
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
			<?php
			$custom = get_post_custom($post->ID);
			$portfolio_desc = $custom["portfolio_desc"][0];
			$portfolio_page_id = get_option('of_portfolio_page_id');
			?>

				<div id="nav-above" class="navigation">
					<?php if( get_option('of_portfolio_page_id') ){ ?>
<!--					<a class="back" href="<?php echo home_url( '/' ); ?>?page_id=<?php echo $portfolio_page_id ?>">&larr; Back to Productions</a> -->
					<a class="back" href="http://www.greencandledance.com/?page_id=101">&larr; Back to Productions</a>

					<?php } else { ?>
					<a class="back" href="javascript:javascript:history.go(-1)">&larr; Back to Productions</a>
					<?php } ?>
				</div>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php if ($portfolio_desc) { ?><h3 class="portfolio-description" style="font-weight:normal;"><?php echo $portfolio_desc ?></h3><?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

				</div>

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mav' ) . '</span>' ); ?></div>
				</div>

				<?php if( get_option('of_related_portfolio_posts') == 'true'){
					include(get_template_directory() .'/inc/related-portfolio-posts.php');
				} ?>
				
				<?php endwhile; // end of the loop. ?>

			</div>
		</div>

<?php get_sidebar( 'portfolio'); ?>
<?php get_footer(); ?>
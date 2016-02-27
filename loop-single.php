<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 */
?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mav' ) . '</span>' ); ?></div>
				</div>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<!--<div class="entry-meta">

						<?php mav_posted_on(); ?>
						<span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span>
						<?php if ( count( get_the_category() ) ) : ?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s categories-img">%2$s</span>', 'mav' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							</span>
						<?php endif; ?>
					</div> -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

				<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mav_author_bio_avatar_size', 60 ) ); ?>
						</div>
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'mav' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<p class="hlight"><?php the_author_meta('first_name'); ?> has written <span><?php the_author_posts(); ?></span> awesome articles for us at <a href="<?php echo home_url( '/' ) ?>"><?php bloginfo( 'name' ); ?></a></p>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'mav' ), get_the_author() ); ?>
								</a>
							</div>
						</div>
					</div>
					
				<?php endif; ?>

					<!--<div class="entry-utility">

						<?php
						$tags_list = get_the_tag_list( '' );
							if ( $tags_list ):
						?>
						<span class="tag-links">
							<?php printf( __( '<span class="%1$s tagged-img">%2$s</span>', 'mav' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
						</span>
						<?php endif; ?>

						<span class="permalink permalink-img">Bookmark the <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">permalink</a></span>
					</div> -->

				</div>
				
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mav' ) . '</span>' ); ?></div>
				</div>
				
				<?php if( get_option('of_related_posts') == 'true'){
				include(get_template_directory() .'/inc/related-blog-posts.php');
				} ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>




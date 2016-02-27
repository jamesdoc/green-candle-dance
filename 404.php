<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

	<div id="container" class="one-column">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( '404 - Not Found', 'mav' ); ?></h1>
				<div class="entry-content">
					<p style="margin-bottom:110px"><?php _e( 'Apologies, but the page you requested could not be found.', 'mav' ); ?></p>
				</div>
			</div>

		</div>
	</div>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
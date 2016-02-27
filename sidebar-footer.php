<?php
/**
 * The Footer widget areas.
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas have widgets.
	 * So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		//&& ! is_active_sidebar( 'third-footer-widget-area'  )

	)
		return;
	// If we get this far, we have widgets. Let do this.
	
	// Don't waste 20 minutes trying to the HTML for these widgets...
	// They are in `admin/widgets/widget-custom-content.php`
?>

	<div id="footer-widget-area" role="complementary">
		
		
		<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		<div id="first" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		<div id="second" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
			</ul>
		</div>
		<?php endif; ?>
		
		<?php /*
			// 2015-04-25 | James Doc: GCD only wanted shop & video in this area. Commented this out to prevent cluttering and confusing widget space
		<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
		<div id="third" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
			</ul>
		</div>
		<?php endif; ?>
		*/ ?>

	</div>

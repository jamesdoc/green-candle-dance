<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 */

	$template_dir = get_template_directory_uri();

?>

	</div>
</div>

	<section id="footer" role="contentinfo">

		<div class="footer-top"></div>

		<footer id="colophon" class="trigger_content">

			<?php get_sidebar( 'footer' );?>

		</footer>

	</section>

	<section id="footer_charity">

		<footer id="charity_icons">
			<ul class="icons">
				<li><a title="Tower Hamlets" href="http://www.towerhamlets.gov.uk/" target="_blank"><img src="<?php echo $template_dir ?>/images/footer-thumbs/tower-hamlets-thumb.jpg"></a></li>
				<li><a title="OCN London Region" href="http://www.ocnlr.org.uk/" target="_blank"><img src="<?php echo $template_dir ?>/images/footer-thumbs/ocn-thumb.jpg"></a></li>
				<li><a title="Oxford House" href="http://www.oxfordhouse.org.uk/" target="_blank"><img src="<?php echo $template_dir ?>/images/footer-thumbs/oxford-house-thumb.jpg"></a></li>
				<li><a title="Pqasso" href="http://www.ces-vol.org.uk/PQASSO" target="_blank"><img src="<?php echo $template_dir ?>/images/footer-thumbs/pqasso-thumb.jpg"></a></li>
				<li><a title="Charity Quality Standard" href="https://www.gov.uk/government/organisations/charity-commission" target="_blank"><img src="<?php echo $template_dir ?>/images/footer-thumbs/charity-quality-thumb.jpg"></a></li>
			</ul>

			<a href="/about/acknowledgements/" class="btn btn--charity-acknowledgements btn--point-right">View all acknowledgments</a>

		</footer>

	</section>


	<section id="footer-bottom" class="clearfix">

		<footer>

			<p class="copyright">
				&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ><?php bloginfo( 'name' ); ?></a> &middot; Green Candle Ltd is registered in England Reg No 2266864 &middot; Registered Charity No 801774​.<br />
				Theme design: <a href="http://mattiaviviani.com/" target="_blank">Mattia Viviani</a> &middot; Build: <a href="http://www.sunnyspell.com/" target="_blank">SunnySpell</a> &middot; Ongoing development: <a href="http://jamesdoc.com" target="_blank" title="Faith, Hope, Love and Web Development">James Doc</a> &middot; All content by Green Candle Dance Company.
			</p>

		</footer>

	</section>

</div>



<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<?php
	/*	Nivo Slider - http://nivo.dev7studios.com/ */
	$slider_effect = get_option('of_slider_effect');
	$slider_slices = get_option('of_slider_slices');
	$slider_animSpeed = get_option('of_slider_animSpeed');
	$slider_pauseTime = get_option('of_slider_pauseTime');
	$slider_directionNav = get_option('of_slider_directionNav');
	$slider_controlNav = get_option('of_slider_controlNav');
	?>

	<script type="text/javascript">
	// Slider - see custom.js for all options
	jQuery(window).load(function() {
		jQuery('#slider').nivoSlider({
			effect: '<?php echo $slider_effect ?>', // Specify sets like: ' fold, fade, sliceDown, etc..'
			slices: <?php echo $slider_slices ?>, // For slice animations
			boxCols: 8, // For box animations
			boxRows: 4, // For box animations
			animSpeed: <?php echo $slider_animSpeed ?>, // Slide transition speed
			pauseTime: <?php echo $slider_pauseTime ?>, // How long each slide will show
			startSlide: 0, // Set starting Slide (0 index)
			directionNav: <?php echo $slider_directionNav ?>, // Next & Prev navigation arrows
			controlNav: <?php echo $slider_controlNav ?>, // 1,2,3... navigation
			controlNavThumbs: false, // Use thumbnails for Control Nav
			controlNavThumbsFromRel: false, // Use image rel for thumbs
//			controlNavThumbsSearch: '.jpg', // Replace this with...
//			controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
			keyboardNav: true, // Use left & right arrows
			pauseOnHover: true, // Stop animation while hovering
			manualAdvance: false, // Force manual transitions
			captionOpacity: 0.8, // Universal caption opacity
			prevText: 'Prev', // Prev directionNav text
			nextText: 'Next', // Next directionNav text
			beforeChange: function(){}, // Triggers before a slide transition
			afterChange: function(){}, // Triggers after a slide transition
			slideshowEnd: function(){}, // Triggers after all slides have been shown
			lastSlide: function(){}, // Triggers when last slide is shown
			afterLoad: function(){} // Triggers when slider has loaded
		});
	});
	</script>

</body>
</html>

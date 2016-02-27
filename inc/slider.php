	<?php $slider_height = get_option('of_slider_height'); ?>
	<!-- SLIDER BEGINS -->
	<div id="slider-wrapper">
		<div id="slider" class="nivoSlider" style="height:<?php echo $slider_height // allows to see the preloader ?>px">
			<?php
			$slides = array();
			global $slides;
			if(get_option('slides')) {
				$slides = get_option('slides');
			} else {
				$slides = false;	
			}
			foreach($slides as $num => $slide) :
			?>
			<?php if($slide['src'] != '') {
			echo '<a href="' . $slide['link'] . '">'; ?>
			<img src="<?php echo $slide['src'] ?>"  alt="<?php the_title(); ?>" title="<?php echo $slide['caption'] ?>"></a>
			
			<?php } else { ?>

			<img src="<?php echo get_template_directory_uri(); ?>/images/ph-slider.jpg" alt="<?php the_title(); ?>">

			<?php } endforeach; ?>

		</div>
	</div>
	<!-- SLIDER ENDS -->
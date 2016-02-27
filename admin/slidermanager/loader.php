<?php

//require_once in function.php

define('MANAGER_URI', get_stylesheet_directory_uri() . '/admin/slidermanager');

add_action('admin_menu', 'manager_admin_menu');
add_action('admin_init', 'manager_init');

global $slides;

if(get_option('slides')) {
	$slides = get_option('slides');
} else {
	$slides = false;	
}

// admin menu
function manager_admin_menu() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
		
		if(isset($_POST['action']) && $_POST['action'] == 'save') {
			
			$slides = array();
			
			foreach($_POST['src'] as $k => $v) {
				$slides[] = array(
					'src' => $v,
					'link' => $_POST['link'][$k],
					'caption' => $_POST['caption'][$k]
				);
			}

			update_option('slides', $slides);
			
		}
		
	}
	
/*	if(function_exists('add_object_page')) {
		add_object_page('Slider Manager', 'Slider Manager', 'edit_themes', 'slidermanager', 'manager_wrap');		
	}
	else {
		add_menu_page('Slider Manager', 'Slider Manager', 'edit_themes', 'slidermanager', 'manager_wrap');
	}	*/
	
}


// slider manager wrapper
function manager_wrap() {
	global $slides;
	
?>

	<div class="wrap" id="of_container">
	
		<h2>Slider Manager</h2>

		<form action="" id="manager_form" method="post">
		
			<ul id="manager_form_wrap">

				<?php if(get_option('slides')) : $slides = get_option('slides'); ?>
				<?php $postcount = 1; // start counter at 0 ?>
				<?php foreach($slides as $k => $slide) : ?>
			
				
				<li class="slide">
					<label style="display:block;"><strong>Slide <?php echo $postcount++; ?></strong></label><br/>
					<label><strong>Image size must be 940px width * 310px height</strong><br/>Slider height can be changed via Appearance > Theme Settings > Slider</label>
					<br/><br/>

					<label>Image Source (eg: http://www.domain.com/images/image.jpg)</label>
					<input type="text" name="src[]" class="slide_src" value="<?php echo $slide['src'] ?>">

					<label>Image Link</label>
					<input type="text" name="link[]" id="slide_link" value="<?php echo $slide['link'] ?>">

					<label>Image Caption</label>
					<textarea name="caption[]" cols="20" rows="2" class="slide_caption"><?php echo $slide['caption'] ?></textarea>

					<?php if ( $slide['src'] ) { ?>
					<img style="display:block;width:250px" src="<?php echo $slide['src'] ?>">
					<?php } else { ?>
					<img style="display:block;" src="<?php echo get_template_directory_uri(); ?>/admin/slidermanager/ph-slidermanager.jpg">
					<?php } ?>
					<input style="float:right;margin-top:-21px;" type="submit" value="Save All Changes" id="manager_submit" class="button-primary">
					<input type="hidden" name="action" value="save">

					<button style="float:right;margin-top:-21px;margin-right:15px;" class="remove_slide button-secondary">Remove This Slide</button>

				</li>

				<?php endforeach; ?>
				
				<?php else : ?>
			
				<li class="slide">
					<label style="display:block;"><strong>Slide <?php echo $postcount++; ?></strong></label><br/>
					<label><strong>Image size must be 940px width * 310px height</strong><br/>Slider height can be changed via Appearance > Theme Settings > Slider</label>
					<br/><br/>

					<label>Image Source (eg: http://www.domain.com/images/image.jpg)</label>
					<input type="text" name="src[]" class="slide_src" value="<?php echo $slide['src'] ?>">

					<label>Image Link</label>
					<input type="text" name="link[]" id="slide_link" value="<?php echo $slide['link'] ?>">

					<label>Image Caption</label>
					<textarea name="caption[]" cols="20" rows="2" class="slide_caption"><?php echo $slide['caption'] ?></textarea>

					<?php if ( $slide['src'] ) { ?>
					<img style="display:block;width:250px" src="<?php echo $slide['src'] ?>">
					<?php } else { ?>
					<img style="display:block;" src="<?php echo get_template_directory_uri(); ?>/admin/slidermanager/ph-slidermanager.jpg">
					<?php } ?>
					<input style="float:right;margin-top:-21px;" type="submit" value="Save All Changes" id="manager_submit" class="button-primary">
					<input type="hidden" name="action" value="save">

					<button style="float:right;margin-top:-21px;margin-right:15px;" class="remove_slide button-secondary">Remove This Slide</button>

				</li>
				
				<?php endif; ?>
			
			</ul>
			
			<input type="submit" value="Save All Changes" id="manager_submit" class="button-primary">
			<input type="hidden" name="action" value="save">
			
		</form>
		
	</div>

<?php
	
}


// slider manager init
function manager_init() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
	
		// scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-appendo', MANAGER_URI . '/js/jquery.appendo.js', false, '1.0', false);
		wp_enqueue_script('slider-manager', MANAGER_URI . '/js/manager.js', false, '1.0', false);
		
		// styles
		wp_enqueue_style('slider-manager', MANAGER_URI . '/css/manager.css', false, '1.0', 'all');
		
	}

}
?>
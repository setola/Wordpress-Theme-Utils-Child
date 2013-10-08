<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @version 1.0.0
 * @package templates
 * @since 0.1
 */

ThemeHelpers::load_css('style');
ThemeHelpers::load_js('bootstrap');
?>

<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'header'); ?>

<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'navbar'); ?>

	<div id="main-content" class="container">
		<div class="row">
			<div class="col-md-6">
				<?php 
					$image = new ImageGenerator(); 
					$image
						->set('width', '460')
						->set('height', '300')
						->set('image_text', '404')
						->set('font_size', '150')
						->set('text_position_x', '80')
						->set('text_position_y', '200')
						->set('bg_color', 'cccccc')
						->set('text_color', '222222');
					echo $image->get_markup();			
				?>
			</div>
			<div class="col-md-6">
				<?php 
					$escape = new EscapeRoute();
					$escape->templates->set_markup('class', 'grid_6');
					echo $escape->get_markup();
				 ?>
				<hr>
				<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'searchform'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php the_widget('WP_Widget_Pages'); ?>
			</div>
			<div class="col-md-6">
				<?php the_widget('WP_Widget_Recent_Posts'); ?>
			</div>
		</div>
	</div>

<?php 
	get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'footer'); 
?>

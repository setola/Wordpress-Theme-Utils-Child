<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 0.1
 * @version 1.0.0
 * @package templates
 */

ThemeHelpers::load_css('style');
ThemeHelpers::load_js('bootstrap');
?>

<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'header'); ?>

<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'navbar'); ?>
	<div class="container">
		<div class="row">
		<?php
			while(have_posts()){
				the_post(); 
				get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'content', get_post_format());
			}
		?>
		</div>
			
		<?php //get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'sidebar'); ?>
		
		<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'pagination'); ?>
	</div>
<?php 
	get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'footer'); 
?>

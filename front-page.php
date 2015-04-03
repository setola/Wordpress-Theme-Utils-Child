<?php 
/**
 * The Template for displaying the home page
 * @version 1.0.0
 * @package templates
 * @since 0.1
 */

use WPTU\Core\Helpers\ThemeHelpers;
use WPTU\Core\Metaboxes\MediaManager;

ThemeHelpers::load_css('style');
ThemeHelpers::load_js('bootstrap');

get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'header'); 
get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'navbar');

echo MediaManager::get_gallery('slideshow');
?>
<div class="container">
	<div class="row">
	<?php
	while(have_posts()){
		the_post();
		get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'content', get_post_type().'-notitle');
	}
	?>
	</div>
</div>

<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'footer');

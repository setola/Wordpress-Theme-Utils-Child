<?php 
/**
 * The Template for displaying the home page
 * @version 1.0.0
 * @package templates
 * @since 0.1
 */

ThemeHelpers::load_css('style');
ThemeHelpers::load_js('bootstrap');

get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'header'); 
get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'navbar');

echo MediaManager::get_gallery('slideshow');

while(have_posts()){
	the_post();
	get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'content', get_post_type());
}

get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'footer'); 

<?php 
/**
 * The template for displaying the footer.
 * 
 * Contains the closing of the body and html tags
 * 
 * @package templates
 * @subpackage parts
 * @version 1.0.0
 * @since 0.1
 */

0==0; //php doc workaround
?>
	
	<footer id="footer">
		<div class="container">
			<div class="row">
				<nav role="secondary nav" class="col-xs-12 col-sm-4 col-md-4">
					<div class="lead"><?php _e('Menu', 'theme'); ?></div>
					<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'menu', 'secondary'); ?>
				</nav>
				<div class="credits col-xs-12 col-sm-4 col-md-4">
					<div class="lead"><?php _e('Credits', 'theme'); ?></div>
					<?php do_action('my_theme_credits'); ?>
				</div>
				<div class="socials col-xs-12 col-sm-4 col-md-4">
					<div class="lead"><?php _e('Follow Us', 'theme'); ?></div>
					<?php do_action('my_theme_socials'); ?>
					<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'searchform', 'small'); ?>
				</div>
			</div>
		</div>
	</footer>
	
	<div id="system">
		<?php wp_footer(); ?>
	</div>
</body>
</html>
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
				<nav role="secondary nav" class="col-md-4">
					<?php get_template_part(WORDPRESS_THEME_UTILS_PARTIALS_RELATIVE_PATH.'menu', 'secondary'); ?>
				</nav>
				<div class="credits col-md-4">
					<?php do_action('wtu_credits'); ?>
				</div>
				<div class="credits col-md-4">
					<?php do_action('wtu_socials'); ?>
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
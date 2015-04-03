<?php
/**
 * The navigation bar for our theme.
 *
 * Displays all of the top menu
 *
 * @package templates
 * @subpackage parts
 * @version 1.0.0
 * @since 0.1
 */

use WPTU\Core\Helpers\HtmlHelper;

?>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only"><?php __('Toggle navigation', 'theme'); ?></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span>
			</button>
			<?php 
				echo HtmlHelper::anchor(
					get_home_url('/'), 
					get_bloginfo('name'),
					array('title' => get_bloginfo('name', 'display'), 'class' => 'navbar-brand')
				);
			?>
		</div>
			 
		<?php
		
			include_once get_stylesheet_directory().'/'.WORDPRESS_THEME_UTILS_LIBRARIES_RELATIVE_PATH.'wp-bootstrap-navwalker/wp_bootstrap_navwalker.php';
			wp_nav_menu( array(
				'menu'              => 'primary',
				'theme_location'    => 'primary',
				'depth'             => 2,
				'container'         => 'div',
				'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
				'menu_class'        => 'nav navbar-nav',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker())
			);
		?>
		
	</div>
</nav>

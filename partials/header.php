<?php 
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till 'main container' div
 *
 * @package templates
 * @subpackage parts
 * @version 1.0.0
 * @since 0.1
 */

use WPTU\Core\Helpers\ThemeHelpers;
use WPTU\Core\Helpers\HtmlHelper;
use WPTU\Core\Helpers\HeadHelper;

echo HtmlHelper::doctype('html5');
echo HtmlHelper::open_html();

?>
<head>
	<?php 
		// you can either use this helper to manage you <head> tag
		$header = new HeadHelper();
		$header
			->set_title(ThemeHelpers::get_the_seo_title())
			->set_meta_tag(
				array(
					'name'		=>	'description',
					'content'	=>	ThemeHelpers::get_the_seo_description()
				)
			)
			->set_meta_tag(
				array(
					'name'		=>	'viewport',
					'content'	=>	'width=device-width, initial-scale=1.0'
				)
			)
			->set_ua('UA-XXXXXXXXXXX-XX')
			->the_head();
		wp_head();
		// or simply add some metas inside after the </head> :)
	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
    <![endif]-->
</head>
<body <?php //body_class(); ?>>

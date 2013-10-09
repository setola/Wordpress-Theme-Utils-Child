<?php 


function my_theme_custom_init(){
	// initialize the framework
	wtu_init();
	
	// Load the needed class the first time an object is instancied
	ThemeUtils::enable_autoload_system();
	
	// Let's say our theme has a main navigation menu
	ThemeUtils::register_main_menu();
	
	// and also a smaller menu on the footer
	ThemeUtils::register_bottom_menu();
	
	// register some js and css
	global $assets;
	$assets = new DefaultAssetsCDN();
	$assets
		->add_css('bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', null, '3.0.0', 'screen')
		->add_css('bootstrap-theme', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css', array('bootstrap'), '3.0.0', 'screen')
		->add_css('style', '/style.css', array('bootstrap'), '1.0.0', 'screen')
		->add_js('bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'), '3.0.0', true)
		->add_js('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5142f4961c6fb998', null, null, true);
	
	// use v() vd() vc() functions
	ThemeUtils::enable_debug();
	
}
add_action('after_setup_theme', 'my_theme_custom_init');


function my_theme_socials(){
	?>
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_compact"></a>
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_google_plusone_share"></a>
		</div>
	<?php 
	ThemeHelpers::load_js('addthis');
}
add_action('wtu_socials', 'my_theme_socials');

/**
 * Customized [caption] shortcode
 * @param unknown $attr
 * @param unknown $content
 * @return unknown|string
 */
function my_theme_caption($val, $attr, $content){
	$attr = shortcode_atts(
		array(
			'id'		=>	'',
			'align'		=>	'aligncenter',
			'width'		=>	'',
			'caption'	=>	''
		), 
		$attr
	);
	
	$caption = HtmlHelper::standard_tag(
		'figcaption', 
		$attr['caption'], 
		array_merge(
			array(
				'id'=>'figcaption_'.$attr['id'], 
				'class'=>'wp-caption-text'
			),
			(array)$attr['caption']
		)
	);

	return HtmlHelper::standard_tag(
		'figure', 
		do_shortcode($content).$caption, 
		array(
			'id'=>$attr['id'], 
			'class'=>'wp-caption img-thumbnail ' . esc_attr($attr['align'])
		)
	);

}
add_filter('img_caption_shortcode', 'my_theme_caption', 10, 3);


function my_theme_gallery($content, $attr) { return 'THE GALLERY IS UNDER PROCESS!!! :D';}
add_filter('post_gallery', 'my_theme_gallery', 10, 2);

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
	
	// we want to be able to have multiple groups of images to split in different gallery in a single page.
	MediaManager::enable();
	$slideshow_config = array(
			'label'		=>	__('Slideshow', 'wtu_framework'),
			'shortcode'	=>	'slideshow',
			'wpml'		=>	array(
					'default_lang'			=>	true,
					'homepage'				=>	true,
					'homepage_default_lang'	=>	true
			),
			'exclude'	=>	array('template-gallery.php', 'template-location.php', 'template-offers.php')
	);
	MediaManager::set_media_list('slideshow', $slideshow_config);
	
	$minigallery_config = array(
			'label'		=>	__('Minigallery', 'wtu_framework'),
			'shortcode'	=>	'minigallery',
			'exclude'	=>	array('template-gallery.php', 'template-location.php', 'front-page.php', 'template-offers.php')
	);
	MediaManager::set_media_list('minigallery', $minigallery_config);
	
	$photogallery_config = array(
			'label'		=>	__('Photogallery', 'wtu_framework'),
			'shortcode'	=>	'photogallery',
			'include'	=>	array('template-gallery.php')
	);
	MediaManager::set_media_list('photogallery', $photogallery_config);
	
	
	
}
add_action('after_setup_theme', 'my_theme_custom_init');

/**
 * Adds some social icons using AddThis service
 */
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
add_action('my_theme_socials', 'my_theme_socials');

/**
 * Adds some entries into the credits menu
 */
function my_theme_credits(){
	$toret = array();
	$toret[] = HtmlHelper::anchor(
			home_url('/'),
			sprintf(__('&copy; %s', 'theme'), get_bloginfo('name'))
	);
	$toret[] = HtmlHelper::anchor(
			__('https://github.com/setola/Wordpress-Theme-Utils/', 'theme'),
			sprintf(__('Built on %s', 'theme'), 'WordPress Themes Utils')
	);
	$toret[] = HtmlHelper::anchor(
			__('http://wordpress.org/', 'theme'),
			sprintf(__('Powered by %s', 'theme' ), 'WordPress')
	);
	$toret[] = HtmlHelper::anchor(
			__('http://eclipse.org/', 'theme'),
			sprintf(__('Coded with %s', 'theme' ), 'Eclipse')
	);

	echo HtmlHelper::unorderd_list($toret, array('class'=>'linear-menu clearfix'));
}
add_action('my_theme_credits', 'my_theme_credits');

/**
 * Customized [caption] shortcode to output html 5 markup
 * @param unknown $attr
 * @param unknown $content
 * @return unknown|string
 */
function my_theme_caption($val, $attr, $content){
	$attr = shortcode_atts(
		array(
			'id'		=>	'',
			'align'		=>	'',
			'width'		=>	580, //if you don't specify the width in your shorcode, this is the default value will be considered.
			'caption'	=>	''
		),
		$attr
	);

	$caption = HtmlHelper::standard_tag(
			'figcaption',
			$attr['caption'],
			array_merge(
					array(
							'id'		=>	'figcaption_'.$attr['id'],
							'class'		=>	'wp-caption-text'
					),
					(array)$attr['caption']
			)
	);
	
	// fix for having the aligncenter class properly working
	// (css 'margin: auto' property requires a known width element)
	// 10 is 2 times the sum of padding and border for this theme
	if($attr['align'] == 'aligncenter'){
		$style = 'width:'.(intval($attr['width'])+10).'px';
	}

	return HtmlHelper::standard_tag(
			'figure',
			do_shortcode($content).$caption,
			array(
					'id'			=>	$attr['id'],
					'class'			=>	'wp-caption img-thumbnail ' . esc_attr($attr['align']),
					'style'			=>	$style
			)
	);

}
add_filter('img_caption_shortcode', 'my_theme_caption', 10, 3);

function my_theme_gallery($content, $attr) { return 'THE GALLERY IS UNDER PROCESS!!! :D';}
add_filter('post_gallery', 'my_theme_gallery', 10, 2);

/**
 * [caption] shortcode now renders html 5 code
 * @param unknown $html
 * @param unknown $id
 * @param unknown $caption
 * @param unknown $title
 * @param unknown $align
 * @param unknown $url the url the image have to link to
 * @param unknown $size
 * @return string
 */
function my_theme_img_tag_filter($html, $id, $caption, $title, $align, $url, $size, $alt) {
	$thumb = wp_get_attachment_image_src($id, $size);
	$image = HtmlHelper::image(
			$thumb[0],
			array(
					'class'		=>	implode(' ', array('align'.$align, 'size-'.$size, 'wp-image-'.$id, 'img-thumbnail')),
					'width'		=>	$thumb[1],
					'height'	=>	$thumb[2],
					'alt'		=>	$alt
			)
	);

	if($url){
		if(!$title){
			$title = get_the_title($id);
		} 
		$image = HtmlHelper::anchor($url, $image, array('title'=>$title)); 
	}
	
	return $image;


	// nice piece of code to enable html 5 figcaption
	// but by doing so you'll break the wysiwyg editor
	// capability to edit image once it's inserted 
	// into the post content. Sorry folks
	/*$figcaption = '';
	if($caption){
		$figcaption = HtmlHelper::standard_tag(
			'figcaption',
			$caption,
			array(
				'class'	=>	'wp-caption-text'
			)
		);
	}
	
	$thumb = wp_get_attachment_image_src($id, $size);
	
	$image = HtmlHelper::image(
		$thumb[0], 
		array(
			'class'		=>	implode(' ', array('align'.$align, 'size-'.$size, 'wp-image-'.$id)), 
			'title'		=>	$title
		)
	);

	if($url){
		$image = HtmlHelper::anchor($url, $image);
	}

	return HtmlHelper::standard_tag(
		'figure',
		$image.$figcaption,
		array(
			'class'		=>	implode(' ', array('wp-caption', 'img-thumbnail', $align))
		)
	);*/
}
add_filter( 'image_send_to_editor', 'my_theme_img_tag_filter', 10, 9 );



function login_menu(){
	$tpl = <<<EOF
		<form class="inline-form login-form margin-form" action="%action%" method="post">
			<fieldset>
				<input type="text" name="log" class="input-small pull-left" placeholder="%user%">
				<input type="password" name="pwd" class="input-small pull-right" placeholder="%password%">
				<label class="checkbox pull-left">
					<input type="checkbox" name="rememberme" checked="checked" value="forever"> %remember%
				</label>
				<button type="submit" name="submit" value="Send" class="btn btn-primary pull-right">%signin%</button>
				<div style="clear:both;"></div>
			</fieldset>
		</form>
EOF;

	$sub = new SubstitutionTemplate();
	return $sub
		->set_tpl($tpl)
		->set_markup('action', get_option('home').'/wp-login.php')
		->set_markup('user', __('Username', 'theme'))
		->set_markup('password', __('Password', 'theme'))
		->set_markup('remember', __('Remember Me', 'theme'))
		->set_markup('signin', __('Sign In', 'theme'))
		->replace_markup();
}

function logout_menu(){
	$logout_href 		= wp_logout_url(urlencode($_SERVER['REQUEST_URI']));
	$logout 				= __('Logout', self::textdomain);
	$admin_href 		= '/wp-admin/';
	$admin 					= __('Dashboard', self::textdomain);
	$vehicles_href 	= '/wp-admin/admin.php?page='.VehiclesStatsConfig::get_instance()->menu->vehicles->slug;
	$vehicles 			= __('Vehicles', self::textdomain);
	$events_href 		= '/wp-admin/admin.php?page='.VehiclesStatsConfig::get_instance()->menu->manage->slug;
	$events 				= __('Events', self::textdomain);
	$stats_href 		= '/wp-admin/admin.php?page='.VehiclesStatsConfig::get_instance()->menu->stats->slug;
	$stats 					= __('Stats', self::textdomain);

	return <<<EOF
			<li><a href="$admin_href" rel="noinde,nofollow">$admin</a></li>
			<li><a href="$vehicles_href" rel="noinde,nofollow">$vehicles</a></li>
			<li><a href="$events_href" rel="noinde,nofollow">$events</a></li>
			<li><a href="$stats_href" rel="noinde,nofollow">$stats</a></li>
			<li class="divider"></li>
			<li><a href="$logout_href" rel="noinde,nofollow">$logout</a></li>
EOF;
}

function account_menu_ajax(){
	die((is_user_logged_in()) ? logout_menu() : login_menu());
}


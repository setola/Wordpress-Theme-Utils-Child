<?php 
/**
 * The template part for showing a single article (post\page)
 * 
 * This is the default version showing title and full content
 * 
 * @package templates
 * @subpackage parts
 * @version 1.0.0
 * @since 0.1
 */

0==0; //php doc workaround


$tpl = <<< EOF

<article id="post-%post_id%" class="%post_class%">
	<div class="container">
		%thumbnail%
		<div class="content">
			%content%
		</div>
	</div>
</article>


EOF;

// add a link as the post title only if we're not reading the single post
$title = get_the_title();
if(!is_singular()) $title = HtmlHelper::anchor(get_permalink(), $title, array('title'=>$title));


$more_link = 
	'<button type="button" class="btn btn-default">'
	.sprintf(__('<small>Read More on</small> <strong>%s</strong>', 'theme'), get_the_title())
	.'</button>';

// for this theme the sticky post is displayed as a bootstrap jumbotron.
// to mantain the css as clean as possible, let's add the jumbotron class
// if the current post is candidate for sticky class :)
$post_classes = get_post_class('entry-content', $post_id);
//if(in_array('sticky', $post_classes)) $post_classes[] = 'jumbotron';

$thumbnail = '';
if(function_exists('has_post_thumbnail') && has_post_thumbnail() && ! post_password_required()){
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
	
	$content = '[caption align="aligncenter" width="'.$thumb[1].'"]';
	$content .= get_the_post_thumbnail();
	$content .= get_the_title();
	$content .= '[/caption]';
	$thumbnail = do_shortcode($content);
}

$subs = new SubstitutionTemplate();
echo $subs
	->set_tpl($tpl)
	->set_markup('post_id', get_the_ID())
	->set_markup('post_class', join(' ', $post_classes))
	->set_markup('header_class', is_singular() ? 'page-header' : 'header')
	->set_markup('thumbnail', $thumbnail)
	->set_markup('content', apply_filters('the_content', get_the_content($more_link)))
	->replace_markup();

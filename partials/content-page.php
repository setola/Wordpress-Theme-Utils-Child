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
		<header class="%header_class%">
			<h1>%title%</h1>
		</header>
		%thumbnail%
		<div class="content">
			%content%
		</div>
	</div>
</article>


EOF;

// add a link as the post title only if we're not reading the single post
$title = get_the_title();


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
	->set_markup('title', $title)
	->set_markup('thumbnail', $thumbnail)
	->set_markup('content', apply_filters('the_content', get_the_content()))
	->replace_markup();


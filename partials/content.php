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
		<div class="entry-meta">
			%metas%
		</div>
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
	'<a type="button" class="btn btn-default">'
	.sprintf(__('<small>Read More on</small> <strong>%s</strong>', 'theme'), get_the_title())
	.'</a>';

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
	->set_markup('metas', my_theme_post_meta_list())
	->set_markup('content', apply_filters('the_content', get_the_content($more_link)))
	->replace_markup();



/*
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

<?php */

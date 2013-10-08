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
		<header class="header">
			<h1>%title%</h1>
		</header>
		<div class="entry-meta">
			%metas%
		</div>
		<div class="content">
			%content%
		</div>
	</div>
</article>


EOF;

// add a link as the post title only if we're not reading the single post
$title = get_the_title();
if(!is_singular()) $title = HtmlHelper::anchor(get_permalink(), $title);


$more_link = 
	'<button type="button" class="btn btn-default">'
	.sprintf(__('Read More on %s', 'theme'), get_the_title())
	.'</button>';

// for this theme the sticky post is displayed as a bootstrap jumbotron.
// to mantain the css as clean as possible, let's add the jumbotron class
// if the current post is candidate for sticky class :)
$post_classes = get_post_class('entry-content', $post_id);
if(in_array('sticky', $post_classes)) $post_classes[] = 'jumbotron';

// Let's add some usefull information about the current post
$icon_class = 'glyphicon';
$separator = '&nbsp;&nbsp;';
$metas = array();
$metas[] = HtmlHelper::span('', array('class'=>$icon_class.' glyphicon-time')).$separator.get_the_date();
$metas[] = HtmlHelper::span('', array('class'=>$icon_class.' glyphicon-folder-open')).$separator.get_the_category_list(', ');
$metas[] = HtmlHelper::span('', array('class'=>$icon_class.' glyphicon-tags')).$separator.get_the_tag_list('', ', ');


$subs = new SubstitutionTemplate();
echo $subs
	->set_tpl($tpl)
	->set_markup('post_id', get_the_ID())
	->set_markup('post_class', join(' ', $post_classes))
	->set_markup('title', $title)
	->set_markup('metas', HtmlHelper::unorderd_list($metas, array('class'=>'list-inline')))
	->set_markup('content', get_the_content($more_link))
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

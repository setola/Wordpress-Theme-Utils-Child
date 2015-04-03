<?php

    use WPTU\Core\Helpers\HtmlHelper;

	global $wp_query, $paged;
		
	$links = '';
	
	// we are in a multiple posts scenario
	if($wp_query->max_num_pages > 1){
		if(!$paged) $paged = 1;
	
		// add link to previous posts
		if($paged > 1){
			$links .= HtmlHelper::list_item(
				HtmlHelper::anchor(
					previous_posts(false), 
					__( '&larr; Newer entries', 'theme')
				),
				array('class'	=>	'previous')
			);
		}
		
		
		// add link to next posts
		if((intval($paged) + 1) <= $wp_query->max_num_pages){
			$links .= HtmlHelper::list_item(
				HtmlHelper::anchor(
					next_posts($wp_query->max_num_pages, false), 
					__( 'Older entries &rarr;', 'theme')
				),
				array('class'	=>	'next')
			);
		}
	}
	
	// we are in a single post scenario
	if(is_singular()){
		$next_post = get_next_post();
		$prev_post = get_previous_post();
		
		$next_post_label = 
			HtmlHelper::standard_tag('small', __('Next entry: '))
			.HtmlHelper::strong(get_the_title($next_post))
			.' &rarr;';
		
		$prev_post_label = 
			HtmlHelper::standard_tag('small', __('&larr; Previous entry: '))
			.HtmlHelper::strong(get_the_title($prev_post));
		
		$links .= HtmlHelper::list_item(
			HtmlHelper::anchor(
				get_permalink($next_post), 
				$next_post_label
			),
			array('class'	=>	'next')
		);
		
		$links .= HtmlHelper::list_item(
			HtmlHelper::anchor(
				get_permalink($prev_post), 
				$prev_post_label
			),
			array('class'	=>	'previous')
		);
	}
	
	// finally if we have something to write
	if(!empty($links)){ 
		echo HtmlHelper::standard_tag(
				'nav', 
				HtmlHelper::standard_tag('h1', __('Posts navigation', 'theme'), array('class'=>'sr-only'))
				.HtmlHelper::unorderd_list($links, array('class'=>'pager')),
				array('role'=>'navigation', 'class'=>'container')
		);
	}

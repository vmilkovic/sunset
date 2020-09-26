<?php

/*
	@package sunset
	THEME SUPPORT OPTIONS
*/

$options = get_option('post_formats');
if(!empty($options)){
	$formats = ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'];
	$output = [];
	foreach($formats as $format){
		$output[] = (@$options[$format] == 1 ? $format : '');
	};
	add_theme_support('post-formats', $output);
}

$header = get_option('custom_header');
if($header){
	add_theme_support('custom-header');
}

$background = get_option('custom_background');
if($background){
	add_theme_support('custom-background');
}

add_theme_support('post-thumbnails');

// Activate Nav Menu Option
function sunset_register_nav_menu(){
	register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'sunset_register_nav_menu');

/**
 * BLOG LOOP POST META
 * @return string
 */
function sunset_posted_meta(){
	$posted_on  = human_time_diff(get_the_time('U'), current_time('timestamp'));
	$categories = get_the_category();
	$separator  = ', ';
	$output     = '';
	$i          = 1;
	if(!empty($categories)):
		foreach($categories as $category):
			if($i > 1):
				$output .= $separator;
			endif;
			$output .= '<a href="' . esc_url( get_category_link($category->term_id) ) . '">' . esc_html($category->name) . '</a>';
			$i++;
		endforeach;
	endif;
	return '<span class="posted-on">Posted <a href="' . esc_url(get_permalink()) . '">' . $posted_on . '</a> ago</span> / <span class="posted-on">' . $output . '</span>';
}

/**
 * BLOG LOOP POST FOOTER
 * @return string
 */
function sunset_posted_footer(){
	return 'tag list and comment link';
}
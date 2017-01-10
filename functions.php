<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* End WooThemes Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

/*Kyle addition - make all custom post types show on archives pages. Found on http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/ */
function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'veteran', 'testimonial', 'event', 'video'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/*Kyle addition - make all custom post types included in search. Found in the comments on http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/ */
// Define what post types to search
function searchAll( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'page', 'feed', 'testimonial', 'event', 'video', 'veteran'));
	}
	return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );

/*Kyle addition - add custom post template selector to CPTs */
function my_cpt_post_types( $post_types ) {

    $post_types[] = 'veteran';

    return $post_types;

}

add_filter( 'cpt_post_types', 'my_cpt_post_types' );
//Kyle and Rogan adding a video shortcode
include 'shortcode-fun.php';
?>
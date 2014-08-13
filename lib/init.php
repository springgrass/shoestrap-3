<?php
/**
 * Roots initial setup and constants
 */
function shoestrap_setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/roots-translations
  load_theme_textdomain('shoestrap', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'shoestrap')
  ));

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption','gallery'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'shoestrap_setup');


if ( ! function_exists( 'porfolio_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function porfolio_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'shoestrap' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'shoestrap' ),
		'menu_name'                  => __( 'Portfolio Categories', 'shoestrap' ),
		'all_items'                  => __( 'All Portfolio Categories', 'shoestrap' ),
		'parent_item'                => __( 'Parent Item', 'shoestrap' ),
		'parent_item_colon'          => __( 'Parent Item:', 'shoestrap' ),
		'new_item_name'              => __( 'New Portfolio Category', 'shoestrap' ),
		'add_new_item'               => __( 'Add Portfolio Category', 'shoestrap' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'shoestrap' ),
		'update_item'                => __( 'Update Portfolio Category', 'shoestrap' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'shoestrap' ),
		'search_items'               => __( 'Search Portfolio Categories', 'shoestrap' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'shoestrap' ),
		'choose_from_most_used'      => __( 'Choose from the most used Portfolio Categories', 'shoestrap' ),
		'not_found'                  => __( 'No Portfolio Categories Found', 'shoestrap' ),
	);
	$rewrite = array(
		'slug'                       => 'portfolio_categories',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'update_count_callback'      => 'portfolio_categories_count',	);
	register_taxonomy( 'Portfolio Category', array( 'portfolio' ), $args );
	
		
	// Register Portfolio Tags
		$labels = array(
		'name'                       => _x( 'Portfolio Tags', 'Taxonomy General Name', 'shoestrap' ),
		'singular_name'              => _x( 'Portfolio Tag', 'Taxonomy Singular Name', 'shoestrap' ),
		'menu_name'                  => __( 'Portfolio Tags', 'shoestrap' ),
		'all_items'                  => __( 'All Portfolio Tags', 'shoestrap' ),
		'parent_item'                => __( 'Parent Item', 'shoestrap' ),
		'parent_item_colon'          => __( 'Parent Item:', 'shoestrap' ),
		'new_item_name'              => __( 'New Portfolio Tag', 'shoestrap' ),
		'add_new_item'               => __( 'Add Portfolio Tag', 'shoestrap' ),
		'edit_item'                  => __( 'Edit Portfolio Tag', 'shoestrap' ),
		'update_item'                => __( 'Update Portfolio Tag', 'shoestrap' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Tags with commas', 'shoestrap' ),
		'search_items'               => __( 'Search Portfolio Tags', 'shoestrap' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Tags', 'shoestrap' ),
		'choose_from_most_used'      => __( 'Choose from the most used Portfolio Tags', 'shoestrap' ),
		'not_found'                  => __( 'No Portfolio Tags Found', 'shoestrap' ),
	);
	$rewrite = array(
		'slug'                       => 'portfolio_tags',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'update_count_callback'      => 'portfolio_tags_count',	);
	register_taxonomy( 'Portfolio Tag', array( 'portfolio' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'porfolio_custom_taxonomy', 0 );

}


if ( ! function_exists('custom_post_type') ) {

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Porfolio', 'Post Type General Name', 'shoestrap' ),
		'singular_name'       => _x( 'Porfolio', 'Post Type Singular Name', 'shoestrap' ),
		'menu_name'           => __( 'Portfolio Posts', 'shoestrap' ),
		'parent_item_colon'   => __( 'Parent Item:', 'shoestrap' ),
		'all_items'           => __( 'All Portfolio', 'shoestrap' ),
		'view_item'           => __( 'View Portfolio', 'shoestrap' ),
		'add_new_item'        => __( 'Add New Portfolio', 'shoestrap' ),
		'add_new'             => __( 'Add New', 'shoestrap' ),
		'edit_item'           => __( 'Edit Portfolio', 'shoestrap' ),
		'update_item'         => __( 'Update Portfolio', 'shoestrap' ),
		'search_items'        => __( 'Search Portfolio', 'shoestrap' ),
		'not_found'           => __( 'No Portfolio  found', 'shoestrap' ),
		'not_found_in_trash'  => __( 'No Portfolio found in Trash', 'shoestrap' ),
	);
	$rewrite = array(
		'slug'                => 'portfolio',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Portfolio', 'shoestrap' ),
		'description'         => __( 'Student Course Work\'s showcase ', 'shoestrap' ),
		'labels'              => $labels,
		'supports'            => array( 'title','editor', 'excerpt','thumbnail', 'revisions' ),
		'taxonomies'          => array( 'portfolio_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'Portfolio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

}


// Add latest_portfolio shortcode
function latest_portfolio_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'posts' => 4,
		), $atts )
	);

	// Code
 	query_posts(array('post_type' => 'portfolio','orderby' => 'title', 'order' => 'ASC' , 'showposts' => $posts));
	
   $return_string = "<ul>";
   if (have_posts()) :
   	  
      while (have_posts()) : the_post();
         $return_string .=  '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
	  $return_string .= "</ul>";
   endif;
   wp_reset_query();
   return $return_string;
}

function register_shortcodes(){
  add_shortcode( 'latest-portfolio', 'latest_portfolio_shortcode' );
}

add_action( 'init', 'register_shortcodes');
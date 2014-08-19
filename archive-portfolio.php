<?php

echo apply_filters( 'shoestrap_title_section', '<header><h1 class="entry-title">' . shoestrap_title() . '</h1></header>' );

do_action( 'shoestrap_index_begin' );

if ( ! have_posts() ) {
	echo '<div class="alert alert-warning">' . __( 'Sorry, no portfolio were found.', 'shoestrap' ) . '</div>';
	get_search_form();
}

global $ss_framework;



// display the categories nav if there is no js 
$args = array(
	'taxonomy'           => 'portfolio_category',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => 0,
	'depth'              => 0,
	'title_li'           => ''
	);
	
 echo '<noscript>';
 echo '<ul class="nav nav-pills">';
 wp_list_categories( $args );
 echo '</ul>';
 echo '</noscript>';

 $terms = get_terms('portfolio_category', array( 'hide_empty' => 0 ));

 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
     echo '<div class="btn-group portfolio-category-controls">';
     foreach ( $terms as $term ) {
       echo '<button type="button" class="btn btn-default" data-group="';
       echo $term->name . '">' . $term->name . '</button>';
        
     }
     echo "</div>";
 }
 
  echo is_wp_error( $terms );

echo '<div class="portfolio-container"><ul id="portfolio-grid" class="portfolio-grid list-unstyled row-fluid">';
//echo '<li class="portfolio-item col-xs-6 col-sm-6 col-md-4 shuffle__sizer"></li>';
while ( have_posts() ) : the_post();
 	$categories_terms = get_the_terms( $post->ID, 'portfolio_category' );
 	
 	if ( $categories_terms && ! is_wp_error( $categories_terms ) ) {
		$post_cats = array();
	
		foreach ( $categories_terms as $term ) {
			$post_cats[] = $term->name;
		}
	}
						
	//$tag_list        = get_the_tag_list(', ');  

    echo '<li class="portfolio-item col-xs-6 col-sm-6 col-md-4"' ;
    echo "data-groups='";
	
	echo json_encode($post_cats);
	
	echo  "'>";

    echo '<a href="' . get_permalink() . '" title="View Portfolio">';
	echo '<figure class="portfolio-figure '  . implode( ' ', get_post_class() ) . '">' ;
	
			//do_action( 'shoestrap_single_top' );
		
		//do_action( 'shoestrap_entry_meta' );
		//shoestrap_title_section();
		
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.		
			the_post_thumbnail( array(275, 245));
		} 
		
		//echo '<div class="picture-item__details">';
		echo '<figcaption class="picture-item__details">';
		echo '<h3 class="picture-item__title">';
		echo get_the_title();
		echo '</h3>';
		the_excerpt();
		//echo implode(', ', $post_cats);
		//echo json_encode($post_cats);
		echo '</figcaption>';
	
		//echo the_terms( $post->ID, 'Portfolio Category', 'Category: ', ', ', ' ' );			
		
	echo '</figure>'; 
	echo '</a>';
	echo '</li>';         
endwhile;

echo '</ul></div>';
echo $ss_framework->clearfix();

do_action( 'shoestrap_index_end' );

echo shoestrap_pagination_toggler();
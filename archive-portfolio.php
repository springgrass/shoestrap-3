<?php

echo apply_filters( 'shoestrap_title_section', '<header><h1 class="entry-title">' . shoestrap_title() . '</h1></header>' );

do_action( 'shoestrap_index_begin' );

if ( ! have_posts() ) {
	echo '<div class="alert alert-warning">' . __( 'Sorry, no portfolio were found.', 'shoestrap' ) . '</div>';
	get_search_form();
}

global $ss_framework;

echo '<div class="portfolio-container"><ul id="portfolio-grid" class="portfolio-grid list-unstyled row-fluid">';
while ( have_posts() ) : the_post();
 	$categories_terms = get_the_terms( $post->ID, 'Portfolio Category' );
	$tag_list        = get_the_tag_list(', ');  

    echo '<li class="portfolio-item col-xs-6 col-sm-6 col-md-4">';
    echo '<a href="' . get_permalink() . '" title="View Portfolio">';
	echo '<figure class="portfolio-figure '  . implode( ' ', get_post_class() ) . '">';
		//do_action( 'shoestrap_single_top' );
		
		//do_action( 'shoestrap_entry_meta' );
		//shoestrap_title_section();
		
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			
			the_post_thumbnail( array(275, 245));
		
		} 
		
		//echo '<div class="picture-item__details">';
		echo '<figcaption class="picture-item__title">';
		echo '<h3>';
		echo get_the_title();
		echo '</h3>';
		the_excerpt();
		echo '</figcaption>';
		
		//echo '</div>';
		
		//echo '<p class="picture-item__tags">';
		//the_excerpt();	
		//echo the_terms( $post->ID, 'Portfolio Category', 'Category: ', ', ', ' ' );	

		//echo '</p>';
		
		
	echo '</figure>'; 
	echo '</a>';
	echo '</li>';         
endwhile;

echo '</ul></div>';
echo $ss_framework->clearfix();

do_action( 'shoestrap_index_end' );

echo shoestrap_pagination_toggler();
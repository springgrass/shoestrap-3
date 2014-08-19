<?php


global $ss_framework;
global $ss_blog;

add_action( 'shoestrap_single_pre_content', array($ss_blog, 'featured_image' ));


while ( have_posts() ) : the_post();

echo '<article class="' . implode( ' ', get_post_class() ) . '">';

do_action( 'shoestrap_single_top' );

shoestrap_title_section();	

echo '<div class="entry-content">';

do_action( 'shoestrap_single_pre_content' );
echo $ss_framework->clearfix();
the_content();
echo $ss_framework->clearfix();

echo '<hr/>';
echo the_terms( $post->ID, 'portfolio_category', 'Categories: ', ', ', ' ' );
do_action( 'shoestrap_single_after_content' );

echo '</div>';

do_action( 'shoestrap_in_article_bottom' );
//echo the_terms( $post->ID, 'Portfolio Category', 'Categories: ', ', ', ' ' );
echo '</article>';
endwhile;








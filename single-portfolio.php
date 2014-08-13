<?php
 
global $ss_framework;
 
while ( have_posts() ) : the_post();
 
echo '<article class="' . implode( ' ', get_post_class() ) . '">';
do_action( 'shoestrap_single_top' );
shoestrap_title_section();
do_action( 'shoestrap_entry_meta' );
 
echo '<div class="entry-content">';
do_action( 'shoestrap_single_pre_content' );
the_content();
echo $ss_framework->clearfix();
echo '<hr/>';
do_action( 'shoestrap_single_after_content' );
echo '</div>';
 
 
do_action( 'shoestrap_in_article_bottom' );
echo '</article>';
endwhile;


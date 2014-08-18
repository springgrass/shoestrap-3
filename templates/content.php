<?php

global $ss_framework;
global $ss_blog;


if ( !  function_exists('display_date_entry_meta' ) ) {
function display_date_entry_meta() {
// part of function in Shoestrap_Blog class
    global $ss_settings;
    global $ss_framework;
	$metas = $ss_settings['shoestrap_entry_meta_config'];
	$date_format = $ss_settings['date_meta_format'];	
	// output date element
	$content = '';	
	//echo get_the_ID() ;
	//echo get_post_format( get_the_ID());
	

	if ( is_array( $metas ) ) {
	foreach ( $metas as $meta => $value ) {
			if ( $meta == 'date' && ! empty( $value ) ) {
		
				if ( ! has_post_format( 'link') ) {
					$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'shoestrap' ): '%2$s';
		            
					if ( $date_format == 0 ) {
						$text = esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date( __('F j, Y | g:i a')) ) );
						$icon = "el-icon-calendar icon";
					}
					elseif ( $date_format == 1 ) {
						$text = sprintf( human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago');
						$icon = "el-icon-time icon";
					}
		
					$content .= sprintf(  '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>' ,
						esc_url( get_permalink() ),
						esc_attr( sprintf( __( 'Permalink to %s', 'shoestrap' ), the_title_attribute( 'echo=0' ) ) ),
						esc_attr( get_the_date( 'c' ) ),
						$text
					);

				}
			}
			
		}
	}
	echo $content;
	
  }
}

add_action('shoestrap_entry_meta_override', array($ss_blog, 'featured_image' ));

//add_action( 'shoestrap_single_pre_content', array($ss_blog, 'featured_image' ));

echo '<article '; post_class(); echo '>';

	do_action( 'shoestrap_in_article_top' );
	//shoestrap_title_section( true, 'h2', true );
	if ( has_action( 'shoestrap_entry_meta_override' ) ) {
		do_action( 'shoestrap_entry_meta_override' );
		
	} else {
		do_action( 'shoestrap_entry_meta' );	
	}
	shoestrap_title_section( true, 'h2', true );
    display_date_entry_meta();
	echo '<div class="entry-summary">';
		echo apply_filters( 'shoestrap_do_the_excerpt', get_the_excerpt() );
		echo $ss_framework->clearfix();
	echo '</div>';

	if ( has_action( 'shoestrap_entry_footer' ) ) {
		echo '<footer class="entry-footer">';
		do_action( 'shoestrap_entry_footer' );
		echo '</footer>';
	}

	do_action( 'shoestrap_in_article_bottom' );

echo '</article>';

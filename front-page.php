<?php

/*function my_custom_entry_meta() {
    echo 'This content will appear wherever meta-data are displayed';
}
add_action( 'shoestrap_entry_meta', 'my_custom_entry_meta' );
*/

function my_shoestrap_content_override() {
    echo 'This is my custom content';
}
add_action( 'shoestrap_content_override', 'my_shoestrap_content_override' );

if ( ! has_action( 'shoestrap_content_page_override' ) ) {
       remove_action( 'shoestrap_single_content','shoestrap_entry_meta',10);
	ss_get_template_part( 'templates/content', 'page' );
} else {
	do_action( 'shoestrap_content_page_override' );
}



<?php

if ( !defined( 'REDUX_OPT_NAME' ) )
	define( 'REDUX_OPT_NAME', 'shoestrap' );

require_once locate_template('/lib/modules/load.modules.php');

require_once locate_template( '/lib/utils.php' );           // Utility functions
require_once locate_template( '/lib/init.php' );            // Initial theme setup and constants
require_once locate_template( '/lib/wrapper.php' );         // Theme wrapper class
require_once locate_template( '/lib/sidebar.php' );         // Sidebar class
require_once locate_template( '/lib/config.php' );          // Configuration
require_once locate_template( '/lib/titles.php' );          // Page titles
require_once locate_template( '/lib/cleanup.php' );         // Cleanup
require_once locate_template( '/lib/nav.php' );             // Custom nav modifications
require_once locate_template( '/lib/gallery.php' );         // Custom [gallery] modifications
require_once locate_template( '/lib/comments.php' );        // Custom comments modifications
require_once locate_template( '/lib/relative-urls.php' );   // Root relative URLs
require_once locate_template( '/lib/widgets.php' );         // Sidebars and widgets
require_once locate_template( '/lib/scripts.php' );         // Scripts and stylesheets

do_action( 'shoestrap_include_files' );

function shoestrap_return_true()  { return true;  }
function shoestrap_return_false() { return false; }
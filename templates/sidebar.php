<?php

/**
 * Widgets 'before_title' modifying based on widgets mode.
 */
function alter_widgets_before_title() {
	//global $ss_settings;
	//return $ss_settings['widgets_mode'] == 0 ? '<div class="panel-heading">' : '<h3 class="widget-title">';
	return '<h3 class="widget-title">';
}

/**
 * Widgets 'after_title' modifying based on widgets mode.
 */
function alter_widgets_after_title() {
	//global $ss_settings;
	//return $ss_settings['widgets_mode'] == 0 ? '</div><div class="panel-body">' : '<span class="line"></span></h3>';
	return '<span class="line"></span></h3>';
}

add_filter( 'shoestrap_widgets_before_title', 'alter_widgets_before_title' );
add_filter( 'shoestrap_widgets_after_title',   'alter_widgets_after_title'   );

dynamic_sidebar( 'sidebar-primary' );
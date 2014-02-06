<?php
/**
 * Enqueue scripts and stylesheets
 */
function shoestrap_scripts() {

	wp_enqueue_style( 'shoestrap_css', shoestrap_css( 'url' ), false, null );

	// jQuery is loaded using the same method from HTML5 Boilerplate:
	// Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
	// It's kept in the header instead of footer to avoid conflicts with plugins.
	if ( !is_admin() && current_theme_supports( 'jquery-cdn' ) ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false );
		add_filter( 'script_loader_src', 'shoestrap_jquery_local_fallback', 10, 2 );
	}

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', false, null, false );
	wp_register_script( 'shoestrap_plugins', get_template_directory_uri() . '/assets/js/bootstrap.min.js', false, null, true );
	wp_register_script( 'shoestrap_main', get_template_directory_uri() . '/assets/js/main.js', false, null, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'shoestrap_plugins' );
	wp_enqueue_script( 'shoestrap_main' );

	if ( shoestrap_getVariable( 'pjax' ) == 1 ) {
		wp_register_script( 'jquery_pjax', get_template_directory_uri() . '/assets/js/jquery.pjax.js', false, null, true );
		wp_enqueue_script( 'jquery_pjax' );
	}

	if ( shoestrap_getVariable( 'retina_toggle' ) == 1 ) {
		wp_register_script( 'retinajs', get_template_directory_uri() . '/assets/js/vendor/retina.js', false, null, true );
		wp_enqueue_script( 'retinajs' );
	}
	wp_register_script( 'fitvids', get_template_directory_uri() . '/assets/js/vendor/jquery.fitvids.js', false, null, true );
	wp_enqueue_script( 'fitvids' );
}
add_action( 'wp_enqueue_scripts', 'shoestrap_scripts', 100 );

// http://wordpress.stackexchange.com/a/12450
function shoestrap_jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;

	if ( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/vendor/jquery-1.11.0.min.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if ( $handle === 'jquery' ) {
		$add_jquery_fallback = true;
	}

	return $src;
}
add_action( 'wp_head', 'shoestrap_jquery_local_fallback' );

function shoestrap_google_analytics() { ?>
<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='//www.google-analytics.com/analytics.js';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if ( GOOGLE_ANALYTICS_ID && !current_user_can('manage_options' ) ) {
	add_action( 'wp_footer', 'shoestrap_google_analytics', 20 );
}
<?php
/**
 * Register  widgets
 */
function oucreate_register_widgets() {
        register_widget( 'ou_Featured_Recent_Post_Widget' );
}
 
add_action( 'widgets_init', 'oucreate_register_widgets' );

class ou_Featured_Recent_Post_Widget extends WP_Widget {

	public function __construct () {
		// Widget settings. 
		$widget_ops = array( 'classname' => 'featured-recent-content', 'description' => 'A widget that display recent post with  featured images' );

		// Create the widget - calling the parent class construct method
		parent::__construct(
	 		'ou_featured_recent_post_widget', // Base ID
			'Featured Recent Post Widget', // Name
			$widget_ops
		);
	}

public function widget( $args, $instance ) {
	extract( $args );

	// Get the user-selected settings
	$title = apply_filters('widget_title', $instance['title'] );
	$show_featured = isset( $instance['show_featured'] ) ? $instance['show_featured'] : false;
	$show_image = isset( $instance['show_image'] ) ? $instance['show_image'] : false;
	
	// Before widget code (defined in the register sidebar function).
	echo $before_widget;

	if ( $title ) {
		echo $before_title.$title.$after_title;
	}

	if( $show_featured ) {
		
		$args = array( 
			'posts_per_page'  => 4,
			'post_type'       => 'post',
			'orderby'         => 'date'
		);

		$featured = new WP_Query( $args );
		if( $featured->have_posts() ) {

			echo '<div class="featured-item">';
		
			while( $featured->have_posts() ) {
				
				$featured->the_post();
?>
                 <div class="col-sm-3">
				<h3><?php the_title(); ?></h3>

				<?php the_post_thumbnail( 'small' ); ?>

				<a href="<?php the_permalink(); ?>">Find out more &raquo;</a>
                </div>
<?php
			}
			echo '</div>';

			wp_reset_query();
		}

	}

	// After widget code (defined in the register sidebar function).
	echo $after_widget;
}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_featured'] = $new_instance['show_featured'];
		$instance['show_image'] = $new_instance['show_image'];

		return $instance;
	}

	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured content', 'show_featured' => false, 'show_staff' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_featured'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_featured' ); ?>" name="<?php echo $this->get_field_name( 'show_featured' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_featured' ); ?>">Show featured menu item?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_image'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_image' ); ?>">Show Images?</label>
		</p>
	<?php

	}

}
<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 27/07/2018
 * Time: 10:27
 */

class Cb5_widgets_disclaimer extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
			'cb5_disclaimer_widget',
			__('Disclaimer link widget', 'cb5_widgets'),
			array(
				'customize_selective_refresh'       => true,
			)
		);
	}
	
	public function form( $instance ) {
	
//	    ADD: defaults for separator
//      fixme: $defaults[location]

//		Set widget defaults
		$defaults = array (
			'title'     =>  '',
			'location'  =>  '',
			'linkClass' =>  '',
			'target'    =>  '_blank',
            'seperator' =>  '|'
		);
		

//		Get all pages
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		
		$pages = get_pages($args);
		
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>">
				<?php _e( 'Target', 'cb5_widgets' ); ?>
			</label>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"
				class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>">
				<?php foreach ($pages as $page){
					printf('<option value="%s">%s</option>', get_permalink($page->ID), $page->post_title);
				} ?>
			</select>
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php _e( 'Name', 'cb5_widgets' ); ?>
            </label>
            <input
                    type="text"
                    id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                    class="widefat"
                    name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>">
            </input>
        </p>
        
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'seperator' ) ); ?>">
				<?php _e( 'Seperator', 'cb5_widgets' ); ?>
            </label>
			<input
				type="text"
                class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'seperator' ) ) ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'seperator' ) ) ?>" />
		</p>

        <p>
            <input
                    type="checkbox"
                    class="checkbox-input"
                    name="<?php echo $this->get_field_name( 'target' ) ?>"
                    id="<?php echo $this->get_field_id( 'target' ) ?>" />
            
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
				<?php _e( 'open in a new tab', 'cb5_widgets' ); ?>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkClass' ) ); ?>">
				<?php _e( 'Class', 'cb5_widgets' ); ?>
            </label>
            <input
                    type="text"
                    class="widefat"
                    name="<?php echo esc_attr( $this->get_field_name( 'linkClass' ) ) ?>"
                    id="<?php echo esc_attr( $this->get_field_id( 'linkClass' ) ) ?>" />
        </p>
        
        <script>
            $(function() {
                $('#<?php echo esc_attr( $this->get_field_id( "icon" ) ); ?>').selectize();
            });
		</script>
	<?php
	}
	
	public function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
		
		$instance['title']        =   isset( $new_instance[ 'title' ] ) ? wp_strip_all_tags( $new_instance[ 'title' ] ) : '';
		$instance['location']     =   isset( $new_instance[ 'location' ] ) ? wp_strip_all_tags( $new_instance[ 'location' ] ) : '';
		$instance['linkClass']    =   isset( $new_instance[ 'linkClass' ] ) ? wp_strip_all_tags( $new_instance[ 'linkClass' ] ) : '';
		$instance['target']       =   isset( $new_instance[ 'target' ] ) ? wp_strip_all_tags( $new_instance[ 'target' ] ) : '';
		$instance['seperator']    =   isset( $new_instance[ 'seperator' ] ) ? wp_strip_all_tags( $new_instance[ 'seperator' ] ) : '';
		
		return $instance;
		
	}
	
	public function widget( $args, $instance ) {
        
        extract( $args );
        
        $title                  =   isset( $instance[ 'title' ] )       ?       $instance[ 'title' ]        :   '';
        $location               =   isset( $instance[ 'location' ] )    ?       $instance[ 'location' ]     :   '';
        $class                  =   isset( $instance[ 'linkClass' ] )   ?       $instance[ 'linkClass' ]    :   '';
        $target                 =   isset( $instance[ 'target' ] )      ?       '_blank'       :   '_self';
        $seperator              =   isset( $instance[ 'seperator' ] )   ?       $instance[ 'seperator' ]    :   '';
        
        printf('<a class="%s" href="%s" target="%s">%s</a>&nbsp;<span class="footer-sep">%s</span>', $class, $location,
            $target, $title, $seperator);
	}
	
	
}

/**
 * Calls the register_widget function
 *
 * @since 1.0.0
 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
 * @see register_widget
 */
function register_disclaimer_widget(){
	register_widget('Cb5_widgets_disclaimer');
}

add_action( 'widgets_init', 'register_disclaimer_widget');
<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 27/07/2018
 * Time: 08:40
 */

class Cb5_widgets_social extends WP_Widget {
	
	/**
	 * Cb5_widgets_social constructor.
	 *
	 * Setup a widget to use
	 * @since 1.0.0
	 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
	 * @see WP_Widget
	 */
	public function __construct( ) {
		parent::__construct(
			'cb5_social_widget',
			__('Social icons widget', 'cb5_widgets'),
			array(
				'customize_selective_refresh'       => true,
			)
		);
	}
	
	/**
	 * @param array $instance
	 *
	 * @since 1.0.0
	 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
	 * @see WP_Widget
	 * @return string|void
	 */
	public function form( $instance ) {
	
//		Set widget defaults
		$defaults = array (
			'icon'          =>  '',
			'link'          =>  '',
			'iconClass'     =>  '',
			'widgetClass'   =>  '',
		);
	
		$icons = array (
			'facebook'      =>  'Facebook',
			'linkedin'      =>  'LinkedIn',
			'twitter'       =>  'Twitter',
			'instagram'     =>  'Instagram',
			'youtube'       =>  'Youtube',
			'tumblr'        =>  'Tumblr',
		);
		
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>">
				<?php _e( 'Icon', 'cb5_widgets' ); ?>
			</label>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"
				class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>">
				
				<?php
				
				foreach($icons as $key => $val){
					print '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected(
						$instance[ 'icon' ], $key, false ) . '>'. $val . '</option>';
				}
				
				?>
				
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>">
				<?php _e('Link', 'cb5_widgets'); ?>
			</label>
			<input
				class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"
				type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widgetClass' ) ); ?>">
				<?php _e('Container class', 'cb5_widgets'); ?>
			</label>
			<input
				class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'widgetClass' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'widgetClass' ) ); ?>"
				type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'iconClass' ) ); ?>">
				<?php _e('Icon class', 'cb5_widgets'); ?>
			</label>
			<input
				class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'iconClass' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'iconClass' ) ); ?>"
				type="text" />
		</p>
		<?php
	}
	
	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @since 1.0.0
	 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
	 * @see WP_Widget
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['icon']         =   isset( $new_instance[ 'icon' ] ) ? wp_strip_all_tags( $new_instance[ 'icon' ] ) : '';
		$instance['link']         =   isset( $new_instance[ 'link' ] ) ? wp_strip_all_tags( $new_instance[ 'link' ] ) : '';
		$instance['iconClass']    =   isset( $new_instance[ 'iconClass' ] ) ? wp_strip_all_tags( $new_instance[ 'iconClass' ] ) : '';
		$instance['widgetClass']  =   isset( $new_instance[ 'widgetClass' ] ) ? wp_strip_all_tags( $new_instance[ 'widgetClass' ] ) : '';
		return $instance;
		
	}
	
	/**
	 * @param array $args
	 * @param array $instance
	 *
	 * @since 1.0.0
	 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		$icon   = isset( $instance['icon'] )        ?       $instance['icon'] : '';
		$link   = isset( $instance['link'] )        ?       $instance['link'] : '';
		$widget = isset( $instance['widgetClass'] ) ?       $instance['widgetClass'] : '';
		$iClass = isset( $instance['iconClass'] )   ?       $instance['iconClass'] : '';
		
//		Check if the widget has an additional class
		if($widget){
			printf('<div class="widget-text wp_widget_plugin_box %s">', $widget);
		} else{
			print '<div class="widget-text wp_widget_plugin_box">';
		}
		
//		Check if there is a link included
		if($link && $iClass){
			printf('<a href="%s" class="%s">', $link, $iClass);
		} elseif($link){
			printf('<a href="%s">', $link);
		}
		
//		Check if there is an icon
		if($icon){
			printf('<i class="fab fa-%s"></i>', $icon);
		}
		
//		If there is a link close the link
		if($link){
			printf('</a>');
		}
		
//		Close widget class
		echo '</div>';
		
	}
	
}

/**
 * Calls the register_widget function
 *
 * @since 1.0.0
 * @author Mitch Hijlkema <mitch@dodejaarsma.nl>
 * @see register_widget
 */
function register_social_widget(){
	register_widget('Cb5_widgets_social');
}

add_action( 'widgets_init', 'register_social_widget');
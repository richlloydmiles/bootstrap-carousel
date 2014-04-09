<?php
/**
 * Bootstrap Carousel Widget
 */
class BS_Carousel_Widget extends WP_Widget {
 
    /** constructor -- name this the same as the class above */
    function bs_carousel_widget() {
        parent::WP_Widget(false, $name = 'Bootstrap Carousel');  
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget( $args, $instance ) { 
        extract( $args );
        $title = $instance['title'];
                      
        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;      
        
        if ( class_exists( 'BS_Carousel' ) ) {
                bs_carousel();                 
        };
        
        echo $after_widget;        
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );       
           
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
    
        $defaults = array( 
            'title' => '',                            
        );
        $instance = wp_parse_args( (array) $instance, $defaults );   

        $title    = esc_attr($instance['title']);            
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'bs-carousel' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>       
        
        <?php
        
    }

} // end class bs_carousel_widget
add_action('widgets_init', create_function('', 'return register_widget("BS_Carousel_Widget");'));
?>
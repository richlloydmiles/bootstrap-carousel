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
        $title_link = $instance['title_link'];
        $tagline = $instance['tagline'];
                      
        if ( $title_link ) {
            $link_open = "<a href='$title_link'>";
            $link_close = "</a>";
        } else {
            $link_open = "";
            $link_close = "";
        }

        echo $before_widget;        
        if ( $title )
            echo $before_title . $link_open . $title . $link_close . $after_title;

        if ( $tagline )
            echo "<p class='tagline text-center'>$tagline</p>"; 
        
        if ( class_exists( 'BS_Carousel' ) ) {
                bs_carousel();                 
        };
        
        echo $after_widget;        
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );       
        $instance['title_link'] = strip_tags( $new_instance['title_link'] );
        $instance['tagline'] = strip_tags( $new_instance['tagline'] );

        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
    
        $defaults = array( 
            'title' => '',
            'title_link' => '',
            'tagline' => ''                         
        );
        $instance = wp_parse_args( (array) $instance, $defaults );   

        $title    = esc_attr($instance['title']);
        $title_link    = esc_attr($instance['title_link']);
        $tagline    = esc_attr($instance['tagline']);            
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'bs-carousel' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e( 'Title Link:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title_link'); ?>" name="<?php echo $this->get_field_name('title_link'); ?>" type="text" value="<?php echo $title_link; ?>" />
            <small>Link the widget title to a URL</small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tagline'); ?>"><?php _e('Tagline:'); ?></label> 
            <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('tagline'); ?>" name="<?php echo $this->get_field_name('tagline'); ?>"><?php echo $tagline; ?></textarea>
            <small>Tagline to display below the widget title</small>
        </p>     
        
        <?php
        
    }

} // end class bs_carousel_widget
add_action('widgets_init', create_function('', 'return register_widget("BS_Carousel_Widget");'));
?>
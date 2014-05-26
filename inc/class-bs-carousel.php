<?php

class BS_Carousel {

    public function __construct()
    {        
        add_shortcode( 'carousel', array($this, 'output' ) );        
    }
   
    public function output( $atts ) 
    {
        extract( shortcode_atts( array(
            'order' => 'ASC',
            'orderby' => 'menu_order',      
        ), $atts ) );
        
        $args = array(
                'post_type' => 'slide',
                'order' => $order,
                'orderby' => $orderby
            );

        $slides = get_posts( $args );
        $output = "";

        if ( $slides ) {
            
            $output .= "
            <div id='carousel' class='bs-carousel carousel slide' data-ride='carousel'>
                <ol class='carousel-indicators'>";
                foreach ( $slides as $slide ) {
                    $count++;
                    if ( $count == 1 ) $slide_active = 'active'; else $slide_active = '';

                    $output .= 
                    "<li data-target='#carousel' data-slide-to='0' class='$slide_active'></li>";
                }
                $output.= "
                </ol>
                <div class='carousel-inner'>";
                    $count = 0;
                    foreach ( $slides as $slide ) {
                        $image = get_the_post_thumbnail( $slide->ID, 'full' );
                        $content = $slide->post_content;
                        
                        $count++;
                        if ( $count == 1 ) $slide_active = 'active'; else $slide_active = '';

                        $output .= 
                        "<div class='item $slide_active'>                                         
                            $image
                            <div class='carousel-caption'>
                                $content
                            </div>
                        </div>";
                    }
                $output .= "
                </div>
                <a class='left carousel-control' href='#carousel' data-slide='prev'>
                    <i class='fa fa-chevron-left'></i>
                </a>
                <a class='right carousel-control' href='#carousel' data-slide='next'>
                    <i class='fa fa-chevron-right'></i>
                </a>";
            
            $output .= "
            </div>";

            return $output;
        }        

    }

}
     
$BS_Carousel = new BS_Carousel();
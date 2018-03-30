<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
if( !class_exists( 'more_projects' ) ) :
class more_projects extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'more_projects', 
            'description' => __('Show a slider with a list of projects, added into portfolio Post Type.', 'yit') 
        );

        $control_ops = array( 'id_base' => 'more_projects' );
        WP_Widget::__construct( 'more_projects', 'More Projects', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) 
    {
        $yit_portfolio = yit_portfolios();
        
        extract( $args );                             

        $project_speed_fx = isset( $instance['project_speed_fx']) ? $instance['project_speed_fx'] : false;
        $project_n_items = isset( $instance['project_n_items']) ? $instance['project_n_items'] : 5;   
        $project_post_types = isset( $instance['project_post_type']) ? $instance['project_post_type'] : false;

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        
        //if ( ! $project_post_types || empty( $project_post_types ) )
        //    $post_type = get_post_meta( get_the_ID(), '_portfolio_post_type', true );  
        //else
        $post_type = $project_post_types;
            
        //if ( empty( $post_type ) )
        //    $post_type = get_post_type();    
        
        //$portfolio_tax = sanitize_title( $yit_portfolio[$post_type]['tax'] );

        global $more;
        $more = 0;

		
		if( $project_post_types ) {
	        foreach( $yit_portfolio as $portfolio ) {
				if($portfolio->ID == $project_post_types) {
		            echo $before_widget;
		
		            if ( $title ) echo $before_title . $title . $after_title;
                    
                    $categories = yit_portfolio_get_setting( 'categories', $portfolio->ID );
								
					$portfolios = yit_portfolio_get_setting( 'items', $portfolio->ID );
                    $is_slider = count( $portfolios ) > 1 ? true : false; 
		
		            echo '<div class="more-projects-widget">';
                    
		                if( $is_slider ) {
                            echo '<div class="top">';
    		                    echo '<a class="prev" href="#">Prev</a>';
    		                echo '</div>';
                        }
                        
		                echo '<div class="sliderWrap">';
		                    echo '<ul>';

								//loop
								yit_set_portfolio_loop( $portfolio->ID );
								foreach( $portfolios as $item_id => $item ) {
									
									$post_permalink = yit_work_permalink( $item_id );
									
			                        echo '<li class="work-item group">';
			                            echo '<a class="work-thumb" href="' . $post_permalink . '">';
											yit_image( "id=$item_id&size=blog_thumb" );//echo wp_get_attachment_image( $item_id, 'blog_thumb' );
			                            echo '</a>';
			                            echo '<a class="meta work-title" href="' . $post_permalink . '">' . $item['title'] . '</a>';

			                            echo '<p class="meta categories">';           
											$str_categories = '';
											$terms = isset($item['terms']) ? $item['terms'] : array();
											foreach( $terms as $name){ $str_categories .= "<a href='". yit_term_link($name) ."'>{$categories[$name]}</a>, "; }
				                            echo substr($str_categories,0, strlen($str_categories)-2);
			                            echo '</p>';
			                        echo '</li>';

								}

		                    echo '</ul>';    
		                echo '</div>';
                        
                        if( $is_slider ) {
    		                echo '<div class="controls">';
    		                    echo '<a class="next" href="#">Next</a>';
    		                echo '</div>';
                        }
		            echo '</div>';
		              
                    if( $is_slider ) {
    		            $script = "<script type=\"text/javascript\">
    		                jQuery(document).ready(function($){
    		                    var slider_wrap = $('.more-projects-widget');
    		                    var height_item = $('li', slider_wrap).outerHeight();
    		                    var height_ul   = $('ul', slider_wrap).height();
    		                    var height_wrap = $('.sliderWrap', slider_wrap).height();
    		                    var n_items     = $('li', slider_wrap).length;
    		                    var visible     = $project_n_items;
    		
    		                    $('.controls, .top', slider_wrap).show();
    		
    		                    // adjust height, according to visible item
    		                    $('.sliderWrap', slider_wrap).css('height', height_item * visible - 6);
    		
    		                    function check_position() {    
    		                        var margin_top_ul = $('ul', slider_wrap).css('margin-top');
    		                        var max_offset  = ( n_items - visible ) * height_item * -1;
    		
    		                        if ( margin_top_ul == '0px' ) {
    		                            $('.prev', slider_wrap).addClass('disabled');
    		                        }
    		
    		                        if ( margin_top_ul == max_offset+'px' ) {
    		                            $('.next', slider_wrap).addClass('disabled');
    		                        }
    		                    }
    		
    		                    check_position();
    		
    		                    $('.next:not(.disabled)', slider_wrap).live('click',function(){
    		                        $('ul', slider_wrap).animate( {marginTop:'-='+height_item}, $project_speed_fx, function(){ check_position(); } );
    		                        $('.prev', slider_wrap).removeClass('disabled');
    		                        return false;
    		                    });
    		
    		                    $('.prev:not(.disabled)', slider_wrap).live('click',function(){
    		                        $('ul', slider_wrap).animate( {marginTop:'+='+height_item}, $project_speed_fx, function(){ check_position(); } );
    		                        $('.next', slider_wrap).removeClass('disabled');
    		                        return false;
    		                    });
    		
    		                    $('.disabled', slider_wrap).live('click', function(){
    		                        return false;
    		                    });
    		                });
    		            </script>";
    		
    		            echo $script;
                    }
                    
		            echo $after_widget;

		            break;
				}
			}
		}


    }

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['project_n_items'] = $new_instance['project_n_items'];
        $instance['project_speed_fx'] = $new_instance['project_speed_fx'];
        $instance['project_post_type'] = $new_instance['project_post_type'];
        return $instance;
    }

    function form( $instance ) 
    {
        global $icons_name, $fxs, $easings;

        /* Impostazioni di default del widget */
        $defaults = array(
            'title' => 'Featured Projects',
            'project_n_items' => 4,
            'project_speed_fx' => 200,
            'project_post_type' => '' 
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p> 
        
        <p>

            <label for="<?php echo $this->get_field_id( 'project_post_type' ); ?>">Portfolio:

                 <select id="<?php echo $this->get_field_id( 'project_post_type' ); ?>" name="<?php echo $this->get_field_name( 'project_post_type' ); ?>">
					 <?php $portfolios = yit_portfolios(); ?>
					 <?php foreach( $portfolios as $portfolio ): ?>
					 	 <option value="<?php echo $portfolio->ID ?>"<?php if($portfolio->ID == $instance['project_post_type']): ?> selected="selected"<?php endif ?>><?php echo $portfolio->post_title ? $portfolio->post_title : 'Portfolio ID: ' . $portfolio->ID ?></option>
					 <?php endforeach ?>
                 </select>

            </label>

        </p>       

        <p><?php _e( 'Show a list of portfolio categories, for portfolio custom types.', 'yit' ) ?></p>             

        <p>
            <label for="<?php echo $this->get_field_id( 'project_n_items' ); ?>">Items:
                 <select id="<?php echo $this->get_field_id( 'project_n_items' ); ?>" name="<?php echo $this->get_field_name( 'project_n_items' ); ?>">
                    <?php
                    for($i=1;$i<=20;$i++)
                    {
                        $select = '';
                        if($instance['project_n_items'] == $i) $select = ' selected="selected"';
                        echo "<option value=\"$i\"$select>$i</option>\n";
                    }
                    ?>
                 </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>">Speed Animation (ms):
                 <input type="text" id="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'project_speed_fx' ); ?>" value="<?php echo $instance['project_speed_fx']; ?>" size="4" />
            </label>
        </p>
    <?php
    }
}
endif;
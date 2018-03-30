<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show last post of a specific category
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

	$args = array(
       'post_type'=>'post',
       'showposts' => 1,
       'cat' => yit_get_excluded_categories(2)
    );

    if ( isset( $cat_name ) && ! empty( $cat_name ) && $cat_name != 'null' && $cat_name != "a:0:{}" ) {
        $args['category_name'] = $cat_name;
    }
    
    $posts = new WP_Query();
    $posts->query($args);

    $showdate = ( isset( $showdate ) && $showdate == 'yes' ) ? true : false;
    $showtitle = ( isset( $showtitle ) &&  $showtitle == 'yes' ) ? true : false;
	$last = ( isset($last) && $last == 'yes' ) ? 'last' : '';

    $html = "\n";
	while($posts->have_posts()) :    
        $posts->the_post();

        global $more, $post;

        $more = 0;

        $img = '';
        if( isset( $icon ) && $icon != '' )
            $img = "<span class=\"fa fa-" . $icon . "\" style=\"font-size: " . $size . "px; color: " . $color . ";\"></span>";

        $html .= "<div class=\"yit_shortcodes last-post col-sm-3 " . $last . " " . $class . "\">\n";
        $html .= "    <h2>" . $title . "</h2>\n";
        if($showtitle){
            $html .= "    $img\n";
            $html .= "    <h3 class=\"title-widget-blog\"><a href=\"".get_permalink()."\">".get_the_title()."</a></h3>\n";
        }

        if($showdate){
            $html .= "    <p class=\"date\">".date( 'F jS, Y', strtotime( $post->post_date ) )."</p>\n";
        }
        
        $html .= yit_plugin_content( 'excerpt', $excerpt_lenght, $more_text );
        $html .= "</div>";
    endwhile;

    if( $last == 'last' ){

        $html .= "<div class=\"clearfix\"></div>";
    }
?>

<?php echo $html; ?>
<?php wp_reset_query()?>
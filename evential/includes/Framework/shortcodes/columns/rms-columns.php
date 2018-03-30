<?php
function columns($atts, $content = null)
{
    extract(shortcode_atts(array(
        'part'          => '1/1'
    ), $atts));
    
    $column_return = '';
    
    if($part == "1")
    {
        $result = '<div class="col-xs-12 col-sm-1 col-lg-1">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "2") 
    {
        $result = '<div class="col-xs-12 col-sm-2 col-lg-2">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif($part == "3")
    {
        $result = '<div class="col-xs-12 col-sm-3 col-lg-3">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "4") 
    {
        $result = '<div class="col-xs-12 col-sm-4 col-lg-4">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "5") 
    {
        $result = '<div class="col-xs-12 col-sm-5 col-lg-5">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "6") 
    {
        $result = '<div class="col-md-6">';
        $result .= do_shortcode(  $content );
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "7") 
    {
        $result = '<div class="col-xs-12 col-sm-7 col-lg-7">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "8") 
    {
        $result = '<div class="col-xs-12 col-sm-8 col-lg-8">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "9") 
    {
        $result = '<div class="col-xs-12 col-sm-9 col-lg-9">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "10") 
    {
        $result = '<div class="col-lg-10 col-lg-offset-1">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "11") 
    {
        $result = '<div class="col-xs-12 col-sm-11 col-lg-11">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }
    elseif ($part == "12") 
    {
        $result = '<div class="col-xs-12 col-sm-12 col-lg-12">';
        $result .= do_shortcode(  $content );  
        $result .= '<div class="clear"></div>';
        $result .= '</div>';

        return $column_return = force_balance_tags( $result );
    }

    
    return $team_column;
}
add_shortcode( "rms-columns", "columns" );


<?php

global $mk_settings, $post;

extract( shortcode_atts( array(
            'column_number' => 4,
            'columns' => '',
            'style' => 'simple',
            'orderby'=> 'date',
            'order'=> 'DESC',
            'icon_color' => $mk_settings['accent-color'],
            'icon_hover_color' => $mk_settings['accent-color'],
            'icon_size' => 16,
            'txt_color' => '#444',
            'txt_hover_color'=> '#fff',
            'btn_color'=> '#444',
            'btn_hover_color' => '#fff',
            'border_color' => '#ccc',
            'bg_color' => '#fff',
            'border_hover_color' => '#ccc',
            'bg_hover_color' => '#333333',
            'el_class' =>'',
            'column_height' => 500,
            'cover_link' => 'false',
            'animation' => '',
            'item_spacing' => '0px',
            'item_margin_bottom' => '0px',
        ), $atts ) );

$query = array(
    'post_type'=>'animated-columns',
    'showposts' => -1,
);

if ( $columns ) {
    $query['post__in'] = explode( ',', $columns );
}
if ( $orderby ) {
    $query['orderby'] = $orderby;
}
if ( $order ) {
    $query['order'] = $order;
}

switch ($column_number) {
    case 1:
        $column_css = 'one-column';
        break;
    case 2:
        $column_css = 'two-column';
        break;
    case 3:
        $column_css = 'three-column';
        break;
    case 4:
        $column_css = 'four-column';
        break;
    case 5:
        $column_css = 'five-column';
        break;
    case 6:
        $column_css = 'six-column';
        break;
    case 7:
        $column_css = 'seven-column';
        break;
    case 8:
        $column_css = 'eight-column';
        break;
    default:
        $column_css = 'four-column';
        break;
}


$r = new WP_Query( $query );

$id = Mk_Static_Files::shortcode_id();

$animation_css = ( $animation != '' ) ? ' mk-animate-element ' . $animation . ' ' : '';

$output = '<div id="animated-columns-'.$id.'" class="mk-animated-columns '.$style.'-style '.$column_css.' '.$animation_css.$el_class.'">';

while ( $r->have_posts() ) : $r->the_post();
    
    $text = get_post_meta( $post->ID, '_text', true );
    $icon = get_post_meta( $post->ID, '_icon', true );
    $title = get_post_meta( $post->ID, '_title', true );
    $desc = get_post_meta( $post->ID, '_desc', true );
    $link = get_post_meta( $post->ID, '_link', true );
    $btn_txt = get_post_meta( $post->ID, '_btn_text', true );
    $target = get_post_meta( $post->ID, '_target', true );

    
    $output .= '<div class="animated-column-item-wrap">';

        $output .= '<div class="animated-column-item">';
        
        if($style == 'simple') {           
            $output .= !empty($link) ? '<a href="'.$link.'" class="full-cover-link" target="'.$target.'"></a>' : '';         
            $output .= '<div class="animated-column-holder">';            
            $output .= '<i class="mk-'.$icon.' animated-column-icon"></i>';
            $output .= '</div>';
            $output .= '<div class="animated-column-title"><span class="animated-column-simple-title">'.$title.'</span></div>';

        }else if($style == 'simple_text') {
            $output .= !empty($link) ? '<a href="'.$link.'" class="full-cover-link" target="'.$target.'"></a>' : '';         
            $output .= '<div class="animated-column-holder">';            
            $output .= '<span class="animated-column-icon">'.$text.'</span>';
            $output .= '</div>';
            $output .= '<div class="animated-column-title"><span class="animated-column-simple-title">'.$title.'</span></div>';
        } else {
            if($cover_link == 'true') {
                $output .= !empty($link) ? '<a href="'.$link.'" class="full-cover-link" target="'.$target.'"></a>' : '';         
            }
            $output .= '<div class="animated-column-holder">';
            $output .= '<i class="mk-'.$icon.' animated-column-icon"></i>';
            $output .= '<div class="animated-column-title">'.$title.'</div>';
            $output .= '</div>';
            $output .= '<div class="animated-column-desc">'.$desc.'</div>';
            if(!empty($link)) {
            $output .='<div class="animated-column-btn">
                        '.do_shortcode( '[mk_button style="outline" outline_skin="'.$btn_color.'" outline_hover_skin="'.$btn_hover_color.'" size="small" target="'.$target.'" align="center" url="'.$link.'"]'.$btn_txt.'[/mk_button]' ).'
                        </div>';
            }
        }

        $output .= '</div>';
    
    $output .= '</div>';

    
endwhile;

$output .= '</div>';
wp_reset_postdata();
echo $output;






Mk_Static_Files::addCSS("
    #animated-columns-{$id} .animated-column-item-wrap{
        padding-right: {$item_spacing}px;
        padding-left: {$item_spacing}px;
        margin-bottom: {$item_margin_bottom}px;
    }

    #animated-columns-{$id} .animated-column-item{
        border-top:1px solid {$border_color};
        border-color:{$border_color};
        background-color:{$bg_color};
        height:{$column_height}px;
    }


    #animated-columns-{$id} .animated-column-item:hover {
        background-color:{$bg_hover_color};
        border-color:{$border_hover_color};
    }

    #animated-columns-{$id} .animated-column-icon {
        color:{$icon_color};
        font-size:{$icon_size}px;
    }

    #animated-columns-{$id} .animated-column-item:hover .animated-column-icon{
        color:{$icon_hover_color};
    }

    #animated-columns-{$id} .animated-column-title,
    #animated-columns-{$id} .animated-column-desc{
          color:{$txt_color}  
    }

    #animated-columns-{$id} .animated-column-item:hover .animated-column-title,
    #animated-columns-{$id} .animated-column-item:hover .animated-column-desc
    {
     color:{$txt_hover_color}     
    }
", $id);


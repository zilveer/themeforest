<?php

//Portfolio Grid

function th_portfolio_grid($attrs,$content=false){
    extract(shortcode_atts(array(
		'all_filter'=> 'All',
        'posts_per_page'=>12,
        'order'=> 'desc',
        'orderby'=> 'none',
    ),$attrs));


    $html='';
    $html.='<div id="filters-container" class="cbp-l-filters-alignRight">';
    $html.="<div data-filter=\"*\" class=\"cbp-filter-item-active cbp-filter-item\">".__($all_filter, 'larx')."
        <div class=\"cbp-filter-counter\"></div>
        </div>";

    $args=array(
        'hierarchical'=>false,
        'parent'=>0,
        'taxonomy'=>'project-type'
    );
    $categories = get_categories( $args );

    if(!empty($categories))
    {
        foreach($categories as $key=>$value){
            $html.="<div data-filter='.{$value->slug}' class=\"cbp-filter-item\">{$value->name}
                <div class=\"cbp-filter-counter\"></div>
                </div>";
        }
    }

    $html.='</div><!--End #filters-container-->';

    $html.='<div id="grid-container" class="cbp-l-grid-masonry">';
    $html.='<ul>';
    //$posts_per_page=3;
    //Loop portfoliio
    $args=array(
        'post_type'=>'portfolio',
        'posts_per_page'=>$posts_per_page,
        'order'=> $order,
        'orderby'=> $orderby,
    );
    query_posts($args);
    while(have_posts())
    {
        the_post();
        $terms=wp_get_post_terms(get_the_ID(),'project-type');
        $term_string='';
        if(!empty($terms))
        {
            foreach($terms as $key=>$value)
            {
                $term_string.=' '.$value->slug;
            }
        }

		$portf_thumbnail = '';
        $portf_thumbnail .= get_post_meta(get_the_id(),'portf_thumbnail',true);

		$th_w=''; $th_h='';
        switch ($portf_thumbnail) {
            case 'portfolio-small':
				$th_w='270'; $th_h='260';
                $item_class = 'cbp-l-grid-masonry-height1';
                break;
            case 'half-vertical':
                $th_w='270'; $th_h='405';
                $item_class = 'cbp-l-grid-masonry-height2';
                break;
        }


        //$size=array(362, 272,'bfi_thumb'=>true);
        global $post;
        $post_type = get_post_meta($post->ID, 'link_type', true);

		$title=get_the_title();
        $th_is_lightbox = 'cbp-lightbox';
        $thumb= '<img src="'.th_thumb($th_w, $th_h).'" alt="'.$title.'">';
		$project_desc=get_post_meta(get_the_ID(),'project_desc',true);
        $video=get_post_meta(get_the_ID(),'name',true);
        $url=get_post_meta(get_the_ID(),'url',true);
        $full = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        if($post_type == 'direct' && !empty($video) )
        {
            $full=$video;
        }
        if( $post_type == 'external' && !empty($url) )
        {
            $full=$url;
            $th_is_lightbox = '';
        }
        if( $post_type == 'single_page')
        {
            $full= get_the_permalink();
            $th_is_lightbox = '';
        }
        
        $permalink=get_the_permalink();
        $html.="<li class=\"cbp-item {$term_string} {$item_class}\">

                    <a class=\"cbp-caption {$th_is_lightbox} \" data-title=\"{$title}<br />{$project_desc}\" href=\"{$full}\">
                        <div class=\"cbp-caption-defaultWrap\">
                            {$thumb}
                        </div>
                        <div class=\"cbp-caption-activeWrap\">
                            <div class=\"cbp-l-caption-alignCenter\">
                                <div class=\"cbp-l-caption-body\">
                                    <div class=\"cbp-l-caption-title\">{$title}</div>
                                    <div class=\"cbp-l-caption-desc\">{$project_desc}</div>
                                </div>
                            </div>
                        </div>
                    </a>

                </li>";
    }
    $html.='</ul>';
    $html.="</div><!--End #grid-container-->";

    wp_reset_query();
    return $html;
}

remove_shortcode('portfolio_grid');
add_shortcode('portfolio_grid', 'th_portfolio_grid');
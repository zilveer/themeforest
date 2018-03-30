<?php
/** ******************** Shorcode for page builder******************************** */

function st_blog_post_func( $atts, $content='' ) {
    global $wp_query;
    global $post, $paged;
    $tmp_post = $post;
	extract( shortcode_atts( array(
		'title' => '',
		'cats' => array(),
        'numpost'=>5,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'type'=>1,
        'site_layout'=>'',
        'show_title'=>'n',
        'show_paging'=>'n'
	), $atts ) );
    
    // $wc = $builder[$i]['pbwith']; old
    $wc = $pbwith; // new
    
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }
        $html ='';
        // just only for one cate
        if(is_string($cats)){
            $cats = explode(',',$cats);
        }
        
        $cats =  $cats[0];
        $cat_link =$cat_title='';
        if($cats>0){
            $cat_link = get_category_link($cats);
            $cat_title = get_cat_name($cats);
        }else{
            // do some thing
        }

        if($show_title =='y' and $title!=''){
             //   $html .='<h1 class="st-category-heading blog-post">'.esc_html($title).'</h1>';
             $html ='
             <div class="builder-title-wrapper clearfix">
                <h3 class="builder-item-title">'.esc_html($title).'</h3>
             </div>
             ';
        }elseif($cat_link and $cat_title){
            // <a href="'.$cat_link.'" >'.esc_html($cat_title).'</a>
             $html ='
                  <div class="builder-title-wrapper clearfix">
                    <h3 class="builder-item-title">'.esc_html($cat_title).'</h3>
                 </div>
             ';
        }
        
        
        if(intval($numpost)<=0){
            $numpost = (int) get_option('posts_per_page',10);
        }else{
            $numpost = intval($numpost);
        }
        
       $args = array( 'posts_per_page' => $numpost );
        if($cats>0){
            $args['category__in'] =  array($cats);
        }
        
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        $args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        if($paged>0){
             $args['paged'] =  $paged;
        }else{
                 $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
        }
        
        // added in ver 1.3
        if(st_is_wpml()){
          $args['sippress_filters'] = true;
          $args['language'] = get_bloginfo('language');
         }

         $new_query = new WP_Query($args);
         $myposts =  $new_query->posts;

        $i = 0;
        if($type == 2){
                
        }
        
        $e = '';
        $c =0;
        if($type==3 && count($myposts)%2!=0){
            $myposts[] =  false;
        }
        $image_size ='';
        if($site_layout ==1 &&( $pbwith =='1_1' ||  $pbwith =='3_4')  && $type !=3){
            $image_size = 'st_large';
        }
        
        // display as list
        foreach( $myposts as $post ) : setup_postdata($post);
         //$class=get_post_class();
         if($type==3){
            if($c==0){
                $e.='<div class="row">';
                $e.='<div class="six columns b20">'.st_get_content(ST_TEMPLATE_DIR.'loop/loop-post.php',$post,array('display_type'=>$type,'i'=>$i,'image_size'=>$image_size)).'</div>';
                $c++;
            }else{
                $e.='<div class="six columns b20">'.st_get_content(ST_TEMPLATE_DIR.'loop/loop-post.php',$post,array('display_type'=>$type,'i'=>$i,'image_size'=>$image_size)).'</div>';
                $e.='<div class="clear"></div></div>';
               $c=0;
            }
         }else{
             $e.=st_get_content(ST_TEMPLATE_DIR.'loop/loop-post.php',$post,array('display_type'=>$type,'i'=>$i,'image_size'=>$image_size));
         }
        $i++;
        endforeach; 
        
        $html .='<div class="loop-posts">'.$e.'</div>';
        
        
        $p ='';
        if(!is_home() && !is_front_page()) { // only true if not is home page or front page
               if($show_paging=='y'){
                 $p =  st_post_pagination($new_query->max_num_pages,2, false);
                  if($p!=''){
                      $p = '<div class="pagination text-center t0">'.$p.'</div>';
                  }
               }
       }
      
        wp_reset_postdata();
  return '<div class="blog-wrap builder-item-wrapper">'.do_shortcode($html).$p.'</div>';
}

add_shortcode( 'blog_post', 'st_blog_post_func' );


function st_img_func( $atts, $caption='' ) {
    
	extract( shortcode_atts( array(
		'img_id' => 0,
		'title' => '',
        'url'=>'',
        'caption'=>'',
        'is_gallery'=>0
	), $atts ) );
    
    extract($atts);
    
    $attachment=wp_get_attachment_image_src($img_id, 'st_medium_thumb');
    
    $html_format ='<div class="gird-box"> %1$s </div>';
    $img = '<img src="'.$attachment[0].'" alt="'.esc_attr($title).'">';
    
    $a_rel= $add_item= '';
    if($is_gallery==1){
        $image_full = wp_get_attachment_image_src($img_id, 'full');
        $url = $image_full[0];
        $a_rel =' rel="prettyPhoto" ';
        $add_item ='
                <span class="portfolio-thumb-hover"></span>
                <span class="hover-lightbox-image"></span>
            ';
    }
    if($url!=''){
            $a = '<a '.$a_rel.' href="'.esc_attr($url).'" title="'.esc_attr($title).'"> '.$add_item.'</a> ';
    }else{
        $a ='   ';
    }
    
     $img = $a.$img;
    
    $img = '<div class="portfolio-media-wrapper">'.$img.'</div>';
    
    if($title!=''){
         $title ='<div class="portfolio-desc"><h4 class="im-title">
                 <a '.$a_rel.' href="'.esc_attr($url).'" title="'.esc_attr($title).'">'.esc_html($title).'</a> 
                 </h4>
             </div>';
    }
    
    if($caption!=''){
        
    }
    
    return  sprintf($html_format, $img.$title .$caption);
 }

add_shortcode( 'st_img', 'st_img_func' );


function st_widget_func( $atts, $caption='' ){
    
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
    
    if($id==''){
        return '';
    }
    return st_get_content_from_func('dynamic_sidebar',$id);
    
}

add_shortcode( 'st_widget', 'st_widget_func' );

/** ======================================== EDITOR SHORTCODE =============================================== */
function st_heading_shortcode($number,$atts,$content=''){
    	extract( shortcode_atts( array(
        'class'=>''
	), $atts ) );
    if($class==''){
        $class ='st-h1';
    }else{
        $class  ='st-h1 '.$class;
    }
    return  '<h'.$number.' class="'.esc_attr($class).'">'.$content.'</h'.$number.'>';
}
function st_h1_func($atts, $content='' ){
    return st_heading_shortcode(1,$atts,$content);
}
add_shortcode( 'h1', 'st_h1_func' );
///===
function st_h2_func($atts, $content='' ){
	return st_heading_shortcode(2,$atts,$content);
}
add_shortcode( 'h2', 'st_h2_func' );
///===
function st_h3_func($atts, $content='' ){
	return st_heading_shortcode(3,$atts,$content);
}
add_shortcode( 'h3', 'st_h3_func' );

///===
function st_h4_func($atts, $content='' ){
	return st_heading_shortcode(4,$atts,$content);
}
add_shortcode( 'h4', 'st_h4_func' );

///===
function st_h5_func($atts, $content='' ){
	return st_heading_shortcode(5,$atts,$content);
}
add_shortcode( 'h5', 'st_h5_func' );

///===
function st_h6_func($atts, $content='' ){
	return st_heading_shortcode(6,$atts,$content);
}
add_shortcode( 'h6', 'st_h6_func' );

// buttons
function st_button_func( $atts, $content='' ){
    
	extract( shortcode_atts( array(
		'type' => '',
        'color'=>'',
        'link'=>'',
        'icon'=>'',
        'target'=>'',
        'rounded'=>0,
	), $atts ) );
    
    $class= array();
    
    if($type){
        $class[] = $type;
    }
    
     if($color!=''){
        $class[]='btn_'.$color;
    }else{
        $class[] ='color';
    }
    
    if(intval($rounded)>0){
        $class[] = 'rounded';
    }
   
   if($icon!=''){
       $icon ='<i class="'.esc_attr($icon).'"></i>' ;
   }
   
   if($target!=''){
        $target = ' target="'.$target.'" ';
   }
    
   if(trim($link)==''){
        return '<button class="btn '.esc_attr(join(' ',$class)).'">'.$icon.esc_html($content).'</button>';
   }else{
        return '<a class="btn '.esc_attr(join(' ',$class)).'" '.$target.' href="'.$link.'">'.$icon.esc_html($content).'</a>';
   }
    
}

add_shortcode( 'button', 'st_button_func' );

// for columns and rows
function st_row( $atts, $content='' ){
    extract( shortcode_atts( array(
		'class' => '',
        'id'=>'',
	), $atts ) );
    $attr ='';
    
    if($id!=''){
        $attr.' id="'.esc_attr($id).'" ';
    }
    if($class!=''){
        $class .='row '.$class;
    }else{
        $class ='row';
    }
    
    $attr.=' class="'.esc_attr($class).'"';
    
    return  '<div class="row-wrapper"><div '.$attr.'>'.do_shortcode(trim($content)).' <div class="clear"></div> </div> </div>';
    
}
add_shortcode( 'row', 'st_row' );


// for columns and rows
function st_col( $atts, $content='' ){
    extract( shortcode_atts( array(
		'class' => '',
        'id'=>'',
        'width'=>''
	), $atts ) );
    $attr ='';
    
    if($id!=''){
        $attr.' id="'.esc_attr($id).'" ';
    }
    if($class!=''){
        $class .='columns  b10 '.$class;
    }else{
        $class ='columns  b10';
    }
    if($width!=''){
        $class =$width.' '.$class;
    }else{
         $class =$width.' twelve';
    }
    
    $attr.=' class="'.esc_attr($class).'"';
    
    return  '<div '.$attr.'>'.do_shortcode(trim($content)).'</div>';
    
}
add_shortcode( 'col', 'st_col' );
// other shortcode
function st_clear_func($atts, $content='' ){
	return '<div class="clear"></div>';
}
add_shortcode( 'clear', 'st_clear_func' );

function st_divider_func($atts, $content='' ){
	return '<div class="row"><div class="twelve columns"><div class="divider"></div></div></div>';
}
add_shortcode( 'divider', 'st_divider_func' );


function st_space_func($atts, $content='' ){
    
    if(isset($atts['height'])  && intval($atts['height'])>0){
        $style = ' style="height: '.intval($atts['height']).'px; display: block;" ';
    }else{
        $style ='';
    }
	return '<div '.$style.' class="space"></div>';
}
add_shortcode( 'space', 'st_space_func' );


// for video 
function st_video_func($atts, $content='' ){
    $link = $atts['link'];
    if($link==''){
        return '';
    }else{
        return st_get_video($link).'<div class="video-shadow"></div>';
    }
   
}
add_shortcode( 'video', 'st_video_func' );


// for  Accordion
function st_accordion_func($atts, $content=''){
    $class= (isset($atts['class'])) ?  $atts['class'] : '';
    if($class==''){
        $class = 'st-accordion';
    }else{
        $class ='st-accordion '.$class;
    }
    return  '<ul class="'.esc_attr($class).'">'.do_shortcode($content).'</ul>';
    
}

function st_accordion_item_func($atts, $content=''){
    
   	extract( shortcode_atts( array(
		'title' => '',
        'class'=>''
	), $atts ) );
    
    $title ='<h3 class="acc-title">'.esc_html($title).'<i class="ui-icon icon-chevron-down"></i></h3>';
    
    return  '<li class="'.esc_attr($class).'">'.$title.'
    <div class="acc-content" style="display: none;"><div class="txt-content">'.do_shortcode($content).'</div></div>
    </li>';
    
}
add_shortcode( 'accordion', 'st_accordion_func' );
add_shortcode( 'accordion_item', 'st_accordion_item_func' );

// for  Toggle
function st_toggle_func($atts, $content=''){
    $class= (isset($atts['class'])) ?  $atts['class'] : '';
    if($class==''){
        $class = 'st-toggle';
    }else{
        $class ='st-toggle '.$class;
    }
    return  '<ul class="'.esc_attr($class).'">'.do_shortcode($content).'</ul>';
    
}

function st_toggle_item_func($atts, $content=''){
    
   	extract( shortcode_atts( array(
		'title' => '',
        'class'=>''
	), $atts ) );
    
    $title ='<h3 class="toggle-title sc-title ">'.esc_html($title).'<i class="ui-icon icon-plus"></i><i class="ui-icon icon-minus"></i></h3>';
    
    return  '<li class="'.esc_attr($class).'">'.$title.'
    <div class="toggle-content" style="display: none;"><div class="txt-content">'.do_shortcode($content).'</div></div>
    </li>';

}


add_shortcode( 'toggle', 'st_toggle_func' );
add_shortcode( 'toggle_item', 'st_toggle_item_func' );

// for tabs

function st_do_shortcode($content, $autop = FALSE) 
{ 

	$content = do_shortcode( $content ); 
	
	if ( $autop ) {
		$content = wpautop($content);
	}
	
	return $content;
}


function st_tabs_func($atts, $content = null)
{	
	extract(shortcode_atts(array(
		'position' => ''
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	}
	else
	{
		for ($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$tabs_post = ( $position == 'left' ) ? 'tabs-left' : '';
		
		$out = '<div class="st-tabs '. $tabs_post .'">';
		
		$out.= '<ul class="tab-title">';
		for ($i = 0; $i < count($matches[0]); $i++) {
			$out.= '<li tab-id="tab-'. $i .'"><span>'. $matches[3][$i]['title'] .'</a></li>';
		}
		$out.= '</ul>';
		
		$out.= '<div class="tab-content-wrapper">';
		for ($i = 0; $i < count($matches[0]); $i++) {
			$out.= '<div id="tab-'. $i .'" class="tab-content"><div class="txt-content">'. st_do_shortcode(trim($matches[5][$i]), TRUE) .'</div></div>';
		}
		$out.= '</div>';
		
		$out.= '</div>';
		
		return $out;
	}
}
add_shortcode('tabs', 'st_tabs_func');




function st_portfolio_func( $atts, $content='' ) {
     global $wp_query;
    global $post;
    $tmp_post = $post;
	extract( shortcode_atts( array(
		'title' => 0,
		'cats' => '',
        'numpost'=>'-1',
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'num_col'=>4,
        'site_layout'=>'',
        'show_heading'=>'y',
        'filter_type'=>'default',
        'custom_filter_text'=>'',
        'custom_filter_url'=>'',
        'row_index'=>9 // not begin
	), $atts ) );
    
    $wc = $pbwith;
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }

      $html  = $heading  = $htitle='';
      if($show_heading!='n'){
        if( $title!=''){
            $f_class='';
             $htitle = esc_html($title);
        }else{
            $f_class=" hide-heading ";
        }
          
        $filter ='';
        $is_filter = false;
      
        if($filter_type=='default'){
            $terms =  get_terms( 'portfolio_tag', array('include'=>$cats,'fields'=>'all') );
            $filter = '<ul data-option-key="filter" class="cpt-filters'.$f_class.'">
                    <li><a class="selected" href="#filter=*">'.__('All','smooththemes').'</a></li>';
             foreach($terms as $term){
                $filter.='<li><a  href="#filter=.'.esc_attr($term->slug).'">'.esc_html(stripslashes($term->name)).'</a></li>';
             }                
                                
            $filter.='</ul>';
            
            $is_filter = true;
        }else{
            if($custom_filter_text!=''){
                 if(trim($custom_filter_url)==''){
                $custom_filter_url ='#';
                }
                $filter ='<a class="view-all" href="'.esc_attr($custom_filter_url).'">'.esc_html($custom_filter_text).'</a>';
            }
        }
      
      
       $heading ='<div class="builder-title-wrapper clearfix'.( ($is_filter && $row_index==1 ) ? '  has_filter' : '  no_filter').'">
                        <h3 class="builder-item-title">'.( ($is_filter && $row_index==1 ) ? '' : $htitle ).'</h3>
                        <div class="builter-title-alt right">
                            '.$filter.'
                        </div>
                        <div class="clear"></div>
                    </div>';
        
        } // end show heading
        
      
          if(intval($numpost)>0){
            $numpost = intval($numpost);
          }else{
            $numpost = -1; // get all portfolio
          }
      
        $args = array( 'posts_per_page' => $numpost );
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        
        $args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        $args['post_type']='portfolio';
        
        if(!empty($cats)){
            $args['tax_query'] =array(
                    'relation' => 'AND',
            		array(
            			'taxonomy' => 'portfolio_tag',
            			'field' => 'id',
            			'terms' => explode(',',$cats),
                        'operator'=>'IN'
            		)
	            );
          }
          
          // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }
          
         //  echo var_dump($wp_query);
         $new_query = new WP_Query($args);
     
        //$myposts =  $wp_query->query($args);
        $myposts = $new_query->posts;
     
        $num_col = intval($num_col)>0 ?  intval($num_col) : 4 ;

        $e = '';
        $c =0;
        $i = 1;
        if(!isset($type))
            $type ='';
       
       $image_size ='st_medium';

        // echo $num_col;
        $col_txt = stpb_number_to_text(12/$num_col);
        foreach( $myposts as $post ) : setup_postdata($post);
            $term_list = wp_get_post_terms($post->ID, 'portfolio_tag', array("fields" => "all"));
            $filter_class=array();
             $caption=  array();
            foreach($term_list as $term){
                $filter_class[]= $term->slug;
                $caption[] = $term->name ;
            }
            
             $ptitle = the_title_attribute( 'echo=0' );
             $title =  sprintf( esc_attr__( 'Permalink to %s', 'smooththemes' ), $ptitle ); 
             $link = get_permalink($post->ID);
              
             $caption  = (!empty($caption)) ? join(esc_html(' / '),$caption) : '&nbsp;&nbsp;';
              
             $caption =   '<div class="cpt-desc">'.$caption.'</div>';
             
            $html.= '<div class="cpt-item item-isotope '.$col_txt.' columns b30 '.esc_attr(join(' ',$filter_class)).'">
                            <div class="thumb-wrapper">
                                '.st_post_thumbnail_gallery($post->ID).'
                            </div>
                             <div class="cpt-detail">
                                <h2 class="cpt-title"><a href="'.$link.'">'.get_the_title($post->ID).'</a></h2>
                                '.$caption.'
                            </div>   
                        </div>';
                    if($i>=$num_col){
                        $html.='<div class="clear"></div>';
                        $i=1;
                    }else{
                         $i++;
                    }
        endforeach; 
      
     wp_reset_query();
     
  return '<div class="builder-item-wrapper builder-portfolio">
                '.$heading.'
                <div class="builder-item-content row'.( $is_filter ? ' has-isotope' : ' no-isotope').'">
                    <div class="twelve columns b0">
                        <div class="cpt-items row clearfix isotope">
                        '.do_shortcode($html).'
                        </div>
                    </div>
                </div>
              
            </div>';
}
add_shortcode('portfolio', 'st_portfolio_func');



// for entry content
function st_this_entry_func($atts, $content='' ){
     global $post;
      return apply_filters('the_content',$post->post_content);
}
add_shortcode( 'this_entry', 'st_this_entry_func' );




function st_shortcode_slider($atts, $content = null){
    
   //  echo var_dump($atts);
    
    $data['slider_items'] = st_get_setup_post_slider_data($atts);
    $data['slider_type'] =  'flexslider' ;
    $data['class']= 'posts-slider';
    $data['show_slider'] =1;
    $data['size']  = 'st_medium';
   
    return  '<div class="post-slider-w silder-wrap">'. st_get_content_from_func('st_the_slider',$data).'</div>';
}
add_shortcode('st_slider', 'st_shortcode_slider');



/** *************************************************************************/
/** ===================== for WooCommerce ==============================*/
/** *************************************************************************/

function st_shortcode_WooCommerce_Best_Sellers($args, $content = null){
    if(!st_is_woocommerce()){
        return '';
    }
    
        global $woocommerce, $paged;
         // wp_cache_get('widget_best_sellers', 'widget');
         //	wp_cache_set('widget_best_sellers', $cache, 'widget');
        
		ob_start();
 	   $old_content = ob_get_clean();
		extract($args);

	//	$title = apply_filters('widget_title', empty($instance['title']) ? __('Best Sellers', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $args['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'meta_key' 		 => 'total_sales',
    		'orderby' 		 => 'meta_value_num',
    		'no_found_rows'  => 0,
    	);

    	$query_args['meta_query'] = array();

    	if ( isset( $args['hide_free'] ) && 1 == $args['hide_free'] ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}

	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
        
        if($paged>0){
            // $args['paged'] =  $paged;
        }else{
            $paged = intval($_REQUEST['paged']);
        }
        
        if($paged>0){
            $query_args['paged'] = $paged;
        }

		$r = new WP_Query($query_args);

        $e  = $p = '';
        
        // show columns
        $num_col =  intval($args['num_col']);
        $num_col =  ($num_col>0  && $num_col<=4)  ? $num_col :  4;
        global $woocommerce_loop;
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $num_col );
        
		if ( $r->have_posts() ) {

			if ( $title )
				echo '<h2 class="st-heading">' . $title . '</h2>';

			echo '<ul class="products">';
			while ( $r->have_posts()) {
				$r->the_post();
				global $product;
			$tpl ='';
                ob_start();
                 woocommerce_get_template_part( 'content', 'product' ); 
                 $tpl = ob_get_clean();
                $e.=$tpl;
			}
		}
        
        $html .=$e;
        $html = '<ul class="products">'.$html.'</ul>';
  
         if(!is_home() && !is_front_page()) { // only true if not is home page or front page
               if($args['show_paging']=='y'){
                 $p =  st_post_pagination($r->max_num_pages,2, false);
                  if($p!=''){
                      $p = '<div class="pagination text-center t0">'.$p.'</div>';
                  }
               }
               
       }
      
  
         wp_reset_query();
	
         echo  $old_content;
	   return '<div class="woocommerce-wrap  best-sellers  woocommerce col-'.$num_col.'">'.do_shortcode($html).$p.'</div>';
}
add_shortcode('st_woocommerce_best_sellers', 'st_shortcode_WooCommerce_Best_Sellers');



function st_woocommerce_shortcode_products( $args, $content='' ) {
     if(!st_is_woocommerce()){
        return '';
    }
    
    global $wp_query,   $woocommerce;
    global $post, $paged;
    $tmp_post = $post;
    
  //   echo var_dump($args); die();
	extract( shortcode_atts( array(
		'title' => 0,
		'cats' => array(),
        'numpost'=>3,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'type'=>1,
        'site_layout'=>'',
        'show_title'=>'n',
        'more_text'=>'',
        'more_url'=>'',
        'show_paging'=>'n',
        'num_col'=>3
	), $args ) );
    
    $wc = $pbwith;
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }
        $html =   $cat_link = $cat_title='';
        // just only for one cate
        if(is_string($cats)){
            $cats = explode(',',$cats);
        }
        
        $cats =  $cats[0];
        /*
        if($cats>0){
            $cat_link = get_category_link($cats);
            $cat_title = get_cat_name($cats);
        }else{
            // do some thing
        }
        */
     
     
        
        if($show_title =='y' and $title!=''){
             $html ='
                <div class="builder-title-wrapper clearfix">
                    <h3 class="builder-item-title">'.esc_html($title).'</h3>';
                    if($more_text!=''){
                         $html .='<a href="'.( $more_url!='' ?  esc_url($more_url) : '#' ).'" class="view-all">'.esc_html($more_text).'</a>';
                    }
                $html.='</div>';
        }
        
        
        if(intval($numpost)<=0){
            $numpost = (int) get_option('posts_per_page',10);
        }else{
            $numpost = intval($numpost);
        }
        
       $args = array( 'posts_per_page' => $numpost );
        if($cats>0){
             $args['tax_query'] = array(
                'relation' => 'AND',
                array(
            			'taxonomy' => 'product_cat',
            			'field' => 'id',
            			'terms' => array($cats),
            			'operator' => 'IN'
            		)
             );
        }
        
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        
        $args['post__not_in'] = $exclude;
        
        // custom order by meta key
        if(isset($orderby[0])  && $orderby[0]=='_'){
               $orderby = substr($orderby,1);
            	$args['meta_key'] 		 = $orderby;
		        $args['orderby'] 		 = 'meta_value_num';
                $args['meta_query'] = array();

            	if ( isset( $args['hide_free'] ) && 1 == $args['hide_free'] ) {
            		$args['meta_query'][] = array(
        			    'key'     => '_price',
        			    'value'   => 0,
        			    'compare' => '>',
        			    'type'    => 'DECIMAL',
        			);
            	}
              $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
              $args['meta_query'][] = $woocommerce->query->visibility_meta_query();  
                
        }else{
             $args['orderby'] = $orderby;
        }
       
        
        $args['order'] = $order;
        if($paged>0){
             $args['paged'] =  $paged;
        }else{
            $paged =  isset($_REQUEST['paged']) ?  intval($_REQUEST['paged']) : 1;
        }
        
        $args['post_type']='product';
        $args['post_status']='publish';
        
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
        }
        
       //  echo var_dump($args); die();
        
        
         $new_query = new WP_Query($args);
         $myposts =  $new_query->posts;

        $i = 0;
        $e = '';
        ob_start();
        $old_content = ob_get_clean();
        if($type==3 && count($myposts)%2!=0){
            $myposts[] =  false;
        }
        
        if($site_layout ==1 &&( $pbwith =='1_1' ||  $pbwith =='3_4')  && $type !=3){
            $image_size = 'st_large';
        }
        
        // show columns
        $num_col =  intval($num_col);
        $num_col =  ($num_col>0  && $num_col<=4)  ? $num_col :  4;
        
        // echo $num_col; die();
        global $woocommerce_loop;
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $num_col );
        foreach( $myposts as $post ) : 
                setup_postdata($post);
            	global $product;
                $tpl ='';
                ob_start();
               
             woocommerce_get_template_part( 'content', 'product' ); 
             $tpl = ob_get_clean();
            // $e.='<div class="product">'.$e.=.'</div>';
            $e.=$tpl;
        $i++;
        endforeach; 
      
        $html .=$e;
        $html = '<ul class="products">'.$html.'</ul>';
        $p='';
        if(!is_home() && !is_front_page()) { // only true if not is home page or front page
               if($show_paging=='y'){
                 $p =  st_post_pagination($new_query->max_num_pages,2, false);
                  if($p!=''){
                      $p = '<div class="pagination text-center t0">'.$p.'</div>';
                  }
               }
       }
       

        wp_reset_postdata();
        echo $old_content; 
        
  return '<div class="woocommerce-wrap woocommerce  builder-item-wrapper">'.do_shortcode($html).$p.'</div>';
}

add_shortcode('st_products', 'st_woocommerce_shortcode_products');


function  st_shorcode_alert_func($atts,$content =''){
    extract(shortcode_atts(array(
		'alert_type' => ''
	), $atts));
    
    if($alert_type!=''){
        $alert_type =' alert-'.$alert_type;
    }
    $html  = '<div class="alert'.$alert_type.'"><button type="button" class="close">'.esc_html(__('&#215;','smooththemes')).'</button>'.do_shortcode($content).'<div class="clear"></div></div>';
    return $html;
    
}

add_shortcode('alert', 'st_shorcode_alert_func');



function st_rooms_func( $atts, $content='' ) {
     global $wp_query;
    global $post;
    $tmp_post = $post;
	extract( shortcode_atts( array(
		'title' => 0,
		'cats' => '',
        'numpost'=>6,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'num_col'=>4,
        'site_layout'=>'',
        'show_heading'=>'y',
        'filter_type'=>'default',
        'custom_filter_text'=>'',
        'custom_filter_url'=>'',
        'row_index'=>9 // not begin
	), $atts ) );
    
    $wc = $pbwith;
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }

      $html  = $heading  = $htitle='';
      if($show_heading!='n'){
        if( $title!=''){
            $f_class='';
             $htitle = esc_html($title);
        }else{
            $f_class=" hide-heading ";
        }
          
        $filter ='';
        $is_filter = false;
      
        if($filter_type=='default'){
            $terms =  get_terms( 'room_cat', array('include'=>$cats,'fields'=>'all') );
            $filter = '<ul data-option-key="filter" class="cpt-filters'.$f_class.'">
                    <li><a class="selected" href="#filter=*">'.__('All','smooththemes').'</a></li>';
             foreach($terms as $term){
                $filter.='<li><a  href="#filter=.'.esc_attr($term->slug).'">'.esc_html(stripslashes($term->name)).'</a></li>';
             }                
                                
            $filter.='</ul>';
            
            $is_filter = true;
        }else{
            if($custom_filter_text!=''){
                 if(trim($custom_filter_url)==''){
                $custom_filter_url ='#';
                }
                $filter ='<a class="view-all" href="'.esc_attr($custom_filter_url).'">'.esc_html($custom_filter_text).'</a>';
            }
        }
      
      
       $heading ='<div class="builder-title-wrapper clearfix'.( ($is_filter && $row_index==1 ) ? '  has_filter' : '  no_filter').'">
                        <h3 class="builder-item-title">'.( ($is_filter && $row_index==1 ) ? '' : $htitle ).'</h3>
                        <div class="builter-title-alt right">
                            '.$filter.'
                        </div>
                        <div class="clear"></div>
                    </div>';
        
        } // end show heading
        
      
          if(intval($numpost)>0){
            $numpost = intval($numpost);
          }else{
            $numpost = -1; // get all portfolio
          }
      
        $args = array( 'posts_per_page' => $numpost );
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        
        $args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        $args['post_type']='room';
        
        if(!empty($cats)){
            $args['tax_query'] =array(
                    'relation' => 'AND',
            		array(
            			'taxonomy' => 'room_cat',
            			'field' => 'id',
            			'terms' => explode(',',$cats),
                        'operator'=>'IN'
            		)
	            );
          }
          
          // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }
          
         //  echo var_dump($wp_query);
         $new_query = new WP_Query($args);
     
        //$myposts =  $wp_query->query($args);
        $myposts = $new_query->posts;
     
        $num_col = intval($num_col)>0 ?  intval($num_col) : 4 ;

        $e = '';
        $c =0;
        $i = 1;
        if(!isset($type))
            $type ='';
       
       $image_size ='st_medium';

        // echo $num_col;
        $col_txt = stpb_number_to_text(12/$num_col);
        foreach( $myposts as $post ) : setup_postdata($post);
            $term_list = wp_get_post_terms($post->ID, 'room_cat', array("fields" => "all"));
            $filter_class=array();
            foreach($term_list as $term){
                $filter_class[]= $term->slug;
            }
            
             $ptitle = the_title_attribute( 'echo=0' );
             $title =  sprintf( esc_attr__( 'Permalink to %s', 'smooththemes' ), $ptitle ); 
              $link = get_permalink($post->ID);
              
              $price = get_post_meta($post->ID,'_room_price',true);
              $price  = ($price!='') ? $price : '&nbsp;&nbsp;';
              
              $caption =   '<div class="cpt-desc">'.esc_html($price).'</div>';
             
            $html.= '<div class="cpt-item item-isotope '.$col_txt.' columns b30 '.esc_attr(join(' ',$filter_class)).'">
                            <div class="thumb-wrapper">
                                '.st_post_thumbnail_gallery($post->ID).'
                            </div>
                             <div class="cpt-detail">
                                <h2 class="cpt-title"><a href="'.$link.'">'.get_the_title($post->ID).'</a></h2>
                                '.$caption.'
                            </div>   
                        </div>';
                    if($i>=$num_col){
                        $html.='<div class="clear"></div>';
                        $i=1;
                    }else{
                         $i++;
                    }
        endforeach; 
      
     wp_reset_query();
     
  return '<div class="builder-item-wrapper builder-rooms">
                '.$heading.'
                <div class="builder-item-content row'.( $is_filter ? ' has-isotope' : ' no-isotope').'">
                    <div class="twelve columns b0">
                        <div class="cpt-items row clearfix isotope">
                        '.do_shortcode($html).'
                        </div>
                    </div>
                </div>
              
            </div>';
}
add_shortcode('rooms', 'st_rooms_func');




function st_events_func( $atts, $content='' ) {
    global $wp_query;
    global $post, $paged;
    $tmp_post = $post;
	extract( shortcode_atts( array(
		'title' => '',
		'cats' => '',
        'numpost'=>5,
        'exclude'=>'',
        'orderby'=>'_st_event_start_date',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'type'=>1,
        'site_layout'=>'',
        'show_title'=>'n',
        'show_paging'=>'n'
	), $atts ) );
    
    // $wc = $builder[$i]['pbwith']; old
    $wc = $pbwith; // new
    
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }
        $html ='';
        // just only for one cate
        if(is_string($cats)){
            $cats = explode(',',$cats);
        }
        

        if( $title!=''){
             $html .= '<div class="builder-title-wrapper clearfix">
                        <h3 class="builder-item-title">'.esc_html($title).'</h3>
                    </div>';
        }
        
        
        if(intval($numpost)<=0){
            $numpost = (int) get_option('posts_per_page',10);
        }else{
            $numpost = intval($numpost);
        }
        
       $args = array( 'posts_per_page' => $numpost );
        if($cats>0){
           // $args['category__in'] =  array($cats);
        }
        
        if($exclude!=''){
            $exclude= explode(',',$exclude);
             $args['post__not_in'] = $exclude;
        }
        
        if($orderby=='_st_event_start_date' || $orderby=='_st_event_end_date'){
            
            $args['meta_key']	 =  $orderby;
            
            $args['meta_query'] = array(
        		array(
        			'key' => $orderby,
                    'value'=>'1000-01-01 00:00',
                    'compare'=>'>=',
        			'type' => 'DATETIME',
        		)
        	);
            
            $args['orderby'] = 'meta_value';
        }else{
            $args['orderby'] = $orderby;
        }
        
        $args['order'] = $order;
        $args['post_type'] = 'event';
        
        if($paged>0){
             $args['paged'] =  $paged;
        }else{
             $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
        }
        
        // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }

         $new_query = new WP_Query($args);
         $myposts =  $new_query->posts;
         
        $e = '';
        $template_file = ST_TEMPLATE_DIR.'loop/loop-event.php';
        
        // display as list
        foreach( $myposts as $post ) : setup_postdata($post);
             $e.=st_get_content($template_file);
        $i++;
        endforeach; 
        
        $html .=$e;
        $p ='';
        if(!is_home() && !is_front_page()) { // only true if not is home page or front page
               if($show_paging=='y'){
                 $p =  st_post_pagination($new_query->max_num_pages,2, false);
                  if($p!=''){
                      $p = '<div class="pagination text-center t0">'.$p.'</div>';
                  }
               }
       }
      
      wp_reset_postdata();
        
  return '<div class="loop-events">'.do_shortcode($html).$p.'</div>';
}

add_shortcode( 'events', 'st_events_func' );


function st_upcomming_events_func($atts, $content='' ){
    
    extract( shortcode_atts( array(
		'title' => '',
        'numpost'=>5,
        'more_text'=>'',
        'more_url'=>'#'
        
	), $atts ) );
    
    
   if(intval($numpost)<=0){
        $numpost = (int) get_option('posts_per_page',10);
    }else{
        $numpost = intval($numpost);
    }
        
       $myposts  = st_get_upcomming_events($numpost);
     
      $e ='';
     
     foreach($myposts as $post){
         $start_date = get_post_meta($post->ID,'_st_event_start_date',true);
    
            if($start_date!=''){
                $start_date = strtotime($start_date);
            }
            
            $end_date = get_post_meta($post->ID,'_st_event_end_date',true);
            if($end_date!=''){
                $end_date = strtotime($end_date);
            }
             
            $link = get_permalink($post->ID);
        
   
          $e .='<li>
                <p class="small-event-data">
                    <strong>'.date_i18n('d',$start_date).'</strong><a href="'.$link.'"></a><span>'.date_i18n('M',$start_date).'</span>
                </p>
                <a class="event-title" href="'.$link.'">'.apply_filters('the_title',$post->post_title).'</a>
                <span>'.__('at','smooththemes').' '.date_i18n('H:iA, l d F Y',$start_date).'</span>
                <span><strong>'.get_post_meta($post->ID,'_st_event_meta_price',true).'</strong></span>
            </li>';
     }
     
      wp_reset_query();
    
    
    $link_more ='';
    if($more_text!=''){
        $link_more  =' <a class="view-all" href="'.$more_url.'">'.esc_html($more_text).'</a>' ;
    }
    
     $html ='<div class="builder-item-wrapper builder-editor">
                <div class="builder-title-wrapper clearfix">
                    <h3 class="builder-item-title">'.esc_html($title).'</h3>
                    '.$link_more.'
                </div>
                <div class="builder-item-content row">
                    <div class="twelve columns b0">
                        <ul class="upcoming-events">
                            '.$e.'
                        </ul>
                    </div>
                </div>
            </div>';
                                    
     return $html;
     
}
add_shortcode( 'upcomming_events', 'st_upcomming_events_func' );



function events_calendar_func($atts, $content=''){
     $calendar = new STEventsCalendar();
     return '<div class="st-events-calendar"><div class="loading" style="display:none;"><div class="loading-icon"></div></div> <div class="events-calendar-ajax">'.$calendar->show().'</div> </div>';
     
}

add_shortcode( 'events_calendar', 'events_calendar_func' );


function st_post_gallery_func( $atts, $content='' ) {
     global $wp_query;
    global $post;
    $tmp_post = $post;
	extract( shortcode_atts( array(
		'title' => 0,
		'cats' => '',
        'numpost'=>6,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'num_col'=>4,
        'site_layout'=>'',
        'show_heading'=>'y',
        'filter_type'=>'default',
        'custom_filter_text'=>'',
        'custom_filter_url'=>'',
        'row_index'=>9 // not begin
	), $atts ) );
    
    $wc = $pbwith;
     $w=  explode('_',$wc);
     $t = intval($w[0]);
     $m = intval($w[1]);
     
     if($m>0 and $t>0){
         $c = $t/$m;
     }else{
        $c=1;
     }

      $html  = $heading  = $htitle='';
      if($show_heading!='n'){
        if( $title!=''){
            $f_class='';
             $htitle = esc_html($title);
        }else{
            $f_class=" hide-heading ";
        }
          
        $filter ='';
        $is_filter = false;
      
        if($filter_type=='default'){
            $terms =  get_terms( 'gallery_tag', array('include'=>$cats,'fields'=>'all') );
            $filter = '<ul data-option-key="filter" class="cpt-filters'.$f_class.'">
                    <li><a class="selected" href="#filter=*">'.__('All','smooththemes').'</a></li>';
             foreach($terms as $term){
                $filter.='<li><a  href="#filter=.'.esc_attr($term->slug).'">'.esc_html(stripslashes($term->name)).'</a></li>';
             }                
                                
            $filter.='</ul>';
            
            $is_filter = true;
        }else{
            if($custom_filter_text!=''){
                 if(trim($custom_filter_url)==''){
                $custom_filter_url ='#';
                }
                $filter ='<a class="view-all" href="'.esc_attr($custom_filter_url).'">'.esc_html($custom_filter_text).'</a>';
            }
        }
      
      
       $heading ='<div class="builder-title-wrapper clearfix'.( ($is_filter && $row_index==1 ) ? '  has_filter' : '  no_filter').'">
                        <h3 class="builder-item-title">'.( ($is_filter && $row_index==1 ) ? '' : $htitle ).'</h3>
                        <div class="builter-title-alt right">
                            '.$filter.'
                        </div>
                        <div class="clear"></div>
                    </div>';
        
        } // end show heading
        
      
          if(intval($numpost)>0){
            $numpost = intval($numpost);
          }else{
            $numpost = -1; // get all portfolio
          }
      
        $args = array( 'posts_per_page' => $numpost );
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        
        $args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        $args['post_type']='gallery';
        
        if(!empty($cats)){
            $args['tax_query'] =array(
                    'relation' => 'AND',
            		array(
            			'taxonomy' => 'gallery_tag',
            			'field' => 'id',
            			'terms' => explode(',',$cats),
                        'operator'=>'IN'
            		)
	            );
          }
          
          // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }
          
         //  echo var_dump($wp_query);
         $new_query = new WP_Query($args);
     
        //$myposts =  $wp_query->query($args);
        $myposts = $new_query->posts;
     
        $num_col = intval($num_col)>0 ?  intval($num_col) : 4 ;

        $e = '';
        $c =0;
        $i = 1;
        if(!isset($type))
            $type ='';
       
       $image_size ='st_medium';

        // echo $num_col;
        $col_txt = stpb_number_to_text(12/$num_col);
        foreach( $myposts as $post ) : setup_postdata($post);
            $term_list = wp_get_post_terms($post->ID, 'gallery_tag', array("fields" => "all"));
            $filter_class=array();
            foreach($term_list as $term){
                $filter_class[]= $term->slug;
            }
            
             $ptitle = the_title_attribute( 'echo=0' );
             $title =  sprintf( esc_attr__( 'Permalink to %s', 'smooththemes' ), $ptitle ); 
             $link = get_permalink($post->ID);
              
              $image_data=  get_post_meta($post->ID,'_st_gallery', true);
              
               $n = count($image_data['images']);
               if($n==1){
                  $caption =  sprintf(__('Total %s photo','smooththemes'),$n);
               }else{
                  $caption =  sprintf(__('Total %s photos', 'smooththemes'),$n);
               }
             
              $caption =   '<div class="cpt-desc">'.$caption.'</div>';
             
            $html.= '<div class="cpt-item item-isotope '.$col_txt.' columns b30 '.esc_attr(join(' ',$filter_class)).'">
                            <div class="thumb-wrapper">
                                '.st_images_thumb($image_data).'
                            </div>
                             <div class="cpt-detail">
                                <h2 class="cpt-title">'.get_the_title($post->ID).'</h2>
                                '.$caption.'
                            </div>   
                        </div>';
                    if($i>=$num_col){
                        $html.='<div class="clear"></div>';
                        $i=1;
                    }else{
                         $i++;
                    }
        endforeach; 
      
     wp_reset_query();
     
  return '<div class="builder-item-wrapper builder-gallery ">
                '.$heading.'
                <div class="builder-item-content row'.( $is_filter ? ' has-isotope' : ' no-isotope').'">
                    <div class="twelve columns b0">
                        <div class="cpt-items row clearfix isotope">
                        '.do_shortcode($html).'
                        </div>
                    </div>
                </div>
              
            </div>';
}

add_shortcode('post_gallery', 'st_post_gallery_func');


function st_reservation_form_func( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'to_email' => '',
	), $atts ) );
    
    $file  = ST_TEMPLATE_DIR.'forms/reservation.php';
    
    $html ='';
    if(is_file($file))
         $html = st_get_content($file,$atts, array(),true);
         
    return $html;
    
    
 }
    
    
add_shortcode('reservation_form', 'st_reservation_form_func');

function st_contact_form_func( $atts, $content='' ) {
	$atts = shortcode_atts( array(
		'to_email' => '',
	), $atts ) ;
    
    $contact_form_template = ST_TEMPLATE_DIR.'forms/contact.php';
    $html ='';
    if(is_file($contact_form_template))
         $html = st_get_content($contact_form_template,$atts, array(),true);
         
    return $html;
    
 }
    
add_shortcode('contact_form', 'st_contact_form_func',$atts);


function st_block_quote_func($atts, $content='' ){
	return '<div class="st-blockquote">
            <i class="icon-quote-left icon-4x pull-left icon-muted"></i> '.$content.'
                </div>';
}
add_shortcode( 'block_quote', 'st_block_quote_func' );




<?php 

$title ='';
if(is_singular()){
    
    if(is_singular('post')){
        // get top title from Admin settings
        if(st_get_setting('show_blog_toptitle','y')!='n'){
            $title  =   st_get_setting('blog_toptitle','');
        }
         
    }else{
         $title =  get_the_title();
    }
    
    if(is_page()){
        global  $post;
        $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
        if(empty($st_page_options) || (isset($st_page_options['show_title'])  &&  $st_page_options['show_title']==1)){
             // show title
        }else{
            $title= '';
        }
        
    }
    
    
}elseif(is_author()){
     $title = get_the_author();
}elseif(is_tax() || is_category() || is_tag()){
      $title = single_term_title('',false);
}elseif(is_search()){
    $title = __('Seach for :','smooththemes'). get_search_query();
}elseif( (is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category() ){
    
   if ( is_day() ) : 
	  $title =	sprintf( __( 'Daily Archives: %s', 'smooththemes' ), '<span>' . get_the_date() . '</span>' ); 
	 elseif ( is_month() ) : 
		$title =	 sprintf( __( 'Monthly Archives: %s', 'smooththemes' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'smooththemes' ) ) . '</span>' );
	 elseif ( is_year() ) : 
		$title =	 sprintf( __( 'Yearly Archives: %s', 'smooththemes'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'smooththemes' ) ) . '</span>' ); 
	 else : 
		$title =__( 'Blog Archives', 'smooththemes' );
	endif; 
    
}elseif(is_404()){
    $title =__('404','smooththemes');
}elseif((is_home() || is_front_page()) && !is_page()){  // default if user do not select static page
    if(st_get_setting('show_blog_toptitle','y')!='n'){
            $title  =   st_get_setting('blog_toptitle','');
        }
}
    



if($title){
?>
<div class="row">
    <div class="twelve columns b0">
        <?php if(is_singular('event')): 
        
         global $post;
           $start_date = get_post_meta($post->ID,'_st_event_start_date',true);
    
            if($start_date!=''){
                $start_date = strtotime($start_date);
            }
            
            $end_date = get_post_meta($post->ID,'_st_event_end_date',true);
            if($end_date!=''){
                $end_date = strtotime($end_date);
            }
        
          ?>
            <div class="event-single-date">
                <p class="small-event-data">
                    <strong><?php echo date_i18n('d',$start_date); ?></strong><a href="#"></a><span><?php echo date_i18n('M',$start_date); ?></span>
                </p>
            </div>
            <div class="single-event-title">
                <div class="page-title-wrapper">
                    <h1 class="page-title"><?php  echo $title; ?></h1>
                </div>
            </div>
            <div class="clear"></div>
   
        <?php elseif(is_singular('room')): ?>
      
        <div class="page-title-wrapper">
                <h1 class="page-title left"><?php echo $title; ?></h1>
                <div class="page-title-alt right">
                    <?php 
                    // show button in top title
                    if(st_get_setting('room_show_res_btn','y')!='n'){
                         echo '<a class="btn book_this_room" href="'.st_get_setting('room_res_btn_link','#').'">'.st_get_setting('room_res_btn_txt',__('Book this room','smooththemes')).'</a>';
                    } 
                    ?>
                    
                </div>
                <div class="clear"></div>
            </div>
        
        <?php else :  ?>
        
        <div class="page-title-wrapper">
            <h1 class="page-title left"><?php echo $title; ?></h1>
            <div class="page-title-alt right"></div>
            <div class="clear"></div>
        </div>
          
        <?php endif; ?>
        
        
    </div>
</div>
<?php
}
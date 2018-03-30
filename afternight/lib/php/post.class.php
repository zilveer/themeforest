<?php

class post {
    static $post_id = 0;
    static function get_my_posts( $author){
        $wp_query = new WP_Query( array('post_status' => 'any', 'post_type' => 'post' , 'author' => $author ) );
        if( count( $wp_query -> posts ) > 0 ){
            return true;
        }else{
            return false;
        }
    }
    
    
    static function filter_where( $where = '' ) {
        global $wpdb;
        if( self::$post_id > 0 ){
            $where .= " AND  ".$wpdb->prefix."posts.ID < " . self::$post_id;
        }
        return $where;
    }
        
    static function random_posts($no_ajax = false) {
        /*returns permalink to a random post*/
        global $wp_query;
        if ((int) get_query_var('paged') > 0) {
            $paged = get_query_var('paged');
        } else {
            if ((int) get_query_var('page') > 0) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
        }

        $wp_query = new WP_Query(array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => 1, 'orderby' => 'rand', 'paged' => $paged));

        if ($wp_query->found_posts > 0) {
            $k = 0;
            foreach ($wp_query->posts as $post) {
                $wp_query->the_post();
                $result = get_permalink($post->ID);
            }
        }

        if (isset($no_ajax) && $no_ajax) {
            return $result;
        } else {
            echo $result;
            exit;
        }
    }
    
        
    static function search(){ 
        /*used for search inputs to search for posts when user types something*/
        
        $query = isset( $_GET['params'] ) ? (array)json_decode( stripslashes( $_GET['params'] )) : exit;
        $query['s'] = isset( $_GET['query'] ) ? $_GET['query'] : exit;
        
        global $wp_query;
        $result = array();
        $result['query'] = $query['s'];
        
        $wp_query = new WP_Query( $query );
        
        if( $wp_query -> have_posts() ){
            foreach( $wp_query -> posts as $post ){
                $result['suggestions'][] = $post -> post_title;
                $result['data'][] =  $post -> ID;
            }
        }
        
        echo json_encode( $result );
        exit();
    }

    
    static function list_view($post, $template = 'blog_page', $additional_hidden_class_for_load_more = '', $list_view_thumbs_size = '', $show_full_content = false, $hide_excerpt = false ) {
            
            if( !post::is_feat_enabled($post->ID)  || !has_post_thumbnail($post->ID)){
                /*if thumbs are disabled for this particular post, it will act the same as 'no_thumb' option*/
                if(get_post_format($post->ID)!="gallery") $list_view_thumbs_size = 'no_thumb';
            }
            $arabic_to_word = array( 0 => '', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve' );
            
            $thumb_sizes = array( 'no_thumb' => 0, 'small_thumb' => 2, 'large_thumb' => 3, 'full_width_thumb' => 4 );
            $text_sizes = array( 'no_thumb' => 12, 'small_thumb' => 10, 'large_thumb' => 9, 'full_width_thumb' => 8 );

            $content_class = $arabic_to_word[ $text_sizes[ $list_view_thumbs_size ] ] . ' columns';
            if( $thumb_sizes[ $list_view_thumbs_size ] == 0 || !self::is_feat_enabled($post->ID)){
                $header_class = '';
                $content_class = 'twelve columns';
            }else{
                $header_class = $arabic_to_word[ $thumb_sizes[ $list_view_thumbs_size ] ] . ' columns';
            }
                        
            if (get_post_format($post->ID)=="video") {
                $size = 'tlist_video'; 
            }else{
                $size = 'tlist';     
            }  

            $onclick = self::video_post_click($post);

            /* Set the class for different image sizes */

            if($list_view_thumbs_size == 'small_thumb'){
                $list_image_class = 'list-small-image';
            } elseif($list_view_thumbs_size == 'large_thumb'){
                $list_image_class = 'list-medium-image';
            } elseif($list_view_thumbs_size == 'full_width_thumb'){
                $list_image_class = 'list-large-image';
            } elseif ($list_view_thumbs_size) {
                $list_image_class = 'list-no-image';
            }
            $skin = post::get_post_setting($post -> ID, 'skin', ' skin-0 ');

        ?>
        <article class="<?php echo $skin .' '; echo $list_image_class; echo ' '.$additional_hidden_class_for_load_more.' ' ;?>" >
            <?php  echo post::get_new_post_label($post -> post_date);  ?>
            <div class="list-wrapper">

                <?php if( strlen( $header_class ) ){ ?>
                <div class="<?php echo $header_class; ?>">
                        <?php if( self::is_feat_enabled($post->ID) ){ ?>
                            <div class="featimg">
                                <?php if (get_post_format($post->ID)!="gallery")  { echo '<a href="'. get_permalink($post->ID) .'">'; } ?>
                                <?php
                                    if (has_post_thumbnail($post->ID) || get_post_format($post->ID)=="gallery") {
                                        if( get_post_format($post->ID)=="gallery" ){
                                                /* for gallery posts we will show a slidedhow if there are more than 1 images  */
                                                ob_start();
                                                ob_clean();
                                                self::get_post_img_slideshow( $post -> ID, $size );
                                                $single_slideshow = ob_get_clean();
                                                if(isset($single_slideshow) && strlen($single_slideshow)){
                                                    echo $single_slideshow;
                                                }
                                        }else{

                                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ,  $size ); 
                                        
                                        ?>

                                        <img src="<?php echo $src[0]; ?>" alt="<?php echo $post->post_title; ?>" />

                                        <?php
                                        
                                    }} else{
                                        
                                        ?>

                                        <img src="<?php echo get_template_directory_uri() ?>/images/no.image.570x380.png" alt="<?php echo $post->post_title; ?>" />

                                        <?php
                                        
                                    }

                                ?>
                                <?php if (options::logic('styling', 'stripes')) {  ?>
                                    <div class="stripes" >&nbsp;</div>
                                <?php }?>
                                <?php if (get_post_format($post->ID)!="gallery")  { echo '</a>'; } ?> 

                                <?php
                                if (get_post_format($post->ID) == 'video') {
                                    echo '<div class="video-post">';
                                    if(isset($onclick)){
                                        $click = "onclick=".$onclick;
                                    }else{
                                        $click = '';
                                    }
                                        
                                    echo '<a href="javascript:void(0);" '.$click.' ><i class="icon-play"></i></a>';
                                    echo '</div>';
                                }
                                ?>
                            </div>

                        <?php } ?>  
                    
                </div>
                <?php } ?>  

                <div class="<?php echo $content_class; ?>">
                    <div class="entry-content">
                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            }elseif(get_post_type( $post -> ID) == 'portfolio') {
                                $cat_tax = 'portfolio-category';   
                            }elseif(get_post_type( $post -> ID) == 'event') {
                                $cat_tax = 'event-category';   
                            }

                            if(isset($cat_tax)){
                                $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ', '); 
                            }else{
                                $the_categories = '';
                            }
                        ?>                    

                        <ul>
                            <?php if( $list_image_class == 'list-large-image' && options::logic( 'blog_post' , 'show_post_format' ) ) { echo '<li class="entry-content-type">'. post::get_post_format_link($post -> ID) .'</li>'; } ?>
                            
                            <?php if(strlen(trim($the_categories))){ ?>
                            <li class="entry-content-category">
                                <ul class="category-list">
                                    <?php echo $the_categories; ?>
                                </ul>
                            </li>
                            <?php } ?> 
                            <li class="entry-content-title">
                                <h4>
                                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php _e('Permalink to', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo $post->post_title; ?></a>
                                </h4>
                                <?php post::get_edit_delet_btns($post); ?>
                            </li>
                            <?php if(get_post_type( $post -> ID) == 'event') { ?>
                                <?php 
                                $event_repeat = meta::get_meta( $post->ID, 'date' );
                                if($event_repeat['is_repeating'] == 'yes') { ?>
                                <!-- For repeated events -->
                                <li class="entry-content-date">
                                    <i class="icon-repeat"></i>
                                    <span class="repeated-event-frequency">
                                        <?php echo __('Every', 'cosmotheme') . ' '. post::repeating_localication_fix($event_repeat['repeating']); ?>
                                    </span>
                                    <?php if( $list_image_class != 'list-large-image' && options::logic( 'blog_post' , 'show_post_format' ) ) { 
                                            echo post::get_post_format_link($post -> ID);
                                     } ?>
                                </li>                                
                                <?php } else { ?>
                                <li class="entry-content-date">
                                    <?php post::get_repeated_events_date($post -> ID); ?>
                                    <?php if( $list_image_class != 'list-large-image'  && options::logic( 'blog_post' , 'show_post_format' )) { 
                                        echo post::get_post_format_link($post -> ID);
                                    } ?>
                                </li>                            
                            <?php } } else { ?>
                                <li class="entry-content-date">
                                    <a href="<?php echo get_permalink($post->ID); ?>"><?php echo post::get_post_date($post -> ID);?></a> 
                                    <?php if( $list_image_class != 'list-large-image' && options::logic( 'blog_post' , 'show_post_format' ) ) { echo post::get_post_format_link($post -> ID); } ?>
                                </li>
                            <?php } ?>
                            <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?><li class="entry-content-excerpt"> <?php } ?>
                                <?php
                                    if(!$hide_excerpt && !($list_image_class== 'list-small-image')){
                                        if (get_post_format($post->ID) == 'audio') {
                                            echo do_shortcode( self::get_audio_file( $post -> ID ) );
                                            
                                        }
                                    }
                                ?>
                                <?php
                                if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){
                                    if ($show_full_content || get_post_format($post->ID)=="quote") {
                                        echo apply_filters('the_content', $post->post_content);
                                    }else{ /*show the excerpt (first 400 characters)*/
                                        post::get_divided_excerpt($post, 100, $excerpt_lenght = 400);  
                                    }
                                }
                                
                                ?>
                            <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?></li><?php } ?>
                        </ul>                           
                    </div>
                </div>        
                <div class="clear"></div>
            </div>
        </article>          
        
        <?php
    }


    static function grid_view_thumbnails($post,  $width = 'three columns', $additiona_class = '', $filter_type = '', $taxonomy = 'category',$element_type = 'article', $is_masonry = false) {
        $nofeat_article_class = '';
        if(!post::is_feat_enabled($post->ID) ){
            $nofeat_article_class = 'nofeat';    
        }

        $post_id = $post->ID;
        $formatclass = custom_get_post_format($post->ID);

    ?>
        <?php if(strlen($filter_type)){?>
        <div class=" all-elements masonry_elem <?php echo $width; echo get_distinct_post_terms( $post->ID, $taxonomy, $return_names = true, $filter_type ); ?> " data-id="id-<?php echo $post->ID; ?>" >
        <?php } ?>
        <?php  

            $thumb_view_type = post::get_post_setting($post_id, 'thumb_view_type', ' thumb-image-main ');
            $skin = post::get_post_setting($post_id, 'skin', ' skin-0 ');

            if( !(has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) ){
                /*if post has no thumbnail or featured image is not enabled we will have text bu default  and add class 'text-only' that will disable anu hover effect */
                $thumb_view_type = '  thumb-text-main  text-only ';
            }
        ?>
        <<?php echo $element_type; ?>  class=" <?php echo $additiona_class. ' '.$thumb_view_type.' '.$skin ; ?> ">
            <?php  echo post::get_new_post_label($post -> post_date);  ?>
                <header>
                    <div class="featimg <?php if (!(has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) )) echo 'z_index_neg'; ?>">
                        <?php

                        if($thumb_view_type == 'thumb-text-main'){ /*if text is shown by default we will add a achor that will link to the post*/
                        ?>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                        <?php    
                        }
                        if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) {
                            
                            if (get_post_format($post->ID)=="video") {
                                $size = 'tlist_video'; 
                            }else{
                                $size = 'tlist';     
                            }
                            
                            $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , $size );
                        
                        ?>
                            <img src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>" />
                                   
                        <?php } else{ ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>" />
                        <?php } ?>

                        <?php 
                        if (options::logic('styling', 'stripes') && has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) {
                            ?><div class="stripes">&nbsp;</div><?php
                        }
                        if($thumb_view_type == 'thumb-text-main'){ /*if text is shown by default we will add a achor that will link to the post*/
                        ?>
                            </a>
                        <?php    
                        }
                        ?>
                        
                    </div>
                </header> 

                <div class="entry-content">
                    <ul>
                        <?php if(options::logic( 'blog_post' , 'show_post_format' )){ ?>
                        <li class="entry-content-type"><?php echo post::get_post_format_link($post -> ID); ?></li>
                        <?php } ?>
                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            } elseif(get_post_type( $post -> ID) == 'portfolio') {
                                $cat_tax = 'portfolio-category';   
                            } elseif(get_post_type( $post -> ID) == 'event') {
                                $cat_tax = 'event-category';   
                            }

                            if(isset($cat_tax)){
                                $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ', '); 
                            }else{
                                $the_categories = '';
                            }

                            if(strlen(trim($the_categories))){
                        ?>
                        <li class="entry-content-category">
                            <ul class="category-list">
                                <?php echo $the_categories; ?>
                            </ul>
                        </li>
                        <?php  
                            }
                        ?>
                        <li class="entry-content-title">
                            <h4><a href="<?php echo get_permalink($post->ID); ?>"  title="<?php _e('Permalink to', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo $post->post_title; ?></a></h4>
                        </li>

                        <?php if(get_post_type( $post -> ID) == 'event') { ?>
                            <?php 
                            $event_repeat = meta::get_meta( $post->ID, 'date' );
                            if($event_repeat['is_repeating'] == 'yes') { ?>
                            <!-- For repeated events -->
                            <li class="entry-content-date">
                                <i class="icon-repeat"></i>
                                <span class="repeated-event-frequency">
                                    <?php echo __('Every', 'cosmotheme') . ' '. post::repeating_localication_fix($event_repeat['repeating']); ?>
                                </span>
                            </li>                                
                        <?php } else { ?>
                            <li class="entry-content-date">
                                <?php post::get_repeated_events_date($post -> ID); ?>
                            </li> 
                        <?php } } else { ?>
                            <li class="entry-content-date"><a href="#"><?php echo post::get_post_date($post -> ID);?></a></li>
                        <?php }?>
                    </ul>
                </div>

                
        </<?php echo $element_type; ?>>
        <?php if(strlen($filter_type)){?>
        </div>
        <?php } ?>
    <?php    
    }

    static function timeline_view($post, $timeline_elem_class = ' timeline-view-left-elem '){

        $post_id = $post->ID;
        $formatclass = custom_get_post_format($post->ID);

        $thumb_view_type = post::get_post_setting($post_id, 'thumb_view_type', ' thumb-image-main '); /* get the view - image or text first */
        $skin = post::get_post_setting($post_id, 'skin', ' skin-0 '); 

        if( !(has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) ){
            /*if post has no thumbnail or featured image is not enabled we will have text bu default  and add class 'text-only' that will disable anu hover effect */
            $thumb_view_type = '  thumb-text-main  text-only ';
        }

    ?>
        <div class="six columns">

            <div class="row <?php echo $timeline_elem_class; ?> timeline-elem" data-elemclass="<?php echo trim($timeline_elem_class); ?>">
                <?php if( trim($timeline_elem_class) == 'timeline-view-right-elem'){ ?>
                <div class="four columns">
                                            
                </div>
                <?php } ?>
                <div class="eight columns">
                    <article class="<?php echo $thumb_view_type.' '.$skin; ?> ">
                        <?php  echo post::get_new_post_label($post -> post_date);  ?>
                        <header>
                            <div class="featimg <?php if (!(has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) ) echo 'z_index_neg'; ?>">
                                <?php

                                if($thumb_view_type == 'thumb-text-main'){ /*if text is shown by default we will add a achor that will link to the post*/
                                ?>
                                    <a href="<?php echo get_permalink($post->ID); ?>">
                                <?php    
                                }
                                if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) {
                                    if (get_post_format($post->ID)=="video") {
                                        $size = 'tlist_video'; 
                                    }else{
                                        $size = 'tlist';     
                                    }
                                    
                                    $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , $size );
                                
                                    $img_width = $img_src[1];
                                    $img_height = $img_src[2];
                                    
                                    if($img_width != $img_height){
                                        /*if the image is not square then we will add a transparent square image and will give position absolute to the original image*/
                                        $original_img_style = 'style="position:absolute"';
                                    }else{
                                        $original_img_style = '';
                                    }
                                ?>
                                    <img src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>"  <?php echo $original_img_style; ?> />
                                  
                                    <?php  
                                        if($img_width != $img_height){
                                            /*if the image is not square then we will add a transparent square image and will give position absolute to the original image*/
                                            
                                    ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>"  />      
                                    <?php        
                                        }
                                    ?>     
                                <?php } else{ ?>
                                    <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>" />
                                <?php } ?>

                                <?php 
                                if (options::logic('styling', 'stripes') && has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) {
                                    ?><div class="stripes">&nbsp;</div><?php
                                }
                                if($thumb_view_type == 'thumb-text-main'){ /*if text is shown by default we will add a achor that will link to the post*/
                                ?>
                                    </a>
                                <?php    
                                }
                                ?>
                                
                            </div>
                        </header>
                        <div class="entry-content">
                            <ul>                             
                                <?php if(options::logic( 'blog_post' , 'show_post_format' )){ ?>
                                    <li class="entry-content-type"><?php echo post::get_post_format_link($post -> ID); ?></li>
                                <?php } ?>
                                <?php  
                                    if(get_post_type($post -> ID) == 'post'){
                                        $cat_tax = 'category';    
                                    } elseif(get_post_type( $post -> ID) == 'portfolio') {
                                        $cat_tax = 'portfolio-category';   
                                    } elseif(get_post_type( $post -> ID) == 'event') {
                                        $cat_tax = 'event-category';   
                                    }

                                    if(isset($cat_tax)){
                                        $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ', '); 
                                    }else{
                                        $the_categories = '';
                                    }

                                    if(strlen(trim($the_categories))){
                                ?>
                                <li class="entry-content-category">
                                    <ul class="category-list">
                                        <?php echo $the_categories; ?>
                                    </ul>
                                </li>
                                <?php  
                                    }
                                ?>
                                
                                <li class="entry-content-title">
                                    <h4>
                                        <a href="<?php echo get_permalink($post->ID); ?>"  title="<?php _e('Permalink to', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo $post->post_title; ?></a>
                                    </h4>
                                </li>
                                <?php if(get_post_type( $post -> ID) == 'event') { ?>
                                    <?php 
                                    $event_repeat = meta::get_meta( $post->ID, 'date' );
                                    if($event_repeat['is_repeating'] == 'yes') { ?>
                                    <!-- For repeated events -->
                                    <li class="entry-content-date">
                                        <i class="icon-repeat"></i>
                                        <span class="repeated-event-frequency">
                                            <?php echo __('Every', 'cosmotheme') . ' '. post::repeating_localication_fix($event_repeat['repeating']); ?>
                                        </span>
                                    </li>                                
                                <?php } else { ?>
                                    <li class="entry-content-date">
                                        <?php post::get_repeated_events_date($post -> ID); ?>
                                    </li> 
                                <?php } } else { ?>                                
                                <li class="entry-content-date"><a href="#"><?php echo post::get_post_date($post -> ID);?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </article>
                </div>

                <ul class="timeline-meta">
                    <li class="timeline-article-separator"></li>
                    <li class="timeline-article-post-type">
                        <?php echo post::get_post_format_link($post -> ID); ?>
                    </li>
                </ul>
            </div>

        </div>
    <?php    

    }

/*    function news_view_title_list($post){

    ?>  
        <li>
            <span class="date"><?php echo post::get_post_date($post -> ID);?></span>
             <h5><a href="<?php echo get_permalink($post->ID); ?>" title="<?php _e('Permalink to', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo $post->post_title; ?></a></h5>
        </li>
    <?php    
    }*/

    static function banner_view($post){


        $info_meta = meta::get_meta( $post -> ID , 'info' );
        
        if( (isset($info_meta['script']) && strlen($info_meta['script']) ) || (isset($info_meta['banner_img']) && strlen($info_meta['banner_img']) ) ){
            $custom_class = '';    
            if(isset($info_meta['class']) && strlen($info_meta['class'])){
                $custom_class = $info_meta['class'];    
            }

            if(isset($info_meta['img_link']) && strlen($info_meta['img_link'])){
                $start_link = '<a href="'.$info_meta['img_link'].'">';
                $end_link = '</a>';
            }else{
                $start_link = '';
                $end_link = '';
            }

            $banner_script = '';
            if(isset($info_meta['script']) && strlen($info_meta['script'])){
                $banner_script = $info_meta['script'];
            }
            $banner_image = '';
            if(isset($info_meta['banner_img']) && strlen($info_meta['banner_img'])){
                $banner_image = $start_link . '<img src="'.$info_meta['banner_img'].'"/>' . $end_link;
            }

    ?>
        <div class="<?php echo $custom_class; ?>">
            <?php
                echo $banner_script;
                echo $banner_image;   
            ?>
        </div>
    <?php    
        } /*EOF if exists script or image*/
    }

    static function grid_view($post,  $width = 'three columns', $additiona_class = '', $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false, $is_carousel = false) {
            $nofeat_article_class = '';
            if(!post::is_feat_enabled($post->ID)){
                $nofeat_article_class = 'nofeat';    
            }
            $post_id = $post->ID;
            $onclick = self::video_post_click($post);
            
            $skin = post::get_post_setting($post_id, 'skin', ' skin-0 ');
        ?>

        <div data-id="id-<?php echo $post->ID; ?>" class="masonry_elem <?php echo $width.' '.$additiona_class; ?>">
            <<?php echo $element_type; ?> class="grid-elem <?php echo $skin; ?>">
                <?php  echo post::get_new_post_label($post -> post_date);  ?>
                <?php if(post::is_feat_enabled($post->ID) && (has_post_thumbnail($post->ID) || get_post_format($post->ID)=="gallery")  ){ ?>  
                <header>              
                    <div class="featimg">

                        <?php
                        if (get_post_format($post->ID)=="video") {
                            $size = 'tlist_video'; 
                        }else{
                            $size = 'tlist';     
                        }
                        
                        if (has_post_thumbnail($post->ID) || get_post_format($post->ID)=="gallery") {
                            if( get_post_format($post->ID)=="gallery" && !$is_carousel ){
                                    /* for gallery posts we will show a slidedhow if there are more than 1 images  */
                                    ob_start();
                                    ob_clean();
                                   
                                    self::get_post_img_slideshow( $post -> ID, $size );
                                    $single_slideshow = ob_get_clean();
                                    if(isset($single_slideshow) && strlen($single_slideshow)){
                                        echo $single_slideshow;
                                    }
                            }else{
                                

                                        
                                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size );
                                
                                ?>
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <img src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>" />
                                
                                      
                            <?php 
                                if (options::logic('styling', 'stripes')) {
                                    ?><div class="stripes"></div><?php
                                }
                                ?>
                                </a>
                                <?php
                            } 

                         
                            
                         
                        }
                        ?>
                        
                        <?php
                        if (get_post_format($post->ID) == 'video') {
                            echo '<div class="video-post">';
                            if(isset($onclick)){
                                $click = "onclick=".$onclick;
                            }else{
                                $click = '';
                            }
                                
                            echo '<a href="javascript:void(0);" '.$click.' ><i class="icon-play"></i></a>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </header>
                <?php } ?>

                <div class="entry-content">
                    <ul>
                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            } elseif(get_post_type( $post -> ID) == 'portfolio') {
                                $cat_tax = 'portfolio-category';   
                            } elseif(get_post_type( $post -> ID) == 'event') {
                                $cat_tax = 'event-category';   
                            }else{
                                $cat_tax = '';
                            }
                            
                            if(isset($cat_tax)){
                                $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ', '); 
                            }else{
                                $the_categories = '';
                            }

                            if(strlen(trim($the_categories))){
                        ?>
                        <li class="entry-content-category">
                            <ul class="category-list">
                                <?php echo $the_categories; ?>
                            </ul>
                        </li>
                        <?php  
                            }
                        ?>                           
                        <li class="entry-content-title"><h4><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4></li>
                        <?php if(get_post_type( $post -> ID) == 'event') { ?>
                            <?php 
                            $event_repeat = meta::get_meta( $post->ID, 'date' );
                            if($event_repeat['is_repeating'] == 'yes') { ?>
                            <!-- For repeated events -->
                            <li class="entry-content-date">
                                <i class="icon-repeat"></i>
                                <span class="repeated-event-frequency">
                                    <?php echo __('Every', 'cosmotheme') . ' '. post::repeating_localication_fix($event_repeat['repeating']); ?>
                                </span>
                                <?php if(options::logic( 'blog_post' , 'show_post_format' )){ echo post::get_post_format_link($post->ID); } ?>
                            </li>                                
                        <?php } else { ?>
                            <li class="entry-content-date">
                                <?php post::get_repeated_events_date($post -> ID); ?>
                                <?php if(options::logic( 'blog_post' , 'show_post_format' )){ echo post::get_post_format_link($post->ID); } ?>
                            </li> 
                        <?php } } else { ?>
                            <li class="entry-content-date"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo post::get_post_date($post -> ID);?></a> <?php if(options::logic( 'blog_post' , 'show_post_format' )){  echo post::get_post_format_link($post -> ID); } ?></li>
                        <?php }?>
                        <li class="entry-content-excerpt">
                            <div class="player_grid_container"> 
                                <?php 
                                if( get_post_format( $post -> ID ) == 'audio' ){
                                    echo do_shortcode( self::get_audio_file( $post -> ID ) );
                                }
                                ?>
                            </div>

                            <?php
                                if( get_post_format($post->ID)=="quote" ){ /*for 'quote' posts we show the entire content*/
                                    echo apply_filters('the_content', $post->post_content);
                                }else{
                                    $ln = options::get_value( 'blog_post' , 'excerpt_lenght_grid' );
                                    post::get_excerpt($post, $ln = $ln);
                                }   
                            ?>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
    
            </<?php echo $element_type; ?>>

        </div>
        <?php
    }

    static function show_meta_author_box($post){
		$meta = meta::get_meta( $post -> ID , 'settings' );

		  
		if( isset( $meta[ 'author' ] ) && strlen( $meta[ 'author' ] ) && !is_author() ){
			$show_author = meta::logic( $post , 'settings' , 'author' );
		}else{
			if( is_single() ){
				$show_author = options::logic( 'blog_post' , 'post_author_box' );
			}

			if( is_page() ){
				$show_author = options::logic( 'blog_post' , 'page_author_box' );
			}

			if( !( is_single() || is_page() ) ){
				$show_author = true;
			}
		}
        if(1==2){ the_tags(); }
		return $show_author;
	}
  
    
        static function add_image_post(){
            $response = array(  'image_error' => '',
                                'error_msg' => '',  
                                'title_error' => '',
                                'post_id' => 0,
                                'auth_error' => '',
                                'success_msg' => '' );
            
            
            $is_valid = true;
            
            if(!is_user_logged_in()){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['auth_error'] = __('You must be logged in to submit a post! ','cosmotheme');  
            }
            if(is_user_logged_in() && isset($_POST['post_id'])){
                $post_edit = get_post($_POST['post_id']);
                
                if(get_current_user_id() != $post_edit->post_author){
                    $is_valid = false;  
                    $response['error_msg'] = __('You are not the author of this post. ','cosmotheme');
                    $response['title_error'] = __('You are not the author of this post. ','cosmotheme');
                }
            }
            if(!isset($_POST['title']) || trim($_POST['title']) == ''){
                $is_valid = false;  
                $response['error_msg'] = 'Title is required. ';
                $response['title_error'] = __('Title is required. ','cosmotheme');
            }
            if(!isset($_POST['attachments']) || !is_array($_POST['attachments']) || !isset($_POST['featured']) || !is_numeric($_POST['featured']))
              {
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['image_error'] = __('An image post must have a featured image. ','cosmotheme');
              }
            
            
            if($is_valid){
                /*create post*/
                if(isset($_POST['post_type']) && $_POST['post_type'] == 'post'){
                    $post_categories = array(1);
                    if(isset($_POST['category_id'])){
                        $post_categories = array($_POST['category_id']);
                    }
                }else if(isset($_POST['post_type']) && $_POST['post_type'] == 'portfolio'){
                    $post_categories = array();
                    if(isset($_POST['portfolio-category'])){
                        $post_categories = array($_POST['portfolio-category']);
                    }
                }    
                    
                
                $post_content = '';
                if(isset($_POST['image_content'])){
                    $post_content = $_POST['image_content'];
                }
                    
                if(isset($_POST['post_id'])){
                    $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type'], $_POST['post_id']);  /*add image as content*/
                }else{
                    $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type']);  /*add image as content*/
                }
                    
                    
                if(is_numeric($new_post))
                  {
                    $attachments = get_children( array('post_parent' => $new_post, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
                    foreach ($attachments as $index => $id) {
                      $attachment = $index;
                    } 
                    foreach($_POST['attachments'] as $index=>$imageid)
                      {
                        if($imageid==$_POST['featured'])
                          {
                              set_post_thumbnail($new_post, $imageid);
                              unset($_POST['attachments'][$index]);
                          }
                        $attachment_post=get_post($imageid);
                        $attachment_post->post_parent=$new_post;
                        wp_update_post($attachment_post);
                      }
                    
                                            
                    /*add source, client, services meta data*/
                      $settings_meta = array(     "post_source"=>  $_POST['source'], "post_client"=>  $_POST['client'], "post_services"=>  $_POST['services']);
                      meta::set_meta( $new_post , 'source' , $settings_meta );  
                    

                            
                    /*add video url meta data*/
                    $image_format_meta = array("type" => $_POST['post_format'], 'images'=>$_POST['attachments']);
                    meta::set_meta( $new_post , 'format' , $image_format_meta );

                    if(isset($_POST['post_format']) && ($_POST['post_format'] == 'video' || $_POST['post_format'] == 'image' || $_POST['post_format'] == 'audio' || $_POST['post_format'] == 'gallery') ){
                        set_post_format( $new_post , $_POST['post_format']);
                    }
                        
                    if(options::get_value( 'upload' , 'default_posts_status' ) == 'publish'){
                        /*if post was publihed imediatelly then we will show the prmalink to the user*/
                            
                        $response['success_msg'] = sprintf(__('You can check your post %s here%s.','cosmotheme'),'<a href="'.get_permalink($new_post).'">','</a>');
                            
                    }else{
                            $response['success_msg'] = __('Success. Your post is awaiting moderation.','cosmotheme');
                    }   
                        $response['post_id'] = $new_post;
                   }                    
                }   
            echo json_encode($response);
            exit;
        }

        static function add_file_post(){

            $response = array(  'image_error' => '',
                                'file_error' => '',
                                'error_msg' => '',  
                                'title_error' => '',
                                'post_id' => 0,
                                'auth_error' => '',
                                'success_msg' => '' );
            
            
            $is_valid = true;
            
            if(!is_user_logged_in()){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['auth_error'] = __('You must be logged in to submit a post! ','cosmotheme');  
            }
            
            if(is_user_logged_in() && isset($_POST['post_id'])){
                $post_edit = get_post($_POST['post_id']);
                
                if(get_current_user_id() != $post_edit->post_author){
                    $is_valid = false;  
                    $response['error_msg'] = __('You are not the author of this post. ','cosmotheme');
                    $response['title_error'] = __('You are not the author of this post. ','cosmotheme');
                }
            }
            
            if(!isset($_POST['title']) || trim($_POST['title']) == ''){
                $is_valid = false;  
                $response['error_msg'] = 'Title is required. ';
                $response['title_error'] = __('Title is required. ','cosmotheme');
            }

            if(!isset($_POST['attachments'])){
                $is_valid = false;  
                $response['error_msg'] = 'File is required. ';
                $response['file_error'] = __('File is required. ','cosmotheme');
            }
            
                if($is_valid){
                    /*create post*/
                    if(isset($_POST['post_type']) && $_POST['post_type'] == 'post'){
                        $post_categories = array(1);
                        if(isset($_POST['category_id'])){
                            $post_categories = array($_POST['category_id']);
                        }
                    }else if(isset($_POST['post_type']) && $_POST['post_type'] == 'portfolio'){
                        $post_categories = array();
                        if(isset($_POST['portfolio-category'])){
                            $post_categories = array($_POST['portfolio-category']);
                        }
                    }
                    
                    

                    $post_content = '';
                    if(isset($_POST['file_content'])){
                        $post_content = $_POST['file_content'];
                    }
                    
                    
                    if(isset($_POST['post_id'])){
                        $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type'], $_POST['post_id']);  /*add image as content*/
                    }else{
                        $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type']);  /*add image as content*/
                    }
                    
                    if(is_numeric($new_post))
                      {
                        set_post_thumbnail($new_post, null);
                        foreach($_POST['attachments'] as $index=>$attachid)
                          {
                            if($attachid==$_POST['featured'])
                              {
                                set_post_thumbnail($new_post, $attachid);
                                unset($_POST['attachments'][$index]);
                              }
                            $attachment_post=get_post($attachid);
                            $attachment_post->post_parent=$new_post;
                            wp_update_post($attachment_post);
                          }
                        $file_url_meta = array(   "link"=>  '', "type" => 'link', 'link_id' => $_POST['attachments']);
                        meta::set_meta( $new_post , 'format' , $file_url_meta );
                        
                        /*add source meta data*/
                        $settings_meta = array(     "post_source"=>  $_POST['source'], "post_client"=>  $_POST['client'], "post_services"=>  $_POST['services']);
                        meta::set_meta( $new_post , 'source' , $settings_meta );    
                                                    
                        /*add file url meta data*/
                        

                        if(isset($_POST['post_format']) && ($_POST['post_format'] == 'video' || $_POST['post_format'] == 'image' || $_POST['post_format'] == 'audio' || $_POST['post_format'] == 'link') ){
                            set_post_format( $new_post , $_POST['post_format']);
                        }
                        
                        if(options::get_value( 'upload' , 'default_posts_status' ) == 'publish'){
                            /*if post was publihed imediatelly then we will show the prmalink to the user*/
                                
                            $response['success_msg'] = sprintf(__('You can check your post %s here%s.','cosmotheme'),'<a href="'.get_permalink($new_post).'">','</a>');
                            
                        }else{
                            $response['success_msg'] = __('Success. Your post is awaiting moderation.','cosmotheme');
                        }   
                        $response['post_id'] = $new_post;
                    }   
                    
                    
                }   
            echo json_encode($response);
            exit;
        }

        static function add_audio_post(){
            $response = array(  'image_error' => '',
                                'audio_error' => '',
                                'error_msg' => '',  
                                'title_error' => '',
                                'post_id' => 0,
                                'auth_error' => '',
                                'success_msg' => '' );
            
            
            $is_valid = true;
            
            if(!is_user_logged_in()){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['auth_error'] = __('You must be logged in to submit a post! ','cosmotheme');  
            }
            
            if(is_user_logged_in() && isset($_POST['post_id'])){
                $post_edit = get_post($_POST['post_id']);
                
                if(get_current_user_id() != $post_edit->post_author){
                    $is_valid = false;  
                    $response['error_msg'] = __('You are not the author of this post. ','cosmotheme');
                    $response['title_error'] = __('You are not the author of this post. ','cosmotheme');
                }
            }
            
            if(!isset($_POST['title']) || trim($_POST['title']) == ''){
                $is_valid = false;  
                $response['error_msg'] = 'Title is required. ';
                $response['title_error'] = __('Title is required. ','cosmotheme');
            }

            if(!isset($_POST['attachments'])){
                $is_valid = false;  
                $response['error_msg'] = 'Audio File is required. ';
                $response['audio_error'] = __('Audio File is required. ','cosmotheme');
            }
                
                if($is_valid){
                    /*create post*/
                    if(isset($_POST['post_type']) && $_POST['post_type'] == 'post'){
                        $post_categories = array(1);
                        if(isset($_POST['category_id'])){
                            $post_categories = array($_POST['category_id']);
                        }
                    }else if(isset($_POST['post_type']) && $_POST['post_type'] == 'portfolio'){
                        $post_categories = array();
                        if(isset($_POST['portfolio-category'])){
                            $post_categories = array($_POST['portfolio-category']);
                        }
                    }
                    
                    
                    $post_content = '';
                    if(isset($_POST['audio_content'])){
                        $post_content = $_POST['audio_content'];
                    }

                    if(isset($_POST['post_id'])){
                        $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type'], $_POST['post_id']);  /*add image as content*/
                    }else{
                        $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type']);  /*add image as content*/
                    }
                    
                    if(is_numeric($new_post))
                      {
                        set_post_thumbnail($new_post, null);
                        foreach($_POST['attachments'] as $index=>$attachid)
                          {
                            if($attachid==$_POST['featured'])
                              {
                                set_post_thumbnail($new_post, $attachid);
                                unset($_POST['attachments'][$index]);
                              }
                            $attachment_post=get_post($attachid);
                            $attachment_post->post_parent=$new_post;
                            wp_update_post($attachment_post);
                          }
                        $audio_url_meta = array(      "audio"=>  $_POST['attachments'], "type" => 'audio');
                        meta::set_meta( $new_post , 'format' , $audio_url_meta );

                        
                        /*add source, client and services meta data*/
                        $settings_meta = array(     "post_source"=>  $_POST['source'], "post_client"=>  $_POST['client'], "post_services"=>  $_POST['services']);
                        meta::set_meta( $new_post , 'source' , $settings_meta );    
                                                
                        if(isset($_POST['post_format']) && ($_POST['post_format'] == 'video' || $_POST['post_format'] == 'image' || $_POST['post_format'] == 'audio' || $_POST['post_format'] == 'link') ){
                            set_post_format( $new_post , $_POST['post_format']);
                        }
                        
                        if(options::get_value( 'upload' , 'default_posts_status' ) == 'publish'){
                            /*if post was publihed imediatelly then we will show the prmalink to the user*/
                                
                            $response['success_msg'] = sprintf(__('You can check your post %s here%s.','cosmotheme'),'<a href="'.get_permalink($new_post).'">','</a>');
                            
                        }else{
                            $response['success_msg'] = __('Success. Your post is awaiting moderation.','cosmotheme');
                        }   
                        $response['post_id'] = $new_post;
                    }   
                    
                    
                }   
            echo json_encode($response);
            exit;
        }
        
        static function add_text_post(){
            $response = array(  'error_msg' => '',  
                                'title_error' => '',
                                'post_id' => 0,
                                'auth_error' => '' );
            
            $is_valid = true;
            
            if(!is_user_logged_in()){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['auth_error'] = __('You must be logged in to submit a post!','cosmotheme');   
            }
            
            if(is_user_logged_in() && isset($_POST['post_id'])){
                $post_edit = get_post($_POST['post_id']);
                
                if(get_current_user_id() != $post_edit->post_author){
                    $is_valid = false;  
                    $response['error_msg'] = __('You are not the author of this post. ','cosmotheme');
                    $response['title_error'] = __('You are not the author of this post. ','cosmotheme');
                }
            }
            
            if(!isset($_POST['title']) || trim($_POST['title']) == ''){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['title_error'] = __('Title is required. ','cosmotheme');
            }
            
                if($is_valid){

                        /*create post*/
                        if(isset($_POST['post_type']) && $_POST['post_type'] == 'post'){
                            $post_categories = array(1);
                            if(isset($_POST['category_id'])){
                                $post_categories = array($_POST['category_id']);
                            }
                        }else if(isset($_POST['post_type']) && $_POST['post_type'] == 'portfolio'){
                            $post_categories = array();
                            if(isset($_POST['portfolio-category'])){
                                $post_categories = array($_POST['portfolio-category']);
                            }
                        }
                        
                        
                        $post_content = '';
                        if(isset($_POST['text_content'])){
                            $post_content = $_POST['text_content'];
                        }
                        
                        if(isset($_POST['post_id'])){
                            $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type'], $_POST['post_id']);  /*add image as content*/
                        }else{
                            $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type']);  /*add image as content*/
                        }
                        
                        if(is_numeric($new_post)){  
                           
                            
                            /*add source, client and services meta data*/
                            $settings_meta = array(     "post_source"=>  $_POST['source'], "post_client"=>  $_POST['client'], "post_services"=>  $_POST['services']);
                            meta::set_meta( $new_post , 'source' , $settings_meta );    
                            
                        
                            if(options::get_value( 'upload' , 'default_posts_status' ) == 'publish'){
                                /*if post was publihed imediatelly then we will show the prmalink to the user*/
                                    
                                $response['success_msg'] = sprintf(__('You can check your post %s here%s.','cosmotheme'),'<a href="'.get_permalink($new_post).'">','</a>');
                                
                            }else{
                                $response['success_msg'] = __('Success. Your post is awaiting moderation','cosmotheme');
                            }   
                            $response['post_id'] = $new_post;
                        }
                
                }
                    
            echo json_encode($response);
            exit;
            
        }
        
        static function add_video_post(){
            $response = array(  'video_error' => '',
                                'error_msg' => '',  
                                'title_error' => '',
                                'post_id' => 0,
                                'auth_error' => '' );
            
            
            $is_valid = true;
            
            if(!is_user_logged_in()){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['auth_error'] = __('You must be logged in to submit a post!','cosmotheme');   
            }
            
            if(is_user_logged_in() && isset($_POST['post_id'])){
                $post_edit = get_post($_POST['post_id']);
                
                if(get_current_user_id() != $post_edit->post_author){
                    $is_valid = false;  
                    $response['error_msg'] = __('You are not the author of this post. ','cosmotheme');
                    $response['title_error'] = __('You are not the author of this post. ','cosmotheme');
                }
            }
            
            if(!isset($_POST['title']) || trim($_POST['title']) == ''){
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['title_error'] = __('Title is required. ','cosmotheme');
            }
            
            if(!isset($_POST['attachments']) || !is_array($_POST['attachments']) || !isset($_POST['featured']) || !is_numeric($_POST['featured']))
            {
                $is_valid = false;  
                $response['error_msg'] = 'error';
                $response['video_error'] = __('A video post must have a featured video.','cosmotheme');
            }
            
            if($is_valid)
              {
                /*create post*/
                if(isset($_POST['post_type']) && $_POST['post_type'] == 'post'){
                    $post_categories = array(1);
                    if(isset($_POST['category_id'])){
                        $post_categories = array($_POST['category_id']);
                    }
                }else if(isset($_POST['post_type']) && $_POST['post_type'] == 'portfolio'){
                    $post_categories = array();
                    if(isset($_POST['portfolio-category'])){
                        $post_categories = array($_POST['portfolio-category']);
                    }
                }
                    
                            
                $post_content = '';
                if(isset($_POST['video_content'])){
                    $post_content = $_POST['video_content'];
                }
                        
                        
                if(isset($_POST['post_id'])){
                    $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type'], $_POST['post_id']);  /*add image as content*/
                }else{
                    $new_post = self::create_new_post($_POST['title'], $_POST['tags'], $post_categories, $post_content, $post_type = $_POST['post_type']);  /*add image as content*/
                }
                    
                if(is_numeric($new_post))
                  { 
                            
                    /*add source, client and services meta data*/
                    $settings_meta = array(     "post_source"=>  $_POST['source'], "post_client"=>  $_POST['client'], "post_services"=>  $_POST['services']);
                    meta::set_meta( $new_post , 'source' , $settings_meta );    

                    $featured_video_url=false;

                    foreach($_POST['attachments'] as $index=>$videoid)
                      {
                        if($videoid==$_POST['featured'])
                          {
                            $featured_video_id=$videoid;
                            unset($_POST['attachments'][$index]);
                            if(isset($_POST['video_urls'][$videoid]) && post::isValidURL($_POST['video_urls'][$videoid]))
                              {
                                set_post_thumbnail($new_post,$videoid);
                                $featured_video_url=$_POST['video_urls'][$videoid];
                                unset($_POST['video_urls'][$videoid]);
                              }
                            else set_post_thumbnail($new_post, null);
                            }
                         $attachment_post=get_post($videoid);
                         $attachment_post->post_parent=$new_post;
                         wp_update_post($attachment_post);
                      }
                
                  $video_format_meta=array("type"=>"video", "video_ids"=>$_POST['attachments'], "feat_id"=>$featured_video_id, "feat_url"=>$featured_video_url);
                  if(isset($_POST['video_urls']))
                    $video_format_meta["video_urls"]=$_POST["video_urls"];
                  meta::set_meta( $new_post , 'format' , $video_format_meta );

                  if(isset($_POST['post_format']) && ($_POST['post_format'] == 'video' || $_POST['post_format'] == 'image' || $_POST['post_format'] == 'audio') ){
                    set_post_format( $new_post , $_POST['post_format']);
                  }
                                    
                  if(options::get_value( 'upload' , 'default_posts_status' ) == 'publish'){
                    /*if post was publihed imediatelly then we will show the prmalink to the user*/
                                    
                    $response['success_msg'] = sprintf(__('You can check your post %s here%s.','cosmotheme'),'<a href="'.get_permalink($new_post).'">','</a>');
                                
                  }else{
                      $response['success_msg'] = __('Success. Your post is awaiting moderation','cosmotheme');
                  } 
                      $response['post_id'] = $new_post;
                }
                    
            }
                                
            echo json_encode($response);
            exit;
        }
        
       
        static function get_embeded_video($video_id,$video_type,$autoplay = 0,$width = 570,$height = 414){
        	
        	$embeded_video = '';
        	if($video_type == 'youtube'){
        		$embeded_video	= '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent&autoplay='.$autoplay.'" wmode="opaque" frameborder="0" allowfullscreen></iframe>';
        	}elseif($video_type == 'vimeo'){
        		$embeded_video	= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;autoplay='.$autoplay.'&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
        	}
        	
        	return $embeded_video;
        }
        
		static function get_local_video($video_url, $width = 570, $height = 414, $autoplay = false ){
			
            $result = '';    
			
            if($autoplay){
                $auto_play = 'true';
            }else{
                $auto_play = 'false';
            }
            
            $result = do_shortcode('[mejsvideo src="'.urldecode($video_url).'" type="video/mp4" width="'.$width.'" height="'.$height.'"  ]');
			//$result = do_shortcode('[video mp4="'.$video_url.'" width="'.$width.'" height="'.$height.'"  autoplay="'.$auto_play.'"]');
			
			return $result;	
		}
  
        static function get_video_thumbnail($video_id,$video_type){
        	$thumbnail_url = '';
        	if($video_type == 'youtube'){
				$thumbnail_url = 'http://i1.ytimg.com/vi/'.$video_id.'/hqdefault.jpg';
        	}elseif($video_type == 'vimeo'){
        		
				$hash = wp_remote_get("http://vimeo.com/api/v2/video/$video_id.php");
				$hash = unserialize($hash['body']);
				
				$thumbnail_url = $hash[0]['thumbnail_large'];  
        	}
        	
        	return $thumbnail_url;
        }
        
    	static function get_youtube_video_id($url){
	        /*
	         *   @param  string  $url    URL to be parsed, eg:  
	 		*  http://youtu.be/zc0s358b3Ys,  
	 		*  http://www.youtube.com/embed/zc0s358b3Ys
	 		*  http://www.youtube.com/watch?v=zc0s358b3Ys 
	 		*  
	 		*  returns
	 		*  */	
        	$id=0;
        	
        	/*if there is a slash at the en we will remove it*/
        	$url = rtrim($url, " /");
        	if(strpos($url, 'youtu')){
	        	$urls = parse_url($url); 
	     
			    /*expect url is http://youtu.be/abcd, where abcd is video iD*/
			    if(isset($urls['host']) && $urls['host'] == 'youtu.be'){  
			        $id = ltrim($urls['path'],'/'); 
			    } 
			    /*expect  url is http://www.youtube.com/embed/abcd*/ 
			    else if(strpos($urls['path'],'embed') == 1){  
			        $id = end(explode('/',$urls['path'])); 
			    } 
			     
			    /*expect url is http://www.youtube.com/watch?v=abcd */
			    else if( isset($urls['query']) ){ 
			        parse_str($urls['query']); 
			        $id = $v; 
			    }else{
					$id=0;
				} 
        	}	
			
			return $id;
        }
        
        static function  get_vimeo_video_id($url){
        	/*if there is a slash at the en we will remove it*/
        	$url = rtrim($url, " /");
        	$id = 0;
        	if(strpos($url, 'vimeo')){
				$urls = parse_url($url); 
				if(isset($urls['host']) && $urls['host'] == 'vimeo.com'){  
					$id = ltrim($urls['path'],'/'); 
					if(!is_numeric($id) || $id < 0){
						$id = 0;
					}
				}else{
					$id = 0;
				} 
        	}	
			return $id;
		}
        

	    static function isValidURL($url)
		{
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		}

        static function create_new_post($post_title,$post_tags, $post_categories,  $content = '', $post_type = 'post', $post_id = 0 ){
            $current_user = wp_get_current_user();

            $post_status = options::get_value( 'upload' , 'default_posts_status' )  ;
            if($post_id == 0){
                if($post_type == 'portfolio'){
                    $post_args = array(
                        'post_title' => $post_title,
                        'post_content' => $content ,
                        'post_status' => $post_status,
                        'post_type' => $post_type,
                        'post_author' => $current_user -> ID,
                        //'tags_input' => $post_tags,
                        //'post_category' => $post_categories
                        'tax_input' => array( 'portfolio-category' => $post_categories, 'portfolio-tag' => $post_tags ) 

                    );
                }else{
                    $post_args = array(
                        'post_title' => $post_title,
                        'post_content' => $content ,
                        'post_status' => $post_status,
                        'post_type' => $post_type,
                        'post_author' => $current_user -> ID,
                        'tags_input' => $post_tags,
                        'post_category' => $post_categories
                    );
                }    
                
                $new_post = wp_insert_post($post_args);
                if ( $post_type == 'portfolio' ) {
                    wp_set_post_terms($new_post, $post_categories, 'portfolio-category');
                    wp_set_post_terms($new_post, $post_tags, 'portfolio-tag');
                }
            }else{
                $updated_post = get_post($post_id);
                if($post_type == 'portfolio'){
                    $post_args = array(
                        'ID' => $post_id,   
                        'post_title' => $post_title,
                        'post_content' => $content ,
                        'post_status' => $post_status,
                        'comment_status'=> $updated_post -> comment_status,
                        'post_type' => $post_type,
                        'post_author' => $current_user -> ID,
                        //'tags_input' => $post_tags,
                        //'post_category' => $post_categories
                        'tax_input' => array( 'portfolio-category' => $post_categories, 'portfolio-tag' => $post_tags ) 
                    );
                }else{
                    $post_args = array(
                        'ID' => $post_id,   
                        'post_title' => $post_title,
                        'post_content' => $content ,
                        'post_status' => $post_status,
                        'comment_status'=> $updated_post -> comment_status,
                        'post_type' => $post_type,
                        'post_author' => $current_user -> ID,
                        'tags_input' => $post_tags,
                        'post_category' => $post_categories
                    );
                }    
                
                $new_post = wp_update_post($post_args);
                if ( $post_type == 'portfolio' ) {
                    wp_set_post_terms($new_post, $post_categories, 'portfolio-category');
                    wp_set_post_terms($new_post, $post_tags, 'portfolio-tag');
                }
            }    
    
            
            
            if($post_status == 'pending'){ /*we will notify admin via email if a this option was activated*/
                if(is_email(options::get_value( 'upload' , 'pending_email' ))){
                    $tomail = options::get_value( 'upload' , 'pending_email' );
                    $subject = __('A new post is awaiting your moderation','cosmotheme');
                    $message = __('A new post is awaiting your moderation.','cosmotheme');
                    $message .= ' ';
                    $message .= sprintf(__('To moderate the post go to  %s ','cosmotheme'), home_url('/wp-admin/post.php?post='.$new_post.'&action=edit')) ;

                    wp_mail($tomail, $subject , $message);

                }   
            }

            return $new_post;
        }

		static function remove_post(){
			if(isset($_POST['post_id']) && is_numeric($_POST['post_id'])){
				$post = get_post($_POST['post_id']);
				if(get_current_user_id() == $post->post_author){
					wp_delete_post($_POST['post_id']);
				}
			}  

			exit;
		}
        
        static function get_source($post_id){
        	/*returns 'post_source' meta data*/
        	$source = '';
  			$source_meta = meta::get_meta( $post_id , 'source' );
  			
  			if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_source']) && trim($source_meta['post_source']) != ''){
  				$source = $source_meta['post_source'];
        		
  			}else{
  				$source = ''; //'<div class="source no_source"><p>'.__('Unknown source','cosmotheme').'</p></div>';
  			}
  			
        
        			
  			return $source;      	
        }

        static function get_client($post_id){
            /*returns 'post_client' meta data*/
            $client = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if( isset($source_meta['post_client']) && trim($source_meta['post_client']) != ''){
                $client = $source_meta['post_client'];
            }
                
            return $client;         
        }

        static function get_services($post_id){
            /*returns 'post_services' meta data*/
            $services = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if(isset($source_meta['post_services']) && trim($source_meta['post_services']) != ''){
                $services = $source_meta['post_services'];
            }
                
            return $services;         
        }

        static function get_custom_meta($post_id){
            $custom_meta = meta::get_meta( $post_id, 'source' );
            if(isset($custom_meta['custominfometa']) && is_array($custom_meta['custominfometa']) && sizeof($custom_meta['custominfometa'])){
                return $custom_meta['custominfometa'];
            }else{
                return false;
            }

        }

        static function render_custom_meta($post_id){
            $custom_meta = post::get_custom_meta($post_id);
            if(is_array($custom_meta)){
                foreach ($custom_meta as $key => $value) {
        ?>
                    <li>
                        <div class="meta_name"><?php echo $key; ?></div>
                        <div class="meta_value"><?php echo $value; ?></div>
                    </li>
        <?php            
                }
            }
        }

		static function get_attached_file($post_id){
        	
        	$attached_file = '';
  			$attached_file_meta = meta::get_meta( $post_id , 'format' );

            $attached_file = '<div class="attached-files">';
  			
			if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']) && is_array($attached_file_meta['link_id'])){
				foreach($attached_file_meta['link_id'] as $file_id)
				  {
					$attachment_url = explode('/',wp_get_attachment_url($file_id));
					$file_name = '';
					if(sizeof($attachment_url)){
					  $file_name = $attachment_url[sizeof($attachment_url) - 1];
					}	
					$attached_file .= '<div class="attached-files-elem">';
					$attached_file .= '<a href="'.wp_get_attachment_url($file_id).'">';
                    $attached_file .= '<div class="attached-files-elem-icon"><i class="icon-attachment"></i></div>';
                    $attached_file .= '<div class="attached-files-elem-title">'. $file_name .'</div>';
                    $attached_file .= '</a>';
					$attached_file .= '</div>';
				  }
			}else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']))
			  {
				$file_id=$attached_file_meta['link_id'];
				$attachment_url = explode('/',wp_get_attachment_url($file_id));
					$file_name = '';
					if(sizeof($attachment_url)){
					  $file_name = $attachment_url[sizeof($attachment_url) - 1];
					}	
					$attached_file .= '<div class="attached-files-elem">';
                    $attached_file .= '<a href="'.wp_get_attachment_url($file_id).'">';
                    $attached_file .= '<div class="attached-files-elem-icon"><i class="icon-attachment"></i></div>';
                    $attached_file .= '<div class="attached-files-elem-title">'. $file_name .'</div>';
                    $attached_file .= '</a>';
					$attached_file .= '</div>';
			  }
  			$attached_file .= '</div>';

  			return $attached_file;      	
        }

		static function get_audio_file($post_id){
        	$attached_file = '';
  			$attached_file_meta = meta::get_meta( $post_id , 'format' );
  			
			if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && is_array($attached_file_meta['audio'])){

				foreach($attached_file_meta['audio'] as $audio_id)
				  {
					//$attached_file .= '[audio:'.wp_get_attachment_url($audio_id).']';
                    $attached_file .= '[mejsaudio src='.wp_get_attachment_url($audio_id).']';
				  }				
			}else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && $attached_file_meta['audio'] != '' ){
			  
                //$attached_file .= '[audio:'.$attached_file_meta['audio'].']';
                $attached_file .= '[mejsaudio src='.$attached_file_meta['audio'].']';
			}
  					
  			return $attached_file;      	
        }
        
        static function play_video($width=570, $height=414){
            $result = '';   

            if(isset($_POST['width']) && is_numeric($_POST['width']) && isset($_POST['height']) && is_numeric($_POST['height'])){
                $width = $_POST['width'];
                $height = $_POST['height'];
            }

            if(isset($_POST['video_id']) && isset($_POST['video_type']) && $_POST['video_type'] != 'self_hosted'){  
                $result = self::get_embeded_video($_POST['video_id'],$_POST['video_type'],1,$width, $height);
            }else{
                $video_url = urldecode($_POST['video_id']);
                $result = self::get_local_video($video_url, $width, $height, true );
            }   
            
            echo $result;
            exit;
        }        
        static function list_tags($post_id){
            $tag_list = '';
            $tags = wp_get_post_terms($post_id, 'post_tag');

            if (!empty($tags)) {
                    $i = 1;
                    foreach ($tags as $tag) { 
                        if($i==1){
                            $tag_list .= $tag->name;
                        }else{
                            $tag_list .= ', '.$tag->name;
                        }    
                        $i++;
                    }
            }
            
            return $tag_list;
        }

         /*check if showing featured image on archive pages is enabled*/
        public static function is_feat_enabled($post_id){
            
            if(options::get_value( 'blog_post' , 'show_feat_on_archive' ) == 'no'){
                return false;
            }else{
                $meta = meta::get_meta( $post_id , 'settings' );
                if(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'yes'){
            
                    return true;
                }elseif(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'no'){
                    return false;
                }else{
                    return true;
                }
            }

        }

        static function get_post_date($post_id){
            if (options::logic('general', 'time')) {
                 $post_date = human_time_diff(get_the_time('U', $post_id), current_time('timestamp')) . ' ' . __('ago', 'cosmotheme'); 
            } else {
                $post_date = __('on','cosmotheme'). ' '.date_i18n(get_option('date_format'), get_the_time('U', $post_id)); 
            }

            return $post_date .' ';
        }

        
        static function get_post_categories($post_id, $only_first_cat = false, $taxonomy = 'category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = ', ',  $a_class = ''){

            
                            
            $cat = '';
            $categories = wp_get_post_terms($post_id, $taxonomy );
            if (!empty($categories)) {
                
                $ind = 1;
                foreach ($categories as $category) {
             //       $categ = get_category($category);
                    if($ind != count($categories) && !$only_first_cat){
                        $cat_delimiter = $delimiter;   
                    }else{
                        $cat_delimiter = '';   
                    }

                    $cat .= $margin_elem_start . '<a href="' . get_category_link($category) . '" class="'.$a_class.'">' . $category->name . $cat_delimiter . '</a>' . $margin_elem_end;
                    
                    if($only_first_cat){
                        break;    
                    }
                    

                    $ind ++;
                }
                
                
                //$cat = __('in','cosmotheme').' '.   $cat;   
            }
                            
              return $cat .' ' ;
        }

        
        static function load_more(){
            $response = array();
            if(isset($_POST['action']) ){

                $id = $_POST[ 'id' ];
                $row_id = $_POST[ 'row_id' ];
                $template_id = $_POST[ 'template_id' ];

                $all_templates = get_option( 'templates' );
                $data = $all_templates[$template_id];

                $template = new LBTemplate( $data );
                $element = $template -> rows[ $row_id ] -> elements[ $id ];

                $is_ajax = true;

                $nonce = $_POST['getMoreNonce'];

                // check to see if the submitted nonce matches with the
                // generated nonce we created earlier
                if ( ! wp_verify_nonce( $nonce, 'myajax-getMore-nonce' ) )
                    die ( 'Busted! Wrong Nonce');

                /*Done with check, now let's do some real work*/

                $element -> view = $_POST['view']; 
                $element -> carousel = 'no'; 
                $element ->  paged = $_POST['current_page'] + 1;
                $element ->  is_ajax = true;

                if(isset($_POST['timeline_class']) && strlen(trim($_POST['timeline_class']))){ /*this is the class of the last elem from timeleine*/
                    $element -> timeline_class = $_POST['timeline_class']; 
                }

                $type = $_POST['type'];
                global $wp_query;
                ob_start();
                ob_clean();
                if( $element -> row -> is_additional ){
                    $element -> restore_query();
                    $element -> render_frontend_posts( $wp_query -> posts );
                }else{
                    call_user_func( array ( $element, "render_frontend_$type" ) );
                }
                $content = ob_get_clean();
                $response['content'] = $content;
                $response['current_page'] = $element ->  paged;
                $response['need_load_more'] = ( $wp_query -> query_vars[ 'paged' ] < $wp_query -> max_num_pages );
                wp_reset_query();
            }

            echo json_encode($response);
            exit;    
        }

        static function get_post_img_slideshow($post_id, $size="tlist_tlarge"){
            $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));


            
            if(count($attachments) > 1){
            ?>

                    <div id="carousel" class="es-carousel-wrapper single_carousel">    
                        <div class="es-carousel">
                            <ul class="elastislide">

                       

                        
            <?php          
                $pretty_colection_id = mt_rand(0,9999);
                $current_slide = 1;
                foreach($attachments as $att_id => $attachment) {
                    $full_img_url = wp_get_attachment_url($attachment->ID);
                    $thumbnail_url= wp_get_attachment_image_src( $attachment->ID, $size);

                    if($current_slide > 1){ $hide_element = "display:none;"; }else{ $hide_element = ''; }
            ?>            
                    <li style="<?php echo $hide_element; ?>">
                        <div class="relative">
                            
                                <img src="<?php echo $thumbnail_url[0]; ?>" width="<?php echo $thumbnail_url[1]; ?>" height="<?php echo $thumbnail_url[2]; ?>" alt="" />
                            
                            <?php if( options::logic( 'blog_post' , 'enb_lightbox' )){ ?>
                            <div class="zoom-image">
                                <a href="<?php echo $full_img_url; ?>" data-rel="prettyPhoto[<?php echo $pretty_colection_id; ?>]" title="">&nbsp;</a>
                            </div>
                            <?php } if (options::logic('styling', 'stripes')) {  ?>
                                <div class="stripes" >&nbsp;</div>
                            <?php }?>
                        </div>
                    </li>
            <?php    
                    $current_slide++;
                }
            ?>
                            </ul>
                        </div>
                    </div>
            <?php    
            }    
        }
        
        static function get_excerpt($post, $ln, $output = true){
            if (!empty($post->post_excerpt)) {
                if (strlen(strip_tags(strip_shortcodes($post->post_excerpt))) > $ln) {
                    $excerpt = mb_substr(strip_tags(strip_shortcodes($post->post_excerpt)), 0, $ln) . '[...]';
                } else {
                    $excerpt = strip_tags(strip_shortcodes($post->post_excerpt));
                }
            } else {
                if (strlen(strip_tags(strip_shortcodes($post->post_content))) > $ln) {
                    $excerpt = mb_substr(strip_tags(strip_shortcodes($post->post_content)), 0, $ln) . '[...]';
                } else {
                    $excerpt = strip_tags(strip_shortcodes($post->post_content));
                }
            }
            if ($output == true) {
                echo $excerpt;
            }else{
                return $excerpt;
            }
            
        }

        static function get_post_views($post_id){
            /*if if stats module from JetPak plugin is enabled, we save number of views in a meta data for the given post */
            if ( function_exists('stats_get_csv')   ){ 
                
                $post_stats = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
                
                if ( is_array( $post_stats ) && sizeof( $post_stats ) ) { 
                    foreach ( $post_stats as $post ){ 
                        if( isset($post['views']) ){
                            update_post_meta($post_id, 'nr_views', $post['views']);
                        }
                    }
                }
            }
        }


        /*outputs the number of comments for a given post */
        static function get_post_comment_number($post_id,$show_label = false){
            if (comments_open($post_id)) {
                $comments_label = __('replies','cosmotheme');
                if (options::logic('general', 'fb_comments')) {
                    ?>
                            <li class="replies" title="">
                                <a href="<?php echo get_comments_link($post_id); ?>" >
                                    <span></span>
                                    <fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count>
                                    <?php if($show_label){ ?>
                                    <span><?php echo $comments_label; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                    <?php
                } else {
                    if(get_comments_number($post_id) == 1){
                        $comments_label = __('reply','cosmotheme');    
                    }
                    ?>
                            <li class="comments" title="<?php echo get_comments_number($post_id); ?> Comments">
                                <a href="<?php echo get_comments_link($post_id); ?>" >
                                    <span></span>
                                    <?php echo get_comments_number($post_id) ?>
                                    <?php if($show_label){ ?>
                                    <span class="comments_label"><?php echo $comments_label; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                    <?php
                }
            }
        }

        /*outputs the number of views for a given post */
        static function get_views_number_html($post_id,$show_label = false){

            if ( function_exists( 'stats_get_csv' ) ){  
            $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
        ?>
            <li class="views">
                <a href="<?php echo get_permalink($post_id); ?>" class="views">    
                    <span></span>
                    <?php echo (int)$views[0]['views']; ?>

                    <?php if($show_label){ ?>
                    <span class="views_label">
                    <?php
                        if( (int)$views[0]['views'] == 1) {
                            _e( 'view' , 'cosmotheme');
                        }else{
                            _e( 'views' , 'cosmotheme' );
                        } 
                    ?>
                    </span>
                    <?php } ?>
                </a>
            </li>
        <?php }
        }

        static function box_view($post,  $width = 'three columns', $additiona_class = '') {

            $info_meta = meta::get_meta( $post -> ID , 'info' );

            /*if(isset($info_meta['background_color'])){
                $box_bg_color = $info_meta['background_color'];
            }else{
                $box_bg_color = ' #f5f5f5 ';
            }

            if(isset($info_meta['text_color']) && strlen(trim($info_meta['text_color']))){
                $box_text_color = $info_meta['text_color'];
            }else{
                $box_text_color = '  #000 ';
            }*/

            if( has_post_thumbnail( $post -> ID  ) ){ 
                $box_img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'tlist' );
                $box_img_src = $box_img_src[0];
            }else{
                $box_img_src = '';
            }

            /*skin - the bg color for the box*/
            if(isset($info_meta['skin']) && strlen(trim($info_meta['skin'])) ){
                $skin = $info_meta['skin'];
            }else{
                $skin = ' skin-0 ';
            }

            $link_start = '';
            $link_end = '';
            if(isset($info_meta['box_link']) && post::isValidURL($info_meta['box_link']) ){
                $link_start = '<a href="'.$info_meta['box_link'].'">';
                $link_end = '</a>';
            }

            $custom_class = '';
            if(isset($info_meta['custom_css']) && strlen(trim($info_meta['custom_css'])) ){
                $custom_class = $info_meta['custom_css'];
            }
            ?>
        <div class="cosmobox <?php echo $width .' '.$additiona_class.' '.$custom_class; ?>">
            <article class="box <?php echo $skin; ?>">
                <?php if(strlen($box_img_src)){ ?>
                    <header>
                        <div class="featimg">
                            <?php
                            echo $link_start;
                            ?>
                            <img src="<?php echo $box_img_src; ?>" alt="<?php echo $post->post_title; ?>"/>
                            <?php
                            echo $link_end;
                            ?>
                        </div>
                    </header>
                
                <?php } ?>
                <div class="entry-content">
                    <ul>
                        <li class="entry-content-title"><h4><?php echo $link_start . $post -> post_title . $link_end; ?></h4></li>
                        <li class="entry-content-excerpt"><?php echo $post -> post_content; ?></li>
                    </ul>
                </div>
            </article>
        </div>

        <?php
        }


    static function render_team( $team, $options, $is_first_child ){
        extract( $options );
        $default_meta = array(
            'img_id' => 0,
            'facebook' => '',
            'twitter' => '',
            'linkedin' => ''
        );
        $meta = meta::get_meta( $team -> ID, 'info' );
        foreach( $meta as $entry_key => $entry_value ){
            if( strlen( $entry_value ) ){
                $default_meta[ $entry_key ] = $entry_value;
            }
        }

        extract( $default_meta );
        if( has_post_thumbnail( $team -> ID  ) ){ 
            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $team -> ID ), 'tlist' );
            $img = $img[0];
        }else{
            $img = get_template_directory_uri() . '/images/default_avatar_100.jpg';
        }

        /*skin - the bg color for team member */
        if(isset($meta['skin']) && strlen(trim($meta['skin'])) ){
            $skin = $meta['skin'];
        }else{
            $skin = ' skin-0 ';
        }

        ?>
        <div class="<?php echo $columns;?> columns">
            <article class="team-text-main <?php echo $skin; ?>">
                <header>
                    <div class="featimg">
                        <img src="<?php echo $img;?>" alt="<?php echo $team -> post_title;?>" />
                        <?php if( strlen( $facebook ) || strlen( $twitter ) || strlen( $linkedin ) ){ ?>
                        <div class="socialicons">
                            <ul class="cosmo-social">
                                <?php if( strlen( $twitter ) ){ ?>
                                <li>
                                    <a href="http://twitter.com/<?php echo $twitter;?>" class="twitter"><i class="icon-twitter"></i></a>
                                </li>
                                <?php } ?>
                                <?php if( strlen( $facebook ) ){ ?>
                                <li>
                                    <a href="http://facebook.com/people/@/<?php echo $facebook;?>" class="fb"><i class="icon-facebook"></i></a>
                                </li>
                                <?php } ?>
                                <?php if( strlen( $linkedin ) ){ ?>
                                <li>
                                    <a href="<?php echo $linkedin;?>" class="linkedin"><i class="icon-linkedin"></i></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </header>
                <div class="entry-content">
                    <ul>
                        <li class="entry-content-name"><h4><?php echo $team -> post_title;?></h4></li>
                        <li class="entry-content-function"><?php echo $team -> post_content;?></li>
                    </ul>
                </div>
            </article>
        </div>
        <?php
        }

        static function get_edit_delet_btns($post){

                /*IS_MY_ADDED_POSTS  is defined only on My Added posts template*/
                if( defined('IS_MY_ADDED_POSTS') ){
            ?>
            <div class="entry-meta-edit">
                <ul>
                    <?php if( get_post_type( $post -> ID) != 'event' && options::logic( 'upload' , 'enb_edit_delete' ) && is_user_logged_in() && $post->post_author == get_current_user_id() && is_numeric(options::get_value( 'upload' , 'post_item_page' ))){ ?> 
                        <li class="edit_post" title="<?php _e('Edit post','cosmotheme') ?>"><a href="<?php  echo esc_url(add_query_arg( 'post', $post->ID, get_page_link(options::get_value( 'upload' , 'post_item_page' ))  ) );  ?>"  ><?php _e( 'Edit', 'cosmotheme' ); ?></a></li>
                    <?php }   ?>
                    <?php if( options::logic( 'upload' , 'enb_edit_delete' )  && is_user_logged_in() && $post->post_author == get_current_user_id() ){  
                        $confirm_delete = __('Confirm to delete this post.','cosmotheme');
                    ?>
                    <li class="delete_post" title="<?php _e('Remove post','cosmotheme') ?>"><a href="javascript:void(0)" onclick="if(confirm('<?php echo $confirm_delete; ?> ')){ removePost('<?php echo $post->ID; ?>','<?php echo home_url() ?>');}" ><?php _e( 'Delete', 'cosmotheme' ); ?></a></li>
                    <?php  } ?>    
                </ul>
            </div>
            <?php }
        }

        static function list_meta($post){
            ?>
            <div class="entry-meta">
                <ul>
                    <li>
                        <ul class="category st">
                            <?php 
                                $cat_tax = 'category';
                                echo post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ''); 
                            ?>
                        </ul>
                    </li>
                    <li class="author st"><a href="<?php echo get_author_posts_url($post->post_author) ?>"><?php echo sprintf(__('by %s','cosmotheme'),get_the_author_meta('display_name', $post->post_author)); ?></a></li>
                    <li class="entry-date st"><?php echo post::get_post_date($post -> ID); ?></li>
                </ul>
            </div>
            <?php
        }

        static function list_meta_single($post){
            $post_id = $post -> ID;
            if (comments_open($post -> ID) || function_exists( 'stats_get_csv' ) || options::logic( 'likes' , 'enb_likes' ) ) {
            ?>    
            <div class="entry-info">
                <ul class="">
                    <?php
                        if (comments_open($post_id)) {
                            if (options::logic('general', 'fb_comments')) {
                                ?>
                                        <li class="metas-big" title="">
                                            <a href="<?php echo get_comments_link($post_id); ?>" >
                                                <span class="comments">
                                                    <em><?php _e('Comments','cosmotheme'); ?></em>
                                                    <i><fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count></i>
                                                </span>
                                            </a>
                                        </li>
                                <?php
                            } else {
                                if(get_comments_number($post_id) == 1){
                                    $comments_label = __('reply','cosmotheme');    
                                }
                                ?>
                                    <li class="metas-big" title="">
                                        <a href="<?php echo get_comments_link($post_id); ?>" >
                                            <span class="comments">
                                                <em><?php _e('Comments','cosmotheme'); ?></em>
                                                <i><?php echo get_comments_number($post_id) ?></i>
                                            </span>
                                        </a>
                                    </li>    
                                <?php
                            }
                        }
                    ?>
                    
                    <?php
                        if ( function_exists( 'stats_get_csv' ) ){  
                        $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
                    ?>
                    <li class="metas-big">
                        <a href="<?php echo get_permalink($post_id); ?>" >
                            <span class="views">
                                <em><?php _e('Views','cosmotheme'); ?></em>
                                <i><?php echo (int)$views[0]['views']; ?></i>
                            </span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php 
                        if( options::logic( 'likes' , 'enb_likes' ) ){ 
                        //$icon_type = options::get_value( 'likes' , 'icons' ); /*for example heart, star or thumbs*/  
                    ?>
                    
                    <li class="metas-big <?php //echo $icon_type; ?>">
                        <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = true);  ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <?php                            
            }
        }

        
        /**
         * This function will receive the skin name entered by user and will return a 'clean'  name
         * that can be used as a css class
         *
         * @param int $post_id - the ID of the option  -> will be used to create class name
         * @param string $setting_name - the name of the setting you want to receive
         * @param string $default_value - the default value that will be returned if the needed setting was not saved yet (posts were created before installing the theme)
         *      
         * @return various - the value of the requested option
         */
        static function get_post_setting($post_id, $setting_name, $default_value){
            $meta = meta::get_meta( $post_id, 'settings' );
            if(isset($meta[$setting_name]) && strlen($meta[$setting_name])){
                return $meta[$setting_name];
            }else{
                return $default_value;
            }
        }

        static function get_post_format_link($post_id){

            if(get_post_type( $post_id) == 'event') { 
                $result ='<a class="entry-format" href="'.get_post_type_archive_link( get_post_type( $post_id) ).'"><i class="icon-calendar"></i></a>'; 
            }else{          
                $result = '';    
                $format = get_post_format( $post_id );
                $format_link = get_post_format_link($format);
                if(!strlen($format_link)){
                    $format_link = "javascript:void(0);";
                }

                switch ($format) {
                    case 'video':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-video"></i></a>';
                        break;
                    case 'image':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-image"></i></a>';
                        break;
                    case 'audio':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-audio"></i></a>';
                        break;
                    case 'link':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-attachment"></i></a>';
                        break;    
                    case 'gallery':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-gallery"></i></a>';
                        break;  
                    case 'quote':
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-quote"></i></a>';
                        break;                            
                    default:
                        $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-standard"></i></a>';
                        break;
                }
            }
            return $result;
        }  


        /* this function divides excerpt in three span */
        static function get_divided_excerpt($post, $ln = 100, $excerpt_lenght = 400){

            if(strlen(post::get_excerpt($post, $excerpt_lenght, $output = false)) > 2*$ln ){
                echo '<span class="excerpt-1">'. mb_substr(post::get_excerpt($post, $excerpt_lenght, $output = false), 0, $ln) . '</span>';
                echo '<span class="excerpt-2">'. mb_substr(post::get_excerpt($post, $excerpt_lenght, $output = false), $ln, $ln) . '</span>';
                echo '<span class="excerpt-3">'. mb_substr(post::get_excerpt($post, $excerpt_lenght, $output = false), 2*$ln, $excerpt_lenght - $ln) . '</span>';
            } else if(strlen(post::get_excerpt($post, $excerpt_lenght, $output = false)) > $ln && strlen(post::get_excerpt($post, $excerpt_lenght, $output = false)) <= 2*$ln ) {
                echo '<span class="excerpt-1">'. mb_substr(post::get_excerpt($post, $excerpt_lenght, $output = false), 0, $ln) . '</span>';
                echo '<span class="excerpt-2">'. mb_substr(post::get_excerpt($post, $excerpt_lenght, $output = false), $ln, $excerpt_lenght - $ln) . '</span>';                
            } else if(strlen(post::get_excerpt($post, $excerpt_lenght, $output = false)) < $ln ) {
                echo '<span class="excerpt-1">'. post::get_excerpt($post, $excerpt_lenght, $output = false) . '</span>';
            }          
        }  

        static function video_post_click($post){
            /* check and initialize play action for video posts, if not video post the function will return false */

            if( get_post_format( $post -> ID ) == 'video' ){
                $format = meta::get_meta( $post -> ID , 'format' );

                if( isset( $format['feat_id'] ) && !empty( $format['feat_id'] ) )
                  {
                    $video_id = $format['feat_id'];
                    $video_type = 'self_hosted';
                    if(isset($format['feat_url']) && post::isValidURL($format['feat_url']))
                      {
                        $vimeo_id = post::get_vimeo_video_id( $format['feat_url'] );
                        $youtube_id = post::get_youtube_video_id( $format['feat_url'] );
                        
                        if( $vimeo_id != '0' ){
                          $video_type = 'vimeo';
                          $video_id = $vimeo_id;
                        }

                        if( $youtube_id != '0' ){
                          $video_type = 'youtube';
                          $video_id = $youtube_id;
                        }
                      }
    
                    if($video_type == 'self_hosted'){
                        $onclick = 'playVideo("'.urlencode(wp_get_attachment_url($video_id)).'","'.$video_type.'",jQuery(this).parents(".featimg"),jQuery(this).parent().width(),jQuery(this).parent().width())';
                    }else{
                        $onclick = 'playVideo("'.$video_id.'","'.$video_type.'",jQuery(this).parents(".featimg"),jQuery(this).parent().width(),jQuery(this).parent().width())';
                    }    
                    
                }
            }

            if(isset($onclick)){
                return  $onclick;
            }else{
                return  false;
            }
        }

        /**
         * This function will aoutput a label for new posts if certain conditions are true
         *
         * @param string $$post_date - the post date of the post 
         *      
         * @return various - the HTML of the new label OR and empty string 
         */
        static function get_new_post_label($post_date){
            $result = '';
            if (options::logic('blog_post', 'mark_new_posts')) { /*if user wants to mark new posts*/
                $unix_post_date = strtotime($post_date); /*transfrom post date into unix date*/
                $seconds_diff = time() - $unix_post_date; /* compute how old is the post - in seconds */

                $news_post_expiration_time = options::get_value( 'blog_post' , 'news_post_expiration_time' );
                if( ($seconds_diff/3600) < $news_post_expiration_time  ){ /*if the post is not older than defined in the settings*/
                    $new_label = options::get_value( 'blog_post' , 'new_post_label' );
                    $result = '<div class="new-post-label">'.$new_label.'</div>';
                } 
            }

            return $result;
        }

        static function get_repeated_events_date($post_id){
            $event_repeat = meta::get_meta( $post_id, 'date' );
            $date_format = get_option( 'date_format' );
            $time_format = get_option( 'time_format' );

            if(isset($event_repeat['start_date_time']) && $event_repeat['start_date_time'] != '') { echo date_i18n($date_format, strtotime($event_repeat['start_date_time'])) . ', ' . date_i18n( $time_format, strtotime($event_repeat['start_date_time']) ) ; } 
            if(isset($event_repeat['end_date_time']) && $event_repeat['end_date_time'] != '' ){ echo ' - '. date_i18n($date_format, strtotime($event_repeat['end_date_time'])) . ', ' . date_i18n( $time_format, strtotime($event_repeat['end_date_time']) ) ; } 
        }

        static function repeating_localication_fix($event_repeat = ''){
            switch ($event_repeat) {
                case 'day':
                    $r = __('day', 'cosmotheme');
                    break;
                case 'week':
                    $r = __('week', 'cosmotheme');
                    break;
                case 'month':
                    $r = __('month', 'cosmotheme');
                    break;
                case 'year':
                    $r= __('year', 'cosmotheme');
                    break;

                default:
                    $r = $event_repeat;
                    break;
            }

            return $r;
        }

    }
  
?>
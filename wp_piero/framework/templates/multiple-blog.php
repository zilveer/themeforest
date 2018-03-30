<?php
/*
 * Title
 */
function cshero_title_render(){
	global $smof_data;
	$post_style = $smof_data['post_style'];
    $title_heading = isset($smof_data['blog_title_heading'])?$smof_data['blog_title_heading']:'h3';
	$show_post_title = '1';
	if(is_single()){
		$show_post_title = isset($smof_data['show_post_title'])?$smof_data['show_post_title']:'1';
	} else {
		$show_post_title = (isset($smof_data['archive_posts_title']))?$smof_data['archive_posts_title']:'1';
	}
	if($show_post_title == '1'){
		ob_start();
		?>
		<div class="cs-blog-title">
			<<?php echo $title_heading;?> class="cs-blog-title-inner">
			    <?php if(is_sticky()){ echo "<i class='fa fa-thumb-tack'></i>"; } ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</<?php echo $title_heading;?>>
		</div>
		<?php
		return  ob_get_clean();
		break;
	}
}
/*
 * Info Bar
 */
function cshero_getCategories(){
    global $smof_data, $post;
    $post_type = get_post_type();
    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    $categories = get_the_terms(0, $taxonomies);
    $separator = ', ';
    if(!empty($categories)):
        $k=0;
        foreach($categories as  $category) {
            if(is_object($category)){
                if($k>0){
                    echo $separator;
                }
                $k++;
                return '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",THEMENAME), $category->name ) ) . '">'.$category->name.'</a>';
            }
        }
    endif;
}
function cshero_infobar_style2(){
    global $smof_data, $post;
    $post_type = get_post_type();
    $taxonomies = 'category';
    $archive_date = get_the_date($smof_data['archive_date_format']);
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    ob_start();
    ?>
    <span class="cshero-info-bar">
        <?php echo __('By ',THEMENAME);
        the_author_posts_link();
        echo __(' in ',THEMENAME);
        $categories = get_the_terms(0, $taxonomies);
        $separator = ', ';
        $output = '';
        if(!empty($categories)):
            foreach($categories as $category) {
                if(is_object($category)){
                   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",THEMENAME), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                }
            }
        endif;
        echo trim($output, $separator);
        echo __(' Posted ',THEMENAME);
        ?>
        <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",THEMENAME).$archive_date; ?>"><?php echo $archive_date; ?></a>
    </span>
    <?php
    return ob_get_clean();
}
function cshero_get_like_comment(){
    ob_start();
    ?>
    <ul class="cshero-info-like">
        <li class="cs-blog-favorite"><?php if(function_exists('post_favorite')){ post_favorite();} ?></li>
        <li class="cs-blog-comments"><a href="<?php echo get_comments_link(get_the_ID());?>"><span class="share-box"><i class="fa fa-comment"></i><?php comments_number(__('0',THEMENAME),__('1',THEMENAME),__('%',THEMENAME));?></span></a></li>
        <?php
        ?>
    </ul>
    <?php
    return ob_get_clean();
}
function cshero_info_bar_render() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    if($smof_data['detail_detail'] == '1'){
        ob_start();
        ?>
        <div class="cs-blog-info">
            <ul class="unliststyle">
                <?php
                if($smof_data['detail_date'] == '1' and in_array('date',$vars)):
                    $archive_date = get_the_date($smof_data['archive_date_format']);?>
                    <li class="cs-blog-date">
                        <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",THEMENAME).$archive_date; ?>"><?php echo $archive_date; ?></a>
                    </li>
                <?php endif; ?>
                <?php if($smof_data['detail_author'] == '1' and in_array('author',$vars)): ?>
                    <li class="cs-blog-author">
                        <?php _e(' | by ', THEMENAME); ?> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ), get_the_author_meta( 'display_name', $author_id )); ?>
                    </li>
                <?php endif; ?>     
            </ul>
        </div>
        <?php
        return  ob_get_clean();
        break;
    }
}
function cshero_info_category_render() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    if($smof_data['detail_detail'] == '1'){
        ob_start();
        ?>
        <div class="cs-blog-info">
            <ul class="unliststyle">
                <?php
                if($smof_data['detail_category'] == '1' and in_array('categories',$vars)):
                    $categories = get_the_terms(0, $taxonomies);
                    $separator = ', ';
                    $output = ''; ?>
                    <?php if(!empty($categories)): ?>
                    <li class="cs-blog-cats">
                        <?php
                            
                            foreach($categories as $category) {
                                if(is_object($category)){
                                   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",THEMENAME), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                                }
                            }
                            echo trim($output, $separator);
                        ?>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>        
            </ul>
        </div>
        <?php
        return  ob_get_clean();
        break;
    }
}
/*
 * Meta in footer
 */
function cshero_info_footer_render() {
    global $smof_data, $post;
    $vars = func_get_args();
    if(count($vars)==0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    if($smof_data['detail_detail'] == '1') {
        ob_start();
    ?>
        <?php if(
            $smof_data['detail_like'] == '1' && in_array('like',$vars) and function_exists('post_favorite')
            || $smof_data['detail_comments'] == '1' && in_array('comment',$vars)
            || $smof_data['detail_tags'] && in_array('tags',$vars)
            || $smof_data['detail_social'] == '1' and in_array('social',$vars) and function_exists('cshero_socials_share')
        ): ?>
        
        <?php endif; ?>     
    <?php
        return ob_get_clean();
    }
}
/*
 * Post Link
 */
function cshero_post_link_render() {
    global $smof_data, $post;
    $vars = func_get_args();
    if(count($vars)==0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    if($smof_data['detail_detail'] == '1') {
        ob_start();
    ?>
        <div class="readmore">
            <?php if(get_post_format() == 'link' && get_post_meta($post->ID, 'cs_post_link', true) and in_array('link',$vars) ): ?>
                <a class="btn btn-small btn-primary-alt btn-no-radius" href="<?php echo get_post_meta(get_the_ID(), 'cs_post_link', true); ?>"><?php if(get_post_meta(get_the_ID(), 'cs_post_link_text', true)){ echo get_post_meta(get_the_ID(), 'cs_post_link_text', true);} else { echo get_post_meta(get_the_ID(), 'cs_post_link', true); } ?></a>
            <?php endif; ?>
        </div>        
    <?php
        return ob_get_clean();
    }
}
/*
 * Content for blog
 */
function custom_excerpt_length( $length ) {
    global $smof_data;
    if($smof_data['blog_full_content']){
        return $smof_data['introtext_length'];
    }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function cshero_content_render($readmore = true){
    global $smof_data;
    $content_type = cshero_posts_full_content();
    if($content_type == '1'){
        the_excerpt();
        if($readmore){
            echo cshero_read_more_render();
        }
    } elseif ($content_type == '2'){
        the_excerpt();
    } else {
        the_content();
        wp_link_pages( array(
        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="page-numbers">',
        'link_after'  => '</span>',
        ) );
    }
}
/*
 * Read More
 */
 function cshero_read_more_render(){
	ob_start();
	?>
	<div class="readmore"><a href="<?php echo esc_url( get_permalink()); ?>" class=""><?php echo __('READ MORE',THEMENAME); ?></a></div>
	<?php
	return  ob_get_clean();
}

function cshero_read_more_overlay_render(){
    ob_start();
    ?>
    <div class="readmore"><a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-default btn-primary-alt btn-no-radius"><?php echo __('READ MORE',THEMENAME); ?></a></div>
    <?php
    return  ob_get_clean();
}

/*
 * Meta in footer
 */
function cshero_post_details_info_render() {
    global $smof_data, $post;
    $vars = func_get_args();
    if(count($vars)==0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $taxonomies = 'category';
    $post_type = get_post_type();
    $author_id=$post->post_author;
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    if($smof_data['detail_detail'] == '1') {
        ob_start();
    ?>
        <?php if(
            $smof_data['detail_like'] == '1' && in_array('like',$vars) and function_exists('post_favorite')
            || $smof_data['detail_comments'] == '1' && in_array('comment',$vars)
            || $smof_data['detail_tags'] && in_array('tags',$vars)
            || $smof_data['detail_social'] == '1' and in_array('social',$vars) and function_exists('cshero_socials_share')
        ): ?>
        <div class="single-post-meta post-meta clearfix">
        <ul class="list-inline list-unstyled">
            <?php
            if($smof_data['detail_date'] == '1' and in_array('date',$vars)):
                $archive_date = get_the_date($smof_data['archive_date_format']);?>
                <li class="cs-blog-date">
                    <i class="pe-7s-date"></i> <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",THEMENAME).$archive_date; ?>"><?php echo $archive_date; ?></a>
                </li>
            <?php endif; ?>
            <?php
            if($smof_data['detail_category'] == '1' and in_array('categories',$vars)):
                $categories = get_the_terms(0, $taxonomies);
                $separator = ', ';
                $output = ''; ?>
                <?php if(!empty($categories)): ?>
                <li class="cs-blog-cats">
                    <i class="pe-7s-folder"></i><?php
                        
                        foreach($categories as $category) {
                            if(is_object($category)){
                               $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",THEMENAME), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                            }
                        }
                        echo trim($output, $separator);
                    ?>
                </li>
                <?php endif; ?>
            <?php endif; ?> 
            <?php if($smof_data['detail_author'] == '1' and in_array('author',$vars)): ?>
                <li class="cs-blog-author">
                    <i class="pe-7s-note"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ), get_the_author_meta( 'display_name', $author_id )); ?>
                </li>
            <?php endif; ?>
            <?php if($smof_data['detail_like'] == '1' && in_array('like',$vars) and function_exists('post_favorite')): ?>
            <li class="cs-blog-favorite"><?php post_favorite(); ?></li>
            <?php endif; ?>

            <?php if ( $smof_data['detail_comments'] == '1' && in_array('comment',$vars) ): ?>
                <li class="cs-blog-comments">
                    <i class="fa fa-comments"></i>
                    <a href="<?php echo get_the_permalink(); ?>" title="<?php _e('View all Comments', THEMENAME); ?>"><?php comments_number(__('0',THEMENAME),__('1',THEMENAME),__('%',THEMENAME)); ?></a>
                </li>
            <?php endif; ?>
              
            <?php if($smof_data['detail_tags'] && in_array('tags',$vars)):
               $tags = get_the_tags($post->ID);
               $separator = ', ';
               $output = '';?>
               <?php if(!empty($tags)): ?>
               <li class="cs-blog-tags"><i class="fa fa-tags"></i>
               <?php
               foreach($tags as $tag) {
                   if(is_object($tag)){
                       $output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in tag %s",THEMENAME), $tag->name ) ) . '">'.$tag->name.'</a>'.$separator;
                   }
               }
               echo trim($output, $separator);
               ?>
               </li>
               <?php endif; ?>
            <?php endif; ?>

            <?php if($smof_data['detail_social'] == '1' and in_array('social',$vars) and function_exists('cshero_socials_share')): ?>
            <li class="cs-blog-social right">
                <?php //cshero_social_sharing_render('',true,false); ?>
                <div class="social-share">
                    <?php
                        $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
                        $img = esc_attr($attachment_image[0]);
                        $title = get_the_title();
                        echo cshero_socials_share(get_the_permalink(),$img, $title);
                    ?>
                </div>
            </li>
            <?php endif; ?>
        </ul>
        </div>  
        <?php endif; ?>     
    <?php
        return ob_get_clean();
    }
}


/* Portfolio Category */
function cshero_getPortfolioCategory() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
        ob_start();
        ?>
        
            <?php
            
            $categories = get_the_terms(0, $taxonomies);
            $separator = ', ';
            $output = ''; ?>
            <?php if(!empty($categories)): ?>
                <div class="portfolio-categories">
                <?php echo _e('in ',THEMENAME); ?>
                <?php
                    foreach($categories as $category) {
                        if(is_object($category)){
                           $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",THEMENAME), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                        }
                    }
                    echo trim($output, $separator);
                ?>
                </div>
            <?php endif; ?>
        <?php
        return  ob_get_clean();
        break;
}

/* Portfolio Content Render */
function cshero_portfolio_content_render($readmore = true){
    global $smof_data;
    $content_type = cshero_posts_full_content();
    if($content_type == '1'){
        echo substr(get_the_content(),0,$smof_data['portfolio_excerpt_length']);  
    } elseif ($content_type == '2'){
        echo substr(get_the_content(),0,$smof_data['portfolio_excerpt_length']);
    } else {
        the_content();
        wp_link_pages( array(
        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="page-numbers">',
        'link_after'  => '</span>',
        ) );
    }
}
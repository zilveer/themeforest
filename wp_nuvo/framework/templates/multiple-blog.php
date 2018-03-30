<?php
/*
 * Title
 */
function cshero_title_render(){
	global $smof_data;
	$show_post_title = '1';
	if(is_single()){
		$show_post_title = isset($smof_data['show_post_title'])?$smof_data['show_post_title']:'1';
	} else {
		$show_post_title = (isset($smof_data['archive_posts_title']))?$smof_data['archive_posts_title']:'1';
	}
	if($show_post_title == '1'){
		ob_start();
		?>
		<div class="cs-blog-title table-cell">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
		</div>
		<?php
		return  ob_get_clean();
	}
}
/*
 * Info Bar
 */
function cshero_info_bar_render() {
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
	if($smof_data['detail_detail'] == '1'){
		ob_start();
		?>
		<div class="cs-blog-info">
            <ul class="unliststyle">
                <?php
                if($smof_data['detail_date'] == '1'):
                    $archive_date = get_the_date($smof_data['archive_date_format']);?>
            	    <li><a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo esc_html__( "View all posts date ",'wp_nuvo').$archive_date; ?>"><?php echo $archive_date; ?></a></li>
            	<?php endif; ?>
            	<?php if($smof_data['detail_author'] == '1'): ?>
                    <li><?php esc_html_e('Posted by ','wp_nuvo'); the_author_posts_link(); ?></li>
                <?php endif; ?>
            	<?php
            	if($smof_data['detail_category'] == '1'):
                	$categories = get_the_terms(0, $taxonomies);
                	$separator = ', ';
                	$output = ''; ?>
                	<?php if(!empty($categories)): ?>
            	    <li>
            		<?php
					foreach($categories as $category) {
					    if(is_object($category)){
						   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s",'wp_nuvo'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
					    }
			        }
					echo trim($output, $separator);
					?>
            	    </li>
            	    <?php endif; ?>
            	<?php endif; ?>
            	<?php if($smof_data['detail_tags']):
            	   $tags = get_the_tags($post->ID);
            	   $separator = ', ';
            	   $output = '';?>
            	   <?php if(!empty($tags)): ?>
            	   <li>
                   <?php
                   foreach($tags as $tag) {
                       if(is_object($tag)){
                           $output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in tag %s",'wp_nuvo'), $tag->name ) ) . '">'.$tag->name.'</a>'.$separator;
                       }
                   }
                   echo trim($output, $separator);
                   ?>
            	   </li>
            	   <?php endif; ?>
            	<?php endif; ?>
            	<?php if($smof_data['detail_comments'] == '1'): ?>
            	<li><a href="<?php echo get_the_permalink(); ?>" title="<?php esc_html_e('View all Comments', 'wp_nuvo'); ?>"><?php comments_number(__('0 Comments','wp_nuvo'),__('1 Comments','wp_nuvo'),__('% Comments','wp_nuvo')); ?></a></li>
            	<?php endif; ?>
            	<?php if($smof_data['detail_like'] == '1'): ?>
            	<li><?php post_favorite(); ?></li>
            	<?php endif; ?>
            	<?php if($smof_data['detail_social'] == '1'): ?>
            	<li><?php cshero_social_sharing_render('',true,false); ?></li>
            	<?php endif; ?>
            	<?php if(get_post_format() == 'link' && get_post_meta($post->ID, 'cs_post_link', true)): ?>
    			<li class="cs-blog-link">
    			    <a href="<?php echo get_post_meta(get_the_ID(), 'cs_post_link', true); ?>"><?php if(get_post_meta(get_the_ID(), 'cs_post_link_text', true)){ echo get_post_meta(get_the_ID(), 'cs_post_link_text', true);} else { echo get_post_meta(get_the_ID(), 'cs_post_link', true); } ?></a>
    			</li>
    			<?php endif; ?>
        	</ul>
		</div>
		<?php
		return  ob_get_clean();
	}
}
/*
 * Content for blog
 */
function cshero_content_render(){
    global $smof_data;
    $content_type = cshero_posts_full_content();
    if($content_type == '1'){
        the_excerpt();
        echo cshero_read_more_render();
    } elseif ($content_type == '2'){
        the_excerpt();
    } else {
        the_content();
        wp_link_pages( array(
        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp_nuvo') . '</span>',
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
 	global $smof_data;
	ob_start();
	?>
	<div class="readmore text-right"><a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-default"><?php echo esc_html__('READ MORE','wp_nuvo'); ?><i class="fa fa-chevron-circle-right"></i></a></div>
	<?php
	return  ob_get_clean();
}
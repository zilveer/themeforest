<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
 
<?php 

                   $item_type = get_option ( THEME_NAME_S . '_search_archive_item_size', '1/1 Full Thumbnail' );
			       $num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
				   $full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content', 'No' );
				    $sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
					if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
													$item_size = "745x350";
												}else if( $sidebar == "both-sidebar" ){
													$item_size = "560x200";
												}else{
													$item_size = "1170x440";
												} 					
                   $post_id = get_the_ID();
                   $thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
                   $thumbnail_id = get_post_thumbnail_id( $post_id );
                   $thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				   
	
                  ?>


      
      <!--BLOG POST START-->
       <article id="post-<?php the_ID(); ?>" <?php post_class('wrap-blog-post mbtm2 blog-post'); ?>>
          <div class="widget-bg"> 
          <?php
		   $post_format = get_post_format();
		   if ( $post_format == "video") {
		   echo '<div id="video">';
				 $item_size_arr= explode('x',$item_size); $item_height=$item_size_arr[1]; $item_width=$item_size_arr[0];	
				 echo '<div class="screen fluid-width-video-wrapper" style="height:'.$item_height.'px; width:'.$item_width.'px;">';
				 	cp_video($post->ID, $item_size );
				 echo '</div><!-- end .screen -->';
				 echo '</div><!-- end #video-->'; 
		   }else{
		?>
        <div class="thumb"> <?php '<a href="' . get_permalink() . '">' . print_blog_thumbnail( get_the_ID(), $item_size ). '</a>'; ?> </div>
        <?php } ?>
        <div class="text">
          <h2><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h2>
          <?php if ($full_content == 'No' ) { ?>
              <div class="blog-content">
                <p> <?php echo  mb_substr( get_the_excerpt(), 0, '300' ) ;	?> </p>
              </div>
              <?php }else { ?>
              <div class="blog-content"><?php echo the_content(); 
                           wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            ) );
                           ?></div>
              <?php } ?>
          <?php print_post_meta(); ?>
        </div>
      
      <!--BLOG POST END--> 
    </div>
</article>

<?php ?>
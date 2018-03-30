<?php

// Header File

 get_header();
if(isset($cs_theme_option['cs_layout'])){ $cs_layout = $cs_theme_option['cs_layout']; }else{ $cs_layout = 'right';} 
 	if ( $cs_layout <> '' and $cs_layout  <> "none" and $cs_layout  == 'left') :  ?>
		<aside class="left-content col-md-3">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_theme_option['cs_sidebar_left']) ) : endif; ?>
		</aside>
	<?php endif; ?>	
<div id="main" role="main">

    <!-- Container Start -->

        <div class="container">

            <!-- Row Start -->

            <div class="row">

	 <?php if ( have_posts() ) : ?>
     <div class="<?php cs_default_pages_meta_content_class( $cs_layout ); ?>">
            <div class="postlist blog archive-page blog-medium">
    
                <?php /* The loop */
    
                
    
                     if (empty($_GET['page_id_all']))
    
                            $_GET['page_id_all'] = 1;
    
                        if (!isset($_GET["s"])) {
    
                            $_GET["s"] = '';
    
                        }
    
                 ?>
    
                
    
                <?php 
					while ( have_posts() ) : the_post(); 
					 $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 348, 192);
				 ?>
    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    
                                <!-- Text Start -->
    							 <?php 
									if($image_url <> ""){
										echo '<figure>
											<a href="'.get_permalink().'" ><img src="'.$image_url.'" alt="" ></a>
										</figure>';
									}
								?>
                                <div class="blog_text webkit">
    
                                    <div class="text">
     
                                        <h2 class="heading-color post-title"><a href="<?php the_permalink(); ?>" class="colrhover"><?php the_title(); ?></a></h2>
    
                                    </div>
    
                                        <ul class="post-options">
                                      <li><i class="fa fa-user">&nbsp;</i><?php printf( __('%s','AidReform'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" >'.get_the_author().'</a>' );?></li>
    
                                      <li>
    
                                          <i class="fa fa-calendar">&nbsp;</i>
    
                                          <time datetime="<?php echo date('F d, Y',strtotime(get_the_date()));?>"><?php echo date('F d, Y',strtotime(get_the_date()));?></time>
    
                                      </li>
    
                                      
    
                                      <li><?php  if ( comments_open() ) {echo '<i class="fa fa-comment"></i>'; comments_popup_link( __( '0', 'AidReform' ) , __( '1', 'AidReform' ), __( '%', 'AidReform' ) );  } ?></li>
    
                                      
    
                                      <?php edit_post_link( __( 'Edit', 'AidReform'), '<li><span class="edit-link">', '</span></li>' ); ?>
    
                                </ul> 
    
                                    <p><?php echo cs_get_the_excerpt(255,true); ?></p>
    
                                </div>
    
                                <!-- Text End -->
    
                                                           
    
                            </article>
    
                         <?php endwhile; ?>
    
                         <?php
    
                            $qrystr = '';
    
                            // pagination start
    
                                if ( isset($cs_theme_option['pagination']) and $cs_theme_option['pagination'] == "Show Pagination" and $wp_query->found_posts > get_option('posts_per_page')) {
    
                                    echo "<nav class='pagination'><ul>";
    
                                         if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
    
                                         if ( isset($_GET['author']) ) $qrystr .= "&author=".$_GET['author'];
    
                                         if ( isset($_GET['tag']) ) $qrystr .= "&tag=".$_GET['tag'];
    
                                         if ( isset($_GET['cat']) ) $qrystr .= "&cat=".$_GET['cat'];
    
                                         if ( isset($_GET['event-category']) ) $qrystr .= "&event-category=".$_GET['event-category'];
    
                                         if ( isset($_GET['m']) ) $qrystr .= "&m=".$_GET['m'];
    
                                         
    
                                    echo cs_pagination(wp_count_posts()->publish,get_option('posts_per_page'), $qrystr);
    
                                    echo "</ul></nav>";
    
                                }
    
                            // pagination end
    
                    ?>
    
                         <?php endif; ?>
    
                         
    
     </div>
     </div>
  <?php
	if ( $cs_layout <> '' and $cs_layout  <> "none" and $cs_layout  == 'right') :  ?>
		<aside class="left-content col-md-3">
			<?php 
			if(isset($cs_theme_option['cs_sidebar_right'])){
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_theme_option['cs_sidebar_right']) ) : endif;
			}else{
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1') ) : endif;
			}
			  ?>
		</aside>
<?php endif; ?>	
 <?php

 //Footer FIle

 get_footer();

?>
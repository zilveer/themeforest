<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

$grandportfolio_homepage_style = grandportfolio_get_homepage_style();

$tg_menu_layout = grandportfolio_menu_layout();
if($tg_menu_layout == 'leftmenu')
{
	grandportfolio_set_homepage_style('fullscreen');
}

get_header();

$grandportfolio_topbar = grandportfolio_get_topbar();

/**
*	Get current page id
**/

$current_page_id = $post->ID;

//If display feat content
$tg_blog_feat_content = kirki_get_option('tg_blog_feat_content');

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($tg_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}

//Include custom header feature
$grandportfolio_screen_class = grandportfolio_get_screen_class();
grandportfolio_set_screen_class('split');

$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
grandportfolio_set_page_content_class('split');

get_template_part("/templates/template-post-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(!empty($tg_blog_feat_content) && has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
	    	if(!empty($tg_blog_feat_content) )
	    	{
			    //Get post featured content
			    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
			    
			    switch($post_ft_type)
			    {
			    	case 'Image':
			    	default:
			        	if(!empty($image_thumb))
			        	{
			        		$large_image_url = wp_get_attachment_image_src($image_id, 'original', true);
			        		
			        		$pp_menu_layout = get_option('pp_menu_layout');
			        		
			        		if($pp_menu_layout != 'leftmenu')
							{
								$small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-blog', true);
							}
							else
							{
			        			$small_image_url = wp_get_attachment_image_src($image_id, 'large', true);
			        		}
			?>
			
			    	    <div class="post_img static">
			    	    	<a href="<?php echo esc_url($large_image_url[0]); ?>" class="img_frame">
			    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
				            </a>
			    	    </div>
			
			<?php
			    		}
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
			?>
			    		<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Youtube Video':
			    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
			?>
			    		<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Gallery':
			    		$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
			?>
			    		<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="670" height="270"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    } //End switch
			} //End if enable blog featured image
			?>
		    
		    <?php
			    //Check if display post header then no need to display it again
				$tg_blog_header_bg = kirki_get_option('tg_blog_header_bg');
		    
		    	//Check post format
		    	$post_format = get_post_format(get_the_ID());
				
				switch($post_format)
				{
					case 'quote':
			?>
					
					<div class="post_header">
						<div class="post_quote_title">
						    <?php the_content(); ?>
						    <?php
								if(empty($tg_blog_header_bg))
								{
							?>
								<div class="post_detail">
							    	<?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>
							    	<?php
							    		//Get Post's Categories
							    		$post_categories = wp_get_post_categories($post->ID);
							    		if(!empty($post_categories))
							    		{
							    	?>
							    		<?php echo esc_html_e('In', 'grandportfolio-translation' ); ?>
							    	<?php
							    	    	foreach($post_categories as $c)
							    	    	{
							    	    		$cat = get_category( $c );
							    	?>
							    	    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
							    	<?php
							    	    	}
							    	    }
							    	?>
							    </div>
							<?php } ?>
						</div>
					</div>
			<?php
					break;
					
					case 'link':
			?>
					
					<div class="post_header">
						<div class="post_quote_title">
						    <?php the_content(); ?>
						    <?php
								if(empty($tg_blog_header_bg))
								{
							?>
								<div class="post_detail">
							    	<?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>
							    	<?php
							    		//Get Post's Categories
							    		$post_categories = wp_get_post_categories($post->ID);
							    		if(!empty($post_categories))
							    		{
							    	?>
							    		<?php echo esc_html_e('In', 'grandportfolio-translation' ); ?>
							    	<?php
							    	    	foreach($post_categories as $c)
							    	    	{
							    	    		$cat = get_category( $c );
							    	?>
							    	    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
							    	<?php
							    	    	}
							    	    }
							    	?>
							    </div>
							<?php } ?>
						</div>
					</div>
			<?php
					break;
					
					default:
		    ?>
				    <div class="post_header">
				    	<?php
						    if(empty($tg_blog_header_bg))
						    {
						?>
					    	<div class="post_header_title">
							    <h5><?php the_title(); ?></h5>
							    <div class="post_detail">
								    <?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>
								    <?php
								    	//Get Post's Categories
								    	$post_categories = wp_get_post_categories($post->ID);
								    	if(!empty($post_categories))
								    	{
								    ?>
								    	<?php echo esc_html_e('In', 'grandportfolio-translation' ); ?>
								    <?php
								        	foreach($post_categories as $c)
								        	{
								        		$cat = get_category( $c );
								    ?>
								        	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
								    <?php
								        	}
								        }
								    ?>
								</div>
							    <br class="clear"/>
					    	</div>
						    <?php
								}
							?>
				    
				    <?php
				    	the_content();
						wp_link_pages();
				    ?>
				    
			    </div>
		    <?php
		    		break;
		    	}
		    ?>
		    
		    <?php
			 $tg_blog_display_tags = kirki_get_option('tg_blog_display_tags');
			
			    if(has_tag() && !empty($tg_blog_display_tags))
			    {
			?>
			    <div class="post_excerpt post_tag">
			    	<i class="fa fa-tags"></i>
			    	<?php the_tags('', '', '<br />'); ?>
			    </div>
			    <br class="clear"/><br/>
			<?php
			    }
			?>
		    
		   <hr/>
			
			<?php
			    $tg_blog_display_author = kirki_get_option('tg_blog_display_author');
			    
			    if($tg_blog_display_author)
			    {
			    	$author_name = get_the_author();
			    	$author_info = get_the_author_meta('description');
			?>
			<div id="about_the_author">
			    <div class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '200' ); ?></div>
			    <div class="author_detail">
			     	<div class="author_content">
			     		<h7 class="author_name"><?php echo esc_html($author_name); ?></h7>
			     		<?php echo esc_html($author_info); ?>
			     	</div>
			    </div>
			</div>
			<?php
			    }
			?>
			
			<?php
			    $tg_blog_display_related = kirki_get_option('tg_blog_display_related');
			    
			    if($tg_blog_display_related)
			    {
			?>
			
			<?php
			//for use in the loop, list 9 post titles related to post's tags on current post
			$tags = wp_get_post_tags($post->ID);
			
			if ($tags) {
			
			    $tag_in = array();
			  	//Get all tags
			  	foreach($tags as $tags)
			  	{
			      	$tag_in[] = $tags->term_id;
			  	}
			
			  	$args=array(
			      	  'tag__in' => $tag_in,
			      	  'post__not_in' => array($post->ID),
			      	  'showposts' => 3,
			      	  'ignore_sticky_posts' => 1,
			      	  'orderby' => 'date',
			      	  'order' => 'DESC'
			  	 );
			  	$my_query = new WP_Query($args);
			  	$i_post = 1;
			  	
			  	if( $my_query->have_posts() ) {
			 ?>
			 	<hr/><br class="clear"/><br/>
			  	<h6 class="subtitle"><span><?php echo esc_html_e('You might also like', 'grandportfolio-translation' ); ?></span></h6><hr class="title_break"/><br class="clear"/>
			  	<div class="post_related">
			    <?php
			       while ($my_query->have_posts()) : $my_query->the_post();
			       
			       $last_class = '';
			       if($i_post%3==0)
			       {
				       $last_class = 'last';
			       }
			       
			       $image_thumb = '';
								
					if(has_post_thumbnail(get_the_ID(), 'large'))
					{
					    $image_id = get_post_thumbnail_id(get_the_ID());
					    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
					}
			    ?>
			       <div class="one_third <?php echo esc_attr($last_class); ?>">
					   <!-- Begin each blog post -->
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
							<div class="post_wrapper grid_layout">
							
								<?php
								    //Get post featured content
								    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
								    
								    switch($post_ft_type)
								    {
								    	case 'Image':
								    	default:
								        	if(!empty($image_thumb))
								        	{
								        		$small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-blog', true);
								?>
								
								    	    <div class="post_img small static">
								    	    	<a href="<?php the_permalink(); ?>">
								    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
								                </a>
								    	    </div>
								
								<?php
								    		}
								    	break;
								    	
								    	case 'Vimeo Video':
								    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
								?>
								    		<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]'); ?>
								    		<br/>
								<?php
								    	break;
								    	
								    	case 'Youtube Video':
								    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
								?>
								    		<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]'); ?>
								    		<br/>
								<?php
								    	break;
								    	
								    	case 'Gallery':
								    		$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
								?>
								    		<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" size="gallery_2" width="670" height="270"]'); ?>
								<?php
								    	break;
								    	
								    } //End switch
								?>
							    
							    <div class="blog_grid_content">
									<div class="post_header grid">
									    <strong><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong>
									    <div class="post_detail">
									        <?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>
									    </div>
									</div>
							    </div>
							    
							</div>
						
						</div>
						<!-- End each blog post -->
			       </div>
			     <?php
			     		$i_post++;
				 		endwhile;
			       	
				 		wp_reset_postdata();
			     ?>
			  	</div>
			    <br class="clear"/>
			<?php
			  	}
			}
			?>
			
			<?php
			    } //end if show related
			?>
			
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->


<?php
if (comments_open($post->ID)) 
{
?>
<br class="clear"/><br/>
<div class="fullwidth_comment_wrapper">
	<?php comments_template( '', true ); ?>
</div>
<?php
}
?>

<?php endwhile; endif; ?>

<?php
get_template_part("/templates/template-footer-split");
?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>
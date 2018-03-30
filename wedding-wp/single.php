 <?php
/******************/
/**  Single Post
/******************/

get_header();
 ?>
 <section class="container page-content" >
    <hr class="vertical-space2">
    <?php 
	if( 'none' != $webnus_options->webnus_blog_singlepost_sidebar() )
	if( 'left' == $webnus_options->webnus_blog_singlepost_sidebar() ){ 
		get_sidebar('bleft');
	}
	?>
	<section class="<?php echo ( 'none' == $webnus_options->webnus_blog_singlepost_sidebar()  )?'col-md-12':'col-md-8'?> omega ">
		<?php if( have_posts() ): while( have_posts() ): the_post();  ?>
      <article class="blog-single-post">
		<?php
			
			setViews(get_the_ID());
			GLOBAL $webnus_options;
			
			
		$post_format = get_post_format(get_the_ID());
	
		$content = get_the_content();
			
			
	if(  $webnus_options->webnus_blog_sinlge_featuredimage_enable() ){
	
		global $featured_video;
		
		$meta_video = $featured_video->the_meta();
		
		if( 'video'  == $post_format || 'audio'  == $post_format)
		{
			
		$pattern =
		  '\\['                              // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "(video|audio)"                     // 2: Shortcode name
		. '(?![\\w-])'                       // Not followed by word character or hyphen
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
		. ')'
		. '(\\]?)';  			
		
			
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			
			
			if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2])))
			{
				$video = $matches[0];
				
				echo do_shortcode($video);
				
				$content = preg_replace('/'.$pattern.'/s', '', $content);
				
			}else				
			if( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) )
			{
				echo do_shortcode($meta_video['the_post_video']);
			}
				
	
			
			
		}else
		if( 'gallery'  == $post_format)
		{
			
						
			$pattern =
		  '\\['                              // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "(gallery)"                     // 2: Shortcode name
		. '(?![\\w-])'                       // Not followed by word character or hyphen
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
		. ')'
		. '(\\]?)';  			

			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			
			
			if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2])))
			{
				
				$atts = shortcode_parse_atts($matches[3]);
				
				$ids = $gallery_type = '';
				
				if(isset($atts['ids']))
				{
					$ids = $atts['ids'];
				}
				if(isset($atts['webnus_gallery_type']))
				{
					$gallery_type = $atts['webnus_gallery_type'];
				}

					echo do_shortcode('[vc_gallery img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'" onclick="link_image" custom_links_target="_self"]');
				
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}
				
	
			
			
		}else
		if( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) )
		{
			echo do_shortcode($meta_video['the_post_video']);
		}
		else
			get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) ); 
	}
			
		?>

	  <?php 
		  ?>
        <div <?php post_class('post'); ?>>
          
           <div class="postmetadata">
			<?php if( 1 == $webnus_options->webnus_blog_meta_gravatar_enable() ) { ?>	
			<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div>
			<?php } ?>
			<?php if( 1 == $webnus_options->webnus_blog_meta_author_enable() ) { ?>	
			<h6 class="blog-author"><strong><?php _e('by','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_author(); ?> </h6>
			<?php } ?>
			<?php if( 1 == $webnus_options->webnus_blog_meta_category_enable() ) { ?>
			<h6 class="blog-cat"><strong><?php _e('in','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_category(', ') ?> </h6>
			<?php } ?>
			<?php if( 1 == $webnus_options->webnus_blog_meta_comments_enable() ) { ?>
			<h6 class="blog-comments"> <?php comments_number(  ); ?> </h6>
			<?php } ?>
			<?php if( 1 == $webnus_options->webnus_blog_meta_views_enable() ) { ?>
			<h6 class="blog-views"> <i class="fa-eye"></i><span><?php echo getViews(get_the_ID()); ?></span> </h6>
			<?php } ?>
		  </div>
	  <?php if( 1 == $webnus_options->webnus_blog_meta_date_enable() ) { ?>
		<h6 class="blog-date"><span><?php the_time('d') ?> </span><?php the_time('M Y') ?> </h6>
		<?php } ?>
          
          <h1><?php the_title() ?></h1>
		
			<?php 
			
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content); 
			if( 'quote' == $post_format  ) echo '</blockquote>';
			
			?>
		 
          <br class="clear">
			  <?php the_tags( '<div class="post-tags"><i class="fa-tags"></i>', '', '</div>' ); ?><!-- End Tags -->
			 
			 <div class="next-prev-posts">
			 <?php $args = array(
					'before'           => '',
					'after'            => '',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'next',
					'nextpagelink'     => '&nbsp;&nbsp; '.__('Next Page','WEBNUS_TEXT_DOMAIN'),
					'previouspagelink' => __('Previous Page','WEBNUS_TEXT_DOMAIN').'&nbsp;&nbsp;',
					'pagelink'         => '%',
					'echo'             => 1
				); 
				
				 wp_link_pages($args);
			
				 
				?>
			  
			 </div><!-- End next-prev post -->
		
         <?php if( $webnus_options->webnus_blog_single_authorbox_enable() ) { ?>
         <div class="about-author-sec">		  
	
		  <?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
		  <h5><?php the_author(); ?></h5>
		   <p><?php echo get_the_author_meta( 'description' ); ?></p>
		  

		  
		  </div>
		  <?php  } ?>
        </div>
		<?php 
		
		  ?>
		
      </article>
      <?php 
       endwhile;
		 endif;
      comments_template(); ?>
    </section>
    <!-- end-main-conten -->
    <?php
    if( 'none' != $webnus_options->webnus_blog_singlepost_sidebar() ) 
	if( 'right' == $webnus_options->webnus_blog_singlepost_sidebar() ){
		get_sidebar('bright');
	}
	?>
    <!-- end-sidebar-->
    <div class="white-space"></div>
  </section>
  <?php 
  get_footer();
  ?>
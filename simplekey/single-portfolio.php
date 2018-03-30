<?php 
global $VAN;
get_header();
?>

<div id="container">

    <!--Portfolio Single Page-->
    <section class="page-area" id="single-content">
       <div class="wrapper">
          <div id="breadcrumbs">
            <span class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'SimpleKey' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next &rarr;', 'SimpleKey' ) ); ?></span>
          </div>
          
           <?php 
		    while (have_posts()) : the_post(); 
		    $portfolio_type=get_post_meta($post->ID, "portfolio_type_value", true);
			$portfolio_audio=trim(strip_tags(get_post_meta($post->ID, "portfolio_audio_value", true)));
		    $portfolio_layout=trim(strip_tags(get_post_meta($post->ID, "portfolio_layout_value", true)));
		    $portfolio_col=trim(strip_tags(get_post_meta($post->ID, "portfolio_col_value", true)));
			$portfolio_gallery=trim(strip_tags(get_post_meta($post->ID, "portfolio_gallery_value", true)));
		    if($portfolio_gallery<>'Yes'){
		   ?>
           
           <?php
            if(empty($portfolio_type)){$portfolio_type="Image";}
		    if($portfolio_type=="Image"){
           		if ( $images = get_children(array(
				'post_parent' => get_the_ID(),
				'post_type' => 'attachment',
				'numberposts' => 50,
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'exclude' => get_post_thumbnail_id(),
				'post_mime_type' => 'image',)))
				{
		   ?>
           <?php 
		   if(empty($portfolio_layout)){$portfolio_layout="Slider";}
		     if($portfolio_layout=="Slider"):
		   ?>
           <div id="slider" class="portfolio_flexslider flexslider">
              <ul class="slides">
               <?php
				foreach( $images as $image ) {
					$attachmenturl=wp_get_attachment_url($image->ID);
					$attachmentimage=wp_get_attachment_image($image->ID, 'image_single_slider' );
					$img_title = $image->post_title;
					$img_desc = $image->post_excerpt;
					$img_caption = $image->post_content;
					echo '<li>'.$attachmentimage.'</li>';
				}
			   ?>
              </ul>
           </div>
           <?php elseif($portfolio_layout=="Grid View"):
		      if($portfolio_col==4){
			     $layout=" columns4";
				 $thumbnail='portfolio_thumbnail_4';
			  }elseif($portfolio_col==5){
			     $layout=" columns5";
				 $thumbnail='portfolio_thumbnail_5';
			  }else{
			     $layout="";
				 $thumbnail='portfolio_thumbnail';
			  }
		   ?>
             <div id="portfolio-media">
              <div class="portfolios<?php echo $layout;?>">
              <?php
				foreach( $images as $image ) {
					$img_title = $image->post_title;
					$img_desc = $image->post_excerpt;
					$img_caption = $image->post_content;
					$attachmenturl=wp_get_attachment_url($image->ID);
					$attachmentimage=wp_get_attachment_image($image->ID, $thumbnail,array('alt'=>$img_caption));
					echo '<div class="portfolio-item"><a href="'.$attachmenturl.'" class="lightbox" rel="group-'.get_the_ID().'" title="'.$img_title.'">'.$attachmentimage.'</a></div>';
				}
			   ?>
             </div>
             </div>
           <?php endif;?>
           <?php 
		      }
			}elseif($portfolio_type=="Video"){
			  $portfolio_video=trim(get_post_meta($post->ID, "portfolio_video_value", true));
			  if($portfolio_video<>''){
		    ?>
            <div id="portfolio-media">
             <?php echo stripslashes($portfolio_video);?>
            </div>
           <?php 
			  }
			}elseif($portfolio_type=="Audio"){
			 $portfolio_audio=trim(get_post_meta($post->ID, "portfolio_audio_value", true));
			 if($portfolio_audio<>''){
		   ?>
            <div id="portfolio-media">
              <?php echo stripslashes($portfolio_audio);?>
            </div>

        <?php }
		  }
		}
		?>
           
           <article class="post">
               <h2><?php the_title();?></h2>
               <?php van_posted_on();?>
               <div class="entry">
                  <?php van_content(true,true);?>
                  <?php wp_link_pages('<div class="van_pagenavi">', '</div>', 'number');?> 
               </div>
               <div class="clearfix"></div>
           </article>
           <?php endwhile;?>
           <?php if(is_single())comments_template(); ?>
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>
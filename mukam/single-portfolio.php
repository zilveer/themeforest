 <?php get_header();?>
 	<?php
 	$after = ''; 
    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
	$header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            $headertype = "header-1";
          elseif ( $header_style == "header_style_2"): 
            $headertype = "header-2";
          elseif ( $header_style == "header_style_3" ):
            $headertype = "header-4";
          elseif ( $header_style == "header_style_4" ):
            $headertype = "header-3";
          elseif ( $header_style == "header_style_5" ):
            $headertype = "header-5";
          elseif ( $header_style == "header_style_6" ):
            $headertype = "shopheader";
          elseif ( $header_style == "header_style_7" ):
            $headertype = "header-7";
          elseif ( $header_style == "header_style_8" ):
            $headertype = "header-6";
          endif;

    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    } 
     
     
    ?>
  
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
	<div class="caption-out<?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
          <h3><?php print $portfolio_header = get_option_tree('portfolio_header',$theme_options);?></h3>
          <p><?php print $portfolio_caption = get_option_tree('portfolio_caption',$theme_options);?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <?php mukam_breadcrumb(); ?>
        </div>
      </div>
    </div>
    </div>
	<!-- Portfolio Content Start -->	
	<div class="bg-color<?php echo $animy3;?>">
		<div class="container">
		   <div class="row">
			  <div class="col-md-12 portfolio-wrapper">
			     <div class="portfolio-style-1 single">
				 <div class="portfolio-style-1-filter">
				 	<?php if( 'your_post_type' == get_post_type() ) {
					    previous_post_link();
					    next_post_link();
					} ?>
					<ul><li><?php echo previous_post_link('%link', 'PREVIOUS'); ?></li> <li>/ <?php echo next_post_link('%link', 'NEXT'); ?></li>
				 </div>
				 <div class="clearfix"></div>
				 <div class="portfolio-1-wrapper">
				 <div class="grid-sizer"></div>
				 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="portfolio-item web-design">
						<div class="portfolio-thumbnail">
							<?php echo the_post_thumbnail('full'); ?>
								<span class="overthumb"></span>
								<div class="carousel-icon">
								<a href="<?php print  mukam_portfolio_thumbnail_url($post->ID) ?>" data-rel="prettyPhoto" class="prettyPhoto lightzoom">
								<i class="mukam-search"></i>
								</a>
								<a href="<?php the_permalink() ?>" class="postlink">
								<i class="mukam-link"></i>
								</a>
								</div>
						</div>
						<div class="portfolio-content">
							<div class="content-left">
								<h3 class="portfolio-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<?php the_content(); ?>	
							</div>
							<div class="content-right">
								<h3 class="about-project"><?php echo __('About Project', 'mukam'); ?></h3>
								<?php $client = get_post_meta($post->ID, "_client", true); 
								if(!empty($client)) { ?>
								<div class="portfolio-meta"><div class="holder"><i class="mukam-socialman"></i></div><div class="project-meta"><?php echo get_post_meta($post->ID, "_client", true); ?></div></div>
								<?php } ?>
								<div class="portfolio-meta"><div class="holder"><i class="mukam-date"></i></div><div class="project-meta"><?php the_time('j F, Y')?></div></div>
								<?php $website = get_post_meta($post->ID, "_website", true); 
								if(!empty($website)) { ?>
								<div class="portfolio-meta"><div class="holder"><i class="mukam-globe"></i></div><div class="project-meta"><a href="<?php echo get_post_meta($post->ID, "_website", true);?>" target="_blank"><?php echo get_post_meta($post->ID, "_website", true);?></a></div></div>
								<?php } ?>
								<div class="portfolio-meta"><div class="holder"><i class="mukam-label"></i></div><div class="project-meta"><?php the_tags( '', ', ', $after ); ?></div></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</article>
					<?php endwhile; else: ?>
						<p>Sorry, no posts matched your criteria.</p>
 					<?php endif; ?>
 					<?php wp_link_pages('before=<div class="post-page">&after=</div>&link_before=<span>&link_after=</span>'); ?>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	</div> 
</section>
<?php get_footer();?>
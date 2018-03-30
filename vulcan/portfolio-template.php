<?php
/*
Template Name: Portfolio Template
*/
?>

<?php get_header();?>

	 <?php 
    global $post;
    
    $portfolio_page = get_option('vulcan_portfolio_page');
    $portfolio_pid = get_page_by_title($portfolio_page);
    ?>
    
        <!-- BEGIN OF PAGE TITLE -->
        <?php global $post;?>
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
              <div class="title">
                <h1><?php the_title();?></h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                  <?php global $post;?>
                  <?php $short_desc = get_post_meta($post->ID, '_short_desc', true ); ?>
                  <p><?php echo $short_desc;?></p>
                </div>
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-fullwidth">          
                <div class="maincontent">
                
                <!-- Content -->
                <?php $porto_heading = get_option('vulcan_porto_heading');?>
                <h3 class="pf-title"><?php echo stripslashes($porto_heading);?></h3>
              	<div id="pf-view"><a href="#" class="switch_thumb"><?php echo __('Switch Thumb','vulcan');?></a></div>
              	<?php 
              	$porto_text  = get_option('vulcan_porto_text');
              	?>
                <p class="ie6-text"><?php echo stripslashes($porto_text); ?>
                <!-- Content End -->
                
                <!-- Filter  -->
            		<div id="filter">
            			<ul>
            			<li><?php echo __('Filter by :','vulcan');?></li>
            			<li><a <?php if ($post->ID == $portfolio_pid->ID) echo 'class="current"';?> href="<?php echo get_page_link($portfolio_pid->ID); ?>">All</a></li>
            			<?php wp_list_categories('taxonomy=portfolio_category&orderby=ID&title_li=&hide_empty=0'); ?> 
            			</ul>
            		</div><!-- end of filter -->
                
                <!-- Portfolio List -->
                <?php $portfolio_2col = get_option('vulcan_portfolio_2col');?>
                <ul class="display <?php if ($portfolio_2col == "true") echo 'thumb_view';?>">
                    <?php 
                      $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                      $porto_cat = get_option('vulcan_portfolio_cid');
                      $porto_num = (get_option('vulcan_porto_num')) ? get_option('vulcan_porto_num') : 4;
                      $portfolio_order = (get_option('vulcan_portfolio_order')) ? get_option('vulcan_portfolio_order') : "date";
                      
                      query_posts(array( 'post_type' => 'portfolio', 'posts_per_page' => $porto_num, 'paged'=>$page,'orderby'=>$portfolio_order));
                      
                      while ( have_posts() ) : the_post();
                        $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
                        $pf_url = get_post_meta($post->ID, '_portfolio_url', true );     
                        $thumb   = get_post_thumbnail_id();
                        $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                        $image   = aq_resize( $img_url, 431, 180, true ); //resize & crop the image                 
                    	?>                  
                    <li>
                        <div class="content_block">
                            <div class="pf-box-view">
                            <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                            <a href="<?php echo ($pf_link) ? $pf_link : $image;?>" rel="prettyPhoto" title="<?php the_title();?>">
                              <img src="<?php echo $image;?>" alt="" />                      
                            </a>                            
                            <?php } ?>
                            </div>
                            <div style="pf-content">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <p><?php the_excerpt();?></p>
                            
                            <div class="more-button pf">
                              <a href="<?php the_permalink();?>"><?php echo __('Read more','vulcan');?></a>
                            </div>
                            
                            <?php if ($pf_url) { ?> 
                              <div class="more-button pf">
                                <a href="<?php echo $pf_url;?>"><?php echo __('Visit Site','vulcan');?></a>
                              </div> 
                            <?php } ?>
                                    
                          </div>                    
                        </div>
                    </li>
                    <?php endwhile;?>
                </ul>
                
                <div class="clr"></div>
                                                       	     			
                <?php pagination();?>
                                                    
              </div>
            </div>   
            <?php endif;?>     
                  
        </div>
        <!-- END OF CONTENT -->
        <?php wp_reset_query();?>
        <?php get_footer();?>

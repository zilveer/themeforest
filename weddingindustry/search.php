<?php get_header(); ?>

<!--start header parallax image-->
<?php if ($redux_demo['archive_post_header_img_display'] == 1){ ?>

	<section class="nicdark_section" style="background:url(<?php echo esc_url( $redux_demo['archive_post_header_img']['url'] ); ?>); background-size:cover;  background-position:center center;">

	    <div class="nicdark_filter <?php echo esc_attr($redux_demo['archive_post_header_filter']); ?>">

	        <!--start nicdark_container-->
	        <div class="nicdark_container nicdark_clearfix">

	            <div class="grid grid_12">
	                <div class="nicdark_space<?php echo esc_attr($redux_demo['archive_post_header_margintop']); ?>"></div>
	                
	            
	                <?php if (is_category()): ?>
						<h1 class="center white extrasize title"><?php _e('CATEGORY','weddingindustry'); ?></h1><div class="nicdark_space10"></div><h3 class="center subtitle white"><?php single_cat_title(); ?></h3>
					<?php elseif (is_tag()): ?>
						<h1 class="center white extrasize title"><?php _e('TAG','weddingindustry'); ?></h1><div class="nicdark_space10"></div><h3 class="center subtitle white"><?php single_tag_title() ?></h3>
					<?php elseif (is_month()): ?>
						<h1 class="center white extrasize title"><?php _e('ARCHIVE FOR','weddingindustry'); ?></h1><div class="nicdark_space10"></div><h3 class="center subtitle white"><?php single_month_title(); ?></h3>
					<?php elseif (is_author()): ?>
						<h1 class="center white extrasize title"><?php _e('AUTHOR','weddingindustry'); ?></h1><div class="nicdark_space10"></div><h3 class="center subtitle white"><?php the_author(); ?></h3>
					<?php elseif (is_search()): ?>
						<h1 class="center white extrasize title"><?php _e('SEARCH FOR','weddingindustry'); ?></h1><div class="nicdark_space10"></div><h3 class="center subtitle white">" <?php the_search_query(); ?> "</h3>
					<?php else: ?>
						<h1 class="center white extrasize title"><?php _e('ARCHIVE','weddingindustry'); ?></h1>
					<?php endif ?>

	                <div class="nicdark_space<?php echo esc_attr($redux_demo['archive_post_header_marginbottom']); ?>"></div>
	            </div>

	        </div>
	        <!--end nicdark_container-->

	    </div>
	     
	</section>

	<div class="nicdark_space50"></div>


<?php }else{ ?>

	<div class="nicdark_space60"></div>

<?php } ?>
<!--end header parallax image-->


<!--start section-->
<section class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">


    	
			<!--start all posts previews-->
	    	<div class="grid grid_8">
	    	
	    		<?php if(have_posts()) : ?>
							
					<?php while(have_posts()) : the_post(); ?>
						
						<!--#post-->
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<!--START PREVIEW-->
								<?php if (has_post_thumbnail()): ?>
									<div class="nicdark_featured_image">
										<a href="<?php esc_url(the_permalink()); ?>" class="nicdark_btn nicdark_bg_<?php echo esc_attr($redux_demo['metabox_posts_color']); ?> white medium nicdark_absolute_left"><?php the_time('j') ?><br><small><?php the_time('M') ?></small></a>
										<?php the_post_thumbnail('archive-image'); ?>
									</div>
								<?php endif ?>

								<div class="nicdark_textevidence nicdark_bg_greydark">
					                <div class="nicdark_size_big">
					                    <p class="white"><i class="icon-calendar nicdark_marginright10"></i><?php the_time('j') ?> <?php the_time('M') ?> <span class="greydark2 nicdark_margin010">|</span> <i class="icon-user nicdark_marginright10"></i><?php the_author(); ?> <span class="greydark2 nicdark_margin010">|</span> <i class="icon-chat nicdark_marginright10"></i><?php comments_number(__('No Comments','weddingindustry'),__('One Comment','weddingindustry'),__( '% Comments','weddingindustry') );?></p>
					                </div>
					            </div>
					            
					            <div class="nicdark_focus nicdark_border_grey nicdark_sizing nicdark_padding20">
					            	<h2><?php the_title(); ?></h2>
					            	<div class="nicdark_space20"></div>
					            	<div class="nicdark_divider left small"><span class="nicdark_bg_grey2 "></span></div>
					            	<div class="nicdark_space20"></div>
					            	<p><?php the_excerpt(); ?></p>
					            	<div class="nicdark_space20"></div>
					            	<a class="nicdark_btn nicdark_press nicdark_bg_<?php echo esc_attr($redux_demo['metabox_posts_color']); ?> white medium  " href="<?php esc_url(the_permalink()); ?>"><?php _e('READ MORE','weddingindustry'); ?></a>
								</div>
								<!--END PREVIEW-->

						</div>
						<!--#post-->

						<div class="nicdark_space50"></div>
							
							
					<?php endwhile; ?>
							
				
				<?php else: ?>
	
					<?php $nicdark_search_message = __('NOTHING FOUND: Search again','weddingindustry'); ?>
		            <div class="nicdark_alerts nicdark_bg_orange ">
		                <p class="white nicdark_size_big"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_attr($nicdark_search_message); ?></p>
		            </div>
				
				<?php endif; ?>

	    	</div>
	    	<!--end all posts previews-->

	    	<!--sidebar-->
	    	<div class="grid grid_4">
	    		<?php if ( ! dynamic_sidebar( 'Sidebar' ) ) : ?><?php endif ?>
	    	</div>
	    	<!--end sidebar-->



	</div>
	<!--end container-->

</section>
<!--end section-->


<!--start pagination-->
<div class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="nicdark_space40"></div>

        <div class="grid grid_6 nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
        	<?php previous_posts_link('PREV') ?>
        </div>
        <div class="grid grid_6 nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
        	<?php next_posts_link('NEXT') ?>
        </div>

        <div class="nicdark_space50"></div>

    </div>
    <!--end nicdark_container-->
            
</div>
<!--end pagination-->


<?php get_footer(); ?>
<?php
/**
 * @package WordPress
 * @subpackage Delight
 */
?>
    </div><!-- #body -->
    <footer data-position="fixed" data-bottom="0" data-top="not">
<?php if(get_pix_option('pix_footer_show')=='show'){ ?>
        <div>
            	<span id="credits_blog"><a id="logo_bottom" href="<?php echo home_url( '/' ); ?>" title="<?php echo stripslashes(get_pix_option( 'pix_site_title' )); ?>" style="display:block"><?php echo stripslashes(get_pix_option('pix_footer_sitetitle')); ?></a> <?php echo stripslashes(get_pix_option('pix_footer_credits')); ?></span><!-- #credits_blog -->
    
    <?php 
		global $custom_options; $meta_image = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE); 
		$the_category = get_query_var('cat');
		$the_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if($the_term){
			$the_term = $the_term->term_id;
		}

		if (((is_home() || is_front_page()) && get_pix_option('pix_home_background') == 'slideshow' && !is_page())
		||
		((is_home() || is_front_page()) && (get_pix_option('pix_home_background') == 'default' ||get_pix_option('pix_home_background') == '') && get_pix_option('pix_general_background')=='slideshow'	&& !is_page())
		||
		((is_single() || is_page()) && isset($meta_image['background']) && $meta_image['background']=='slideshow')
		||
		((is_single() || is_page()) && isset($meta_image['background']) && ($meta_image['background']=='default' || $meta_image['background']=='') && get_pix_option('pix_general_background')=='slideshow')
		||
		(is_tax() && get_pix_option('pix_array_term_slide_'.$the_term)=='slideshow')
		||
		(is_tax() && get_pix_option('pix_array_term_slide_'.$the_term)=='default' && get_pix_option('pix_general_background')=='slideshow')
		||
		(is_archive() && get_pix_option('pix_archive_slide')=='slideshow' && !is_category() && !is_tax())
		||
		(is_archive() && get_pix_option('pix_archive_slide')=='default' && get_pix_option('pix_general_background')=='slideshow'	&& !is_category() && !is_tax())
		||
		(is_category() && get_pix_option('pix_array_category_slide_'.$the_category)=='slideshow'		)
		||
		(is_category() && get_pix_option('pix_array_category_slide_'.$the_category)=='default' && get_pix_option('pix_general_background')=='slideshow'	)
		||
		(is_search() && get_pix_option('pix_searchpage_slide')=='slideshow'	)
		||
		(is_search() && get_pix_option('pix_searchpage_slide')=='default' && get_pix_option('pix_general_background')=='slideshow'	)
		||
		(is_404() && get_pix_option('pix_404_slide')=='slideshow'	)
		||
		(is_404() && get_pix_option('pix_404_slide')=='default' && get_pix_option('pix_general_background')=='slideshow')	
		) { ?>
       
    
            <?php if(get_pix_option('pix_footerthumbnail_show')=='show'){ ?>
            <div id="navgallery_wrap" class="jThumbnailScroller">
            	<div id="navgallery_wrapper" class="jTscrollerContainer">
                    <ul class="navgallery jTscroller">
                    </ul><!-- .navgallery -->
                </div><!-- #navgallery_wrapper -->
            </div><!-- #navgallery_wrap -->
			<?php } ?>
            <?php if(get_pix_option('pix_photocredits_show')=='show' || get_pix_option('pix_photocommands_show')=='show' || get_pix_option('pix_footerthumbnail_show')=='show'){ ?><div id="pix_controls">
                <?php if(get_pix_option('pix_footerthumbnail_show')=='show'){ ?><a href="#" id="pix_show_thumbs"><?php _e('Show thumbs','delight'); ?></a>&nbsp;&nbsp;&nbsp;<?php } ?><?php if(get_pix_option('pix_photocredits_show')=='show'){ ?><a class="pix_clue_credits" href="#"><?php _e('Photo Credits','delight'); ?></a>&nbsp;&nbsp;&nbsp;<?php } ?>
                <?php if(get_pix_option('pix_photocommands_show')=='show'){ ?><span id="pix_prev_slide" style="visibility:visible">&laquo;</span> <span id="pixwall_delight_stop" style="visibility:visible">=</span><span id="pixwall_delight_play" style="visibility:visible">?</span> <span id="pix_next_slide" style="visibility:visible">&raquo;</span><?php } ?>
            </div><!-- #pix_controls --><?php } ?>
                <div id="hide_credits_pictures"><div id="pix_credits_pictures"><!-- pix_credits_hide --></div></div>

    
    <?php } else if ((is_home()) && get_pix_option('pix_home_background') == 'video'
		||
		(is_home()) && get_pix_option('pix_home_background') == 'default' && get_pix_option('pix_general_background')=='video'		
		||
		(is_single() || is_page()) && isset($meta_image['background']) && $meta_image['background']=='video'
		||
		(is_single() || is_page()) && isset($meta_image['background']) && $meta_image['background']=='default' && get_pix_option('pix_general_background')=='video'
		||
		is_tax() && get_pix_option('pix_array_term_slide_'.$the_term)=='video'
		||
		is_tax() && get_pix_option('pix_array_term_slide_'.$the_term)=='default' && get_pix_option('pix_general_background')=='video'
		||
		is_archive() && get_pix_option('pix_archive_slide')=='video' && !is_category() && !is_tax()
		||
		is_archive() && get_pix_option('pix_archive_slide')=='default' && get_pix_option('pix_general_background')=='video'	&& !is_category() && !is_tax()
		||
		is_category() && get_pix_option('pix_array_category_slide_'.$the_category)=='video'		
		||
		is_category() && get_pix_option('pix_array_category_slide_'.$the_category)=='default' && get_pix_option('pix_general_background')=='video'	
		||
		is_search() && get_pix_option('pix_searchpage_slide')=='video'	
		||
		is_search() && get_pix_option('pix_searchpage_slide')=='default' && get_pix_option('pix_general_background')=='video'	
		||
		is_404() && get_pix_option('pix_404_slide')=='video'	
		||
		is_404() && get_pix_option('pix_404_slide')=='default' && get_pix_option('pix_general_background')=='video'	
		) { ?>
            <?php if(get_pix_option('pix_photocredits_show')=='show' || get_pix_option('pix_photocommands_show')=='show'){ ?><div id="pix_controls">
                <?php if(get_pix_option('pix_photocredits_show')=='show'){ ?><a class="pix_clue_credits" href="#"><?php _e('Video Credits','delight'); ?></a>&nbsp;&nbsp;<?php } ?>
                <?php if(get_pix_option('pix_photocommands_show')=='show'){ ?><span style="display:inline-block; position:relative; width:10px"><span id="pix_play_slide" style="display:none">?</span><span id="pix_pause_slide" style="display:none">=</span><span id="pix_resume_slide" style="display:none">?</span></span>&nbsp;&nbsp;<span style="display:inline-block; position:relative; width:20px"><span id="pix_unmute_slide"  style="display:none">A</span><span id="pix_mute_slide">B</span></span><?php } ?>
            </div><!-- #pix_controls --><?php } ?>

    
    <?php } ?>
    
        </div><!-- generic footer div -->
<?php } ?>
    </footer>
    <?php
        wp_footer();
		
		echo stripslashes(get_pix_option('pix_google_analytics'));
    ?>
</body>
</html>
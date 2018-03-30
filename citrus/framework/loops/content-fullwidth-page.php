<!-- #post-<?php the_ID(); ?> -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_content(); 
	  wp_link_pages( array(	'before'			=>	'<div class="page-link">',
	  						'after'				=>	'</div>',
							'link_before'		=>	'<span>',
							'link_after'		=>	'</span>',
							'next_or_number'	=>	'number',
							'pagelink' 			=>	'%',
							'echo' 				=>	1 ) );
	 
	 echo '<div class="dt-sc-margin10"></div>';
	 echo '<div class="container">';
		 echo '<div class="social-bookmark">';
				show_fblike('page');
				show_googleplus('page');
				show_twitter('page');
				show_stumbleupon('page');
				show_linkedin('page');
				show_delicious('page');
				show_pintrest('page');
				show_digg('page');
		 echo '</div>';	
								
		 echo '<div class="social-share">';						
				dttheme_social_bookmarks('sb-page');
		 echo '</div>';
		 edit_post_link( __( ' Edit ','dt_themes' ) );
	 echo '</div>';
	 
	 ?>
</div><!-- #post-<?php the_ID(); ?> -->

<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $dttheme_options = get_option(IAMD_THEME_SETTINGS);
	  $dttheme_general = $dttheme_options['general'];
	  
  	  $globally_disable_page_comment =  array_key_exists('disable-page-comment',$dttheme_general) ? true : false;
	  if( (!$globally_disable_page_comment) && (isset($tpl_default_settings['comment'])) ): ?>
          <!-- **Comment Entries** -->
          <div class="container">  
              <div class="dt-sc-margin40"></div> 	
<?php  			comments_template('', true); ?> 
      	  </div><!-- **Comment Entries - End** -->
<?php endif;?>
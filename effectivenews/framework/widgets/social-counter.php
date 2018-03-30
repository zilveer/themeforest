<?php 

add_action('widgets_init','mom_social_counter');

function mom_social_counter() {
	register_widget('mom_social_counter');
	}

class mom_social_counter extends WP_Widget {
	function mom_social_counter() {
			
		$widget_ops = array('classname' => 'momizat-social_counter','description' => __('Widget display a count of your social networks followers/fans numbers','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		parent::__construct('momizatSocialCounter',__('Effective - Social Counter','theme'),$widget_ops);

		}
	
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$rss_text = $instance['rss_text'];
	$rss_link = $instance['rss_link'];
	$twitter = $instance['twitter'];
	$facebook = $instance['facebook'];
	$googlep = $instance['googlep'];
	$dribbble = $instance['dribbble'];
	$youtube = $instance['youtube'];
	$vimeo = $instance['vimeo'];
	$soundcloud = $instance['soundcloud'];
	$instagram = $instance['instagram'];
	$behance = $instance['behance'];
	$delicious = $instance['delicious'];
	$pinterest = $instance['pinterest'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

if ($rss_link == '') {
	$rss_link = get_bloginfo('rss2_url');
}

?>

                        <div class="mom-socials-counter">
                            <ul>
                                <?php if ($rss_text != '') { ?>
                                    <li class="msc-item msc-rss">
                                        <a href="<?php echo $rss_link; ?>"><div class="sc-head">
                                            <i class="fa-icon-rss"></i>
                                        </div>
                                        </a>
                                        <div class="sc-count">
                                            <span><?php echo $rss_text; ?></span>
                                            <?php _e('Subscribers', 'theme'); ?>
                                        </div>
                                    </li>
                                <?php } ?>

                                <?php if ($facebook != '') { ?>
                                <li class="msc-item msc-facebook">
                                    <a href="<?php echo mom_sc_facebook($facebook, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="fa-icon-facebook"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_facebook($facebook); ?></span>
                                        <?php _e('fans', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($twitter != '') { ?>
                                <li class="msc-item msc-twitter">
                                    <a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="fa-icon-twitter"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_twitter($twitter); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($googlep != '') { ?>
                                <li class="msc-item msc-googlePlus">
                                    <a href="<?php echo mom_sc_googleplus($googlep, 'link'); ?>"  target="_blank">
                                        <div class="sc-head">
                                        <i class="fa-icon-google-plus"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_googleplus($googlep); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($dribbble != '') { ?>
                                <li class="msc-item msc-dribbble">
                                    <a href="<?php echo mom_sc_dribbble($dribbble, 'link'); ?>" target="_blank">
                                        <div class="sc-head">
                                        <i class="fa-icon-dribbble"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_dribbble($dribbble); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($youtube != '') { ?>
                                <li class="msc-item msc-youtube">
                                    <a href="<?php echo mom_sc_youtube($youtube, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="fa-icon-youtube"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_youtube($youtube); ?></span>
                                        <?php _e('Subscribers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($vimeo != '') { ?>
                                <li class="msc-item msc-vimeo">
                                    <a href="<?php echo mom_sc_vimeo($vimeo, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="momizat-icon-vimeo"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_vimeo($vimeo); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($pinterest != '') { ?>
                                <li class="msc-item msc-pinterest">
                                    <a href="<?php echo $pinterest; ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="momizat-icon-pinterest"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_pinterest($pinterest); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>
				
                                <?php if ($instagram != '') { ?>
                                <li class="msc-item msc-instagram">
                                    <a href="<?php echo mom_sc_instagram($instagram, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="fa-icon-instagram"></i>
                                    </div>
				    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_instagram($instagram); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($soundcloud != '') { ?>
                                <li class="msc-item msc-soundcloud">
                                    <a href="<?php echo mom_sc_soundcloud($soundcloud, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="momizat-icon-soundcloud"></i>
                                    </div>
                                    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_soundcloud($soundcloud); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>
				
				<?php if ($behance != '') { ?>
                                <li class="msc-item msc-behance">
                                    <a href="<?php echo mom_sc_behance($behance, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="enotype-icon-behance"></i>
                                    </div>
				    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_behance($behance); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
                                <?php } ?>

                                <?php if ($delicious != '') { ?>
                                <li class="msc-item msc-delicious">
                                    <a href="<?php echo mom_sc_delicious($delicious, 'link'); ?>" target="_blank">
                                    <div class="sc-head">
                                        <i class="momizat-icon-delicious"></i>
                                    </div>
				    </a>
                                    <div class="sc-count">
                                        <span><?php echo mom_sc_delicious($delicious); ?></span>
                                        <?php _e('followers', 'theme'); ?>
                                    </div>
                                </li>
				<?php } ?>
                            </ul>
                        </div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['rss_text'] = $new_instance['rss_text'];
			$instance['rss_link'] = $new_instance['rss_link'];
			$instance['twitter'] = $new_instance['twitter'];
			$instance['facebook'] = $new_instance['facebook'];
			$instance['googlep'] = $new_instance['googlep'];
			$instance['dribbble'] = $new_instance['dribbble'];
			$instance['youtube'] = $new_instance['youtube'];
			$instance['vimeo'] = $new_instance['vimeo'];
			$instance['soundcloud'] = $new_instance['soundcloud'];
			$instance['instagram'] = $new_instance['instagram'];
			$instance['behance'] = $new_instance['behance'];
			$instance['delicious'] = $new_instance['delicious'];
			$instance['pinterest'] = $new_instance['pinterest'];


                    delete_transient('mom_twitter_followers');
        delete_transient('mom_facebook_followers');
        delete_transient('mom_facebook_page_url');
        delete_transient('mom_googleplus_followers');
        delete_transient('mom_googleplus_page_url');
        delete_transient('mom_dribbble_followers');
        delete_transient('mom_dribbble_page_url');
         delete_transient('mom_youtube_followers');
        delete_transient('mom_youtube_page_url');
        delete_transient('mom_vimeo_followers');
        delete_transient('mom_vimeo_page_url');
        delete_transient('mom_soundcloud_followers');
        delete_transient('mom_soundcloud_page_url');
        delete_transient('mom_behance_followers');
        delete_transient('mom_behance_page_url');
        delete_transient('mom_instagram_followers');
        delete_transient('mom_instagram_page_url');
        delete_transient('mom_delicious_followers');
        delete_transient('mom_delicious_page_url');
        delete_transient('mom_pinterest_followers');
        
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Socials Counter', 'theme'),
			'rss_text' => '1000+',
			'rss_link' => '',
			'twitter' => '',
			'facebook' => 'effectivews',
			'googlep' => '',
			'dribbble' => '',
			'youtube' => '',
			'vimeo' => '',
			'soundcloud' => '',
			'instagram' => '',
			'behance' => '',
			'delicious' => '',
			'pinterest' => '',
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
                
                
                ?>
	<div class="mom_meta_note">
		<p><?php _e("Before add this widget you must make sure you fill all required data in theme options -> <a target='_blank' href='".admin_url('?page=momizat_options&tab=5')."'>API's Authentication</a>", "theme"); ?> </p>
	</div>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_text' ); ?>"><?php _e('rss number or text', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'rss_text' ); ?>" name="<?php echo $this->get_field_name( 'rss_text' ); ?>" value="<?php echo $instance['rss_text']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_link' ); ?>"><?php _e('RSS Link (leave empty to use default rss link)', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'rss_link' ); ?>" name="<?php echo $this->get_field_name( 'rss_link' ); ?>" value="<?php echo $instance['rss_link']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Name', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('facebook page ID (<a target="_blank" href="http://hellboundbloggers.com/2010/07/10/find-facebook-profile-and-page-id/">more Info</a>)', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'googlep' ); ?>"><?php _e('google+ ID', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'googlep' ); ?>" name="<?php echo $this->get_field_name( 'googlep' ); ?>" value="<?php echo $instance['googlep']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e('dribbble username', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtub channel name', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo channel name', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('pinterest full URL (Beta)', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><?php _e('Soundcloud name', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php echo $instance['soundcloud']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e('Behance username', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo $instance['behance']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious username', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" class="widefat" />
		</p>
		<p><a href="#" class="button delete-sc-cache"><?php _e('Delete cache', 'theme'); ?></a><span></span><br><small><?php _e('Your socials numbers is saved in the cache each hour if you want delete the cache now click on this button', 'theme'); ?></small></p>

   <?php 
}
	} //end class
<?php
	wp_reset_query();
	
	// author id
	$user_ID = get_the_author_meta('ID');

	//social
	$twitter = get_user_meta($user_ID, 'twitter', true);
	$facebook = get_user_meta($user_ID, 'facebook', true);
	$google = get_user_meta($user_ID, 'google', true);
	$youtube = get_user_meta($user_ID, 'youtube', true);
	$dribbble = get_user_meta($user_ID, 'dribbble', true);
	$linkedin = get_user_meta($user_ID, 'linkedin', true);

	$user_post_count = count_user_posts( $user_ID );

?>


<?php if(df_option_compare('aboutPostAuthor','aboutPostAuthor',$post->ID)==true) { ?>
	<?php if(!is_author()) { ?>
		<!-- Panel title -->
		<div class="panel_title">
		    <div>
		        <h4><?php echo esc_html__("About author", THEME_NAME);?></h4>
		    </div>
		</div>
	<?php } ?>
	<!-- Author box -->
	<div class="author_box">
		<?php if(df_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100))) { ?>
	    	<img src="<?php echo esc_url(df_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100)));?>" alt="<?php echo esc_attr__(get_the_author_meta('display_name',$user_ID)); ?>" />
	    <?php } ?>
	    <div class="description">
	        <a class="bio" href="<?php $user_info = get_userdata($user_ID); echo esc_url(get_author_posts_url($user_ID, $user_info->user_nicename )); ?>">
				<?php echo esc_html__(get_the_author_meta('display_name',$user_ID)); ?>
				<span class="posts"><?php echo esc_html($user_post_count);?> <?php esc_html_e("posts", THEME_NAME);?></span>
	        </a>
	        <p><span class='vcard author'><span class='fn'><?php echo esc_html__(get_the_author_meta('description')); ?></span></span></p>
	        <ul class="social_icons">
	            <?php if($facebook) { ?><li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
	            <?php if($twitter) { ?><li><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
	            <?php if($dribbble) { ?><li><a href="<?php echo esc_url($dribbble);?>"><i class="fa fa-dribbble"></i></a></li><?php } ?>
	            <?php if($youtube) { ?><li><a href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a></li><?php } ?>
	            <?php if($google) { ?><li><a href="<?php echo esc_url($google);?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
	            <?php if($linkedin) { ?><li><a href="<?php echo esc_url($linkedin);?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
	        </ul>
	        <a class="view_all" href="<?php $user_info = get_userdata($user_ID); echo esc_url(get_author_posts_url($user_ID, $user_info->user_nicename )); ?>">
	        	<?php esc_html__("View all posts by this author &rarr;", THEME_NAME);?>
	        </a>
	    </div>
	</div>
<?php } ?>
<?php wp_reset_query(); ?>
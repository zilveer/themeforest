<?php
    //Display top social icons
    //Check if open link in new window
    $tg_topbar_social_link = kirki_get_option('tg_topbar_social_link');
?>
<div class="social_wrapper">
    <ul>
    	<?php
    		$pp_facebook_url = get_option('pp_facebook_url');
    		
    		if(!empty($pp_facebook_url))
    		{
    	?>
    	<li class="facebook"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> href="<?php echo esc_url($pp_facebook_url); ?>"><i class="fa fa-facebook-official"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_twitter_username = get_option('pp_twitter_username');
    		
    		if(!empty($pp_twitter_username))
    		{
    	?>
    	<li class="twitter"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo esc_attr($pp_twitter_username); ?>"><i class="fa fa-twitter"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_flickr_username = get_option('pp_flickr_username');
    		
    		if(!empty($pp_flickr_username))
    		{
    	?>
    	<li class="flickr"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo esc_attr($pp_flickr_username); ?>"><i class="fa fa-flickr"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_youtube_url = get_option('pp_youtube_url');
    		
    		if(!empty($pp_youtube_url))
    		{
    	?>
    	<li class="youtube"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Youtube" href="<?php echo esc_url($pp_youtube_url); ?>"><i class="fa fa-youtube"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_vimeo_username = get_option('pp_vimeo_username');
    		
    		if(!empty($pp_vimeo_username))
    		{
    	?>
    	<li class="vimeo"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo esc_attr($pp_vimeo_username); ?>"><i class="fa fa-vimeo-square"></i></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_tumblr_username = get_option('pp_tumblr_username');
    		
    		if(!empty($pp_tumblr_username))
    		{
    	?>
    	<li class="tumblr"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo esc_attr($pp_tumblr_username); ?>.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_google_url = get_option('pp_google_url');
    		
    		if(!empty($pp_google_url))
    		{
    	?>
    	<li class="google"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo esc_url($pp_google_url); ?>"><i class="fa fa-google-plus"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_dribbble_username = get_option('pp_dribbble_username');
    		
    		if(!empty($pp_dribbble_username))
    		{
    	?>
    	<li class="dribbble"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo esc_attr($pp_dribbble_username); ?>"><i class="fa fa-dribbble"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_linkedin_url = get_option('pp_linkedin_url');
    		
    		if(!empty($pp_linkedin_url))
    		{
    	?>
    	<li class="linkedin"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo esc_url($pp_linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
            $pp_pinterest_username = get_option('pp_pinterest_username');
            
            if(!empty($pp_pinterest_username))
            {
        ?>
        <li class="pinterest"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo esc_attr($pp_pinterest_username); ?>"><i class="fa fa-pinterest"></i></a></li>
        <?php
            }
        ?>
        <?php
        	$pp_instagram_username = get_option('pp_instagram_username');
        	
        	if(!empty($pp_instagram_username))
        	{
        ?>
        <li class="instagram"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo esc_attr($pp_instagram_username); ?>"><i class="fa fa-instagram"></i></a></li>
        <?php
        	}
        ?>
        <?php
        	$pp_behance_username = get_option('pp_behance_username');
        	
        	if(!empty($pp_behance_username))
        	{
        ?>
        <li class="behance"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Behance" href="http://behance.net/<?php echo esc_attr($pp_behance_username); ?>"><i class="fa fa-behance-square"></i></a></li>
        <?php
        	}
        ?>
        <?php
		    $pp_500px_url = get_option('pp_500px_url');
		    
		    if(!empty($pp_500px_url))
		    {
		?>
		<li class="500px"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="500px" href="<?php echo esc_url($pp_500px_url); ?>"><i class="fa fa-500px"></i></a></li>
		<?php
		    }
		?>
    </ul>
</div>
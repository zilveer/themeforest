<?php global $mango_settings;
 ?>
<div class="social-icons">
    <?php if ( !empty($mango_settings[ 'mango_mail' ] )): ?>
        <a class="social-icon icon-mail" href="mailto:<?php echo esc_attr ( $mango_settings[ 'mango_mail' ] ); ?>" target="_blank"><i class="fa fa-envelope"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_fb' ]) ): ?>
        <a class="social-icon icon-facebook" href="<?php echo esc_url ( $mango_settings[ 'mango_fb' ] ); ?>" target="_blank">
            <i class="fa fa-facebook"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_twitter' ]) ): ?>
        <a class="social-icon icon-twitter" href="<?php echo esc_url ( $mango_settings[ 'mango_twitter' ] ); ?>" target="_blank">
            <i class="fa fa-twitter"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_gmail' ]) ): ?>
        <a class="social-icon icon-google" href="<?php echo esc_url ( $mango_settings[ 'mango_gmail' ] ); ?>" target="_blank">
            <i class="fa fa-google-plus"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_li' ] )): ?>
        <a class="social-icon icon-linkedin" href="<?php echo esc_url ( $mango_settings[ 'mango_li' ] ); ?>" target="_blank">
            <i class="fa fa-linkedin"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_pin' ] )): ?>
        <a class="social-icon icon-pinterest" href="<?php echo esc_url ( $mango_settings[ 'mango_pin' ] ); ?>" target="_blank">
            <i class="fa fa-pinterest"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_vimeo' ] )): ?>
        <a class="social-icon icon-vimeo" href="<?php echo esc_url ( $mango_settings[ 'mango_vimeo' ] ); ?>" target="_blank">
            <i class="fa fa-vimeo-square"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_youtube' ]) ): ?>
        <a class="social-icon icon-youtube" href="<?php echo esc_url ( $mango_settings[ 'mango_youtube' ] ); ?>" target="_blank">
            <i class="fa fa-youtube"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_flickr' ]) ): ?>
        <a class="social-icon icon-flickr" href="<?php echo esc_url ( $mango_settings[ 'mango_flickr' ] ); ?>" target="_blank">
            <i class="fa fa-flickr"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_instagram' ] )): ?>
        <a class="social-icon icon-instagram" href="<?php echo esc_url ( $mango_settings[ 'mango_instagram' ] ); ?>" target="_blank">
            <i class="fa fa-instagram"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_behance' ] )): ?>
        <a class="social-icon icon-behance"
               href="<?php echo esc_url ( $mango_settings[ 'mango_behance' ] ); ?>" target="_blank">
            <i class="fa fa-behance"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_dribbble' ] )): ?>
        <a class="social-icon icon-dribbble" href="<?php echo esc_url ( $mango_settings[ 'mango_dribbble' ] ); ?>" target="_blank">
            <i class="fa fa-dribbble"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_skype' ] )): ?>
        <a class="social-icon icon-skype" href="skype:<?php echo ( $mango_settings[ 'mango_skype' ] ); ?>?chat">
            <i class="fa fa-skype"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_skype_tell' ] )): ?>
        <a class="social-icon icon-skypecall" href="tel:<?php echo ( $mango_settings[ 'mango_skype_tell' ] ); ?>">
            <i class="fa fa-phone-square"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_soundcloud' ] )): ?>
        <a class="social-icon icon-soundcloud" href="<?php echo esc_url ( $mango_settings[ 'mango_soundcloud' ] ); ?>" target="_blank">
            <i class="fa fa-soundcloud"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_yelp' ] )): ?>
        <a class="social-icon icon-yelp" href="<?php echo esc_url ( $mango_settings[ 'mango_yelp' ] ); ?>" target="_blank">
            <i class="fa fa-yelp"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_tumblr' ] )): ?>
        <a class="social-icon icon-tumblr" href="<?php echo esc_url ( $mango_settings[ 'mango_tumblr' ] ); ?>" target="_blank">
            <i class="fa fa-tumblr"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_deviantart' ] )): ?>
        <a class="social-icon icon-deviantart" href="<?php echo esc_url ( $mango_settings[ 'mango_deviantart' ] ); ?>" target="_blank">
            <i class="fa fa-deviantart"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_weibo' ] )): ?>
        <a class="social-icon icon-weibo" href="<?php echo esc_url ( $mango_settings[ 'mango_weibo' ] ); ?>" target="_blank">
            <i class="fa fa-weibo"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_github' ] )): ?>
        <a class="social-icon icon-github"
               href="<?php echo esc_url ( $mango_settings[ 'mango_github' ] ); ?>" target="_blank">
            <i class="fa fa-github"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_slideshare' ] )): ?>
        <a class="social-icon icon-slideshare" href="<?php echo esc_url ( $mango_settings[ 'mango_slideshare' ] ); ?>" target="_blank">
            <i class="fa fa-slideshare"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_reddit' ] )): ?>
        <a class="social-icon icon-reddit" href="<?php echo esc_url ( $mango_settings[ 'mango_reddit' ] ); ?>" target="_blank">
            <i class="fa fa-reddit"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_digg' ] )): ?>
        <a class="social-icon icon-digg" href="<?php echo esc_url ( $mango_settings[ 'mango_digg' ] ); ?>" target="_blank">
            <i class="fa fa-digg"></i></a>
    <?php endif; ?>
	
    <?php if ( !empty($mango_settings[ 'mango_xing' ] )): ?>
        <a class="social-icon icon-xing" href="<?php echo esc_url ( $mango_settings[ 'mango_xing' ] ); ?>" target="_blank">
            <i class="fa fa-xing"></i></a>
    <?php endif; ?>
</div>
    <ul class="mom-social-icons">
        <?php if(mom_option('twitter_url') != '') { ?>
            <li class="twitter"><a target="_blank" class="vector_icon" href="<?php echo mom_option('twitter_url'); ?>"><i class="fa-icon-twitter"></i></a></li>
        <?php } ?>

        <?php if(mom_option('facebook_url') != '') { ?>
        <li class="facebook"><a target="_blank" class="vector_icon" href="<?php echo mom_option('facebook_url'); ?>"><i class="fa-icon-facebook "></i></a></li>        
        <?php } ?>

        <?php if(mom_option('gplus_url') != '') { ?>
           <li class="gplus"><a target="_blank" class="vector_icon" href="<?php echo mom_option('gplus_url'); ?>" ><i class="fa-icon-google-plus"></i></a></li>     
        <?php } ?>

        <?php if(mom_option('linkedin_url') != '') { ?>
                <li class="linkedin"><a target="_blank" class="vector_icon" href="<?php echo mom_option('linkedin_url'); ?>"><i class="fa-icon-linkedin"></i></a></li>
        <?php } ?>

        <?php if(mom_option('youtube_url') != '') { ?>
                <li class="youtube"><a target="_blank" class="vector_icon" href="<?php echo mom_option('youtube_url'); ?>"><i class="fa-icon-youtube"></i></a></li>
        <?php } ?>
        <?php if(mom_option('skype_url') != '') { ?>
	       <li class="skype"><a target="_blank" class="vector_icon" href="skype:<?php echo mom_option('skype_url'); ?>?call"><i class="fa-icon-skype"></i></a></li>
        <?php } ?>


        <?php if(mom_option('flickr_url') != '') { ?>
                <li class="flickr"><a target="_blank" class="vector_icon" href="<?php echo mom_option('flickr_url'); ?>"><i class="fa-icon-flickr"></i></a></li>
        <?php } ?>


        <?php if(mom_option('picasa_url') != '') { ?>
        <li class="picasa"><a target="_blank" class="vector_icon" href="<?php echo mom_option('picasa_url'); ?>"><i class="momizat-icon-picassa"></i></a></li>
        <?php } ?>

        <?php if(mom_option('vimeo_url') != '') { ?>
        <li class="vimeo"><a target="_blank" class="vector_icon" href="<?php echo mom_option('vimeo_url'); ?>"><i class="momizat-icon-vimeo"></i></a></li>
        <?php } ?>

        <?php if(mom_option('tumblr_url') != '') { ?>
        <li class="tumblr"><a target="_blank" class="vector_icon" href="<?php echo mom_option('tumblr_url'); ?>"><i class="fa-icon-tumblr"></i></a></li>
        <?php } ?>
        <?php if(mom_option('rss_on_off') != false) { ?>
             <li class="rss"><a target="_blank" class="vector_icon" href="<?php bloginfo( 'rss2_url' ); ?>"><i class="fa-icon-rss"></i></a></li>
        <?php } ?>	
	<?php
	    //print_r(mom_option('social_icons'));
	    $icons = mom_option('custom_social_icons');
	    if (isset($icons) && $icons != false) {
	    foreach ($icons as $icon) {
		if ( (isset($icon['image']) &&  $icon['image'] != '') || (isset($icon['icon']) &&  $icon['icon'] != '')) {
		echo '<li>';
		    
		    if ($icon['image'] == '' && $icon['icon'] != '') {
			$bgcolorh = isset($icon['bgcolorh']) ? $icon['bgcolorh'] : '';
			if ($bgcolorh != '') {
			    $bgcolorh = 'data-bghover="'.$bgcolorh.'"';
			}
			echo '<a target="_blank" class="vector_icon" rel="'.$icon['icon'].'" href="'.$icon['url'].'"'.$bgcolorh.'><i class="'.$icon['icon'].'"></i></a>';
		    } else {
			echo '<a target="_blank" class="vector_icon" href="'.$icon['url'].'"><img src="'.$icon['image'].'" alt=""></i></a>';
		    }

		echo '</li>';
		}
	    }
	    }
	?>
    </ul>
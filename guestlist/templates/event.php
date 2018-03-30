
			<h1><?php the_title();  ?></h1>
			<h4><?php echo $subtitle; ?></h4>
		
			<ul class="event_info">
				<li class="date"><?php echo date("F jS Y, H:i", $eventdate) ?></li>
				<li class="currency" style="background-image: url(<?php bloginfo('stylesheet_directory') ?>/images/event/currency/<?php echo $eventcurrency ?>);"><?php echo $eventprice ?></li> <!-- euro, dollar are possible css classes -->
				<li class="location"><a href="<?php bloginfo('stylesheet_directory') ?>/maps.php?address=<?php echo urlencode($eventlocation) ?>" class="ajax"><?php echo __('How to find us', $bSettings->getPrefix()) ?></a></li>
			</ul>
		
			<div class="event_content">
                <div id="event_scrollbar">
                    <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                    <div class="viewport">
                        <div class="overview">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>	
			</div>
            <?php 
                if($bSettings->get('social_media_enable') == "on"):
            ?>        
            <ul class="social_media">
                <?php 
                    if($bSettings->get('social_facebook_enable') == "on"): 
                        $link_facebook = BebelUtils::getCustomMeta('event_facebook_url', '', get_the_ID());
                        if($link_facebook == '')
                        {
                            $link_facebook = $bSettings->get('social_facebook_url');
                        }
                        if($link_facebook != ''):
                ?>
                <li><a href="<?php echo $link_facebook ?>" class="facebook"></a></li>
                <?php 
                    endif;
                endif; ?>
                <?php 
                    if($bSettings->get('social_twitter_enable') == "on"): 
                        $link_twitter = BebelUtils::getCustomMeta('event_twitter_url', '', get_the_ID());
                        if($link_twitter == '')
                        {
                            $link_twitter = $bSettings->get('social_twitter_url');
                        }
                        if($link_twitter != ''):
                ?>
                <li><a href="<?php echo $link_twitter ?>" class="twitter"></a></li>
                <?php 
                    endif;
                 endif; ?>
                <?php 
                    if($bSettings->get('social_linkedin_enable') == "on"): 
                        $link_linkedin = BebelUtils::getCustomMeta('event_linkedin_url', '', get_the_ID());
                        if($link_linkedin == '')
                        {
                            $link_linkedin = $bSettings->get('social_linkedin_url');
                        }
                        if($link_linkedin != ''):
                ?>
                <li><a href="<?php echo $link_linkedin ?>" class="linkedin"></a></li>
                <?php 
                    endif;
                endif; ?>
            </ul>        
            <?php        
                endif;
                if($startdate <= time() && $enddate >= time()):
                $lost_code_link = BebelUtils::addParameterToPermalink(get_permalink(), array('step' => 'lost_code'));
            ?>
            <a href="<?php echo $lost_code_link ?>" class="lostcodelink"><?php _e('Lost your access code?', $bSettings->getPrefix()); ?></a>
            <?php endif; ?>
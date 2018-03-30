<!-- Contact Us -->
<?php
    global $customize,$is_customize_mode;
    if($customize['twitter']['show'] || $is_customize_mode): 
?>
    <section id="twitter" class="awe-section twitter awe-parallax" <?php display_background_css('twitter'); ?>>
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay=".5s">
                
                <div class="awe-content">
                    <div class="awe-twitter">
                        <i class="awe-icon fa fa-twitter"></i>
                        <div id="owl-twitter" class="col-xs-12">
                            <?php
                            $feeds = apply_filters('twitter_feeds',false,true);
                            //var_dump($feeds);
                            if(is_array($feeds)):
                            ?>
                            <!-- Item 1 -->
                            <?php foreach($feeds as $feed): ?>
                            <!-- Item -->
                            <div class="item">
                                <p><?php echo $feed->text;?></p>
                                <span class="time-about">About <?php echo $feed->created_at;?></span>
                                <h2><a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $feed->id;?>">@<?php echo $feed->user->name; ?></a></h2>
                            </div>
                            <!-- Item -->
                            <?php endforeach; ?>
                            <?php else:?>
                                <div class="no-item">
                                    <h3 class="dark"><a href="https://apps.twitter.com/app/new"><?php _e("[Please config Twitter]",LANGUAGE);?></a></h3>
                                </div>
                            <?php endif;?>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php sectionOverLay('twitter'); ?>
    </section>
<?php endif; ?>
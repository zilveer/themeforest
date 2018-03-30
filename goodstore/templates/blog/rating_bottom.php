<div class="jw-rating jw-rating-bottom">
    <?php
    $ratingManager = ratingManager::getInstance();
    $ratings = $ratingManager->getRatings(get_the_ID());
    $totalrat = $ratingManager->getRatingsScore($ratings);
    $total = round($totalrat * 100);
    ?>

    <?php
    $ratingTitle = $ratingManager->getRatignsTitle(get_the_ID());
    if (!is_null($ratingTitle) && strlen($ratingTitle) > 0) {
        ?>
        <div class="jw-rating-row jw-rating-row-title">
            <?php echo $ratingTitle; ?>
        </div>
    <?php } ?>

    <?php
    $totalRating = 0;
    $ratingsCount = 0;
    foreach ($ratings as $oneRating) {
        $postRatio = round(($oneRating->score) * 100);
        ?>
        <?php
        $class = "";

        if ($oneRating->useredit == "1") {
            $class = " user_editable";
        } else {
            $totalRating += $oneRating->score;

            $ratingsCount += 1;
            ?>
            <div class="jw-rating-row">
                <div class="jw-rating-criteria-name" ><?php echo $oneRating->name; ?></div>

                <div class="jw-rating-content">
                    <div class="jw-rating-area stars">                    
                        <div class="jw-ratig-background stars" style="width:<?php echo $postRatio; ?>%">
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        <?php } ?>
    <?php } ?>         

    <!-- TOTAL RATING -->
    <?php if ($ratingManager->getRatignsShowOverall(get_the_ID()) || $ratingManager->getRatignsShowDesc(get_the_ID())) { ?>
        <div class="jw-rating-row jw-rating-row-overall-box" >

            <span  style="display:none"> <?php echo get_the_author(); ?></span>
            <span itemprop="itemreviewed" style="display:none"> <?php echo get_the_title(); ?></span>
            <span itemprop="datePublished" style="display:none"> <?php echo get_the_date(); ?></span>

            <?php if (strlen($ratingManager->getRatignsDesc(get_the_ID())) > 0 && $ratingManager->getRatignsShowDesc(get_the_ID())) { ?>
                <div class="jaw-rating-row-desc" >
                    <p><?php echo $ratingManager->getRatignsDesc(get_the_ID()); ?></p>
                </div>
            <?php } ?>                
            <?php if ($ratingsCount > 0 && $ratingManager->getRatignsShowOverall(get_the_ID())) { ?>
                <div class="jw-rating-row-overall">                    
                    <?php
                    // $total = round($totalRating / $ratingsCount * 100);
                    ?>
                    <div class="jw-rating-row-total-score" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <span itemprop="ratingValue"><?php echo round($total / 20, 1); ?></span>

                        <?php
                        if ($ratingManager->getOverllRatignType(get_the_ID()) == "stars") {
                            ?>
                            <meta itemprop="worstRating" content = "0"/>
                            <meta itemprop="bestRating" content = "5"/>
                            <?php
                        } else if ($ratingManager->getOverllRatignType(get_the_ID()) == "percent") {
                            ?>
                            <meta itemprop="worstRating" content = "0"/>
                            <meta itemprop="bestRating" content = "100"/>     
                            <?php
                        }
                        ?>

                    </div>
                    <div class="jw-rating-area-stars">
                        <div class="jw-rating-area stars">                    
                            <div class="jw-ratig-background stars" style="width:<?php echo esc_attr($total); ?>%"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <!-- END TOTAL RATING -->

    <!-- USER RATING -->
    <?php if ($ratingManager->getRatignsShowUserRating(get_the_ID())) { ?>
        <div class="jw-rating-row jw-rating-area-percent-user-rating">                  
            <?php
            $userRating = $ratingManager->getOneRating(get_the_ID(), 'UsersRatings');
            if (isset($userRating->score)) {
                $userScore = round(($userRating->score) * 100);
            } else {
                $userScore = 100;
            }
            if (isset($userRating->voted)) {
                $voted = $userRating->voted;
            } else {
                $voted = 0;
            }
            ?>

            <div class="jw-rating-criteria-name" >
                <span class="jw-rating-userrating-name" data-rel="<?php _e('Your rating', 'jawtemplates'); ?>"><?php _e('Users rating', 'jawtemplates'); ?>:</span>
                <span class="jw-rating-userrating-score"><?php (round($userScore / 2) / 10); ?></span>
                <span class="jw-rating-userrating-votes" data-rel="<?php _e('votes', 'jawtemplates'); ?>">(<?php echo $voted; ?> <?php _e('votes', 'jawtemplates'); ?>)</span>
            </div>
            <div class="jw-rating-area-stars">
                <div class="jw-rating-area ratig-background-stars user-rating stars">                    
                    <div class="jw-ratig-background rating-top-stars stars user_editable" style="width:<?php echo esc_attr($userScore); ?>%">
                        <input type="hidden" class="jw_rating_name" name="jw_rating_name" value="<?php echo esc_attr($userRating->name); ?>">
                        <input type="hidden" class="jw_rating_id" name="jw_rating_id" value="<?php echo esc_attr($userRating->id); ?>">
                        <input type="hidden" class="jw_rating_value" name="jw_rating_value" value="<?php echo esc_attr($userRating->score); ?>">
                        <input type="hidden" class="jw_rating_post_id" name="jw_rating_post_id" value="<?php echo esc_attr(the_ID()); ?>">
                        <input type="hidden" class="jw_rating_user_value" name="jw_rating_post_id" value="0">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <!-- END USER RATING -->
</div>
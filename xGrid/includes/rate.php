<?php
/**
 *  Reviews
 */
$ratings                            = new user_rating();
$bd_review_enable                   = get_post_meta(get_the_ID(), 'bd_review_enable', true);
$bd_user_ratings_visibility         = get_post_meta(get_the_ID(), 'bd_user_ratings_visibility', true);
$bd_final_score                     = get_post_meta(get_the_ID(), 'bd_final_score', true);
$bd_longer_summary                  = get_post_meta(get_the_ID(), 'bd_longer_summary', true);
$bd_brief_summary                   = get_post_meta(get_the_ID(), 'bd_brief_summary', true);
$bd_review_type                     = get_post_meta(get_the_ID(), 'bd_review_type', true);
$bd_criteria_display                = get_post_meta(get_the_ID(), 'bd_criteria_display', true);
$bd_criteria_header                 = get_post_meta(get_the_ID(), 'bd_criteria_header', true);
$bd_c1_rating                       = get_post_meta(get_the_ID(), 'bd_c1_rating', true);
$bd_c1_description                  = get_post_meta(get_the_ID(), 'bd_c1_description', true);
$bd_c2_rating                       = get_post_meta(get_the_ID(), 'bd_c2_rating', true);
$bd_c2_description                  = get_post_meta(get_the_ID(), 'bd_c2_description', true);
$bd_c3_rating                       = get_post_meta(get_the_ID(), 'bd_c3_rating', true);
$bd_c3_description                  = get_post_meta(get_the_ID(), 'bd_c3_description', true);
$bd_c4_rating                       = get_post_meta(get_the_ID(), 'bd_c4_rating', true);
$bd_c4_description                  = get_post_meta(get_the_ID(), 'bd_c4_description', true);
$bd_c5_rating                       = get_post_meta(get_the_ID(), 'bd_c5_rating', true);
$bd_c5_description                  = get_post_meta(get_the_ID(), 'bd_c5_description', true);
$bd_c6_rating                       = get_post_meta(get_the_ID(), 'bd_c6_rating', true);
$bd_c6_description                  = get_post_meta(get_the_ID(), 'bd_c6_description', true);
$bd_c1_percentage                   = $bd_c1_rating * 20;
$bd_c2_percentage                   = $bd_c2_rating * 20;
$bd_c3_percentage                   = $bd_c3_rating * 20;
$bd_c4_percentage                   = $bd_c4_rating * 20;
$bd_c5_percentage                   = $bd_c5_rating * 20;
$bd_c6_percentage                   = $bd_c6_rating * 20;
$bd_final_percentage                = $bd_final_score * 20;
$bd_c1_width                        = $bd_c1_percentage + 2;
$bd_c2_width                        = $bd_c2_percentage + 2;
$bd_c3_width                        = $bd_c3_percentage + 2;
$bd_c4_width                        = $bd_c4_percentage + 2;
$bd_c5_width                        = $bd_c5_percentage + 2;
$bd_c6_width                        = $bd_c6_percentage + 2;
$bd_final_width                     = $bd_final_percentage + 2;
?>
<?php if($bd_review_enable == 1) { ?>
    <div itemscope itemtype="http://data-vocabulary.org/Review" id="bd-review-wrapper" class="bd-review-placement-<?php echo($bd_criteria_display); ?>">
    <span style="display:none" itemprop="itemreviewed"><?php the_title();?></span>
    <span style="display:none" itemprop="reviewer"><?php the_author(); ?></span>
    <?php
    if ($bd_criteria_header !== '')
    {
        ?>
        <div id="bd-review-header">
            <h4><?php echo $bd_criteria_header; ?></h4>
        </div>
    <?php
    }
    ?>

    <?php if($bd_review_type == 'percent') { ?>

        <?php
        if($bd_c1_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c1_percentage; ?>" style="width:<?php echo $bd_c1_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c1_description; ?> - <?php echo $bd_c1_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c2_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c2_percentage; ?>" style="width:<?php echo $bd_c2_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c2_description; ?> - <?php echo $bd_c2_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c3_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c3_percentage; ?>" style="width:<?php echo $bd_c3_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c3_description; ?> - <?php echo $bd_c3_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c4_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c4_percentage; ?>" style="width:<?php echo $bd_c4_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c4_description; ?> - <?php echo $bd_c4_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c5_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c5_percentage; ?>" style="width:<?php echo $bd_c5_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c5_description; ?> - <?php echo $bd_c5_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c6_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-percent">
                <span class="bd-criteria-percentage" data-percentage="<?php echo $bd_c6_percentage; ?>" style="width:<?php echo $bd_c6_percentage; ?>%"></span>
                <span class="bd-criteria-description"><?php echo $bd_c6_description; ?> - <?php echo $bd_c6_percentage; ?>%</span>
            </div>
        <?php
        }
        ?>

    <?php } else { ?>

        <?php
        if($bd_c1_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c1_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c1_description; ?></span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c2_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c2_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c2_description; ?></span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c3_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c3_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c3_description; ?></span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c4_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c4_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c4_description; ?></span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c5_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c5_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c5_description; ?></span>
            </div>
        <?php
        }
        ?>

        <?php
        if($bd_c6_rating !== '')
        {
            ?>
            <div class="bd-review-criteria bd-criteria-star">
                <span class="bd-criteria-star-under"><span class="bd-criteria-star-top" style="width:<?php echo $bd_c6_width;?>%"></span></span>
                <span class="bd-criteria-description"><?php echo $bd_c6_description; ?></span>
            </div>
        <?php
        }
        ?>

    <?php } ?>

    <div class="bd-review-summary bd-final-score-<?php echo $bd_review_type ?>">
        <div id="bd-short-summary">
            <p><strong>Summary:</strong> <?php echo $bd_longer_summary;?></p>
        </div>

        <div id="bd-criteria-final-score">
            <span itemprop="rating">
                <h3>
                    <?php
                    if($bd_review_type == 'percent')
                    {
                        echo ($bd_final_percentage . '<span>%</span>');
                    }
                    else
                    {
                        echo $bd_final_score;
                    }
                    ?>
                </h3>
            </span>
            <h4><?php echo $bd_brief_summary;?></h4>
            <?php if ($bd_review_type == 'stars') { ?><span id="bd-final-score-stars-under"><span id="bd-final-score-stars-top" style="width:<?php echo $bd_final_width;?>%"></span></span> <?php } ?>
        </div>
    </div>

    <?php
    if($bd_user_ratings_visibility == 1)
    {
        ?>
        <div itemscope itemtype="http://data-vocabulary.org/Review-aggregate" class="bd-user-review-criteria">
                <span class="bd-user-review-description">
                <b><span class="your_rating" style="display:none;"><?php _e('Your Rating', 'bd'); ?></span>
                    <span class="user_rating"><?php _e('User Rating', 'bd'); ?></span></b>: <span class="score"><?php echo $ratings->current_rating; ?></span> <small>(<span class="count"><?php echo $ratings->count; ?></span> <?php _e('votes', 'bd'); ?>)</small></span>
                <span class="bd-user-review-rating">
                    <span class="bd-criteria-star-under">
                    <span class="bd-criteria-star-top" style="width:<?php echo $ratings->current_position; ?>%"></span></span>
                </span>
        </div>
    <?php
    }
    ?>
    </div>
<?php } ?>
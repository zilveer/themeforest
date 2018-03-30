<?php
global $smof_data;
?>

<!-- Our Team Page -->
<div class="page-container pattern-2" id="our-team">
    <div class="row">
        <div class="twelve columns page-content">
            <h1 class="page-title">
                <?php $dreamer_team_page_title=$smof_data[ 'team_page_title']; echo $dreamer_team_page_title ?>
            </h1>
            <h2 class="page-subtitle">
                <?php $dreamer_team_page_description=$smof_data[ 'team_page_description']; echo $dreamer_team_page_description ?>
            </h2>
        </div>

        <?php $args=array( 'post_type'=>'team', 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1), ); query_posts($args); while (have_posts()) : the_post();
        $dreamer_team_facebook_link = get_post_meta(get_the_ID(), 'dreamer_facebook_link', TRUE);
        $dreamer_team_twitter_link  = get_post_meta(get_the_ID(), 'dreamer_twitter_link', TRUE);
        $dreamer_team_linkedin_link = get_post_meta(get_the_ID(), 'dreamer_linkedin_link', TRUE);
        $dreamer_team_position      = get_post_meta(get_the_ID(), 'dreamer_team_member_position', TRUE);
        ?>
        <div class="three columns padding-four-columns team-member mobile-two">
            <div class="team-image-wrapp">
                <?php the_post_thumbnail( 'team-thumbnail'); ?>
                <div class="team-hover">
                    <div class="team-social-media">
                        <?php if (!empty($dreamer_team_facebook_link)): ?>
                            <a target="_blank" href="<?php echo $dreamer_team_facebook_link ?>" class="team-facebook"></a>
                        <?php endif ?>
                        <?php if (!empty($dreamer_team_twitter_link)): ?>
                            <a target="_blank" href="<?php echo $dreamer_team_twitter_link ?>" class="team-twitter"></a>
                        <?php endif ?>
                        <?php if (!empty($dreamer_team_linkedin_link)): ?>
                            <a target="_blank" href="<?php echo $dreamer_team_linkedin_link ?>" class="team-linkedin"></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <h3 class="our-team-title">
                <?php the_title(); ?>
            </h3>
            <?php if (!empty($dreamer_team_position)): ?>
                <h3 class="our-team-subtitle">
                    <?php echo $dreamer_team_position ?>
                </h3>
            <?php endif ?>
            <div class="our-team-divider"></div>
            <div class="our-team-text">
                <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php wp_reset_query(); ?>
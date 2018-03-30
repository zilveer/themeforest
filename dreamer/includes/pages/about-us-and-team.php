<div class="twelve columns page-content">
    <h1 class="page-title"><?php global $smof_data; $dreamer_team_page_title = $smof_data['team_page_title']; echo $dreamer_team_page_title ?></h1>
    <h2 class="page-subtitle"><?php global $smof_data; $dreamer_team_page_description = $smof_data['team_page_description']; echo $dreamer_team_page_description ?></h2>
</div>

<?php global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'about-us' ) );
query_posts( $args );
if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="four columns about mobile-three-one">
    <?php the_post_thumbnail('about-thumbnail'); ?> 
    <h3 class="about-us-title"><?php the_title(); ?></h3>
    <div class="about-us-text"><?php the_content(); ?></div>
</div>
<?php endwhile; endif; ?>

<div class="twelve columns page-content">
    <h1 class="page-title"><?php global $smof_data; $dreamer_team_page_title = $smof_data['team_page_title']; echo $dreamer_team_page_title ?></h1>
    <h2 class="page-subtitle"><?php global $smof_data; $dreamer_team_page_description = $smof_data['team_page_description']; echo $dreamer_team_page_description ?></h2>
</div>

<?php global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'team' ) );
query_posts( $args );
if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="three columns padding-four-columns team-member mobile-two">
    <?php the_post_thumbnail('team-thumbnail'); ?> 
    <h3 class="our-team-title"><?php the_title(); ?></h3>
    <h3 class="our-team-subtitle"><?php $dreamer_team_position = get_post_meta(get_the_ID(), 'dreamer_team_member_position', TRUE); echo $dreamer_team_position ?></h3>
    <div class="our-team-divider"></div>
    <div class="our-team-text"><?php the_content(); ?></div>
    <div class="team-hover">
        <div class="team-social-media">
            <a href="<?php $dreamer_team_facebook_link = get_post_meta(get_the_ID(), 'dreamer_facebook_link', TRUE); echo $dreamer_team_facebook_link ?>" class="team-facebook"></a>
            <a href="<?php $dreamer_team_twitter_link = get_post_meta(get_the_ID(), 'dreamer_twitter_link', TRUE); echo $dreamer_team_twitter_link ?>" class="team-twitter"></a>
            <a href="<?php $dreamer_team_linkedin_link = get_post_meta(get_the_ID(), 'dreamer_linkedin_link', TRUE); echo $dreamer_team_linkedin_link ?>" class="team-linkedin"></a>
        </div>
    </div>
</div>
<?php endwhile; endif; ?>


<?php wp_reset_query(); ?>
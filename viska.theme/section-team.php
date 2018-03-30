<!-- Team -->
<?php
    global $customize,$is_customize_mode;
    if($customize['team']['show'] || $is_customize_mode): 
?>
    <section id="team" class="awe-section team" <?php display_background_css('team'); ?>>
        <div class="container">
            <div class="row">
                <!-- The title -->
                <?php displayHeader('team'); ?>
                <div class="clear"></div>
                <!-- Awe content -->
                <div class="awe-content js-awe-get-items ">
                    <div class="awe-teams js-content-slider clearfix <?php contentSlider('team') ?>" <?php sliderCols('team') ?>>

                        <!-- Item -->
                        <?php
                            $args = array(
                                'post_type'         => 'awe_team',
                                'posts_per_page'    =>  '-1',
                            );
                            $team = new WP_Query($args);
                            $time = 0.4;
                        while($team->have_posts()) : $team->the_post(); $metadata = get_post_meta($post->ID,'',false); //var_dump($metadata);
                        ?>
                        <div class="js-content-item <?php hasSlider('team') ?> wow <?php animationContent('team'); ?>" data-wow-duration="<?php echo $time; ?>s" data-wow-delay="<?php echo $time; ?>s" data-animate="<?php animationContent('team'); ?>" >
                            <div class="item">
                                <div class="img">
                                    <img src="<?php echo $metadata['photo'][0] ?>" alt="team photo">
                                    <div class="content hover-overlay">
                                        <p>
                                            <?php echo $metadata['smallintro'][0]; ?>
                                        </p>
                                        <?php
                                        $socials = get_post_meta(get_the_ID(),'social',true);
                                        $icons = array(
                                            'facebook'  =>  'fa fa-facebook',
                                            'google'    =>  'fa fa-google-plus',
                                            'twitter'   =>  'fa fa-twitter',
                                            'github'    =>  'fa fa-github-alt',
                                            'instagram' =>  'fa fa-instagram',
                                            'pinterest' =>  'fa fa-pinterest',
                                            'linkedin'  =>  'fa fa-linkedin',
                                            'skype'     =>  'fa fa-skype',
                                            'tumblr'    =>  'fa fa-tumblr',
                                            'youtube'   =>  'fa fa-youtube',
                                            'vimeo'     =>  'fa fa-vimeo-square',
                                            'dribbble'  =>  'fa fa-dribbble'
                                        );
                                        foreach ($socials as $name => $link) {
                                            if(!empty($link)){
                                                echo '<a href="'.$link.'"><i class="awe-icon '.$icons[$name].'"></i></a>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <h3><?php the_title(); ?></h3>
                                <span><?php echo $metadata['position'][0] ?></span>
                            </div>
                        </div>
                        <?php $time = $time +0.2; endwhile; wp_reset_query(); ?>
                        <!-- Item -->
                    <?php if($customize['team']['content']['join']==1 || $is_customize_mode) : ?>
                        <?php 
                        $join_image = get_template_directory_uri()."/assets/images/team-logo.png";
                        if(isset($customize['team']['content']['join_image']))
                        {
                            $join_image = $customize['team']['content']['join_image'];
                        }
                        $join_link = '#';
                        if(isset($customize['team']['content']['join_link']))
                        {
                            $join_link = $customize['team']['content']['join_link'];
                        }
                        $join_text = 'Join Our Team';
                        if(isset($customize['team']['content']['join_text']))
                        {
                            $join_text = $customize['team']['content']['join_text'];
                        }
                        ?>
                        <div class="js-content-item <?php hasSlider('team') ?> <?php joinTeamWow(); ?> bounceIn" data-wow-duration="1s" data-wow-delay="1.4s" <?php joinTeam() ?>>
                            <div  class="join-team">
                                <a href="<?php echo $join_link; ?>" class="content">
                                    <img class="join-team-logo" src="<?php echo $join_image ?>" alt="team logo">
                                    <h2><?php echo $join_text; ?></h2>
                                    <p class="add-join-team">
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon-add-team.png" alt="icon add team logo">
                                    </p>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    </div>
                </div>


            </div>
            <?php sectionFooter('team'); ?>
        </div>
        <?php sectionOverLay('team'); ?>
    </section>
<?php endif; ?>
<!-- About -->
<?php
    global $customize,$is_customize_mode;
    if($customize['about']['show'] || $is_customize_mode): 
?>  
    <section id="about" class="awe-section about" <?php display_background_css('about'); ?> >
        <div class="container">
            <div class="row">
                <!-- The title -->
                <?php
                global $customize;
                $args = array(
                    'p'=>$customize['aboutus'],
                    'post_type' => 'awe_aboutus',
                );
                $about = new WP_Query($args);
                while ($about->have_posts()) {
                    $about->the_post(); 
                ?>
            <?php if($customize['about']['header']['enable'] ) : ?>
                <div class="js-header <?php if(has_post_thumbnail()) echo 'col-sm-7';else echo 'col-xs-12'; ?> wow <?php animationHeader('about'); ?>" data-wow-duration="0.2s" data-wow-delay="0.2s" data-animate="<?php animationHeader('about'); ?>" >
                    <div class="awe-header">
                        <h2 class="<?php headerStyle('about') ?>"><?php the_title(); ?></h2>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($is_customize_mode && $customize['about']['header']['enable'] == 0) : ?>
                <div class="js-header <?php if(has_post_thumbnail()) echo 'col-sm-7';else echo 'col-xs-12'; ?> <?php animationHeader('about'); ?>" data-wow-duration="0.2s" data-wow-delay="0.2s" data-animate="<?php animationHeader('about'); ?>" <?php echo displaySectionHeaderInCustomize('about') ?>>
                    <div class="awe-header">
                        <h2 class="<?php headerStyle('about') ?>"><?php the_title(); ?></h2>
                    </div>
                </div>
            <?php endif;?>

                <!-- Text and a Button -->
                <div class="js-awe-get-items <?php if(has_post_thumbnail()) echo 'col-sm-7';else echo 'col-xs-12'; ?> title wow <?php animationContent('about'); ?>" data-wow-duration="0.8s" data-wow-delay="0.8s" data-animate="<?php animationContent('about'); ?>">

                    <?php the_content(); ?>
                <?php if($customize['about']['footer']['enable'] == 1 || $is_customize_mode) : ?>
                    <a href="<?php echo $customize['about']['footer']['button']['link'] ?>" class="awe-button js-about-button" title="<?php echo $customize['about']['footer']['button']['text'] ?>" <?php if(!$customize['about']['footer']['button']['enable']) echo 'style="

                    display:none"'; ?>><?php echo $customize['about']['footer']['button']['text'] ?></a>
                <?php endif; ?>
                </div>
                <!-- Image Mobile -->
                <?php 
                if ( has_post_thumbnail() ) { 
                    echo '<div class="about-img">';
                    the_post_thumbnail();
                    echo '</div>';
                } 
                ?>
            <?php 
                } // end while
                wp_reset_query(); 
            ?>

            </div>
        </div>
        <?php sectionOverLay('about'); ?>
    </section>
<?php endif; ?>
<!-- Work -->
<?php
    global $customize,$is_customize_mode;
    if($customize['portfolio']['show'] || $is_customize_mode): 
?>
    <section id="work" class="awe-section work" <?php display_background_css('portfolio'); ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('portfolio'); ?>
            </div>
        </div>
        <!-- START AJAX SECTION -->
    <?php if($customize['porfolio_display'] == 'expanding') : ?>
        <div id="ajax-section" class="ajax-section">
            <div class="ajax-inner">
                <!-- START PROJECT NAVIGATION -->
                <div id="project-navigation" class="project-navigation">
                    <div class="container">
                        <ul>
                            <li class="prevProject">
                                <a href="#" title="Prev"><i class="awe-icon fa fa-angle-left"></i></a>
                            </li>
                            <li class="closeProject">
                                <a href="#loader" title="Close project"><span class="awe-icon fa fa-times"></span></a></li>
                            <li class="nextProject">
                                <a href="#" title="Next"><i class="awe-icon fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END PROJECT NAVIGATION -->


                <!-- START PROJECT LOADER SECTION -->
                <div id="loader"></div>
                <!-- END PROJECT CLOSE BUTTON -->
                
        
                <!-- START AJAX CONTENT -->
                <div id="ajax-content-outer" class="ajax-content-outer">
                    <div id="ajax-content-inner" class="ajax-content-inner"></div>
                </div>
                <!-- END AJAX CONTENT -->
            </div>
        </div>
        <!-- END AJAX SECTION -->
    <?php endif; ?>

        <div class="awe-content">


            <div class="awe-works">
                <div class="container">
                    <!-- Filter nav -->
                    <div id="filters">
                        <ul>
                            <li class="wow fadeIn" data-wow-delay=".2s">
                                <a id="all" href="#" data-filter="*">
                                    <?php _e('Show All',LANGUAGE); ?>
                                </a>
                            </li>
                        <?php
                            $time = 0.4;
                            $categories = get_terms( 'portfolio_cat', array(
                                'orderby'    => 'name',
                                'hide_empty' => 1
                            ) );
                            if (is_array($categories)) {
                                
                            
                                foreach ($categories as $term) { $time = $time + 0.2; ?>
                                    <li class="wow fadeIn" data-wow-delay="<?php echo $time; ?>">
                                        <a href="#" data-filter=".<?php echo $term->slug; ?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </li>
                                <?php
                                }
                            }
                        ?>
                        </ul>
                    </div>
                </div>

                <!-- work Wrap -->
                <div id="work-wrap" class="photography work-wrap">
                <?php
                    $args = array(
                        'post_type'         => 'awe_portfolio',
                        'posts_per_page'    => '-1'
                    ); 
                    $portfolio = new WP_Query($args);
                    while ($portfolio->have_posts()) : $portfolio->the_post();
                    $categories = get_the_terms(get_the_ID(),'portfolio_cat');
                    $cat_names=array();
                    $cat_slugs=array();
                    if(is_array($categories))
                        foreach($categories as $cat)
                        {
                            $cat_names[]=$cat->name;
                            $cat_slugs[]=$cat->slug;
                        }
                    $class_cats = implode(' ',$cat_slugs);
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'awe-portfolio-thumb' );
                    $a_class = 'href="#"';
                    if($customize['porfolio_display'] == 'expanding')
                    {
                        $a_class = 'href="#projects-'.$post->post_name.'" class="work-image"';
                    }
                    if($customize['porfolio_display'] == 'lightbox')
                    {
                        global $wp_rewrite;
                        if ($wp_rewrite->permalink_structure == '')
                            $a_class = 'href="'.get_the_permalink().'" data-url="'.get_the_permalink().'&amp;livepreview=true" class="awe_magnific_popup work-image"';
                        else
                            $a_class = 'href="'.get_the_permalink().'" data-url="'.get_the_permalink().'?livepreview=true" class="awe_magnific_popup work-image"';
                    }
                ?>
                    <!-- work Item -->
                    <div class="work-item <?php echo $class_cats; ?>">
                        <div class="work">
                            <a <?php echo $a_class; ?>>
                                <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>"/>
                                <div class="caption">
                                    <div class="caption-box">
                                        <h2><?php the_title(); ?></h2>
                                        <span><?php
                                        $i=0; $cat='';
                                        if(is_array($cat_names)): foreach ($cat_names as $value) {
                                            if($i>0) $cat .= ' & '.$value;
                                            else $cat .= $value;
                                            $i++;
                                        }
                                        echo $cat; 
                                        endif; 

                                        ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_query(); ?>

                </div>
                <!-- End Work Wrap -->
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
    $resume_title = get_theme_option('resume_title');
    // Get resume posts
    function resumeSort($c1, $c2) {
        return $c1['order'] < $c2['order'] ? -1 : ($c1['order']>$c2['order'] ? 1 : 0);
    }
    $cats = getTaxonomiesByPostType(array('resume'), array('category_resume'));
    if (count($cats) > 0) {
        for ($i=0; $i<count($cats); $i++) {
            $opt = category_resume_taxonomy_custom_fields_get($cats[$i]['term_id']);
            $cats[$i]['order'] = isset($opt['category_order']) ? $opt['category_order'] : 999;
        }
        usort($cats, 'resumeSort');
?>
            <section id="resume" class="section resume_section even">
                <?php
                    $home = get_home_url();
                    $home .= (my_strpos($home, '?')===false ? '?' : '&') . 'prn=1';
                ?>
                <?php if(get_theme_option('resume_buttons')) { ?>
                <div id="resume_buttons">
                <a href="<?php echo $home; ?>" id="resume_link" target="_blank"><span class="label"><?php echo __('Print', 'wpspace'); ?></span><span class="icon-print icon"></span></a>
                    <?php if(get_theme_option('resume')) { ?>
                <a href="<?php echo get_theme_option('resume'); ?>" id="resume_link_download" target="_blank"><span class="label"><?php echo __('Download', 'wpspace'); ?></span><span class="icon-download icon"></span></a>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="section_header resume_section_header">
                    <h2 class="section_title resume_section_title"><a href="#"><span class="icon icon-align-<?php if (is_rtl()) {echo 'right';} else {echo 'left';}?>"></span><span class="section_name"><?php echo $resume_title; ?></span></a><span class="section_icon"></span></h2>
                </div>
                <div class="section_body resume_section_body">
                    <div class="sidebar resume_sidebar">
                        <?php do_action( 'before_sidebar' ); ?>
                        <?php if ( ! dynamic_sidebar( 'sidebar-resume' ) ) { ?>
                        <?php } ?>
                    </div>
                    <div class="wrapper resume_wrapper">
                        <?php
                            // Get resume posts
                            global $post;
                            $cat_number = 0;
                            foreach ($cats as $cat) {
                                $cat_number++;
                                $cat_title = $cat['name'];
                                $cat_options = get_option('category_resume_term_'.$cat['term_id']);
                                $cat_color = isset($cat_options['category_resume_color']) && $cat_options['category_resume_color'] ? $cat_options['category_resume_color'] : '#000000' ;
                                $cat_title_color = isset($cat_options['category_title_color']) && $cat_options['category_title_color'] ? $cat_options['category_title_color'] : '#373737' ;
                        ?>
                        <div class="category resume_category resume_category_<?php echo $cat_number; ?><?php echo $cat_number==1 ? ' first' : ''; ?><?php echo $cat_number%2==1 ? ' even' : ' odd'; ?>">
                            <div class="category_header resume_category_header">
                                <h3 class="category_title" style="background: <?php echo $cat_title_color; ?>"><span class="category_title_icon" style="background-color:<?php echo $cat_color; ?>"></span><?php echo $cat_title; ?></h3>
                            </div>
                            <div class="category_body resume_category_body">
                            <?php
                                $sorting = get_theme_option('resume_sorting');
                                $args = array(
                                    'post_type' => 'resume',
                                    'post_status' => 'publish',
                                    'post_password' => '',
                                    'posts_per_page' => -1,
                                    'orderby' => 'meta_value',
                                    'meta_key' => 'resume_to',
                                    'order' => $sorting,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category_resume',
                                            'terms' => array($cat['slug']),
                                            'field' => 'slug'
                                        )
                                    )
                                );
                                $query = new WP_Query($args); 
                                $post_number = 0;
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $post_number++;
                                        $post_id = get_the_ID();
                                        $post_link = get_permalink();
                                        $post_date = get_the_date();
                                        $post_title = getPostTitle($post_id, 50, '...');
                                        $post_descr = getPostDescription();
                                        $date_format = get_theme_option('resume_date_format');
                                        
                                        //$post_content = apply_filters('the_content', get_the_content('', true));
                                        //$post_content = str_replace(']]>', ']]&gt;', $post_content);
                                        $post_content = apply_filters('the_content', get_the_content(__('<span class="readmore">Read more</span>', 'wpspace')));
                                        $post_content = decorateMoreLink(str_replace(']]>', ']]&gt;', $post_content));
                                        $post_from = $post_to = '';
                                        $hide_to = true;                              
                                        $post_custom = get_post_custom($post_id);
                                        $post_position = $post_custom["position"][0];
                                        if(isset($post_custom["resume_from"][0])) {
                                            $post_from = $post_custom["resume_from"][0];
                                            if(isset($post_custom["resume_month_from"])) {
                                                $post_month_from = $post_custom["resume_month_from"][0];
                                                if(!empty($post_month_from)) {
                                                    $temp_date = date($date_format, strtotime($post_from.'-'.$post_month_from.'-01'));
                                                    $post_from = prepareDateForTranslation($temp_date).($date_format == 'm' ? '.' : '&nbsp;').$post_from;         
                                                }
                                            }
                                        }
                                        if(isset($post_custom["resume_to"][0])) {
                                            $post_to = $post_custom["resume_to"][0];
                                            if($post_to != 'present') {
                                                if(isset($post_custom["resume_month_to"])) {
                                                    $post_month_to = $post_custom["resume_month_to"][0];
                                                    if(!empty($post_month_to)) {
                                                        $temp_date = date($date_format, strtotime($post_to.'-'.$post_month_to.'-01'));
                                                        $post_to = prepareDateForTranslation($temp_date).($date_format == 'm' ? '.' : '&nbsp;').$post_to;         
                                                    }
                                                }
                                            }
                                        }
                                        
                                ?>
                                <article class="post resume_post resume_post_<?php echo $post_number; ?><?php echo $post_number==1 ? ' first' : ''; ?><?php echo $post_number%2==1 ? ' even' : ' odd'; ?>">
                                    <div class="post_header resume_post_header">
                                        <?php if($post_to != '') {
                                        ?>                                               
                                        <div class="resume_period">
											<?php if($post_from != '') { ?>
                                            <span class="period_from"><?php echo $post_from; ?> - </span>
                                            <?php }	?>											
                                            <span class="period_to<?php echo $post_to != 'present' ? '' : ' period_present'; ?>"><?php echo $post_to; ?></span>
                                        </div>
                                        <?php }
                                            $show_link = get_theme_option('resume_title_link') == 'yes' ? true : false;
                                        ?>
                                        <h4 class="post_title"><span class="post_title_icon" style="background-color: <?php echo $cat_color; ?>"></span><?php if($show_link) { ?>
                                            <a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a>
                                            <?php } else { 
                                                echo $post_title; } ?>
                                            </h4>
                                        <h5 class="post_subtitle"><?php echo $post_position; ?></h5>
                                    </div>
                                    <div class="post_body resume_post_body">
                                        <?php echo $post_content; ?>
                                    </div>
                                </article>
                                <?php
                                    } // while (have_posts)
                                } // if (have_posts)
                                ?>
                            </div> <!-- .category_body -->
                        </div> <!-- .category -->
                        <?php
                            }
                        ?>
                    </div> <!-- .wrapper -->
                </div> <!-- .section_body -->
            </section> <!-- #resume -->
<?php 
    } // if (count($cats)>0)
    wp_reset_postdata();   
?>
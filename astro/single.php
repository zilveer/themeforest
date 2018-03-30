<?php 
    get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
    $show_sidebar=$prk_astro_options['right_sidebar'];
    if ($show_sidebar=="1")
    { 
        $show_sidebar=true;
    }
    else
    {
        $show_sidebar=false;
    }
    $site_background_color = $prk_astro_options['site_background_color'];
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');  
    }
    $darker_inactive_color=alter_brightness($prk_astro_options['inactive_color'],-80);
    $inactive_color=$prk_astro_options['inactive_color'];
    while (have_posts()) : the_post();
        //GET THEME CUSTOM FIELDS INFO
        $sl_id="single_slider";
        $sl_class="flexslider boxed_shadow on_blog";
        $slides_class="";
        if (get_field('no_slider')=="1")
        {
            $sl_id="not_slider";
            $sl_class="";
            $slides_class="boxed_shadow";
        }
        if (get_field('featured_color')!="")
        {
            $featured_color=get_field('featured_color');
            $featured_class='class="featured_color" ';
        }
        else
        {
            $featured_color="default";
            $featured_class="";
        }
        if ($prk_astro_options['autoplay_blog']=="1")
        {
            $autoplay="true";
        }
        else
        {
            $autoplay="false";
        }
        ?>
        <div id="centered_block">
            <?php 
                if (get_field('post_layout')=="boxed")
                {
                    ?>
                    <div id="main_block" class="twelve row page-<?php echo get_the_ID(); ?>">
                    <div id="content" data-parent="<?php echo get_page_link(prk_get_parent_blog()); ?>">
                    <div id="main" role="main" class="main_no_sections">
                    <div class="twelve extra_pad columns prk_inner_block centered">
                    <div class="twelve centered blog_sgl_pst columns">
                    <div class="<?php if ($show_sidebar) {echo "twelve columns sidebarized"; }else{echo "twelve columns unsidebarized no_title_page";} ?>">
                   <?php 
                }
            ?>
            <div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>"  data-color="<?php echo $featured_color; ?>">
                <ul class="slides" data-autoplay="<?php echo $autoplay; ?>" data-delay="<?php echo $prk_astro_options['delay_blog']; ?>">
                    <?php
                        $ext_count=0;
                        if (get_field('skip_featured')=="")
                        {
                            if (has_post_thumbnail( $post->ID ) )
                            {
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                $image[0] = get_image_path($image[0]);
                                $ext_count=1;
                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                $vt_image = vt_resize( '', $image[0] , 1820, 0, false , $retina_flag );
                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="" />';
                                echo"</li>";
                            }
                        }
                        //PLACE THE OTHER NINE IMAGES
                        for ($count=2;$count<11;$count++)
                        {
                            if (get_field('image_'.$count)!="")
                            {
                                $ext_count++;
                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                        $in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
                                        $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag);
                                        echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="" />';
                                echo "</li>";
                            }
                            //OTHER MEDIA SUPPORT
                            if (get_field('video_'.$count)!="")
                            {
                                $ext_count++;
                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                    $el_class='prk-video-container';
                                    if (strpos(get_field('video_'.$count),'soundcloud.com') !== false) {
                                        $el_class= 'soundcloud-container';
                                    }
                                    echo "<div class='".$el_class."'>";
                                    echo get_field('video_'.$count);
                                    echo "</div>";
                                echo "</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <?php 
                if (get_field('post_layout')!="boxed")
                {
                    ?>
                    <div id="main_block" class="twelve row page-<?php echo get_the_ID(); ?>">
                    <div id="content" data-parent="<?php echo get_page_link(prk_get_parent_blog()); ?>">
                    <div id="main" role="main" class="main_no_sections">
                    <div class="twelve extra_pad columns prk_inner_block centered">
                    <div class="twelve centered blog_sgl_pst columns">
                    <div class="<?php if ($show_sidebar) {echo "twelve columns sidebarized"; }else{echo "twelve columns unsidebarized no_title_page";} ?>">
                   <?php 
                }
            ?>
                            <div id="single_blog_content" <?php echo $featured_class; ?>data-color="<?php echo $featured_color; ?>">
                                <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
                                        <div class="single_post_wp">                    
                                            <div id="single_blog_meta" class="prk_uppercased">
                                            <?php
                                                if (get_field('bl_icon')=="") {
                                                    $bl_icon='navicon-link';
                                                }
                                                else
                                                {
                                                    $bl_icon=get_field('bl_icon'); 
                                                }
                                            ?>
                                        <div class="single_blog_meta_div">
                                            <div class="<?php echo $bl_icon; ?> zero_color left_floated prk_less_opacity more_space"></div>
                                            <?php
                                            if (is_sticky())
                                            {
                                                ?>
                                                    <div class="left_floated default_color sticky_text">
                                                        <?php echo($prk_translations['sticky_text']); ?>
                                                    </div>
                                                    <div class="pir_divider">|</div>
                                                <?php
                                            }
                                            ?>
                                            <div class="left_floated astro_date">
                                                <?php echo the_date(); ?>
                                            </div>
                                        </div>
                                <?php
                                if ($prk_astro_options['categoriesby_blog']=="1")
                                {
                                    ?>
                                    <div class="single_blog_meta_div">
                                        <div class="pir_divider">|</div>
                                        <div class="left_floated default_color">
                                            <?php the_category(', '); //CATS WITH LINKS ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                                <?php 
                                    if ($prk_astro_options['postedby_blog']=="1")
                                    {
                                        ?>
                                        <div class="single_blog_meta_div">
                                            <div class="pir_divider">|</div>
                                            <div class="left_floated">
                                                <?php echo($prk_translations['posted_by_text']); ?>
                                                <?php echo " ".get_the_author(); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <?php
                                    if ( comments_open() ) :
                                        ?>
                                        <div class="single_blog_meta_div right_floated">
                                            <div class="left_floated show_later">&nbsp;/&nbsp;</div>
                                            <div class="left_floated default_color">
                                                <a href="<?php comments_link(); ?>">        
                                                    <?php 
                                                        comments_number($prk_translations['comments_no_response'], $prk_translations['comments_one_response'], '% '.$prk_translations['comments_oneplus_response']);
                                                    ?> 
                                                </a>
                                            </div>
                                            <div class="navicon-bubbles-2 left_floated prk_less_opacity zero_color hide_later"></div>
                                        </div>
                                      <?php
                                    endif;
                                ?>
                                <div class="clearfix"></div>  
                            <div class="simple_line"></div>
                         
                        </div>     
                                    <div class="clearfix"></div>       
                                    <div id="single_post_content" class="on_colored prk_no_composer prk_break_word">
                                        <h1 id="blog_ttl" class="header_font bd_headings_text_shadow zero_color prk_break_word">
                                            <?php the_title(); ?>
                                        </h1>
                                        <?php the_content(); ?>
                                    </div>
                                    <?php wp_link_pages('before=<div class="astro_single_pagination"><div class="astro_single_pagination_inner"><div class="navicon-stack left_floated prk_less_opacity zero_color"></div><p class="fade_anchor prk_heavier left_floated">&after=</p></div></div>'); ?>
                                    <div class="clearfix"></div>
                                    <?php
                                        if (get_the_tags()!="")
                                        {
                                           
                                            ?>
                                            <div id="prk_tags" class="left_floated prk_uppercased">
                                                <div class="navicon-tags left_floated prk_less_opacity zero_color"></div>
                                                <div class="left_floated default_color header_font"><?php the_tags(''); ?></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <?php
                                        } 
                                    ?>
                                    <div id="single_meta_footer" class="prk_uppercased"> 
                                        <?php
                                        if ($prk_astro_options['share_blog']=="1")
                                        {
                                            ?>
                                            <div class="prk_sharrre_wrapper left_floated">
                                                <div class="share_trigger left_floated">
                                                    <div class="navicon-share left_floated zero_color prk_less_opacity">
                                                    </div>
                                                    <div class="left_floated default_color">     
                                                        <?php 
                                                            echo $prk_translations['share_text_blog'];
                                                        ?> 
                                                    </div>
                                                </div>
                                                <div class="sharrre_hider">
                                                    <div class="prk_sharre_btns left_floated default_color">
                                                        <?php if (isset($prk_astro_options['share_blog_del']) && $prk_astro_options['share_blog_del']=="1") { ?>
                                                        <div class="prk_sharrre_delicious" data-url="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_blog_fb']) && $prk_astro_options['share_blog_fb']=="1")  { ?>
                                                        <div class="prk_sharrre_facebook" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_blog_goo']) && $prk_astro_options['share_blog_goo']=="1")  { ?>
                                                        <div class="prk_sharrre_google" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_blog_lnk']) && $prk_astro_options['share_blog_lnk']=="1")  { ?>
                                                        <div class="prk_sharrre_linkedin" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php 
                                                            if (isset($prk_astro_options['share_blog_pin']) && $prk_astro_options['share_blog_pin']=="1") 
                                                            { 
                                                                if (has_post_thumbnail( $post->ID ) )
                                                                {
                                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                                }
                                                                else
                                                                {
                                                                    $image[0]="";
                                                                }
                                                                ?>
                                                                <div class="prk_sharrre_pinterest" data-media="<?php echo $image[0]; ?>" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php 
                                                            } 
                                                        ?>
                                                        <?php if (isset($prk_astro_options['share_blog_stu']) && $prk_astro_options['share_blog_stu']=="1")  { ?>
                                                        <div class="prk_sharrre_stumbleupon" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        
                                                        <?php if (isset($prk_astro_options['share_blog_twt']) && $prk_astro_options['share_blog_twt']=="1")  { ?>
                                                        <div class="prk_sharrre_twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                          <?php
                                        }
                                        ?>
                                    
                                    <div class="header_font right_floated">
                                            <div class="left_floated fade_anchor bk_blog_link">
                                                <a href="<?php echo get_page_link(prk_get_parent_blog()); ?>" class="default_color"><?php echo($prk_translations['to_blog']); ?></a>
                                            </div>
                                            <div class="navicon-pencil left_floated zero_color prk_less_opacity"></div>
                                        </div>   
                                        <div class="clearfix"></div>
                                    
                                    <div class="simple_line"></div>
                                    <?php 
                                        if (isset($prk_astro_options['related_blog']) && $prk_astro_options['related_blog']=="1")
                                        {
                                            ?>
                                            <div class="prevnext_single_blog">
                                                <div class="navigation-previous-blog bd_headings_text_shadow zero_color fade_anchor">
                                                        <?php next_post_link_plus( array(
                                                            'in_same_cat' => true,
                                                            'format' => '%link',
                                                            'link' => ' <div class="navicon-backward"></div>
                                                                        <div class="after_icon_blog"><h5 class="header_font">%title</h5></div>'
                                                            ) );
                                                        ?>
                                                </div>
                                                <div class="navigation-next-blog right_floated bd_headings_text_shadow zero_color fade_anchor">
                                                        <?php previous_post_link_plus( array(
                                                            'in_same_cat' => true,
                                                            'format' => '%link',
                                                            'link' => '<div class="next_link_blog">
                                                              <div class="left_floated bf_icon_blog"><h5 class="header_font">%title</h5></div>
                                                          </div>
                                                          <div class="left_floated">
                                                                <div class="navicon-forward"></div>
                                                            </div>'
                                                            ) );
                                                        ?>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php 
                                        if ($prk_astro_options['related_author']=="1")
                                        {
                                            ?>
                                            <div class="prk_titlify_father h3s">
                                                <h3 class="header_font zero_color bd_headings_text_shadow prk_titlify">
                                                    <?php echo $prk_translations['about_author_text']." ";the_author_posts_link(); ?>
                                                </h3>
                                            </div>
                                            <div id="author_area" class="">
                                                <div class="in_quote">
                                                <?php 
                                                    if (function_exists('get_avatar')) { 
                                                        echo "<div class='prk_author_avatar'>";
                                                        echo get_avatar( get_the_author_meta('email'), '84' );
                                                        echo "</div>";
                                                    }
                                                ?>
                                                <div class="author_info default_color">
                                                    
                                                    <?php 
                                                        $auth_array = get_user_by('slug', get_the_author_meta('user_nicename'));
                                                        echo nl2br($auth_array->description); 
                                                    ?>
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <div id="c_wrap_single">
                                        <?php comments_template(); ?>
                                  </div>
                                </article>
                                </div>
                                </div>
                            <?php 
                                if ($show_sidebar) 
                                {
                                    ?>
                                    <aside id="sidebar" class="columns on_single" role="complementary">
                                        <?php 
                                            if (get_field('post_layout')!="boxed")
                                            {
                                                ?>
                                                <div id="single_blog_meta" class="prk_uppercased">
                                                    <div class="single_blog_meta_div">
                                                        <div class="navicon-link zero_color left_floated prk_less_opacity more_space"></div>
                                                           <div class="left_floated">
                                                            &nbsp;                                          
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>  
                                                    <div class="simple_line on_sidebar"></div>
                                                </div>
                                                <?php 
                                            }
                                            get_sidebar(); 
                                        ?>
                                    </aside>
                                    <?php
                               }
                            ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
</div>
<?php endwhile; /* End loop */ ?>
<?php get_footer(); ?>
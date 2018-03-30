<?php 
    get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');  
    }
    while (have_posts()) : the_post(); 
        if (get_field('featured_color')!="")
        {
            $featured_color=get_field('featured_color');
            $featured_class='featured_color';
        }
        else
        {
            $featured_color="default";
            $featured_class="";
        }
        $main_layout=$prk_astro_options['portfolio_layout'];
        if (is_array($main_layout))
        {
            $main_layout="fullscreen";
        }
        if (get_field('inner_layout')=="fullscreen")
            $main_layout="fullscreen";
        if (get_field('inner_layout')=="classic")
            $main_layout="classic";
        if (get_field('inner_layout')=="no_cropping")
            $main_layout="no_cropping";
        if (get_field('inner_layout')=="half")
            $main_layout="half";
        if ($prk_astro_options['autoplay_portfolio']=="1")
        {
            $autoplay="true";
        }
        else
        {
            $autoplay="false";
        }
        if ($main_layout=="classic")
        {
            ?>
            <div id="centered_block" class="prk_no_change"> 
                <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
                    <div id="content" class="has_top_bar prk_tucked" data-parent="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                    <div id="main" class="main_no_sections"> 
                        <div class="twelve">
                    <article id="prk_full_folio" <?php post_class($featured_class); ?> data-color="<?php echo $featured_color; ?>">
                         <div id="single_slider" class="flexslider boxed_shadow" data-color="<?php echo $featured_color; ?>">
                                    <ul class="slides" data-autoplay="<?php echo $autoplay; ?>" data-delay="<?php echo $prk_astro_options['delay_portfolio']; ?>">
                                        <?php
                                            $ext_count=0;
                                            if (get_field('skip_featured')=="")
                                            {
                                                if (has_post_thumbnail( $post->ID ) )
                                                {
                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                    $image[0] = get_image_path($image[0]);
                                                    $in_ttl="";
                                                    $alt_text="";
                                                    if ( $thumb = get_post_thumbnail_id() )
                                                    {
                                                        $in_ttl=get_post($thumb)->post_title;
                                                        $alt_text=get_post_meta($thumb, '_wp_attachment_image_alt', true);
                                                    }
                                                    echo '<li id="slide_1">';
                                                    $ext_count=1;
                                                    $vt_image = vt_resize( '', $image[0] , 1920, 1200, false , $retina_flag );
                                                    echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image[0]).'" />';
                                                    echo '</li>';
                                                }
                                            }
                                            if (get_field('use_gallery')!="images_only")
                                            {
                                                //PLACE THE OTHER NINETEEN IMAGES
                                                for ($count=2;$count<21;$count++)
                                                {
                                                    if (get_field('image_'.$count)!="")
                                                    {
                                                        $ext_count++;
                                                        echo "<li id=slide_".$ext_count.">";
                                                        $in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
                                                        $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
                                                        echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($in_image[0]).'" />';
                                                        echo "</li>";
                                                    }
                                                    if (get_field('video_'.$count)!="")
                                                    {
                                                        $ext_count++;
                                                        echo "<li id=slide_".$ext_count." class='slide_video'>";
                                                        $el_class='prk-video-container';
                                                        if (strpos(get_field('video_'.$count),'soundcloud.com') !== false) {
                                                          $el_class= 'soundcloud-container';
                                                        }
                                                        echo "<div class='".$el_class."'>";
                                                        echo get_field('video_'.$count);
                                                        echo "</div></li>";
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $regex = '/(\w+)\s*=\s*"(.*?)"/';
                                                $pattern = '/\[gallery(.*?)\]/';
                                                preg_match_all($regex, get_post_meta($post->ID,'image_gallery',true), $matches);
                                                $stripped_gallery = array();
                                                for ($i = 0; $i < count($matches[1]); $i++) {
                                                    $stripped_gallery[$matches[1][$i]] = $matches[2][$i];
                                                }
                                                if (!empty($stripped_gallery) && $stripped_gallery['ids']!="")
                                                {
                                                    $array = explode(',', $stripped_gallery['ids']);
                                                    foreach($array as $value)
                                                    {
                                                        $ext_count++;
                                                        echo "<li id=slide_".$ext_count.">";
                                                        $in_image=wp_get_attachment_image_src($value,'full');
                                                        $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
                                                        echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($in_image[0]).'" />';
                                                        echo "</li>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <div class="clearfix"></div> 
                                <div class="twelve extra_pad columns prk_inner_block centered"> 
                        <div class="row prk_row">
                            <div id="prk_full_size_single">
                                <div class="twelve columns halfsized">
                                    <h1 id="folio_ttl" class="header_font bd_headings_text_shadow zero_color">
                                        <?php the_title(); ?>
                                    </h1>
                                    <div class="simple_line on_folio"></div>
                                    <?php
                                        if ($prk_astro_options['show_heart_folio']=="1" || get_field('ext_url')!="")
                                        {
                                            echo '<div id="full_prj_meta">';
                                        }
                                        if ($prk_astro_options['show_heart_folio']=="1")
                                        {
                                            echo '<div class="prk_heart_project bd_headings_text_shadow zero_color header_font">';
                                                echo get_folio_like(get_the_ID(),true);
                                            echo '</div>';
                                        }
                                        if (get_field('ext_url')!="") 
                                        {
                                            //ADD HTTP PREFIX IF NEEDED
                                            if (substr(get_field('ext_url'),0,7)!="http://" && substr(get_field('ext_url'),0,8)!="https://")
                                                $final_url="http://".get_field('ext_url');
                                            else
                                                $final_url=get_field('ext_url');
                                            ?>
                                            <div id="full_portfolio_link" class="right_floated zero_color header_font bd_headings_text_shadow">
                                                <a class="view_more_single left_floated" href="<?php echo $final_url; ?>" target="_blank" data-color="<?php echo $featured_color; ?>">
                                                    <div class="prj_label left_floated">
                                                    <?php
                                                        if (get_field('ext_url_label')!="") 
                                                        {
                                                            echo get_field('ext_url_label');
                                                        }
                                                        else {
                                                            
                                                            echo $prk_translations['launch_text'];
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class='navicon-forward left_floated'></div> 
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        if ($prk_astro_options['show_heart_folio']=="1" || get_field('ext_url')!="")
                                        {
                                            echo '<div class="clearfix"></div></div>';
                                        }
                                    ?>
                                        <div class="clearfix"></div>
                                        <div class="single-entry-content prk_no_composer">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="prk_project_meta" class="header_font bd_headings_text_shadow">
                                            <?php
                                                if ($prk_astro_options['share_portfolio']=="1")
                                                {
                                                    ?>
                                                    <div class="prk_sharrre_wrapper left_floated">
                                                        <div class="share_trigger left_floated">
                                                            <div class="navicon-share left_floated zero_color">
                                                            </div>
                                                            <div id="pfolio_share_text" class="left_floated zero_color header_font prk_uppercased bd_headings_text_shadow">     
                                                                <?php 
                                                                    echo $prk_translations['share_text_folio'];
                                                                ?> 
                                                            </div>
                                                        </div>
                                                        <div class="sharrre_hider">
                                                            <div class="prk_sharre_btns left_floated zero_color">
                                                                <?php if (isset($prk_astro_options['share_portfolio_del']) && $prk_astro_options['share_portfolio_del']=="1") { ?>
                                                                <div class="prk_sharrre_delicious" data-url="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_fb']) && $prk_astro_options['share_portfolio_fb']=="1")  { ?>
                                                                <div class="prk_sharrre_facebook" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_goo']) && $prk_astro_options['share_portfolio_goo']=="1")  { ?>
                                                                <div class="prk_sharrre_google" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_lnk']) && $prk_astro_options['share_portfolio_lnk']=="1")  { ?>
                                                                <div class="prk_sharrre_linkedin" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php 
                                                                    if (isset($prk_astro_options['share_portfolio_pin']) && $prk_astro_options['share_portfolio_pin']=="1") 
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
                                                                <?php if (isset($prk_astro_options['share_portfolio_stu']) && $prk_astro_options['share_portfolio_stu']=="1")  { ?>
                                                                <div class="prk_sharrre_stumbleupon" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                
                                                                <?php if (isset($prk_astro_options['share_portfolio_twt']) && $prk_astro_options['share_portfolio_twt']=="1")  { ?>
                                                                <div class="prk_sharrre_twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  <?php
                                                }
                                            ?>
                                            <div class="right_floated zero_color header_font bd_headings_text_shadow">
                                                <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                                                    <div id="back_to_folio" class="left_floated">
                                                        <?php echo($prk_translations['to_portfolio']); ?>
                                                    </div>
                                                    <div class="navicon-undo left_floated"></div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="simple_line"></div>
                                        <div class="prevnext_single_blog on_folio">
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
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                <div id="full-entry-right" class="columns hide_later">
                                    <h1 id="folio_ttl" class="header_font bd_headings_text_shadow zero_color prk_invisible hide_later">
                                        <?php echo "Details" ?>
                                    </h1>
                                    <div class="simple_line on_folio hide_later"></div>
                                    <div class="clearfix"></div>
                    <?php 
                                          if ($prk_astro_options['dateby_port']=="1")
                                          {
                                              ?>
                                              <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['date_text']); ?>
                                                    </div>
                                                    
                                                    <div class="block_description">
                                                        <?php echo the_date(); ?>
                                                    </div>
                                               </div>
                                              <?php
                                          }
                                        if ($prk_astro_options['categoriesby_port']=="1")
                                        {
                                            if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
                                            {
                                                ?>
                                                <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['skills_text']); ?>
                                                    </div>
                                                    <div class="block_description default_color side_skills">
                                                        <?php echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                                          {
                                              ?>
                                                <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['tags_text']); ?>
                                                    </div>
                                                    <div class="block_description default_color side_skills">
                                                        <?php echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' ); ?>
                                                    </div>
                                                </div>
                                              <?php
                                          }
                                    if (get_field('client_url')!="")
                                    { 
                                        ?>
                                        <div class="six_margin_bt">
                                            <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                            <?php echo($prk_translations['client_text']); ?>
                                            </div>
                                            <div class="block_description">
                                                <?php echo get_field('client_url'); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                ?>
                <div id="half_helper" class="clearfix"></div>
            </div>
        </div>
                                <div class="clearfix"></div>
                                </div> 
                                <div class="clearfix"></div>
                        <div id="after_single_folio" class="twelve centered prk_inner_block columns">
                        <div class="columns twelve">        
                            <?php comments_template(); ?>
                        </div>
                    </div>
                    </article>
                    </div>
                    </div>
                    </div>
                </div>
            </div>   
            <?php
        }
        else if ($main_layout=="half")
        {
            if (get_field('limited_slider')=="1")
            {
                $limited_class=" limited_height";
            }
            else
            {
                $limited_class="";
            }
            ?>
            <div id="centered_block" class="prk_no_change"> 
                <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
                    <div id="content" class="has_top_bar prk_tucked" data-parent="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                    <div id="main" class="main_no_sections"> 
                        <div class="twelve">
                    <article id="prk_full_folio" <?php post_class($featured_class); ?> data-color="<?php echo $featured_color; ?>">
                        <div id="halfer" class="twelve extra_pad columns prk_inner_block centered"> 
                        <div class="row prk_row">
                            <div id="prk_full_size_single">
                                <div class="twelve columns halfsized">
                                    <div id="single_slider" class="flexslider boxed_shadow<?php echo $limited_class; ?>" data-color="<?php echo $featured_color; ?>">
                                        <ul class="slides" data-autoplay="<?php echo $autoplay; ?>" data-delay="<?php echo $prk_astro_options['delay_portfolio']; ?>">
                                            <?php
                                                $ext_count=0;
                                                if (get_field('skip_featured')=="")
                                                {
                                                    if (has_post_thumbnail( $post->ID ) )
                                                    {
                                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                        $image[0] = get_image_path($image[0]);
                                                        $in_ttl="";
                                                        $alt_text="";
                                                        if ( $thumb = get_post_thumbnail_id() )
                                                        {
                                                            $in_ttl=get_post($thumb)->post_title;
                                                            $alt_text=get_post_meta($thumb, '_wp_attachment_image_alt', true);
                                                        }
                                                        echo '<li id="slide_1">';
                                                        $ext_count=1;
                                                        $vt_image = vt_resize( '', $image[0] , 1920, 1200, false , $retina_flag );
                                                        echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image[0]).'" />';
                                                        echo '</li>';
                                                    }
                                                }
                                                if (get_field('use_gallery')!="images_only")
                                                {
                                                    //PLACE THE OTHER NINETEEN IMAGES
                                                    for ($count=2;$count<21;$count++)
                                                    {
                                                        if (get_field('image_'.$count)!="")
                                                        {
                                                            $ext_count++;
                                                            echo "<li id=slide_".$ext_count.">";
                                                            $in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
                                                            $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
                                                            echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($in_image[0]).'" />';
                                                            echo "</li>";
                                                        }
                                                        if (get_field('video_'.$count)!="")
                                                        {
                                                            $ext_count++;
                                                            echo "<li id=slide_".$ext_count." class='slide_video'>";
                                                            $el_class='prk-video-container';
                                                            if (strpos(get_field('video_'.$count),'soundcloud.com') !== false) {
                                                              $el_class= 'soundcloud-container';
                                                            }
                                                            echo "<div class='".$el_class."'>";
                                                            echo get_field('video_'.$count);
                                                            echo "</div></li>";
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    $regex = '/(\w+)\s*=\s*"(.*?)"/';
                                                    $pattern = '/\[gallery(.*?)\]/';
                                                    preg_match_all($regex, get_post_meta($post->ID,'image_gallery',true), $matches);
                                                    $stripped_gallery = array();
                                                    for ($i = 0; $i < count($matches[1]); $i++) {
                                                        $stripped_gallery[$matches[1][$i]] = $matches[2][$i];
                                                    }
                                                    if (!empty($stripped_gallery) && $stripped_gallery['ids']!="")
                                                    {
                                                        $array = explode(',', $stripped_gallery['ids']);
                                                        foreach($array as $value)
                                                        {
                                                            $ext_count++;
                                                            echo "<li id=slide_".$ext_count.">";
                                                            $in_image=wp_get_attachment_image_src($value,'full');
                                                            $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
                                                            echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($in_image[0]).'" />';
                                                            echo "</li>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                        <div id="prk_project_meta" class="header_font bd_headings_text_shadow">
                                            <?php
                                                if ($prk_astro_options['share_portfolio']=="1")
                                                {
                                                    ?>
                                                    <div class="prk_sharrre_wrapper left_floated">
                                                        <div class="share_trigger left_floated">
                                                            <div class="navicon-share left_floated zero_color">
                                                            </div>
                                                            <div id="pfolio_share_text" class="left_floated zero_color header_font prk_uppercased bd_headings_text_shadow">     
                                                                <?php 
                                                                    echo $prk_translations['share_text_folio'];
                                                                ?> 
                                                            </div>
                                                        </div>
                                                        <div class="sharrre_hider">
                                                            <div class="prk_sharre_btns left_floated zero_color">
                                                                <?php if (isset($prk_astro_options['share_portfolio_del']) && $prk_astro_options['share_portfolio_del']=="1") { ?>
                                                                <div class="prk_sharrre_delicious" data-url="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_fb']) && $prk_astro_options['share_portfolio_fb']=="1")  { ?>
                                                                <div class="prk_sharrre_facebook" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_goo']) && $prk_astro_options['share_portfolio_goo']=="1")  { ?>
                                                                <div class="prk_sharrre_google" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (isset($prk_astro_options['share_portfolio_lnk']) && $prk_astro_options['share_portfolio_lnk']=="1")  { ?>
                                                                <div class="prk_sharrre_linkedin" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                <?php 
                                                                    if (isset($prk_astro_options['share_portfolio_pin']) && $prk_astro_options['share_portfolio_pin']=="1") 
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
                                                                <?php if (isset($prk_astro_options['share_portfolio_stu']) && $prk_astro_options['share_portfolio_stu']=="1")  { ?>
                                                                <div class="prk_sharrre_stumbleupon" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                                
                                                                <?php if (isset($prk_astro_options['share_portfolio_twt']) && $prk_astro_options['share_portfolio_twt']=="1")  { ?>
                                                                <div class="prk_sharrre_twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  <?php
                                                }
                                            ?>
                                            <div class="right_floated zero_color header_font bd_headings_text_shadow">
                                                <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                                                    <div id="back_to_folio" class="left_floated">
                                                        <?php echo($prk_translations['to_portfolio']); ?>
                                                    </div>
                                                    <div class="navicon-undo left_floated"></div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="simple_line"></div>
                                        <div class="prevnext_single_blog on_folio">
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
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                <div id="full-entry-right" class="columns">
                                    <h3 id="folio_ttl" class="header_font bd_headings_text_shadow zero_color">
                                        <?php the_title(); ?>
                                    </h3>
                                    
                                        <div class="clearfix"></div>
                                        <div class="single-entry-content prk_no_composer">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    <div class="simple_line on_folio"></div>
                                    <?php
                                        if ($prk_astro_options['show_heart_folio']=="1" || get_field('ext_url')!="")
                                        {
                                            echo '<div id="full_prj_meta">';
                                        }
                                        if ($prk_astro_options['show_heart_folio']=="1")
                                        {
                                            echo '<div class="prk_heart_project bd_headings_text_shadow zero_color header_font">';
                                                echo get_folio_like(get_the_ID(),true);
                                            echo '</div>';
                                        }
                                        if (get_field('ext_url')!="") 
                                        {
                                            //ADD HTTP PREFIX IF NEEDED
                                            if (substr(get_field('ext_url'),0,7)!="http://" && substr(get_field('ext_url'),0,8)!="https://")
                                                $final_url="http://".get_field('ext_url');
                                            else
                                                $final_url=get_field('ext_url');
                                            ?>
                                            <div id="full_portfolio_link" class="right_floated zero_color header_font bd_headings_text_shadow">
                                                <a class="view_more_single left_floated" href="<?php echo $final_url; ?>" target="_blank" data-color="<?php echo $featured_color; ?>">
                                                    <div class="prj_label left_floated">
                                                    <?php
                                                        if (get_field('ext_url_label')!="") 
                                                        {
                                                            echo get_field('ext_url_label');
                                                        }
                                                        else {
                                                            
                                                            echo $prk_translations['launch_text'];
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class='navicon-forward left_floated'></div> 
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        if ($prk_astro_options['show_heart_folio']=="1" || get_field('ext_url')!="")
                                        {
                                            echo '<div class="clearfix"></div></div>';
                                        }
                                          if ($prk_astro_options['dateby_port']=="1")
                                          {
                                              ?>
                                              <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['date_text']); ?>
                                                    </div>
                                                    
                                                    <div class="block_description">
                                                        <?php echo the_date(); ?>
                                                    </div>
                                               </div>
                                              <?php
                                          }
                                        if ($prk_astro_options['categoriesby_port']=="1")
                                        {
                                            if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
                                            {
                                                ?>
                                                <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['skills_text']); ?>
                                                    </div>
                                                    <div class="block_description default_color side_skills">
                                                        <?php echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                                          {
                                              ?>
                                                <div class="six_margin_bt">
                                                    <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                                        <?php echo($prk_translations['tags_text']); ?>
                                                    </div>
                                                    <div class="block_description default_color side_skills">
                                                        <?php echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' ); ?>
                                                    </div>
                                                </div>
                                              <?php
                                          }
                                    if (get_field('client_url')!="")
                                    { 
                                        ?>
                                        <div class="six_margin_bt">
                                            <div class="single_portfolio_headings zero_color header_font bd_headings_text_shadow">
                                            <?php echo($prk_translations['client_text']); ?>
                                            </div>
                                            <div class="block_description">
                                                <?php echo get_field('client_url'); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                ?>
                <div id="half_helper" class="clearfix"></div>
            </div>
        </div>
                                <div class="clearfix"></div>
                                </div> 
                                <div class="clearfix"></div>
                        <div id="after_single_folio" class="twelve centered prk_inner_block columns">
                        <div class="columns twelve">        
                            <?php comments_template(); ?>
                        </div>
                    </div>
                    </article>
                    </div>
                    </div>
                    </div>
                </div>
            </div>   
            <?php
        }
        else {
            $slides_class="prk_ferro_wrap prk_cover_screen ".$main_layout;
            ?>
            <div id="centered_block">
                <div id='astro_featured_header' class="<?php echo($featured_class); ?>" data-color="<?php echo $featured_color; ?>">
                    <?php
                        $ext_count=0;
                        if (has_post_thumbnail( $post->ID ) )
                        {
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                            $image[0] = get_image_path($image[0]);
                            $vt_image = vt_resize( '', $image[0] , 1820, 1200, false , $retina_flag );
                            if (get_field('skip_featured')=="") {
                                $ext_count=1;
                                echo '<div id="slide_1" class="'.$slides_class.'" data-bgimage="'.$vt_image['url'].'" data-pos="1">';
                                    if (get_the_title(get_post_thumbnail_id($post->ID))!="" || get_post(get_post_thumbnail_id($post->ID))->post_excerpt!="") {
                                        echo '<div class="astro_sgl_wrapper '.$prk_astro_options['folio_descs_align'].'">';
                                            echo '<div class="astro_sgl_title header_font">'.get_the_title(get_post_thumbnail_id($post->ID)).'</div>';
                                            echo '<div class="astro_sgl_desc">'.get_post(get_post_thumbnail_id($post->ID))->post_excerpt.'</div>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            }
                            echo '<img src="'.$vt_image['url'].'" class="hide_now" alt="" />';
                        }
                        if (get_field('use_gallery')!="images_only")
                        {
                            //PLACE THE OTHER NINETEEN IMAGES
                            for ($count=2;$count<21;$count++) {
                                if (get_field('image_'.$count)!="") {
                                    $ext_count++;
                                    $in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
                                    $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag);
                                    echo '<div id="slide_'.$ext_count.'" class="'.$slides_class.'" data-bgimage="'.$vt_image['url'].'" data-pos="'.$ext_count.'">';
                                        if (get_the_title(get_field('image_'.$count))!="" || get_post(get_field('image_'.$count))->post_excerpt!="") {
                                            echo '<div class="astro_sgl_wrapper '.$prk_astro_options['folio_descs_align'].'">';
                                                echo '<div class="astro_sgl_title header_font">'.get_the_title(get_field('image_'.$count)).'</div>';
                                                echo '<div class="astro_sgl_desc">'.get_post(get_field('image_'.$count))->post_excerpt.'</div>';
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                }
                                //VIDEO SUPPORT
                                if (get_field('video_'.$count)!="")
                                {
                                    $ext_count++;
                                    echo "<div id=slide_".$ext_count." class='slide_video ".$slides_class."' data-pos='".$ext_count."'>";
                                    $el_class='prk-video-container';
                                    if (strpos(get_field('video_'.$count),'soundcloud.com') !== false) {
                                      $el_class= 'soundcloud-container';
                                    }
                                    echo "<div class='".$el_class."'>";
                                        echo get_field('video_'.$count);
                                    echo "</div></div>";
                                }
                            }
                        }
                        else
                        {
                            $regex = '/(\w+)\s*=\s*"(.*?)"/';
                            $pattern = '/\[gallery(.*?)\]/';
                            preg_match_all($regex, get_post_meta($post->ID,'image_gallery',true), $matches);
                            $stripped_gallery = array();
                            for ($i = 0; $i < count($matches[1]); $i++) {
                                $stripped_gallery[$matches[1][$i]] = $matches[2][$i];
                            }
                            if (!empty($stripped_gallery) && $stripped_gallery['ids']!="") {
                                $array = explode(',', $stripped_gallery['ids']);
                                foreach($array as $value) {
                                    $ext_count++;
                                    $in_image=wp_get_attachment_image_src($value,'full');
                                    $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag);
                                    echo '<div id="slide_'.$ext_count.'" class="'.$slides_class.'" data-bgimage="'.$vt_image['url'].'" data-pos="'.$ext_count.'">';
                                        if (get_the_title($value)!="" || get_post($value)->post_excerpt!="") {
                                            echo '<div class="astro_sgl_wrapper '.$prk_astro_options['folio_descs_align'].'">';
                                                echo '<div class="astro_sgl_title header_font">'.get_the_title($value).'</div>';
                                                echo '<div class="astro_sgl_desc">'.get_post($value)->post_excerpt.'</div>';
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
                <div id="content" class="has_left_bar" data-count="<?php echo $ext_count; ?>">
                    <div id="main_block">
                        <div id="prk_nav_close">
                            <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>" data-pir_title="<?php echo($prk_translations['to_portfolio']); ?>">Portfolio</a>
                        </div>
                         <?php
                            next_post_link_plus( array(
                                'in_same_cat' => true,
                                'loop' => true,
                                'before' => '<div id="prk_nav_left">',
                                'after' => '</div>',
                                'format' => '%link'
                            ));
                            previous_post_link_plus( array(
                                'in_same_cat' => true,
                                'loop' => true,
                                'before' => '<div id="prk_nav_right">',
                                'after' => '</div>',
                                'format' => '%link'
                            ));
                        ?>
                        <div id="project_info" class="twelve columns prk_noclose_class">
                            <div class="twelve columns">
                                <div id="prk_prj_title">
                                    <h1>
                                        <?php the_title(); ?>
                                    </h1>
                                </div>
                            <?php
                                if ($prk_astro_options['dateby_port']=="1")
                                {
                                  ?>
                                  <div class="prk_prj_block">
                                        <div class="single_portfolio_headings bd_headings_text_shadow zero_color header_font prk_uppercased">
                                            <?php echo($prk_translations['date_text']); ?>
                                        </div>
                                        
                                        <div class="block_description">
                                            <?php echo the_date(); ?>
                                        </div>
                                   </div>
                                  <?php
                                }
                                if ($prk_astro_options['categoriesby_port']=="1")
                                {
                                    if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
                                    {
                                        ?>
                                        <div class="prk_prj_block">
                                            <div class="single_portfolio_headings bd_headings_text_shadow zero_color header_font prk_uppercased">
                                                <?php echo($prk_translations['skills_text']); ?>
                                            </div>
                                            <div class="block_description default_color side_skills">
                                                <?php echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                                {
                                  ?>
                                    <div class="prk_prj_block">
                                        <div class="single_portfolio_headings bd_headings_text_shadow zero_color header_font prk_uppercased">
                                            <?php echo($prk_translations['tags_text']); ?>
                                        </div>
                                        <div class="block_description default_color side_skills">
                                            <?php echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' ); ?>
                                        </div>
                                    </div>
                                  <?php
                                }
                                if (get_field('client_url')!="")
                                { 
                                ?>
                                <div class="prk_prj_block">
                                <div class="single_portfolio_headings bd_headings_text_shadow zero_color header_font prk_uppercased">
                                    <?php echo($prk_translations['client_text']); ?>
                                </div>
                                <div class="block_description">
                                    <?php echo get_field('client_url'); ?>
                                </div>
                                </div>
                                <?php
                                }
                                    if (get_the_content()!="")
                                    {
                                        ?>
                                        <div class="single_portfolio_headings bd_headings_text_shadow zero_color header_font prk_uppercased">
                                            <?php echo($prk_translations['prj_desc_text']); ?>
                                        </div>
                                        <div class="single_entry_content prk_no_composer">
                                            <?php the_content(); ?>
                                        </div>
                                        <?php
                                    }
                                    if ($prk_astro_options['show_heart_folio']=="1")
                                    {
                                        echo '<div class="prk_heart_project bd_headings_text_shadow zero_color header_font">';
                                            echo get_folio_like(get_the_ID(),true);
                                        echo '</div>';
                                    }
                                ?>
                                <div class="clearfix"></div>
                                <div class="simple_line"></div>
                                <div id="prk_project_meta" class="header_font bd_headings_text_shadow">
                                    <?php
                                        if ($prk_astro_options['share_portfolio']=="1")
                                        {
                                            ?>
                                            <div class="prk_sharrre_wrapper left_floated">
                                                <div class="share_trigger left_floated">
                                                    <div class="navicon-share left_floated zero_color">
                                                    </div>
                                                    <div id="pfolio_share_text" class="left_floated zero_color header_font prk_uppercased">     
                                                        <?php 
                                                            echo $prk_translations['share_text_folio'];
                                                        ?> 
                                                    </div>
                                                </div>
                                                <div class="sharrre_hider">
                                                    <div class="prk_sharre_btns left_floated zero_color">
                                                        <?php if (isset($prk_astro_options['share_portfolio_del']) && $prk_astro_options['share_portfolio_del']=="1") { ?>
                                                        <div class="prk_sharrre_delicious" data-url="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_portfolio_fb']) && $prk_astro_options['share_portfolio_fb']=="1")  { ?>
                                                        <div class="prk_sharrre_facebook" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_portfolio_goo']) && $prk_astro_options['share_portfolio_goo']=="1")  { ?>
                                                        <div class="prk_sharrre_google" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if (isset($prk_astro_options['share_portfolio_lnk']) && $prk_astro_options['share_portfolio_lnk']=="1")  { ?>
                                                        <div class="prk_sharrre_linkedin" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        <?php 
                                                            if (isset($prk_astro_options['share_portfolio_pin']) && $prk_astro_options['share_portfolio_pin']=="1") 
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
                                                        <?php if (isset($prk_astro_options['share_portfolio_stu']) && $prk_astro_options['share_portfolio_stu']=="1")  { ?>
                                                        <div class="prk_sharrre_stumbleupon" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                        
                                                        <?php if (isset($prk_astro_options['share_portfolio_twt']) && $prk_astro_options['share_portfolio_twt']=="1")  { ?>
                                                        <div class="prk_sharrre_twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                          <?php
                                        }
                                        if (get_field('ext_url')!="") 
                                        { 
                                            //ADD HTTP PREFIX IF NEEDED
                                            if (substr(get_field('ext_url'),0,7)!="http://" && substr(get_field('ext_url'),0,8)!="https://")
                                                $final_url="http://".get_field('ext_url');
                                            else
                                                $final_url=get_field('ext_url');
                                            ?>
                                            <div id="full_portfolio_link" class="right_floated zero_color">
                                                <a class="view_more_single left_floated" href="<?php echo $final_url; ?>" target="_blank" data-color="<?php echo $featured_color; ?>">
                                                    <div class="prj_label left_floated">
                                                    <?php
                                                        if (get_field('ext_url_label')!="") 
                                                        {
                                                            echo get_field('ext_url_label');
                                                        }
                                                        else {
                                                            
                                                            echo $prk_translations['launch_text'];
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class='navicon-forward left_floated'></div> 
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    endwhile; /* End loop */
?>
<?php get_footer(); ?>

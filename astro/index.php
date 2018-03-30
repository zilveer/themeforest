<?php
if ($prk_astro_options['archives_type']=="classic" || $prk_astro_options['archives_type']=="")
{
  get_header();
  global $retina_device;
  $retina_flag = $retina_device === "prk_retina" ? true : false;
  //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
  if (INJECT_STYLE) {
      include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');  
  }
  $show_sidebar=$prk_astro_options['right_sidebar'];
  if ($show_sidebar=="1")
      $show_sidebar=true;
  else
    $show_sidebar=false;
  if (get_field('show_sidebar')=="1") 
  {
      $show_sidebar=true;
  }
  if (get_field('show_sidebar')=="no") 
  {
      $show_sidebar=false;
  }
  $show_title=true;
  if (get_field('hide_title')=="1") 
  {
      $show_title=false;
  }
  $cat = get_term_by('name', single_cat_title('',false), 'category'); 
  if (!($cat)!=1)
      $cat_selector=$cat->slug;
  else
      $cat_selector="";
  $tagname = get_query_var('tag');
  //APPLY FILTERS FOR TAG IF NEEDED
  if ($tagname!="")
      $tag_selector=$tagname;
  else
      $tag_selector="";
  $my_query = new WP_Query();
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $monthnum = (get_query_var('monthnum')) ? get_query_var('monthnum') : "";
  $yearnum = (get_query_var('year')) ? get_query_var('year') : "";
  if ($paged>1)
  {
      $excluder=get_option("sticky_posts");
  }
  else
  {
      $excluder="";
  }
  $args = array( 
      'post_type'=>'post', 
      'paged' => $paged,
      'category_name'=>$cat_selector,
      "post__not_in" =>$excluder,
      'tag'=>$tagname,
      'year'=>$yearnum,
      'monthnum'=>$monthnum);
  $my_query->query($args);
  $post_counter=($paged-1)*$posts_per_page;
  if ($my_query->have_posts()) : 
  $ins=0;
  ?>
  <div id="centered_block" class="prk_inner_block columns centered main_no_sections">
    <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
      <?php
       if ($show_title==true)
        {
            prk_output_title("advanced");
        }
      ?>
      <div id="content">
        <div id="main" class="main_no_sections">
          <div class="twelve prk_inner_block centered">
          <div  class="<?php if ($show_sidebar) {echo "twelve columns sidebarized no_title_page";}else{echo "berlo twelve columns unsidebarized no_title_page";} ?>">
      <?php 
            $ins=0;
            echo '<div id="classic_blog_section" class="prk_section">';
            echo "<ul id=\"blog_entries\">";
              while ($my_query->have_posts()) : $my_query->the_post(); 
                $post_counter++;
                if (get_field('featured_color')!="")
                {
                  $featured_color=get_field('featured_color');
                  $featured_class="featured_color ";
                }
                else
                {
                  $featured_color="default";
                  $featured_class="";
                }
              ?>
            <li id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>blog_entry_li cf" data-color="<?php echo $featured_color; ?>">
              <?php 
              if (has_post_thumbnail( $post->ID ) ):
                //GET THE FEATURED IMAGE
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                $image[0] = get_image_path($image[0]);
                $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
              else :
                //THERE'S NO FEATURED IMAGE
                
              endif; 
                if (has_post_thumbnail( $post->ID ) )
                {
                  ?>
                  <div class="blog_content twelve"> 
                        <a href="<?php the_permalink(); ?>" class="fade_anchor" data-color="<?php echo $featured_color; ?>">
                            <div class="blog_top_image boxed_shadow">
                              <div class="blog_fader_grid">
                                  <div class="navicon-plus titled_link_icon body_bk_color"></div>
                                </div>
                                <?php 
                                    if (!isset($prk_astro_options['forcesize_news']))
                                        $prk_astro_options['forcesize_news']='no';
                                    $height_force=0;
                                    $cropper=false;
                                    if ($prk_astro_options['forcesize_news']=='yes') {
                                        $height_force=385;
                                        $cropper=true;
                                      }
                                    $vt_image = vt_resize( '', $image[0] , $prk_astro_options['custom_width']-120, $height_force, $cropper , $retina_flag );
                                    ?>
                                  <img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image boxed_shadow" alt="" />
                            </div>
                        </a>
                    <?php
                }
                else
                {
                  //CHECK IF THERE'S A VIDEO TO SHOW
                  if (get_field('video_2')!="")
                  {
                    echo '<div class="blog_content twelve">';
                    $el_class='video-container boxed_shadow';
                    if (strpos(get_field('video_2'),'soundcloud.com') !== false) {
                      $el_class= 'soundcloud-container';
                    }
                    echo "<div class='".$el_class."'>";
                    echo get_field('video_2');
                    echo "</div>";
                  }
                  else
                  {
                    ?>
                    <div class="blog_content no_top_mg twelve">
                    <div class="blog_top_image zero_margin_bottom">&nbsp;</div> 
                    <?php
                  }
                }
                if (get_field('bl_icon')=="") {
                    $bl_icon='navicon-link';
                }
                else
                {
                    $bl_icon=get_field('bl_icon'); 
                }
                ?>
                <div class="clearfix"></div>
                    <div class="single_blog_meta_class prk_uppercased">
                        <div class="single_blog_meta_div">
                            <div class="<?php echo $bl_icon; ?> zero_color left_floated prk_less_opacity more_space"></div>
                                <?php
                                    if (is_sticky())
                                    {
                                        ?>
                                            <div class="left_floated default_color sticky_text">
                                                <?php echo($prk_translations['sticky_text']); ?>
                                            </div>
                                            <div class="left_floated">&nbsp;/&nbsp;</div>
                                        <?php
                                    }
                                ?>
                                <div class="left_floated">
                                    <?php echo get_the_time(get_option('date_format')); ?>
                                </div>
                        </div>
                            <?php
                                if ($prk_astro_options['categoriesby_blog']=="1")
                                {
                                    ?>
                                    <div class="single_blog_meta_div">
                                        <div class="left_floated">&nbsp;/&nbsp;</div>
                                        <div class="left_floated default_color blog_categories">
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
                                            <div class="left_floated">&nbsp;/&nbsp;</div>
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
                                                <a href="<?php comments_link(); ?>" class="fade_anchor">        
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
                       </div>
                       <div class="classic_blog_meta">
                            <h3 class="header_font bd_headings_text_shadow">
                              <a href="<?php the_permalink(); ?>" class="fade_anchor zero_color prk_break_word" data-color="<?php echo $featured_color; ?>">
                                <?php the_title(); ?>
                              </a>
                            </h3>
                          <div class="clearfix"></div>
                        </div>
                        <div class="on_colored entry_content prk_break_word">
                            <?php 
                              echo the_excerpt_dynamic(64);
                            ?>
                            <div class="clearfix eight_margin"></div> 
                        </div>
                        <div class="simple_line zero_margin_bottom"></div>
                        <div class="blog_lower header_font prk_heavy">
                            <?php
                                if ($prk_astro_options['share_blog']=="1")
                                {
                                    ?>
                                    <div class="prk_sharrre_wrapper left_floated">
                                        <div class="share_trigger left_floated">
                                            <div class="navicon-share left_floated zero_color">
                                            </div>
                                            <div class="left_floated zero_color">     
                                                <?php 
                                                    echo $prk_translations['share_text_blog'];
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="sharrre_hider">
                                            <div class="prk_sharre_btns left_floated zero_color">
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
                            <div class="single_blog_meta_div right_floated">
                                <a href="<?php the_permalink() ?>" class="fade_anchor zero_color" data-color="<?php echo $featured_color; ?>">
                                    <div class="left_floated">
                                        <?php echo($prk_translations['read_more']); ?>
                                    </div>
                                    <div class="navicon-forward left_floated"></div>
                                </a>
                            </div>
                        </div>
                    </div>
              
            </li>
            <?php $ins++; ?>
          <?php 
            endwhile;
            echo "</ul>";
           endif; 
            //SHOW NAVIGATION
            if ($my_query->max_num_pages>1)
            {
                ?>
                <div id="entries_navigation_blog">
                    <div class="navigation twelve body_text_shadow default_color header_font fade_anchor">
                        <?php
                            next_posts_link('<div class="navicon-backward left_floated"></div><div class="left_floated">'.$prk_translations['older'].'</div>',$my_query->max_num_pages); 
                            previous_posts_link('<div class="left_floated">'.$prk_translations['newer'].'</div><div class="navicon-forward left_floated"></div>',$my_query->max_num_pages); 
                        ?>
                    </div>
                </div> 
                <?php
            }
        ?>
      </div>
    </div>

    <?php 
          if ($show_sidebar) 
          {
              ?>
              <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
                    <div id="single_blog_meta" class="prk_uppercased show_later">
                        <div class="single_blog_meta_div">
                            <div class="navicon-link zero_color left_floated prk_less_opacity more_space"></div>
                            <div class="left_floated">&nbsp;</div>
                        </div>        
                        <div class="clearfix"></div>  
                        <div class="simple_line on_sidebar"></div>
                    </div>
                  <?php get_sidebar(); ?>
              </aside>
              <?php
          }
      ?>
      </div>
    </div>
    </div>
</div>
</div>
<?php
}//CLASSIC
?>
<?php
if ($prk_astro_options['archives_type']=="grid")
{
  get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
  //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
  if (INJECT_STYLE) {
    include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');  
  }
  $show_sidebar=$prk_astro_options['right_sidebar'];
  if ($show_sidebar=="1")
    $show_sidebar=true;
  else
    $show_sidebar=false;
    if (get_field('show_sidebar')=="1") 
    {
      $show_sidebar=true;
  }
  if (get_field('show_sidebar')=="no") 
  {
    $show_sidebar=false;
  }
  $show_title=true;
  if (get_field('hide_title')=="1") 
  {
      $show_title=false;
  }
  $iso_images_max_w=390;
  $iso_images_min_w=340;
?>
<div id="centered_block"> 
<div id="main_block" class="row page-<?php echo get_the_ID();if ($show_sidebar==true) {echo " big_main_sided";} ?> ms_blog">
  <?php
    $extra_space="";
        if ($show_title==true)
        {
            prk_output_title("advanced");
            if ($show_sidebar==false)
              $extra_space=" prk_more_space";
        }
    ?>
  <div id="content">
        <div id="main" class="main_no_sections<?php echo $extra_space; ?>">
          <div class="twelve extra_pad columns centered">
              <div  class="<?php if ($show_sidebar) {echo "twelve columns sidebarized";}else{echo "twelve wided";} ?>">
              <?php
              $cat = get_term_by('name', single_cat_title('',false), 'category'); 
              if (!($cat)!=1)
                  $cat_selector=$cat->slug;
              else
                  $cat_selector="";
              $tagname = get_query_var('tag');
              //APPLY FILTERS FOR TAG IF NEEDED
              if ($tagname!="")
                  $tag_selector=$tagname;
              else
                  $tag_selector="";
              $my_query = new WP_Query();
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
              $monthnum = (get_query_var('monthnum')) ? get_query_var('monthnum') : "";
              $yearnum = (get_query_var('year')) ? get_query_var('year') : "";
              if ($paged>1)
              {
                  $excluder=get_option("sticky_posts");
              }
              else
              {
                  $excluder="";
              }
              $args = array( 
                  'post_type'=>'post', 
                  'paged' => $paged,
                  'category_name'=>$cat_selector,
                  "post__not_in" =>$excluder,
                  'tag'=>$tagname,
                  'year'=>$yearnum,
                  'monthnum'=>$monthnum);
              $my_query->query($args);
              $post_counter=($paged-1)*$posts_per_page;
              if ($my_query->have_posts()) : 
              $ins=0;
              if (get_field('thumbs_margin')!="") 
              {
                $thumbs_margin=get_field('thumbs_margin');
              }
              else
              {
                $thumbs_margin=20;
              }
              ?>
              <div id="blog_masonry_father">
              <div id="blog_entries_masonr" data-max-width="<?php echo $iso_images_max_w; ?>" data-min-width="<?php echo $iso_images_min_w; ?>" data-margin="<?php echo $thumbs_margin; ?>" class="prk_section clearfix">
                          <?php
                while ($my_query->have_posts()) : $my_query->the_post(); 
                  $post_counter++;
                  if (get_field('featured_color')!="")
                                    {
                                      $featured_color=get_field('featured_color');
                                      $featured_class="featured_color ";
                                    }
                                    else
                                    {
                                      $featured_color="default";
                                      $featured_class="";
                                    }
                  ?>
                  <div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?> blog_entry_li cf<?php if ($post_counter == $my_query->post_count) echo " last_li"; ?>" data-type="<?php $category= get_the_category();
                  foreach($category as $test) 
                  { 
                    echo $test->slug;echo " ";
                  }  ?>" data-id="id-<?php echo $post_counter; ?>" data-color="<?php echo $featured_color; ?>">
                    <?php 
                      $less_size="";
                      if (has_post_thumbnail( $post->ID ) ):
                        //GET THE FEATURED IMAGE
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                        $image[0] = get_image_path($image[0]);
                        $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                        
                      else :
                        //THERE'S NO FEATURED IMAGE
                      endif; 
                      if (has_post_thumbnail( $post->ID ) )
                      { 
                        ?>
                        <a href="<?php the_permalink() ?>" class="fade_anchor" data-color="<?php echo $featured_color; ?>">
                                                <div class="masonr_img_wp boxed_shadow">
                                                  <div class="blog_fader_grid">
                                                    <div class="navicon-plus titled_link_icon body_bk_color"></div>
                                                  </div>
                            <?php        
                              $vt_image = vt_resize( '', $image[0] , 680, 0, false , $retina_flag );//620 is for single row on small screens
                            ?>
                            <img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
                                                </div>
                        </a>
                        <?php
                      }
                      else
                      {
                        //CHECK IF THERE'S A VIDEO TO SHOW
                                            if (get_field('video_2')!="")
                                            {
                                              $el_class='video-container boxed_shadow';
                          if (strpos(get_field('video_2'),'soundcloud.com') !== false) {
                            $el_class= 'soundcloud-container';
                          }
                          echo "<div class='".$el_class."'>";
                          echo get_field('video_2');
                                                    echo "</div>";
                                            }
                                            else
                                            {
                                              $less_size=" less_meta_pad";
                          ?>
                                                <div class="blog_top_image eight_margin">&nbsp;</div> 
                                                <?php
                                            }
                      }
                    ?>
                    <div class="prk_mini_meta<?php echo $less_size; ?>">
                      <?php
                                          if (is_sticky())
                                        {
                                            ?>
                                              <div class="left_floated default_color sticky_text">
                                                  <?php echo $prk_translations['sticky_text']; ?>
                                              </div>
                                            <?php
                                            echo '<div class="left_floated">&nbsp;/&nbsp;</div>';
                                        }
                                    ?>
                                    <div class="left_floated default_color">
                                        <?php 
                                          echo the_time(get_option('date_format')); 
                                        ?>
                                      </div>
                                      <?php
                                            if ($prk_astro_options['categoriesby_blog']=="1")
                                            {
                                              echo '<div class="left_floated">&nbsp;/&nbsp;</div>';
                                                ?>
                                                  <div class="left_floated blog_categories default_color">
                                                        <?php 
                                                          the_category(', '); //CATS WITH LINKS 
                                                        ?>
                                                    </div>
                                                <?php
                        }
                                      ?>
                                      <div class="clearfix"></div>
                                  </div>
                    <div class="entry_title entry_title_single">
                      <h4 class="masonr_title zero_color bd_headings_text_shadow">
                        <a href="<?php the_permalink(); ?>" class="fade_anchor prk_break_word" data-color="<?php echo $featured_color; ?>">
                          <?php the_title(); ?>
                        </a>
                      </h4>
                                        <div class="clearfix"></div>
                                        </div>
                      <div class="on_colored entry_content">
                        <div class="masonr_text prk_break_word">
                          <?php echo the_excerpt_dynamic(30); ?></div>
                         <div class="clearfix"></div>
                                          </div>
                                        <div class="simple_line zero_margin_bottom"></div>
                                        <div class="blog_lower header_font prk_heavy">
                                          <?php 
                                            if (comments_open())
                                            {
                                              ?>
                                              <div class="single_blog_meta_div">
                                                <div class="left_floated zero_color">
                                                  <a href="<?php comments_link(); ?>">
                                                    <div class="navicon-bubbles-2 left_floated"></div>
                                                          <?php 
                                                                comments_number($prk_translations['comments_no_response'], $prk_translations['comments_one_response'], '% '.$prk_translations['comments_oneplus_response']);
                                                            ?>
                                                          </a> 
                                                      </div>
                                            </div>
                                            <?php
                                          }
                                    ?>
                                        <div class="single_blog_meta_div right_floated">
                                                <a href="<?php the_permalink() ?>" class="fade_anchor zero_color" data-color="<?php echo $featured_color; ?>">
                                                    <div class="left_floated">
                                                      <?php echo($prk_translations['read_more']); ?>
                                                    </div>
                                                    <div class="navicon-forward left_floated"></div>
                                                </a>
                                        </div>
                      </div>
                                        
                    </div>
                  <?php 
                  $ins++;
                endwhile;
                ?>  
          </div>
        <?php endif; 
        //SHOW NAVIGATION
        if ($my_query->max_num_pages>1)
        {
          ?>
                <div id="entries_navigation_blog">
            <div class="navigation twelve body_text_shadow default_color header_font fade_anchor">
              <?php
                next_posts_link('<div class="navicon-backward left_floated"></div><div class="left_floated">'.$prk_translations['older'].'</div>',$my_query->max_num_pages); 
                previous_posts_link('<div class="left_floated">'.$prk_translations['newer'].'</div><div class="navicon-forward left_floated"></div>',$my_query->max_num_pages); 
              ?>
                  </div>
              </div> 
                  <?php
        }
      ?>
  </div>
  </div>
    <?php 
      if ($show_sidebar) 
      {
        ?>
        <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated masonrized" role="complementary">
            <?php get_sidebar(); ?>
        </aside>
        <?php
      }
    ?>
    <div class="clearfix"></div>
      </div>
    </div>
</div>
</div>
</div>
  <?php
}//MASNORY
?>
<?php get_footer(); ?>
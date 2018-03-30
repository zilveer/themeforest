<?php /*
Template Name: Fullwidth
*/ ?>
<?php get_header(); ?>
<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    }
?>
    <div id="border_top"></div><!--  END "border_top"  //-->
    <div id="header" class="clearfix">
        <div id="logo">
        	<a href="<?php echo get_bloginfo('wpurl');?>">
            <img src="<?php echo $lcp_hp_toplogo;?>" alt="<?php echo get_bloginfo('name');?>" id="lclogo"/>
          </a>
        </div><!--  END "logo"  //-->
        <div id="header_contacts"><?php echo $lcp_contact_info; ?></div>
    </div><!--  END "header"  //-->
    <div id="container" class="clearfix">
    <div id="toppanel" class="clearfix">
            <div id="navigation">
                <ul>
                    <li class="<?php if(is_home()){echo "current_page_item";}?>"><a href="<?php echo get_bloginfo('wpurl');?>"><?php echo $lcp_home_name; ?></a></li>
                    <?php wp_list_pages('exclude='.$lcp_nav_exclude.'&sort_column=menu_order&title_li='); ?>
                    <li class="<?php if( post_is_in_descendant_category($lcp_portfolio_id) && !is_home() ){echo "current_page_item";} ?>"><a href="<?php echo get_category_link($lcp_portfolio_id); ?>"><?php echo get_cat_name($lcp_portfolio_id); ?></a>
                    <ul>
                    <?php wp_list_categories('title_li=&child_of='.$lcp_portfolio_id); ?>
                    </ul>
                    </li>
                    <li class="<?php if( post_is_in_descendant_category($lcp_blog_id) && !is_home() ){echo "current_page_item";} ?>"><a href="<?php echo get_category_link($lcp_blog_id); ?>"><?php echo get_cat_name($lcp_blog_id); ?></a>
                     <ul>
                    <?php wp_list_categories('title_li=&child_of='.$lcp_blog_id); ?>
                    </ul>
                    </li>
                    <li><a href="<?php echo get_permalink($lcp_contact_id); ?>"><?php echo $lcp_contact_name; ?></a>
                    </li>
                </ul><!--  END for whole navigation UL  //-->
            </div><!--  END "navigation"  //-->
            <div id="search">
                <form id="searchform" action="<?php echo get_bloginfo('wpurl');?>" method="get">
                        <input id="s" class="field" type="text" onblur="if (this.value == '') {this.value = '<?php echo $lcp_nav_input;?>';}" onfocus="if (this.value == '<?php echo $lcp_nav_input;?>') {this.value = '';}" value="<?php echo $lcp_nav_input;?>" name="s"/>
                        <input class="submit" type="submit" name="submit" value="<?php echo $lcp_nav_searchbut; ?> "/>
                  </form>
            </div><!--  END "search"  //-->
        </div><!--  END "toppanel"  //-->
        
    
        <div id="content_wrap">
            <div id="inner_content">
               <?php 
               $frontpage = false;
               if(is_front_page()){
                $frontpage = true; 
               query_posts($query_string."&cat=".$lcp_blog_id."&posts_per_page=".$lcp_hp_post_per_page); 
               }
                
               ?>
               <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               
                <?php if(post_is_in_descendant_category($lcp_blog_id)) 
               {?>
                <div class="entry fullwidth"" id="post-<?php the_ID();?>">
                <?php if(get_post_meta($post->ID, 'mainimg', true) != ""){ ?>
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'mainimg', true)."&amp;h=170&amp;w=560&amp;zc=1"; ?>" alt="postimg"/></a>
               <?php } ?>
                   <div class="date clearfix">
                        <div class="date_holder">
                            <?php the_time('\<\s\p\a\n \c\l\a\s\s\=\"\m\o\n\t\h\"\>M\<\s\p\a\n\ \c\l\a\s\s\=\"\y\e\a\r\"\> Y \<\/\s\p\a\n\>\<\/\s\p\a\n\>\<\s\p\a\n\ \c\l\a\s\s\=\"\d\a\y\"\>d\<\/\s\p\a\n\>','',''); ?>
                        </div><!--  END "date_holder"  //-->
                    </div><!--  END "date"  //-->
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a><?php comments_popup_link('0','1', '%', 'comment_counter'); ?></h1>
                        <h3>Posted In <span><?php the_category(','); ?></span></h3>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                       
                            	<?php the_content(__('[..]')); ?>
                              <?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
                    <div class="comments">
                    <?php comments_template(); ?>
                    </div>
                </div><!--  END "entry"  //-->
                <?php } ?>
               <?php if(post_is_in_descendant_category($lcp_portfolio_id) || is_page()) 
               {?>
               <div class="entry fullwidth"">
               <?php if(get_post_meta($post->ID, 'mainimg', true) != ""){ ?>
                    <a href="<?php echo get_bloginfo('template_url')."/".get_post_meta($post->ID, 'mainimg', true); ?>" rel="prettyPhoto[portfolio]" title="Project No.1"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'mainimg', true)."&amp;h=170&amp;w=560&amp;zc=1"; ?>" alt="port1.jpg"/></a>
               <?php } ?>    
                    <div class="title_holder">

                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                       	<?php the_content(__('[..]')); ?>
                       	<?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
                </div><!--  END "entry"  //-->

               <?php } ?>
              
            <?php endwhile;
            
             else: ?>
            <p><?php echo $lsp_s_nopost; ?></p>
            <?php endif; ?>
            <?php// wp_reset_query(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  <!-- You need to have WP-PageNavi plugin installed for using this!-->
            </div><!--  END "inner_content"  //-->

        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->
    

<?php get_footer(); ?>
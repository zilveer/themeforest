<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>

	<!-- Sidebar -->
<?php if(is_single()) { ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-one-single') ) :  endif;?>


    	<?php $post_id = get_post(get_the_ID()); ?>
        
        
        <?php if(get_option('im_theme_single_detail') == 'true'){ ?>
        <!-- post detail -->
        <div class="categories">
        	<h2><?php echo get_option('im_sidebar_lang_single_post_detail', true); ?></h2>
            <ul class="bloginfo">
            	<li>
                	<img src="<?php bloginfo('template_url'); ?>/image/01.png" alt="" class="post-icon"> 
					<?php echo get_option('im_sidebar_lang_single_post_detail_author', true); ?>: <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a>
                </li>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/02.png" alt="" class="post-icon"> 
					<?php echo get_option('im_sidebar_lang_single_post_detail_date', true); ?>: <?php echo get_the_date(); ?>
                </li>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/03.png" alt="" class="post-icon">
					<?php echo get_option('im_sidebar_lang_single_post_detail_categories', true); ?>: <?php 
							foreach((get_the_category(get_the_ID())) as $category) { 
								echo '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a> ';
							} 
					?>
				</li>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/04.png" alt="" class="post-icon"> 
					<?php echo get_option('im_sidebar_lang_single_post_detail_total', true); ?>: <a href="#"><?php echo $post_id->comment_count; ?> <?php echo get_option('im_sidebar_lang_single_post_detail_comments', true); ?></a>
                </li>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/06.png" alt="" class="post-icon">
                	<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" class="fancypicture" title="<?php the_title(); ?>"><?php echo get_option('im_sidebar_lang_single_post_detail_view_post_image', true); ?></a>
                </li>
                <?php if(get_post_meta($post->ID, 'im_theme_portfolio_video_url', true) != '' and get_post_meta($post->ID, 'im_theme_portfolio_video_url', true) != 'http://'){  ?>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/07.png" alt="" class="post-icon"> 
                    <a href="<?php echo get_post_meta($post->ID, 'im_theme_portfolio_video_url', true); ?>" class="fancyvideo"><?php echo get_option('im_sidebar_lang_single_post_detail_watch_post_video', true); ?></a>
                </li>
                <?php } ?>
                <?php if(get_post_meta($post->ID, 'im_theme_portfolio_iframe_url', true) != ''){  ?>
                <li>
                	<img src="<?php bloginfo('template_url'); ?>/image/08.png" alt="" class="post-icon"> 
                	<a href="<?php echo get_post_meta($post->ID, 'im_theme_portfolio_iframe_url', true); ?>" class="fancylink"><?php echo get_option('im_sidebar_lang_single_post_detail_look_post_iframe', true); ?></a>
                 </li>
                 <?php } ?>
            </ul>
            <span class="clear"></span>
        </div><!-- .categories -->
        <?php } ?>
        
        
        
        <?php if(get_option('im_theme_single_tag') == 'true'){ ?>
        <!-- Populer Tags -->
        <div class="tags">
        	<h2><?php echo get_option('im_sidebar_lang_single_post_tags', true); ?></h2>
            <ul>
            <?php
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
					echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
				  }
				}
			?>
            </ul>
            <span class="clear"></span>
        </div><!-- .tags -->
        <?php } ?>
        
        
        
        <?php if(get_option('im_theme_single_related') == 'true'){ ?>
        <!-- Related Post-->
        <div class="sidebar-comments">
            <h2><?php echo get_option('im_sidebar_lang_single_related_post', true); ?></h2>
            <ul>
            <?php
			global $post;
			$tmp_post = $post;
			$args = array( 'numberposts' => 5, 'offset'=> 1 );
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata($post); ?>
				<li>
                	<a class="tip" href="<?php the_permalink(); ?>">
                    	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" alt="" width="60" height="60">
                    </a>
                    <h1 class="sidebar-last-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> 
                    <p>By <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></p> 
                </li>
			<?php endforeach; ?>
			<?php $post = $tmp_post; ?>
            </ul>
            <span class="clear"></span>
        </div> <!-- /.sidebar-comments -->
        
        
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-two-single') ) :  endif;?>
        <?php } ?>
        
        
 <?php } else { ?>
        
        <?php // CONTACT FORM SIDEBAR MODULE ?>
        <?php if(get_post_meta(get_the_ID(), 'im_theme_page_type', true) == 'CONTACT' and is_page()) { ?>
        
                <!-- Categories -->
            <div class="categories">
                <h2><?php echo get_option('im_sidebar_lang_single_adress_detail', true); ?></h2>
                <ul class="bloginfo">
                <?php if(get_option('im_theme_contact_name',true) != '') { ?>
                    <li><img src="<?php bloginfo('template_url'); ?>/image/01.png" alt="" class="post-icon"> Name : <?php echo get_option('im_theme_contact_name',true); ?></li>
                <?php } ?>
                <?php if(get_option('im_theme_contact_telephone',true) != '') { ?>
                    <li><img src="<?php bloginfo('template_url'); ?>/image/contact.png" alt="" class="post-icon"> Telephone: <?php echo get_option('im_theme_contact_telephone',true); ?></li>
                <?php } ?>
                <?php if(get_option('im_theme_contact_fax',true) != '') { ?>
                    <li><img src="<?php bloginfo('template_url'); ?>/image/print.png" alt="" class="post-icon"> Fax: <?php echo get_option('im_theme_contact_fax',true); ?></li>
                <?php } ?>
                <?php if(get_option('im_theme_contact_email',true) != '') { ?>
                    <li><img src="<?php bloginfo('template_url'); ?>/image/email.png" alt="" class="post-icon"> E-Mail: <a href="<?php echo get_option('im_theme_contact_email',true); ?></a>"><?php echo get_option('im_theme_contact_email',true); ?></a></li>
                <?php } ?>
                <?php if(get_option('im_theme_contact_web',true) != '') { ?>
                    <li><img src="<?php bloginfo('template_url'); ?>/image/world.png" alt="" class="post-icon"> Web: <a href="<?php echo get_option('im_theme_contact_web',true); ?>"><?php echo get_option('im_theme_contact_web',true); ?></a></li>
                <?php } ?>
                </ul>
                <span class="clear"></span>
            </div><!-- .categories -->

        <?php } else { ?>
        
        
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-one-blog') ) :  endif;?>
        
        <?php if(get_option('im_theme_sidebar_cat') == 'true'){ ?>
        <!-- Categories -->
        <div class="categoriesim">
			 <?php wp_list_categories(  array( 'title_li'  => '<h2>' . __(get_option('im_sidebar_lang_blog_categories', true)) . '</h2>') ); ?>
            <span class="clear"></span>
        </div><!-- .categories -->
        <?php } ?>
        
        
        <?php if(get_option('im_theme_sidebar_tag') == 'true'){ ?>
        <!-- Populer Tags -->
        <div class="tags">
        	<h2><?php echo get_option('im_sidebar_lang_blog_populer_tags', true); ?></h2>
   			<ul>                     
                <?php        
					$tags = get_tags();
					$html = '';
					foreach ($tags as $tag){
						$tag_link = get_tag_link($tag->term_id);
								
						$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag'>";
						$html .= "{$tag->name}</a></li>";
					}
					$html .= '';
					echo $html;		
				?>
 			 </ul>  
    		<span class="clear"></span>
        </div><!-- .tags -->
        <?php } ?>
         
         
         
        <?php if(get_option('im_theme_blog_archive') == 'true'){ ?>
        <!-- Categories -->
        <div class="categories">
        	<h2><?php echo get_option('im_sidebar_lang_blog_archive', true); ?></h2>
            <ul>
            	<?php wp_get_archives(); ?> 
            </ul>
            <span class="clear"></span>
        </div><!-- .categories -->
        <?php } ?>
        
        
        
        <?php if(get_option('im_theme_last_comment') == 'true'){ ?>
        <!-- Latest Comments-->
        <div class="sidebar-comments">
            <h2><?php echo get_option('im_sidebar_lang_blog_last_comment', true); ?></h2>
            <ul>
				<?php
                    $args = array(
                        'number' => '5'
                    );
                    $comments = get_comments($args);
                    foreach($comments as $comment) :
						echo '
						<li><a href="'.get_permalink($comment->comment_post_ID).'" class="tip">'.get_avatar($comment->comment_author_email, 48).'</a> 
							<h1 class="sidebar-last-post"><a href="'.get_permalink($comment->comment_post_ID).'">'.get_the_title($comment->comment_post_ID).'</a></h1> 
							<p>by '.$comment->comment_author.'</p> 
						</li>
						';
                    endforeach;
                ?>

            </ul>
            <span class="clear"></span>
        </div>
        <?php } ?>
        
        
        
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-two-blog') ) :  endif;?>
        
        
        
        <?php } // contact form yoksa buradakileri calistir ?>
        <?php } ?>
		

	
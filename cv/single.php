<?php
/**
 * The Template for displaying all single posts.
 *
 * @package shift_cv
 */

get_header(); 

$mult = min(2, max(1, get_theme_option("retina_ready")));

$profile_title = get_theme_option('profile_title');
$home = get_home_url();
if (get_theme_option('homepage')=='blog')
	$home .= (my_strpos($home, '?')===false ? '?' : '&') . 'cv=1';
?>
	<section id="profile" class="section profile_section odd first blog_page">
		<?php if(get_theme_option('profile_enable') == 'yes') { ?>
		<a href="<?php echo $home; ?>" id="profile_page_link"><span class="icon-user icon"></span><span class="label"><?php echo $profile_title; ?></span></a>
		<?php } ?>
		<div class="section_header profile_section_header">
			<?php
				// User data
				$user_lastname = get_theme_option('user_lastname');
				$user_firstname = get_theme_option('user_firstname');
				$user_photo = getResizedImageURL(get_theme_option('user_photo'), 117*$mult, 117*$mult);
				$user_position = get_theme_option('user_position');
			?>
			<div id="profile_header">
				<div id="profile_user">
					<div id="profile_photo"><a href="<?php echo $home; ?>"><img src="<?php echo $user_photo; ?>" alt="<?php echo $user_lastname.' '.$user_firstname; ?>" border="0" /></a></div>
					<div id="profile_name_area">
						<div id="profile_name">
							<h1 id="profile_title"><span class="firstname"><?php echo $user_firstname; ?></span> <span class="lastname"><?php echo $user_lastname; ?></span></h1>
							<h4 id="profile_position"><?php echo $user_position; ?></h4>
						</div>								
					</div>
				</div>	
			</div>	
		</div>
	</section>	
	<section id="breadcrumbs" class="section breadcrumbs_section even">
		<div class="section_header breadcrumbs_section_header">
			<?php showBreadcrumbs( array('home' => get_theme_option('homepage')!='blog' ? __('Home', 'wpspace') : '', 'truncate_title' => 50, 'show_all_posts'=>true ) ); ?>
        </div>
    </section>
	<div id="primary" class="content_area">
		<div id="content" class="site_content post_content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php setPostViews(get_the_ID()); ?>

                <?php
				global $theme_custom_settings, $sidebar_position;

				$tpl_dir = get_template_directory_uri();
				$post_id = get_the_ID();
				$full_time = '';
				$post_type = get_post_type();
				$post_format = get_post_format();
				$post_format_data = trim(chop($post_format ? get_post_meta($post_id, 'custom_post_format', true) : ''));
				$post_link = get_permalink();
				$post_title = getPostTitle();
				$post_comments = get_comments_number();
				$post_protected = post_password_required();
				$post_date = get_the_date();
				$post_views = getPostViews($post_id);
				$post_categories = getCategoriesByPostId($post_id);
				$post_categories_str = '';
				$post_categories_slugs = array();
				for ($i = 0; $i < count($post_categories); $i++) {
					$post_categories_str .= ($i > 0 ? ',' : '') . '<a href="' . $post_categories[$i]['link'] . '" class="post_categories '. ($i%2==0 ? 'even' : 'odd') . ($i==0 ? ' first' : '') . ($i==count($post_categories)-1 ? ' last' : '') . '">' . $post_categories[$i]['name'] .'</a>';
					$post_categories_slugs[] = $post_categories[$i]['slug'];
				}
				//$post_video_thumb = getResizedImageTag($post_id, 510*$mult, 295*$mult); //get_ the_post_thumbnail($post_id, 'slider');
				$post_thumb = getResizedImageTag($post_id, ($sidebar_position=='fullwidth' ? 755 : 510)*$mult, null, false, false);
				
				// Author info
				$author_id = get_the_author_meta( 'ID' );
				$author_name = get_the_author();
				$author_link = get_author_posts_url( $author_id );
				$author_email = get_the_author_meta('user_email', $author_id);
				$author_avatar = get_avatar($author_email, 142);
				$author_descr = get_the_author_meta('description', $author_id);
				$title_level = get_theme_option('title_level')+1;
				$teaser = get_theme_option('show_teaser');
				$post_icon = 'icon-pencil';
				if($post_format == 'gallery') {
					$post_icon = 'icon-camera';
				}
				else if($post_format == 'audio') {
					$post_icon = 'icon-music';
				}
				else if($post_format == 'link') {
					$post_icon = 'icon-link';
				}
				else if($post_format == 'video') {
					$post_icon = 'icon-eye-open';
				}
				else if($post_format == 'quote') {
					$post_icon = 'icon-quote-right';
				}
				else if($post_format == 'status') {
					$post_icon = 'icon-bullhorn';
				}
				if(get_theme_option('full_date') === 'yes') {
					$full_post_date = get_the_date();
					$full_time ='<div class="full_post_date"><span class="icon icon-time"></span>'.$full_post_date.'</div>';
				}						
				?>

				<section class="section post_section blog_section">
					<div class="section_header post_section_header <?php echo $post_format; ?>">
					<?php if ($post_type == 'post') { ?>
						<h2 class="section_title post_section_title"><strong><span class="icon <?php echo $post_icon; ?>"></span><span class="section_name"><?php echo date_i18n('M.d', strtotime($post_date)); ?></span></strong></h2>
					<?php if (!$post_protected) { ?>
						<div class="post-info">
							<?php echo $full_time; ?>
							<a href="<?php echo $author_link; ?>" class="post_author"><span class="icon icon-user"></span><?php echo $author_name; ?></a>
							<a href="<?php echo $post_link; ?>" class="comments_count"><span class="icon icon-comment"></span><?php echo $post_comments; ?></a>
						</div>
					<?php } // !protected ?>
					<?php } // type=='post' ?>
					</div>
					<div class="section_body post_section_body">
						<article id="post_<?php echo $post_id; ?>" <?php post_class('format-' . ($post_format ? $post_format : 'standard')); ?>>
							<h<?php echo $title_level; ?> class="post_title"><?php echo $post_title; ?></h<?php echo $title_level; ?>>
				<?php
				if (!$post_protected) {

					if ( $post_format == 'gallery' && $post_format_data != '' ) {		//======================================== Gallery format
						$pfd = explode("\n", $post_format_data);
						$photos_str = '';
						foreach ($pfd as $ph) {
							$ph = trim(chop($ph));
							if ($ph != '') $photos_str .= '
								<li>
									<img src="' . $ph . '" border="0" alt="" />
								</li>';
						}
						if ($photos_str) {
						?>
							<div class="post_gallery slider_container">
								<ul class="slides">
									<?php echo $photos_str; ?>
								</ul>
							</div>
						<?php
						}
					} else if ( $post_format == 'video' && $post_format_data != '' ) {	//======================================== Video format
						$urls = explode("\n", $post_format_data);
						foreach ($urls as $url) {
							$post_video = getVideoPlayerURL($url);
					?>
							<div class="post_video">
								<iframe class="video_frame" src="<?php echo $post_video; ?>?wmode=opaque&autoplay=0" width="620" height="295" frameborder="0" webkitAllowFullScreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowFullScreen"></iframe>
							</div>
					<?php
						}
					} else if ( $post_format == 'audio' && $post_format_data != '' ) { 
						$urls = explode("\n", $post_format_data);
						foreach ($urls as $url) {
					?>
							<audio src="<?php echo trim(chop($url)); ?>" width="100%" height="60px"></audio>
					<?php 
						}
					} else if ($post_thumb && !is_attachment()) {											//======================================== All other formats
					?>
						<div class="post_thumb">
							<?php echo $post_thumb; ?>
						</div>
					<?php 
					}
	
					if ($post_format == 'link' && $post_format_data != '' ) {			//======================================== Link format
						$urls = explode("\n", $post_format_data);
						foreach ($urls as $url) {
					?>
							<div class="link">
								<a href="<?php echo trim(chop($url)); ?>"><?php echo trim(chop($url)); ?></a>
							</div>
					<?php 
						}
					}
				} // if (!$post_protected)
				?>
				<div class="content_text">
                    <?php the_content('', $teaser); ?>
					<?php wp_link_pages( array( 
						'before' => '<div class="nav_pages_parts"><span class="pages">' . __( 'Pages:', 'wpspace' ) . '</span>', 
						'after' => '</div>',
						'link_before' => '<span class="page_num">',
						'link_after' => '</span>'
						) ); ?>
                </div>

                <?php if (!$post_protected) { ?>
                	<div class="post_additional">
					<?php if ($post_type == 'post') {
						//===================================== Post tags list =====================================
						
						if ($post_categories_str) { ?><span class="post_categories"><span class="icon-align-<?php if (is_rtl()) {echo 'right';} else {echo 'left';}?>"></span><?php echo $post_categories_str; ?></span><?php }
						
						//===================================== Post Categories list =============================
						
						$post_tags_temp = wp_get_post_tags($post_id);
						$post_tags = '';								
						if(count($post_tags_temp) >= 1) {
							$post_tags .= '<div class="post_tags"><span class="icon icon-tag"></span>';
							$i = 0;
							$total = count($post_tags_temp);
							foreach ($post_tags_temp as $k) {
								$term_id = (int)$k->term_id;
								$tag_link = get_term_link($term_id, 'post_tag');
								$i++;
								$tag_name = $k->name;
								if($total > $i) {
									$tag_name .= ',';
								}
								if($tag_link) {
									$post_tags .='<a href="'.$tag_link.'">'.$tag_name.'</a>';
								}
							}
							$post_tags .='</div>';
						}
						echo $post_tags;
						?>
						</div>
						<?php
						
                        //===================================== Social Share =====================================
						if (get_theme_option("blog_show_post_share") == 'yes') {
						?>
                            <div class="block-social">
                                <div class="soc_label"><?php _e('Share this Story:', 'wpspace'); ?></div>
                                <?php
                                    showShareSocialLinks(array(
                                        'post_link' => $post_link,
                                        'post_title' => $post_title,
                                        'icon_size' => '',
                                        'allowed' => array('facebook', 'twitter', 'gplus')
                                    ));
	                            ?>
                            </div>
						<?php
						}
					} // if (post_type != 'page') 
				} // if (!post_password_required())
				?>
    	        </article>
    			
                <?php if (!$post_protected) { ?>
					<?php if ($post_type == 'post') { ?>   
						<?php
                        //===================================== Post author info =====================================
                        if (get_theme_option("blog_show_post_author") == 'yes') {
                        ?>
                            <div id="post_author">
                                <div class="photo"><a href="<?php echo $author_link; ?>"><?php echo $author_avatar; ?></a></div>
                                <h3><a href="<?php echo $author_link; ?>"><span><?php echo __('About', 'wpspace'); ?></span> <?php echo $author_name; ?></a></h3>
                                <div class="extra_wrap">
                                    <div class="description"><?php echo nl2br($author_descr); ?></div>
                                </div>	
                            </div>
                        <?php
                        }
					} //if ($post_type == 'post') {
                    ?>
                        
                        <?php
                        //===================================== Related posts =====================================
                        if (get_theme_option("blog_show_related_posts") == 'yes') {
							$args = array( 'numberposts' => '6', 'post_type' => $post_type);
							$args['post_type'] = $post_type;
							$args['post_status'] = 'publish';
							$args['post__not_in'] = array($post_id);
							if ($post_categories_str) {
								$args['tax_query'] = array(
									array(
										'taxonomy' => $post_type=='portfolio' ? 'category_portfolio' : 'category',
										'field' => 'slug',
										'terms' => $post_categories_slugs
									)
								);
							}
							$recent_posts = wp_get_recent_posts( $args );
							if (count($recent_posts) > 0) {
						?>
							<div id="related_posts">
								<h3 class="section_title"><span class="icon"></span><?php _e('Related posts', 'wpspace'); ?></h3>
								<?php
								$i=0;
								foreach( $recent_posts as $recent ) {
									$i++;
									$recent['link'] = get_permalink($recent['ID']);
									if ($recent['post_date'] > date('Y-m-d 23:59:59') && $recent['post_date_gmt'] > date('Y-m-d 23:59:59')) continue;
									if ($recent['ID'] == $post_id) continue;
									?>
									<article id="post_<?php echo $recent['ID']; ?>" class="related_posts <?php echo ($i % 2 == 0 ? 'even' : 'odd') . ($i==1 ? ' first' : ''); ?>">
										<h3><a href="<?php echo $recent['link']; ?>"><?php echo getShortString($recent['post_title'], 50); ?></a></h3>
										<div class="post-info">
											<a href="<?php echo $recent['link']; ?>" class="post_date"><span class="icon-time"></span><?php echo date_i18n('M.d', strtotime($recent['post_date'])); ?></a>
											<a href="<?php echo $recent['link']; ?>"><span class="icon-user"></span><?php echo get_the_author(); ?></a>
										</div>
									</article>
									<?php
									if ($i>=2) break;
								}
								?>
							</div>
							<?php
							}
						}	// if (blog_show_related_posts)
                	} // if (!post_password_required())
				//===================================== Comments =====================================
                if ( comments_open() || get_comments_number() != 0 ) { 
                    comments_template();
                    if(get_theme_option('comment_button')) {
                ?>
                <a href="#comments" id="scrollTo"><span class="label"><?php _e("Comment", "wpspace"); ?></span><span class="icon icon-comment"></span></a>
				<?php 
						}
					}
                ?>
    
            <?php endwhile; // end of the loop. ?>
    
		</div><!-- #post_content -->
	</div><!-- #primary -->
</div>	
<?php 
	get_sidebar();
	get_footer(); 
?>
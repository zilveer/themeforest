<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package shift_cv
 */

get_header();
$is_colpsd = get_theme_option('profile_collapsed') == 'yes' ? true : false;
$mult = min(2, max(1, get_theme_option("retina_ready")));
?>
	<div id="primary" class="content_area<?php echo $is_colpsd ? ' collapsed' : ''; ?>">
		<div id="content" class="site_content" role="main">

			<section id="profile" class="section profile_section first odd">
				<?php
					
					$blog_page = getTemplatePageId('blog');
					if ($blog_page || get_theme_option('homepage') == 'blog') { ?>
						<?php if(get_theme_option('blog_enable') == 'yes') { ?>
						<a href="<?php echo get_permalink($blog_page); ?>" id="blog_page_link"><span class="icon-pencil icon"></span><span class="label"><?php echo __('Blog', 'wpspace') ?></span></a>
						<?php } ?>
					<?php 								
						}
				?>
				<div class="section_header profile_section_header<?php if(!$is_colpsd) { ?> opened<?php } ?>">
					<?php
						// User data
						$user_lastname = get_theme_option('user_lastname');
						$user_firstname = get_theme_option('user_firstname');
						$user_birthday = get_theme_option('user_birthday');
						$user_photo = getResizedImageURL(get_theme_option('user_photo'), 117*$mult, 117*$mult);
						$user_position = get_theme_option('user_position');
						$user_address = get_theme_option('user_address');
						$user_phone = get_theme_option('user_phone');
						$user_email = get_theme_option('user_email');
						$user_website = get_theme_option('user_website');
						$user_company = get_theme_option('user_company');
						$user_description = get_theme_option('user_description');
						$profile_title = get_theme_option('profile_title');
					?>
					<h2 class="section_title profile_section_title<?php if(!$is_colpsd) { ?> vis<?php } ?>"><a href="#"><span class="icon icon-user"></span><span class="section_name <?php echo $is_colpsd ? 'show' : ''; ?>"><?php echo $profile_title; ?></span></a><span class="section_icon"></span></h2>
					<div id="profile_header">
                        <div id="profile_user">
                        	<?php if($user_photo) { ?>
                            <div id="profile_photo"><img src="<?php echo $user_photo; ?>" alt="<?php echo $user_lastname.' '.$user_firstname; ?>" /></div>
                            <?php } ?>
                            <div id="profile_name_area">
                                <div id="profile_name">
                                    <h1 id="profile_title"><span class="firstname"><?php echo $user_firstname; ?></span> <span class="lastname"><?php echo $user_lastname; ?></span></h1>
                                    <h4 id="profile_position"><?php echo $user_position; ?></h4>
                                </div>                              
                            </div>
                        </div>                 
						<div id="profile_data">
                            <?php if(!empty($user_firstname) || !empty($user_lastname)) : ?>                
							<div class="profile_row">
								<span class="th"><?php _e('Name', 'wpspace'); ?>:</span><span class="td"><?php echo $user_firstname.' '.$user_lastname; ?></span>
							</div>
                            <?php endif; ?>
                            <?php if(!empty($user_birthday)) : ?>
							<div class="profile_row">
								<span class="th"><?php _e('Date of birth', 'wpspace'); ?>:</span><span class="td"><?php echo $user_birthday; ?></span>
							</div>
                            <?php endif; ?>
                            <?php if(!empty($user_address)) : ?>
							<div class="profile_row">
								<span class="th"><?php _e('Address', 'wpspace'); ?>:</span><span class="td"><?php echo $user_address; ?></span>
							</div>
                            <?php endif; ?>
                            <?php if(!empty($user_phone)) : ?>
							<div class="profile_row">
								<span class="th"><?php _e('Phone', 'wpspace'); ?>:</span><span class="td"><?php echo $user_phone; ?></span>
							</div>
                            <?php endif; ?>
                            <?php if(!empty($user_email)) : ?>
							<div class="profile_row">
								<span class="th"><?php _e('Email', 'wpspace'); ?>:</span><span class="td"><?php echo $user_email; ?></span>
							</div>
                            <?php endif; ?>
                            <?php if(!empty($user_website)) : ?>
							<div class="profile_row">
								<span class="th"><?php _e('Website', 'wpspace'); ?>:</span><span class="td"><a href="<?php echo $user_website; ?>"><?php echo $user_website; ?></a></span>
							</div>
                            <?php endif; ?>
						</div>
						
					</div>	
				</div>
				<div class="section_body profile_section_body">
					<div class="proile_body">
						<?php echo $user_description; ?>
					</div>			
				</div>
			</section>	


<div id="mainpage_accordion_area">
<?php 
    $order_list = get_theme_option('section_sort');
    $order_arr = explode(',', $order_list);
    if(!empty($order_list)) {    
        foreach ($order_arr as $val) {
            get_template_part('template', $val);
        }
    }
    else {
        get_template_part('template', 'resume');
        get_template_part('template', 'portfolio');
        get_template_part('template', 'testimonials');
        get_template_part('template', 'contacts'); 
    }
?>

</div> <!-- #mainpage_accordion_area -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php 
	wp_reset_postdata();
	get_footer(); 
?>
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
 * @package cv_theme
 */

get_header();
add_filter('show_admin_bar', '__return_false');
wp_enqueue_style( 'print-theme', get_template_directory_uri().'/css/print.css' );
if  (is_rtl()){wp_enqueue_style( 'print-theme_rtl', get_template_directory_uri().'/css/print_rtl.css' );}

$mult = min(2, max(1, get_theme_option("retina_ready")));
?>
	<div id="primary" class="content_area">
        <script>
            jQuery(document).ready(function(){
                window.print();
            });
        </script>   
		<div id="content" class="site_content" role="main">

			<section id="profile" class="section profile_section first odd printable">
				<div class="section_header profile_section_header opened">
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
					?>
					<div id="profile_header">
                        <table width="100%">
                            <tr>
                                <td id="profile_user">
                                    <div id="profile_photo"><img src="<?php echo $user_photo; ?>" alt="<?php echo $user_firstname.' '.$user_lastname; ?>" border="0" /></div>
                                    <div id="profile_name_area">
                                        <div id="profile_name">
                                            <h1 id="profile_title"><span class="firstname"><?php echo $user_firstname; ?></span> <span class="lastname"><?php echo $user_lastname; ?></span></h1>
                                            <h4 id="profile_position"><?php echo $user_position; ?></h4>
                                        </div>                              
                                    </div>
                                </td>                 
        						<td id="profile_data">
        							<div class="profile_row">
        								<span class="th"><?php _e('Name', 'wpspace'); ?>:</span><span class="td"><?php echo $user_firstname.' '.$user_lastname; ?></span>
        							</div>
        							<div class="profile_row">
        								<span class="th"><?php _e('Date of birth', 'wpspace'); ?>:</span><span class="td"><?php echo $user_birthday; ?></span>
        							</div>
        							<div class="profile_row">
        								<span class="th"><?php _e('Address', 'wpspace'); ?>:</span><span class="td"><?php echo $user_address; ?></span>
        							</div>
        							<div class="profile_row">
        								<span class="th"><?php _e('Phone', 'wpspace'); ?>:</span><span class="td"><?php echo $user_phone; ?></span>
        							</div>
        							<div class="profile_row">
        								<span class="th"><?php _e('Email', 'wpspace'); ?>:</span><span class="td"><?php echo $user_email; ?></span>
        							</div>
        							<div class="profile_row">
        								<span class="th"><?php _e('Website', 'wpspace'); ?>:</span><span class="td"><a href="<?php echo $user_website; ?>"><?php echo $user_website; ?></a></span>
        							</div>
        						</td>
                            </tr>                                 
                        </table>                  
					</div>	
				</div>
				<div class="section_body profile_section_body">
					<div class="proile_body">
						<?php echo $user_description; ?>
					</div>			
				</div>
			</section>	

<?php
    // Get resume posts
    function resumeSort($c1, $c2) {
        return $c1['order'] < $c2['order'] ? -1 : ($c1['order']>$c2['order'] ? 1 : 0);
    }
	// Get resume posts
	$cats = getTaxonomiesByPostType(array('resume'), array('category_resume'));
	if (count($cats) > 0) {
        for ($i=0; $i<count($cats); $i++) {
            $opt = category_resume_taxonomy_custom_fields_get($cats[$i]['term_id']);
            $cats[$i]['order'] = isset($opt['category_order']) ? $opt['category_order'] : 999;
        }
        usort($cats, 'resumeSort');   
?>
			<section id="resume" class="section resume_section even printable">
				<div class="section_header resume_section_header">
				</div>
				<div class="section_body resume_section_body">
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
                        ?>
                        <div class="category resume_category resume_category_<?php echo $cat_number; ?><?php echo $cat_number==1 ? ' first' : ''; ?><?php echo $cat_number%2==1 ? ' even' : ' odd'; ?>">
                            <div class="category_header resume_category_header">
                                <h3 class="category_title"><span class="category_title_icon" style="background-color:<?php echo $cat_color; ?>"></span><?php echo $cat_title; ?></h3>
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
                                        <?php } ?>
                                        <h4 class="post_title"><span class="post_title_icon" style="background-color: <?php echo $cat_color; ?>"></span><?php echo $post_number.'.&nbsp;'.$post_title; ?></h4>
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
				<div class="sidebar resume_sidebar cleared">
                    <h2 class="sidebar_title">Skills</h2>
					<?php do_action( 'before_sidebar' ); ?>
					<?php if ( ! dynamic_sidebar( 'sidebar-resume' ) ) { ?>
					<?php } ?>
				</div>

			</section> <!-- #resume -->
<?php 
	} // if (count($cats)>0)
?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php 
	wp_reset_postdata();
	get_footer(); 
?>
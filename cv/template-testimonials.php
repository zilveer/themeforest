<?php
    $mult = min(2, max(1, get_theme_option("retina_ready")));
	$testi_title = get_theme_option('testi_title');
	$test_sorting = get_theme_option('resume_sorting');
    $args = array(
        'post_type' => 'testi',
        'post_status' => 'publish',
        'post_password' => '',
        'posts_per_page' => -1,
        'orderby' => 'date',
		'order' => $test_sorting
    );
    $query = new WP_Query($args); 
    if($query->found_posts > 0) {
	// Get testimonials posts
?>
			<section id="testi" class="section testi_section even">
				<div class="section_header testi_section_header">
					<h2 class="section_title testi_section_title"><a href="#"><span class="icon icon-quote-right"></span><span class="section_name"><?php echo $testi_title; ?></span></a><span class="section_icon"></span></h2>
				</div>
				<div class="section_body testi_section_body">
                    <div class="wrapper testi_wrapper">
						<?php
                            // Get testi posts
                            global $post;
                            $cat_number = 0;      
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
                                    $testi_thumb = getResizedImageTag($post_id, 190*$mult, 190*$mult);

                                    $post_custom = get_post_custom($post_id);
                                    $testi_author = '';
                                    if(isset($post_custom["author"])) {
                                		$testi_author = $post_custom["author"][0];
                                	};
                                    $testi_date = '';
                                	if(!empty($post_custom["testi_year"][0])) {
                                		$testi_year = $post_custom["testi_year"][0];                                    		
                                		$testi_date = $testi_year;
                                		if(isset($post_custom["testi_month"][0])) {
                                			$testi_month = $post_custom["testi_month"][0];
                                			$testi_date .= '&nbsp;'.$testi_month;
                                            $temp_date = date($date_format, strtotime($testi_year.'-'.$testi_month.'-01'));
                                            $testi_date = $testi_year.'&nbsp;'.prepareDateForTranslation($temp_date).($date_format == 'm' ? '.' : '');
                                		}
                                	}
                                ?>
                                <article class="post testi_post testi_post_<?php echo $post_number; ?><?php echo $post_number==1 ? ' first' : ''; ?><?php echo $post_number%2==1 ? ' even' : ' odd'; ?>">
                                    <div class="post_header testi_post_header">
                                        <h4 class="post_title"><span class="post_title_icon" style="background-color:#000;"></span><?php echo $post_title; ?></h4>                                        
                                        <div class="testi_date">
                                            <span class="period_from"><?php if(!empty($testi_date)) echo $testi_date; ?></span>
                                        </div>
                                        <?php if($testi_author != '') { ?>
                                        <h5 class="post_subtitle"><?php echo $testi_author; ?></h5>
                                        <?php } ?>
                                    </div>
                                    <div class="post_body testi_post_body">
                                        <?php if(!empty($testi_thumb)) { ?>
                                        <div class="testi_thumb"><?php echo $testi_thumb; ?></div>
                                        <?php } ?>
                                        <div class="post_content">
                                            <?php if(get_theme_option('quote_icon') == 'yes') { ?><span class="icon-quote-left"></span><?php } echo $post_content; ?>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            } // while (have_posts)
                        } // if (have_posts)
                        ?>
                	</div> <!-- .wrapper -->
				</div> <!-- .section_body -->
			</section> <!-- #resume -->
<?php 
	} //if count of posts > 0 
    wp_reset_postdata();   
?>
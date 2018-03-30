<?php get_header(); ?>
<?php
		global $da;
                $cats = get_categories();
                
                $category = '';
                $year = '';
                $monthnum = '';
                $filter = '';
                $sortby = '';
                if (isset($_GET['category'])) {
                           $category = $_GET['category'];     
                }
                if (isset($_GET['year'])) {
                                $year = (int)$_GET['year'];
                }
                if (isset($_GET['month'])) {
                                $monthnum = (int)$_GET['month'];
                }
                
                if (isset($_GET['format'])) {
                                $filter = $_GET['format'];
                }

                if (isset($_GET['sortby'])) {
                                $sortby = $_GET['sortby'];
                }
                
                //$months = range(1,12);
                $months = array (
                                '01' => __('January', 'theme'),
                                '02' => __('February', 'theme'),
                                '03' => __('March', 'theme'),
                                '04' => __('April', 'theme'),
                                '05' => __('May', 'theme'),
                                '06' => __('June', 'theme'),
                                '07' => __('July', 'theme'),
                                '08' => __('August', 'theme'),
                                '09' => __('September', 'theme'),
                                '10' => __('October', 'theme'),
                                '11' => __('November', 'theme'),
                                '12' => __('December', 'theme')
                );
                $formats = get_theme_support( 'post-formats' );
            $filterq = '';
            if ($filter != '') {
		$filterq = array(
				array(
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => $filter,
				)
			);
	}
?>
        <div class="inner">
            <div class="main_container">
                <div class="main-col">
                    <?php if (mom_option('search_breadcrumbs') == 1) { ?>
                <div class="category-title">
<div class="mom_breadcrumb breadcrumb breadcrumbs"><div class="breadcrumbs-plus">
<span xmlns:v="http://rdf.data-vocabulary.org/#"><a class="home" href="<?php echo esc_url(home_url()); ?>" typeof="v:Breadcrumb"><?php _e('Home', 'theme'); ?></a> <span class="separator"><i class="sep fa-icon-double-angle-right"></i></span><?php echo __('Search results for', 'theme').' "'.$s.'"'; ?></span></div></div>
                </div>
                <?php } ?>
                    <?php if (mom_option('search_advanced') == 1) { ?>
                    <div class="advanced-search-form base-box">
                        <form action="<?php echo home_url('/'); ?>">
                            <div class="asf-el keyword">
                            <label for=""><?php _e('keyword:', 'theme'); ?></label>
                            <input type="text" placeholder="<?php _e('Enter keywords', 'theme'); ?>" value="<?php echo $s; ?>" name="s" data-nokeyword="<?php _e('Keyword is required.', 'theme'); ?>">
                            </div> <!-- form element -->
                            <div class="asf-el cat">
                            <label for=""><?php _e('Category:', 'theme'); ?></label>
                            <div class="mom-select">
                                   <select name="category">
                                        <?php
                                        echo '<option value="">'.__('All', 'theme').'</option>';
                                        foreach ( $cats as $cat ) {
                                        echo '<option value="'.$cat->term_id.'"'.selected( $category, $cat->term_id ).'>' . $cat->name . '</option>';
                                        }
                                        ?>
                            </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <div class="asf-el date">
                            <label for=""><?php _e('Date:', 'theme'); ?></label>
                            <div class="mom-select year">
                                <select name="year">
                                    <?php
                                      echo '<option value="">'.__('Year', 'theme').'</option>';
                                    echo mom_get_years('year');
                                    ?>
                                </select>
                            </div> <!-- mom select -->
                            <div class="mom-select month">
                                <select name="month">
                                            <?php
                                            echo '<option value="">'.__('...', 'theme').'</option>';
                                            foreach ($months as $val => $name) { ?>
                                                            <option value="<?php echo $val; ?>" <?php selected( $monthnum, $val ); ?>><?php echo $val; ?></option>
                                            <?php } ?>
                                </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <div class="asf-el filter">
                            <label for=""><?php _e('Filter By:', 'theme'); ?></label>
                            <div class="mom-select">
                                <select class="filter" name="format">
                                               <?php
                                                echo '<option value="">'.__('All', 'theme').'</option>';
                                                foreach ($formats[0] as $format) { ?>
                                                                <option value="<?php echo $format; ?>" <?php selected( $filter, $format ); ?>><?php echo $format; ?></option>
                                                <?php } ?>

                            </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <button class="search button" type="submit"><?php _e('Search', 'theme'); ?></button>
                        </form>
                    </div> <!-- advanced-search-form -->
                    <?php } ?>
                    <?php
                                $search_page_style = mom_option('search_style');
                                $count = mom_option('search_count'); 
                                $args = '';
				       global $wp_query;
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
                                                $args = array (
                                                                's' => $s,
                                                                'cat' => $category,
                                                                'year' => $year,
                                                                'monthnum' => $monthnum,
                                                                'posts_per_page' => $count,
                                                                'paged' => $paged,
                                                                'order' => $sortby,
                                                                'tax_query' => $filterq
                                                );
                                $query = new WP_Query($args) ;
                ?>
                <?php if ($search_page_style == 'blog') { ?>
                        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php mom_blog_post('', false, 250); ?>
                        <?php endwhile; ?>
                         <?php mom_pagination($query->max_num_pages); ?>

                        <?php  else:  ?>
                        
<div class="base-box blog-post default-blog-post">
    <div class="bp-entry">
        <div class="bp-head">
                                <h2><?php _e('Your search for', 'theme'); echo ' "'.$s.'" ';  _e('did not match','theme'); ?></h2>
        </div> <!--blog post head-->
        <div class="bp-details">
            <ul>
		<li><?php _e('Make sure all words are spelled correctly', 'theme'); ?></li>
		<li><?php _e('Try different keywords' , 'theme'); ?></li>
		<li><?php _e('Try more general keywords', 'theme'); ?></li>
	    </ul>
        </div> <!--details-->
    </div> <!--entry-->
    <div class="clear"></div>
</div> <!--blog post-->
        <?php  endif; ?>
        
                <?php } else { ?>
                    <?php if ( $query->have_posts() ) : ?>                
                <div class="news-box base-box">
                    <header class="nb-header">
                        <h2 class="nb-title"><span><?php echo __('Search results for', 'theme').' "'.$s.'"'; ?></span></h2>
                    </header> <!--nb header-->
                    <div class="nb-content">
                        <div class="news-list">                
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                                        <article <?php post_class('nl-item'); ?>>
                                                        
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('related-posts'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
                                </div>
                                <?php } ?>
                                <div class="news-summary <?php echo $is_img; ?>">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                    <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
					<?php mom_show_review_score(); ?>				   
                                   </div> <!--meta-->
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 150, '...');
					?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        </div> <!--news list-->
                    </div>
                    
                </div> <!--news box-->
                         <?php mom_pagination($query->max_num_pages); ?>
                        <?php  else:  ?>
                    <div class="base-box blog-post default-blog-post">
                        <div class="bp-entry">
                            <div class="bp-head">
                                <h2><?php _e('Your search for', 'theme'); echo ' "'.$s.'" ';  _e('did not match','theme'); ?></h2>
                            </div> <!--blog post head-->
                            <div class="bp-details">
                                <ul>
                                    <li><?php _e('Make sure all words are spelled correctly', 'theme'); ?></li>
                                    <li><?php _e('Try different keywords' , 'theme'); ?></li>
                                    <li><?php _e('Try more general keywords', 'theme'); ?></li>
                                </ul>
                            </div> <!--details-->
                        </div> <!--entry-->
                        <div class="clear"></div>
                    </div> <!--blog post-->
                    <?php  endif; ?>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
                </div> <!--main column-->
                <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
            </div> <!--main container-->            
                <?php get_sidebar(); ?>
        </div> <!--main inner-->
<?php get_footer(); ?>
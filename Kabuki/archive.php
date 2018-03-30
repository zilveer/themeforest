<?php get_header(); ?>
<?php if (has_nav_menu('category-menu')) {  ?><div id="nav-secondary"><?php if ( function_exists( 'get_option_tree') && is_string(get_option_tree( 'sec_menu_info' )) ) { echo '<div id="sec-info">'.get_option_tree( 'sec_menu_info' ).'</div>'; } ?><?php wp_nav_menu( array( 'theme_location' => 'category-menu','depth'=>'2','menu_class'=>'middle-menu','container_class'=>'middle-menu-container','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>' ) ); ?><?php if ( ! dynamic_sidebar( 'Menu Social Icons' )) : endif; ?></div><?php } ?>
	<div class="mobilemenu"><?php dropdown_menu( array( 'theme_location' => 'category-menu','depth'=>'2','dropdown_title' => '-- Navigate to --','indent_string' => '- ','indent_after' => '') ); ?></div>

	<div id="content">
		<?php if ( ! dynamic_sidebar( 'Alert' ) ) : ?>
			<!--Wigitized 'Alert' for the home page -->
		<?php endif ?>
		
		<div id="blog-header"><h1><?php if ( is_day() ) : /* if the daily archive is loaded */ ?>
			<?php echo __( 'Daily Archives:', 'satori' ); echo ' <span>'.get_the_date().'</span>'; ?>
		<?php elseif ( is_month() ) : /* if the montly archive is loaded */ ?>
			<?php echo __( 'Monthly Archives:', 'satori' ); echo ' <span>'.get_the_date('F Y').'</span>'; ?>
		<?php elseif ( is_year() ) : /* if the yearly archive is loaded */ ?>
			<?php echo __( 'Yearly Archives:', 'satori' ); echo ' <span>'.get_the_date('Y').'</span>'; ?>
		<?php else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */ ?>
			Blog Archives
		<?php endif; ?></h1>
		</div><!--.postHeaderTitle--><div class="clear"></div>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post-single">
			<div class="post-wrapper">
				<div class="post-header">
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div><div class="clearleft"></div><!--.postHeader-->
				<?php if ( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-content">
				<?php the_content(__('Read more', 'satori' ).' &raquo;');?>
				<div class="post-meta">
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/clock_12x12.png' ?>" alt="date" /></span>
					<span class="meta-date"><?php $arc_year = get_the_time('Y'); $arc_month = get_the_time('m'); $arc_day = get_the_time('d');  echo '<a href="'.get_day_link($arc_year, $arc_month, $arc_day).'">'.get_the_date().'</a>'; ?></span>
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/user_9x12.png' ?>" alt="author" /></span>
					<span class="meta-author"><?php the_author_posts_link(); ?></span>
					<?php if(in_category(range(0,9999))) { echo "<span class='meta-img'><img src='"; echo get_stylesheet_directory_uri(); echo "/images/misc_icons/grey_light/list_12x11.png' alt='category' /></span>"; } ?>
					<span class="meta-cat"><?php the_category(', '); ?></span>
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/comment_alt2_stroke_11x12.png' ?>" alt="comments" /></span>
					<span class="meta-comment-count"><?php $nocomm = __('No comments', 'satori'); $onecomm = __('comment', 'satori'); $comm = __('comments', 'satori'); comments_popup_link($nocomm, '1 '.$onecomm, '% '.$comm, 'meta-comments-count'); ?></span>
				</div><!--.postMeta-->
				<div class="clearboth"></div>
				</div>
			</div>
			</div><!--.post-single-->
		<?php endwhile; else: ?>
			<div class="no-results">
				<p><strong><?php _e('There has been an error.', 'satori'); ?></strong></p>
				<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'satori'); ?></p>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
			</div><!--noResults-->
		<?php endif; Pager_hook(); ?>
			


	</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
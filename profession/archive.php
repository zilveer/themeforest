<?php 
	get_header(); 

	// Intro
	get_template_part('article', 'menu'); 
	$vType = get_post_meta(get_the_ID(), 'video_server', true);
	
?>

<div class="blog-content wrap">
	<div class="container">	
	
	<?php if (have_posts()){ ?>
		<!--Intro-->
		<div id="wrap_intro" class="wrap" >	
			<div class="container">
				<?php 
					$pageTitle    = '';
					$post = $posts[0]; // Hack. Set $post so that the_date() works.
					
					if (is_category()) {
						$pageTitle = sprintf(__('All posts in %s', TEXTDOMAIN), single_cat_title('',false));
					}
					elseif( is_tag() ){
						$pageTitle = sprintf(__('All posts tagged %s', TEXTDOMAIN), single_tag_title('',false));
					}
					elseif( is_day() ){
						$pageTitle = sprintf(__('Archive for %s', TEXTDOMAIN), get_the_time('F jS, Y'));
					}
					elseif( is_month() ){
						$pageTitle = sprintf(__('Archive for %s', TEXTDOMAIN), get_the_time('F, Y'));
					}
					elseif ( is_year() ){
						$pageTitle = sprintf(__('Archive for %s', TEXTDOMAIN), get_the_time('Y') );
					}
					elseif ( is_author() ){
						/* Get author data */
						if(get_query_var('author_name'))
							$curauth = get_user_by('login', get_query_var('author_name'));
						else
							$curauth = get_userdata(get_query_var('author'));

						$pageTitle = sprintf(__('Posts by %s', TEXTDOMAIN), $curauth->display_name );
					}
					elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ){
						$pageTitle = __('Blog Archives', TEXTDOMAIN);
					}
				?>
				
				<div class="row">
					<div class="blog-header span12">
						<h2> <?php echo $pageTitle; ?> </h2> 
					</div>
				</div>
				
			</div>
		</div>
		
<?php } //if have_posts() ?>

		<div class="row clearfix">

			<?php
			$blogClass = 'span9';

			if(opt('blog_sidebar_position') == 0)
				$blogClass = 'span12';
			?>

			<?php if ( have_posts() ) { ?>
				<div class="posts <?php echo $blogClass; ?>">
					<div id="blog_loop">
						<?php  while ( have_posts() ) { the_post(); ?>

							<?php get_template_part('loop'); ?>

						<?php } ?>
					</div>
					<div id="readmore_container"></div>
				</div>
			<?php } ?>

			<?php  if( opt('blog_sidebar_position') != 0) get_sidebar();  ?>

			<?php if (have_posts()) { ?>

				<!--Single Page Navigation-->
				<div class="page-navigation clearfix">
					<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', TEXTDOMAIN)) ?></div>
					<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', TEXTDOMAIN)) ?></div>
				</div>

			<?php } ?>

		</div>
	</div>
</div>
<?php get_footer();
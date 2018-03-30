<?php 

/*
Template Name: Blog with left sidebar
*/

get_header(); 

//Extracting the values that user defined in OptionTree Plugin 
$postNumber = ot_get_option('post_number');

?>
	<!-- BEGIN MAIN CONTENT -->
	<div id="page-title-wrap">
		<div class="container">
			<div id="breadcrumb"><?php if (function_exists('heal_breadcrumbs') && ( get_post_meta($post->ID,"breadcrumb",true) == "Yes" ) ) heal_breadcrumbs(); ?></div>
			<div id="page-title"><?php the_title(); ?></div>
			<div id="page-subtitle"><?php echo get_post_meta($post->ID, "page_description",true); ?></div>
		</div>
	</div>
	<div class="container">
		<div class="twelve columns left-content content-right">
			<?php
				query_posts( array( 'post_type' => 'post', 'paged' => get_query_var('paged'), 'posts_per_page' => $postNumber ) );
				if ( have_posts() ): while ( have_posts() ) : the_post(); 
			?>
			<div class="blogpost-wrap">
				<div class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
				<div class="blog-meta">
					<ul>
						<li class="blog-date">Date: <span><?php the_time('d M Y'); ?></span></li>
						<li class="blog-author">Author: <span><?php the_author_posts_link() ?></span></li> 
						<li class="blog-category">Category: <span><?php the_category(', ') ?></span></li> 
						<li class="blog-comment">Comments: <span><a href="<?php echo get_permalink() . '#comment-section' ?>"><?php comments_number(0,1,'%'); ?></a><?php ?></span></li>
					</ul>
				</div>
				<div class="blog-image">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail(array(650, 230));
						} 	
					?>
				</div>
				<div class="blog-content">
					<div class="blog-text">
						<?php the_excerpt(' '); ?>
						<div class="readmore">
							<a href="<?php the_permalink() ?>">Read more ...</a>
						</div>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
			<?php
				endwhile;endif;
				heal_pagination('',2);
			?>
		</div>
		<div class="four columns right-content sidebar-left">
			<?php dynamic_sidebar( 'blog_sidebar' ); ?>	
		</div>
	</div>
	<!-- END MAIN CONTENT -->
<?php get_footer(); ?>

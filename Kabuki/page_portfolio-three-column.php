<?php /* Template name: Portfolio: 3 columns */ ?> 

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="content">
	<div id="page-wrapper" class="page-portfolio">
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<article>
				<div class="home-link"><a href="<?php echo home_url(); ?>"><?php _e('Home', 'satori').'&raquo;'; ?></a></div>
				<h1><?php the_title(); ?></h1>
				<div class="clearleft"></div>
				<div class="top-border"></div>
				<div class="post-edit"><?php edit_post_link(); ?></div>
				<div class="post-content page-content">
					<?php the_content(); ?>
					
				</div><!--.post-content .page-content .portfolio-content -->
				
				<?php  
    				$terms = get_terms("tagportfolio");  
    				$count = count($terms);  
    				echo '<ul id="portfolio-filter">';  
    				echo '<li><a href="#all" title="">'.__('All', 'satori').'</a></li>';  
        			if ( $count > 0 )  
        			{  
           	 		foreach ( $terms as $term ) {  
                	$termname = strtolower($term->name);  
                	$termname = str_replace(' ', '-', $termname);  
                	echo '<li><a href="#'.$termname.'" title="" >'.$term->name.'</a></li>';  
           				 }  
       				 }  
    				echo "</ul><div class='clear'></div>";  
				?> 
				
				<?php
				$loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
				$count =0;
				?>
			</article>
	</div><!--#post-# .post-->
	</div><!--#page-wrapper-->

			<div id="portfolio-wrapper">
			<ul id="portfolio-list">

				<?php if ( $loop ) : 

				while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<?php
				$terms = get_the_terms( $post->ID, 'tagportfolio' );

				if ( $terms && ! is_wp_error( $terms ) ) :
					$links = array();

					foreach ( $terms as $term )
					{
						$links[] = $term->name;
					}
					$links = str_replace(' ', '-', $links);
					$tax = join( " ", $links );
				else :
					$tax = '';
				endif;
				?>

				<?php $infos = get_post_custom_values('_url'); ?>

				<li class="portfolio-item <?php echo strtolower($tax); ?> all">
					<a href="<?php the_permalink() ?>">
					<div class="overlay">
						<h3><?php the_title(); ?></h3>
						<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
					</div>
					<div class="thumb"><?php if(has_post_thumbnail()) { the_post_thumbnail(); } else { echo '<img src="'.catch_first_image().'" alt="" />'; } ?></div>
					</a>
				</li>
				<?php endwhile; else: ?>
				<li class="error-not-found"><?php _e('No portfolio entries found.', 'satori'); ?></li>
				<?php endif; ?>
				</ul>
				<div class="clearboth">
				</div>
				
				</div>

		<?php // comments_template( '', true ); ?>

	<?php endwhile; ?>

</div><!--#content-->

<?php get_footer(); ?>
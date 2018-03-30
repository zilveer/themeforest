<?php /* Template name: Portfolio: 1 column */ ?> 

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
				$count =0;
				?>
			</article>
	</div><!--#post-# .post-->
	</div><!--#page-wrapper-->

			<div id="portfolio-wrapper">
			<ul id="portfolio-list">

				<?php 
				global $more;
				global $the_query;
				$temp = $the_query;
				$the_query= null;
				$the_query = new WP_Query(array('post_type' => 'project', 'posts_per_page' => '-1'));
				?>
				
				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>


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

				<?php $infos = get_post_custom_values('_url'); $more = 0; ?>

				<li class="portfolio-item <?php echo strtolower($tax); ?> all">
					<div class="thumb"><a href="<?php the_permalink() ?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(); } else { echo '<img src="'.catch_first_image().'" alt="" />'; } ?></a></div>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<div class="excerpt"><?php the_content(__('Read more', 'satori' ).' &raquo;'); ?></div>
				</li>
				<?php endwhile; ?>
				</ul>
				<div class="clearboth">
				</div>
				</div>
				
		<?php // comments_template( '', true ); ?>

	<?php endwhile; ?>

</div><!--#content-->

<?php get_footer(); ?>
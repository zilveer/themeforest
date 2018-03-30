<?php get_header(); ?>

	<!--BEGIN #primary .hfeed-->
	<div id="primary" class="full" role="main">

		<div class="portfolio-items">
		    <div id="filterable-portfolio" class="grids portfolios" data-filter-type="<?php echo stag_get_option('portfolio_style'); ?>">

		    <?php if( have_posts() ) : ?>
			
			<?php
				while( have_posts() ) : the_post();

				if( !has_post_thumbnail() ) continue;

				$skills = get_the_terms(get_the_ID(), 'skill');

				$class = 'grid-4';

				if(is_array($skills)){
				    foreach($skills as $skill){
				        $class .= ' '.$skill->slug;
				    }
				}
			?>

				<div <?php post_class($class); ?>>
				    <div class="overlay">
				      <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
				      <div class="portfolio-navigation">
				        <a href="<?php the_permalink(); ?>" class="accent-background portfolio-trigger" data-id="<?php the_ID(); ?>"><i class="icon-eye"></i></a>
				        <a href="<?php the_permalink(); ?>" class="accent-background" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"><i class="icon-post-link"></i></a>
				      </div>
				    </div>
				    <?php the_post_thumbnail('full'); ?>
				</div>

		    <?php endwhile; ?>

		    <?php endif; ?>

		    </div><!-- #filterable-portfolio -->
	    </div><!-- .portfolio-items -->

	</div><!-- #primary -->

<?php get_footer(); ?>

<?php get_header(); ?>
<div class="page-padding">
	<div class="row max_width align-center">
		<section class="small-12 large-10 columns cf">
	  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		  <article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post blog-post'); ?> id="post-<?php the_ID(); ?>" role="article">
		  
		  	<header class="post-title small-12 small-centered medium-8 columns">
		  		<h1 itemprop="headline"><?php the_title(); ?></h1>
		  	</header>
		  	<?php get_template_part( 'inc/postformats/post-meta' ); ?>
		    <figure class="post-gallery">
		    	<?php the_post_thumbnail('north-blog-post'); ?>
		    </figure>
		    <div class="row">
		    	<div class="small-12 medium-2 columns">
		    		<?php 
		    			$boxed = is_singular('post') ? true : false;
		    			do_action( 'thb_social_article_detail', false, false, $boxed); 
		    		?>
		    	</div>
		    	<div class="small-12 medium-8 columns">
		    		<div class="post-content">
				    	<?php the_content(); ?>
				    	<?php if ( is_single()) { wp_link_pages(); } ?>
	    			</div>
	    			<?php get_template_part( 'inc/postformats/post-prevnext' ); ?>
	    		</div>
	    		<div class="small-12 medium-2 columns"></div>
		    </div>
		  </article>
	  <?php endwhile; else : endif; ?>
		</section>
	</div>
	<!-- Start #comments -->
	<section id="comments" class="cf full">
		<div class="row align-center">
			<div class="small-12 medium-10 large-7 columns">
	  		<?php comments_template('', true ); ?>
	  	</div>
	  </div>
	</section>
	<!-- End #comments -->
</div>
<?php get_footer(); ?>

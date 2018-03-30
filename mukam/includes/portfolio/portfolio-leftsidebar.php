<!-- Portfolio Content -->     
	  <div class="bg-color">
		<div class="container">
		   <div class="row">
		   	  <?php get_sidebar(); ?>
			  <div class="col-sm-9 col-md-9 portfolio-wrapper portfolio-right">
			     <div class="portfolio-style-3">
				 <div class="portfolio-style-1-filter">
					<ul>
						<a href="#portfolio-item-3"><li class="slug-portfolio-item-3 active"><?php echo __('All', 'mukam');?></li></a>
						<?php
							$terms = get_terms("portfolio-category");
							$count = count($terms);
							if ( $count > 0 ){
								foreach ( $terms as $term) {
								echo '<a href="#'.$term->slug.'"><li class="slug-'.$term->slug.'"><span>/</span>'.$term->name.'</li></a>';
								}
							}
							?>
					</ul>
				 </div>
				 <div class="clearfix"></div>
				 <div class="portfolio-3-wrapper">
				 <div class="grid-sizer"></div>
				 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="portfolio-item-3 <?php $categories = wp_get_object_terms($post->ID, 'portfolio-category');
    					foreach($categories as $category){
      					echo $category->slug.' '; }?>">
						<div class="portfolio-thumbnail">
							<?php echo the_post_thumbnail(); ?>
								<span class="overthumb"></span>
								<div class="carousel-icon">
								<a href="<?php print  mukam_portfolio_thumbnail_url($post->ID) ?>" data-rel="prettyPhoto" class="prettyPhoto lightzoom">
								<i class="mukam-search"></i>
								</a>
								<a href="<?php the_permalink() ?>" class="postlink">
								<i class="mukam-link"></i>
								</a>
								</div>
						</div>
						<div class="portfolio-content">
							<h4 class="portfolio-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<p><?php echo wp_trim_words( get_the_content(), 15 ); ?></p>
						</div>
						<div class="clearfix"></div>
					</article>
					<?php endwhile; endif; ?> 
					</div>
					<div class="pagination-container">
						<?php mukam_pagination();?>
                	</div>
				 </div>
			  </div>
		   </div> 
	    </div>
	  </div>
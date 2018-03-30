<?php $after =""; ?>
<!-- Portfolio Content -->     
	  <div class="bg-color">
		<div class="container">
		   <div class="row">
			  <div class="col-md-12 portfolio-wrapper">
			     <div class="portfolio-style-1">
				 <div class="portfolio-style-1-filter">
					<ul>
						<a href="#portfolio-item"><li class="slug-portfolio-item active"><?php echo __('All', 'mukam');?></li></a>
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
				 <div class="portfolio-1-wrapper">
				 <div class="grid-sizer"></div>
				 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="portfolio-item <?php $categories = wp_get_object_terms($post->ID, 'portfolio-category');
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
							<h3 class="portfolio-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo wp_trim_words( get_the_content(), 50 ); ?></p>
							<h4 class="about-project"><?php echo __('About Project', 'mukam'); ?></h4>
							<?php $client = get_post_meta($post->ID, "_client", true); 
							if(!empty($client)) { ?>
							<div class="portfolio-meta"><div class="holder"><i class="mukam-socialman"></i></div><div class="project-meta"><?php echo get_post_meta($post->ID, "_client", true); ?></div></div>
							<?php } ?>

							<div class="portfolio-meta"><div class="holder"><i class="mukam-date"></i></div><div class="project-meta"><?php the_time('j F, Y')?></div></div>

							<?php $website = get_post_meta($post->ID, "_website", true); 
							if(!empty($website)) { ?>
							<div class="portfolio-meta"><div class="holder"><i class="mukam-globe"></i></div><div class="project-meta"><a href="<?php echo get_post_meta($post->ID, "_website", true);?>" target="_blank"><?php echo get_post_meta($post->ID, "_website", true);?></a></div></div>
							<?php } ?>


							<div class="portfolio-meta"><div class="holder"><i class="mukam-label"></i></div><div class="project-meta"><?php the_tags( '', ', ', $after ); ?></div></div>
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
	<!-- Portfolio -->
	<article  id="portfolio" class="cvpage <?php if ( opt('vertical_template') == 0 ) { ?> wrap <?php } ?>">
	
		<?php
        $locations = get_nav_menu_locations();
        if (isset($locations['primary-nav'])) {
            $menu_id = $locations['primary-nav'];
            $menu_items = wp_get_nav_menu_items( $menu_id, array() );
            foreach( $menu_items as $menu_item ) {
                $len=strlen(get_site_url());
                $url=substr($menu_item->url,$len+1);
                if($url == '#portfolio' ) {
                ?>
                    <div class="page-title">
                        <h2><?php  echo $menu_item->post_title ?></h2>
                    </div>
                <?php
                }
            }
        }
		$includeCats = get_post_meta( get_the_ID(), 'portfolio_categories', true );
		$useCats  = false;
		$list_cats_args = array('title_li' => '', 'taxonomy' => 'Portfolio-type', 'walker' => new Portfolio_Walker());

		if(gettype($includeCats) == 'array' && count($includeCats))
		{
			$useCats = true;
			$list_cats_args['include'] = implode(',', $includeCats);
		}
		?>
									
		<div class="span12 portfolio-header">
			
			<!-- portfolio navigation -->
			<?php if( !$useCats || count($includeCats) > 1 ){ ?>
			
				<ul id="filters" class="option-set subnavigation clearfix" data-option-key="filter">
					<li><a class="current" data-filter="*" href="#"><?php _e('View All', TEXTDOMAIN); ?></a></li>
					<?php wp_list_categories($list_cats_args); ?>
				</ul>
			
			<?php } ?>
		
		</div>

		<div  id="portfolio_gallery" class="span12 portfoliopart">
			<div id="gallery" class="isotope">
				<div id="portfolio_loop">
					<?php
					
					$paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;

					$queryArgs = array(
					
						'post_type'      => 'portfolio',
						'posts_per_page' =>  opt('portfolioposts_per_page'),
						'paged'          => $paged1
					);

					$count = 1;
					$query = new WP_Query($queryArgs);

					while ($query->have_posts()) { 
						
						$query->the_post(); 
						
						get_template_part( 'loop', 'portfolio' ); 
						
					
						$count++;
					
					} 

					?>
				</div>
			</div>
		</div>		
				
		<?php 
		
		$query = new WP_Query($queryArgs);
		
		if ( $query-> have_posts()) { ?>
				
			<!--Single Page Navigation-->
			<div class="ppage-navigation clearfix">
				<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', TEXTDOMAIN)) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', TEXTDOMAIN)) ?></div>
			</div>
	
		<?php } ?>		

		<?php wp_reset_query(); ?>

	</article>
	<!-- Portfolio End -->
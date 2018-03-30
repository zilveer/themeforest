<?php
/** Blog Updates block **/
class AQ_Portfolio_AJAX_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Portfolio AJAX',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_portfolio_ajax_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'layout' => '4col',
			'entries' => '4',
			'excerpt' => '100',
			'categorys' => '0',
			'showtitle' => 1,
			'showdate' => 1,
			'showcomments' => 1,
			'showlikes' => 1,
			'showauthor' => 1,
			'showcat' => 1,
			'excerpt' => '100',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$layout_options = array(
			'2col' => '2 Columns',
			'3col' => '3 Columns',
			'4col' => '4 Columns'
		);

		$entries_options = array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20'
		);

		$my_options = array();
		$my_options['0'] = 'All';
		$categories=get_categories();
		foreach($categories as $slug => $category) { 
		 	$my_options[$category->cat_ID] = $category->name;
		}

		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('layout') ?>">
				Layout<br/>
				<?php echo aq_field_select('layout', $block_id, $layout_options, $layout); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('entries') ?>">
				Number of Entries<br/>
				<?php echo aq_field_select('entries', $block_id, $entries_options, $entries); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('showtitle') ?>">
				Show Title <?php echo aq_field_checkbox('showtitle', $block_id, $showtitle); ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		switch ($layout) {
			case '2col':
				$span = 'col-md-6';
				$imagesize = 'tb-860';
				$counter = '2';
				$videoheight = '195';
				break;
			case '3col':
				$span = 'col-md-4';
				$imagesize = 'tb-360';
				$counter = '3';
				$videoheight = '245';
				break;
			case '4col':
				$span = 'col-md-3';
				$imagesize = 'tb-360';
				$counter = '4';
				$videoheight = '145';
				break;							
			default:
				$span = 'col-md-3';
				$imagesize = 'tb-360';
				$counter = '4';
				$videoheight = '145';
				break;
		}

		if(isset($showtitle)) { $displaytitle = $showtitle; } else { $displaytitle = ''; }

	?>
		<script type="text/javascript">
			jQuery(document).ready(function($){

				$('.load-more-projects li').first().slideDown();
				$('#home-latest-posts .post-item').matchHeight();

			    jQuery('.load-more-projects a').live('click', function(e) {
			    	var $this = $(this);
				    e.preventDefault();
				    jQuery(this).addClass('loading').text('Loading...');
				    var link = jQuery(this).attr('href');
				    var $content = '#portfolio-ajax-inner';
				    var $nav_wrap = '.load-more-projects';
				    var $stickto = '#stick2meportfolio';
				    var $next_href = jQuery(this).parent().next().find('a').attr('href');				    

					    jQuery.get(link+'', function(data){
					    	var $timestamp = new Date().getTime();
					    	var $new_content = jQuery($content, data).wrapInner('').html();

					        jQuery($new_content).hide().appendTo($stickto).fadeIn(500);
					        $('portfolio-ajax .post-item').matchHeight();

        	        		jQuery(this).attr('href', $next_href);
				        	jQuery('.load-more-projects a').removeClass('loading');
							setTimeout(function(){
								$this.fadeOut(function(){
									jQuery('.load-more-projects a').text('Load More Projects');
									$this.parent().next().fadeIn();
								});
							}, 200);		        	
			         	});		         	
			    });

			});
			</script>

			<div id="portfolio-ajax" class="row">

				<div id="portfolio-ajax-inner" class="row">

				<?php  
				if($categorys == '0') { $cat = ''; } else { $cat = $categorys; }
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
					$args = array(
                   'cat' => $cat,
                   'post_type' => 'dt_portfolio_cpt',
                   'posts_per_page' => $entries,
                   'post__not_in'	 =>	get_option('sticky_posts'),
                   'paged' => $paged,
                   );
					$portfolio_query = new WP_Query($args);
					if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>

	                <div class="post-item <?php echo $span; ?>">
	               		<div class="item-inner">
	                        <?php the_post_thumbnail( 'small-featured', array( 'class' => 'img-responsive' ) ); ?>
	                        <div class="overlay">
	                        	<a class="preview lb btn btn-outlined btn-primary" href="<?php echo $feat_image; ?>" data-rel="prettyPhoto" title="<?php the_title(); ?>"><i class="fa fa-eye"></i></a>  
	                            <a class="preview btn btn-outlined btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>          
	                        </div>  
	                    </div>
	                    <?php if($showtitle) { ?>
	                    <h3 class="post-title fade-up"><?php the_title(); ?></h3>
	                    <?php } ?>   
	                </div>

					<?php endwhile; endif; ?>	

					<div id="stick2meportfolio"></div>	

				</div><!-- #portfolio-ajax -->		

				<?php 
					ebor_portfolio_load_more($portfolio_query->max_num_pages); 
					wp_reset_query(); 
				?>				

			</div><!-- #portfolio-ajax -->

	<?php

	}
	
}
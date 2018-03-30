<?php
/** Blog Updates block **/
class AQ_Blog_Updates_AJAX_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Blog Posts AJAX',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_blog_updates_ajax_block', $block_options);
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
			<label for="<?php echo $this->get_field_id('showauthor') ?>">
				Show Author <?php echo aq_field_checkbox('showauthor', $block_id, $showtitle); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('showcat') ?>">
				Show Category <?php echo aq_field_checkbox('showcat', $block_id, $showtitle); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('showtitle') ?>">
				Show Title <?php echo aq_field_checkbox('showtitle', $block_id, $showtitle); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('showdate') ?>">
				Show Post Date <?php echo aq_field_checkbox('showdate', $block_id, $showdate); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('showcomments') ?>">
				Show Comment Count <?php echo aq_field_checkbox('showcomments', $block_id, $showcomments); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('showlikes') ?>">
				Show Likes Count <?php echo aq_field_checkbox('showlikes', $block_id, $showcomments); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('excerpt') ?>">
				Maximum Character in Excerpt<br/>
				<?php echo aq_field_input('excerpt', $block_id, $excerpt, $size = 'full') ?>
				<em style="padding-left: 5px; font-size: 0.75em;">Leave it blank to disable excerpt.</em>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('categorys') ?>">
				Category<br/>
				<?php echo aq_field_select('categorys', $block_id, $my_options, $categorys); ?>
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
		if(isset($showdate)) { $displaydate = $showdate; } else { $displaydate = ''; }
		if(isset($showcomments)) { $displaycomments = $showcomments; } else { $displaycomments = ''; }

	?>
		<script type="text/javascript">
			jQuery(document).ready(function($){

				$('.load-more-posts li').first().slideDown();
				$('#home-latest-posts .post-item').matchHeight();

			    jQuery('.load-more-posts a').live('click', function(e) {
			    	var $this = $(this);
				    e.preventDefault();
				    jQuery(this).addClass('loading').text('Loading...');
				    var link = jQuery(this).attr('href');
				    var $content = '#home-latest-posts-inner';
				    var $nav_wrap = '.load-more-posts';
				    var $stickto = '#stick2me';
				    var $next_href = jQuery(this).parent().next().find('a').attr('href');				    

					    jQuery.get(link+'', function(data){
					    	var $timestamp = new Date().getTime();
					    	var $new_content = jQuery($content, data).wrapInner('').html();

					        jQuery($new_content).hide().appendTo($stickto).fadeIn(500);
					        $('#home-latest-posts .post-item').matchHeight();

        	        		jQuery(this).attr('href', $next_href);
				        	jQuery('.load-more-posts a').removeClass('loading');
							setTimeout(function(){
								$this.fadeOut(function(){
									jQuery('.load-more-posts a').text('Load More Posts');
									$this.parent().next().fadeIn();
								});
							}, 200);		        	
			         	});		         	
			    });

			});
			</script>

			<div id="home-latest-posts" class="row">

				<div id="home-latest-posts-inner" class="row">

				<?php  
				if($categorys == '0') { $cat = ''; } else { $cat = $categorys; }
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
					$args = array(
                   'cat' => $cat,
                   'post_type' => 'post',
                   'posts_per_page' => $entries,
                   'post__not_in'	 =>	get_option('sticky_posts'),
                   'paged' => $paged,
                   );
					$blog_query = new WP_Query($args);
					if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

	                <div class="post-item <?php echo $span; ?>">
	               		<div class="item-inner">
	                        <?php the_post_thumbnail( 'small-featured', array( 'class' => 'img-responsive' ) ); ?>
	                        <div class="overlay">
	                            <a class="preview btn btn-outlined btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>          
	                        </div>
		                    <?php if($showdate || $showcat || $showcomments ) { ?>
		                    <div class="post-meta">
		                        <?php if($showdate) { ?>
					                <span class="post-date">
					                	<a href="<?php echo get_month_link('', ''); ?>" class="thedate"><?php echo get_the_date( 'j' ); ?></a>
					                	<a href="<?php echo get_month_link('', ''); ?>" class="themonth"><?php echo get_the_date( 'F' ); ?></a>
					            	</span>
		                        <?php } ?>
		                        <?php if($showcomments) { ?>
		                        	<span class="post-comment"><i class="fa fa-comments"></i> <a href="<?php the_permalink(); ?>"><?php echo get_comments_number( 'ID' ); ?></a></span>
	                        	<?php } ?>
		                    </div>   
		                    <?php } ?>       
	                    </div>
	                    <?php if($showtitle) { ?>
	                    <h3 class="post-title fade-up"><?php the_title(); ?></h3>
	                    <?php } ?>   
						<?php if (!empty($excerpt) || $excerpt == '0') { ?>
						<p class="description fade-up"><?php the_excerpt_max_charlength(300);?></p>
						<?php } ?>
	                    <a class="btn btn-outlined btn-primary bounce-in" href="<?php the_permalink(); ?>">View Post</a>
	                </div>

					<?php endwhile; endif; ?>	

					<div id="stick2me"></div>					

				</div><!-- #home-latest-posts -->					

				<?php 
					ebor_blog_load_more($blog_query->max_num_pages); 
					wp_reset_query(); 
				?>		

			</div><!-- #home-latest-posts -->

	<?php

	}
	
}
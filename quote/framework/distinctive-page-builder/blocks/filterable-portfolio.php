<?php
/** Blog Updates block **/
class AQ_Filterable_Portfolio_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Filterable Portfolio',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('AQ_Filterable_Portfolio_Block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'layout' => '4col',
			'showtitle' => 1,
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$layout_options = array(
			'2col' => '2 Columns',
			'3col' => '3 Columns',
			'4col' => '4 Columns'
		);

		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('layout') ?>">
				Layout<br/>
				<?php echo aq_field_select('layout', $block_id, $layout_options, $layout); ?>
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
				$span = 'span3';
				$imagesize = 'tb-360';
				$counter = '4';
				$videoheight = '145';
				break;
		}

	?>

		<?php $cats = get_terms('dt_portfolio_cpt_categories');
			if($cats) { ?>
			<nav class="work-nav fade-down" id="options">
				<ul class="portfolio-filter fade-down centered" data-option-key="data-filter" id="filters">
					<li><a href="#" class="selected btn btn-primary btn-outlined" data-filter="*"><span>All</span></a></li>
					<?php foreach ($cats as $cat ) : ?>
					<li><a href="#" class="btn btn-primary btn-outlined " data-filter=".<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php } ?>

            <section id="projects" class="row"> 
                <ul id="thumbs" class="portfolio-items">

				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			 	query_posts(array('post_type'=>'dt_portfolio_cpt','posts_per_page' => -1,'paged'=>$paged));
			 	$count=0;
	            while (have_posts()) : the_post();
					$count++;
		            $cats = get_the_terms( get_the_ID(), 'dt_portfolio_cpt_categories' );
		            global $post; $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                    <li class="portfolio-item image-wrap <?php echo $span; ?> <?php if($cats) foreach ($cats as $cat) echo $cat->slug .' '; ?>">
                        <div class="item-inner">
	                        <?php the_post_thumbnail( 'main-featured', array( 'class' => 'img' ) ); ?>	                        
	                        <div class="overlay">
	                            <a class="preview lb btn btn-outlined btn-primary" href="<?php echo $feat_image; ?>" data-rel="prettyPhoto" title="<?php the_title(); ?>"><i class="fa fa-eye"></i></a>  
	                            <a class="preview btn btn-outlined btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>             
	                        </div>           
	                    </div>
                    </li>

				<?php endwhile; wp_reset_query(); ?>    
				</ul>
            </section>

	<?php

	}
	
}
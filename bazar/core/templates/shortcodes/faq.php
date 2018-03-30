<?php
	wp_enqueue_script( 'yit_faq', YIT_CORE_ASSETS_URL . '/js/yit/jquery.yit_faq.js', array('jquery'), '1.0', true ); 

	wp_reset_query();    
	
	$ids = '';
	if ( isset( $category ) && $category != '' ) {
		$ids = explode( ',', $category );
	  	$ids = array_map( 'trim', $ids );
		if (in_array('0', $ids)) $ids = '';
	}

	if ( is_array($ids) ) :
	    $args = array(
	        'post_type' => 'faq',
	        'posts_per_page' => -1,
	        'tax_query' => array(
				array(
					'taxonomy' => 'category-faq',
					'field' => 'id',
					'terms' => $ids
				)
			)
	    );
	else :
		$args = array(
	        'post_type' => 'faq',
	        'posts_per_page' => -1,
	    );
	endif;
	
	$faq = new WP_Query( $args );	
	
	$args = array(
	  'taxonomy'     => 'category-faq',
	  'title_li' => '',
	  'include'    => $ids
	);
	
	$cat = get_categories( $args );	
	
	$cols = 'span' . yit_get_sidebar_layout() == 'sidebar-no' ? 12 : apply_filters( 'yit_with_sidebar_columns', 9 );

    if( !$faq->have_posts() ) return false ?>
		<?php if ($cat && strcmp($filter, 'yes') == 0) : ?>
			<div class="row"><ul class="filters faq">
				<li><?php _e( 'Filter by: ', 'yit' ) ?></li>
				
					<li><a href="#all" data-option-value="*" class="active"><?php _e('All', 'yit') ?></a></li>
				
				<?php foreach ($cat as $c) :
					echo '<li>|| <a href="#' . $c->slug . '" data-option-value=".' . $c->slug . '">' . $c->name . '</a></li>';			
				endforeach ?>
			</ul></div>
		<?php endif ?>
		
		<div id="faqs-container">
	    <?php while( $faq->have_posts() ) : $faq->the_post();
			$filter_class = '';
			$title = get_the_title();
			$content = get_the_content();
			$filter = get_the_terms(0, 'category-faq');
			if (is_array($filter)) :				
				foreach( $filter as $f ) {
				    $filter_class .= $f->slug . ' ';
				}
			endif;
			
			?>
			
			<div class="faq-wrapper all <?php echo $filter_class ?>">
				<div class="faq-title <?php echo $cols ?>">
					<div class="plus"></div>
					<h4><?php the_title() ?></h4>
				</div>
				<div class="faq-item <?php echo $cols ?>">						
					<div class="faq-item-content">
						<?php echo the_content() ?>
					</div>					
				</div>
			</div>
		<?php endwhile; ?>
		</div>


<script>
jQuery(document).ready(function($){
	$('#faqs-container').yit_faq();
});
</script>
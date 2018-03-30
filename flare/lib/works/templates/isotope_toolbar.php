<nav class="isotope-toolbar">
	<div class="filters">
		<p><strong><?php _e( 'Filter:', 'btp_theme' ); ?></strong></p>
		<ul class="meta">
			<li class="current"><a href="#" data-filter="*"><?php _e( 'Show all', 'btp_theme' ); ?></a></li>
		  	<?php  
		    	$terms = get_terms( 'btp_work_category' );  
		    	  
		        foreach ( $terms as $term ) {
		            ?>
		            <li><a href="#" data-filter=".filter-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
		            <?php  
		       }
			?>   	
		</ul>
	</div>	
</nav>

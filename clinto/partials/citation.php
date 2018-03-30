<?php if ( function_exists( 'ot_get_option' ) and ot_get_option( 'citation' ) != '' ) { ?>


			<div class="xwell center">
				<div class="container"><i class="icon-quote-left icon-4x pull-left icon-muted"></i><i class="icon-quote-right icon-4x pull-right icon-muted"></i>
					<p class="lead"><?php echo ot_get_option( 'citation', '' ) ?> <small><?php echo ot_get_option( 'citation_author', '' ) ?></small></p>
					
				</div>
			</div>

<?php } ?>
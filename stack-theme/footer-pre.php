<?php if( theme_options('footer', 'pre_footer_show') != 'off' ): ?>

	<section id="pre-footer">
		<div class="container">
			
			<div class="row">

				<?php 
				$pre_footer_layout = theme_options('footer', 'pre_footer_layout');
				if( $pre_footer_layout == '3-colums' ): ?>

				<?php elseif( $pre_footer_layout == '1-column' ): ?>
			  		
			  		<div class="span12">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '2-columns' ): ?>
			  		
			  		<div class="span6">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span6">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '2-columns-2' ): ?>

			  		<div class="span4">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span8">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '2-columns-3' ): ?>

			  		<div class="span8">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span4">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '3-columns' ): ?>

			  		<div class="span4">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span4">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>
					<div class="span4">
						<?php if ( dynamic_sidebar( 'footer_3' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '3-columns-2' ): ?>

			  		<div class="span6">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_3' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '3-columns-3' ): ?>

			  		<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>
					<div class="span6">
						<?php if ( dynamic_sidebar( 'footer_3' ) ); ?>
					</div>

			  	<?php elseif( $pre_footer_layout == '4-columns' ): ?>

			  		<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_3' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_4' ) ); ?>
					</div>

			 	<?php else: ?>

					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_1' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_2' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_3' ) ); ?>
					</div>
					<div class="span3">
						<?php if ( dynamic_sidebar( 'footer_4' ) ); ?>
					</div>

			  	<?php endif; ?>
			  

			</div>

		</div>
	</section><!-- #pre-footer -->

<?php endif; ?>
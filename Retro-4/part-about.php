<?php

$meta = get_post_meta( $post->ID, 'about', true );


// Count columns

$col_number = 0;

if ( isset( $meta['show-column-one'] ) ) {
	$col_number++;
}

if ( isset( $meta['show-column-two'] ) ) {
	$col_number++;
}

if ( isset( $meta['show-column-three'] ) ) {
	$col_number++;
}

if ( isset( $meta['show-column-four'] ) ) {
	$col_number++;
}

$col_total = $col_number;
$col_number = 0;


// Define column number

$gridclass = 'col-3 tablet-col-6';

if ( $col_total == 1 ) :
	$gridclass = 'col-12 tablet-full';

elseif ( $col_total == 2 ) :
	$gridclass = 'col-6 tablet-col-6';

elseif ( $col_total == 3 ) :
	$gridclass = 'col-4 tablet-full';

elseif ( $col_total == 4 ) :
	$gridclass = 'col-3 tablet-col-6';

endif;

?>

<hr class="top-dashed"> 

<div class="container">

	<div class="row clear">
		
		<?php get_template_part( 'section', 'title' ); ?>

	</div><!-- row -->

	<div class="row clear columned-layout">

		<?php if ( isset( $meta['show-column-one'] ) ) { ?>

			<div class="col mobile-full <?php echo $gridclass ?>">

				<?php if ( isset( $meta['icon-one'] ) && $meta['icon-one'] != 'icon retroicon-prohibited' ) { ?>

					<div class="big-icon">			

						<?php if ( isset( $meta['icon-link-one'] ) && isset( $meta['icon-one'] ) ) { ?>

						<a class="big-icon-link" href="<?php echo esc_url( $meta['icon-link-one'] ); ?>">

						<?php } ?>

							<?php $iconbgcolor = retro_get_icons_background_color( $post->ID ) ?>

							<span class="<?php echo $meta['icon-one'] ?>" style="background-color: <?php esc_attr_e( $iconbgcolor ); ?>; -webkit-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -moz-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -o-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3;"></span>

						<?php if ( isset( $meta['icon-link-one'] ) && isset( $meta['icon-one'] ) ) { ?>
						
						</a>

						<?php } ?>							

					</div>

				<?php } ?>

				<h4><?php echo $meta['column-one-title'] ?></h4>

				<div class="subline"><?php echo $meta['column-one-subline'] ?></div>

				<hr>          

				<p><?php echo $meta['column-one-content'] ?></p>

			</div><!-- col --> 

		<?php } ?>

		<?php if ( isset( $meta['show-column-two'] ) ) { ?>

			<div class="col mobile-full <?php echo $gridclass ?>">

				<?php if ( isset( $meta['icon-two'] ) && $meta['icon-two'] != 'icon retroicon-prohibited' ) { ?>

					<div class="big-icon">			

						<?php if ( isset( $meta['icon-link-two'] ) && isset( $meta['icon-two'] ) ) { ?>

						<a class="big-icon-link" href="<?php echo esc_url( $meta['icon-link-two'] ); ?>">

						<?php } ?>

							<?php $iconbgcolor = retro_get_icons_background_color( $post->ID ) ?>

							<span class="<?php echo $meta['icon-two'] ?>" style="background-color: <?php esc_attr_e( $iconbgcolor ); ?>; -webkit-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -moz-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -o-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3;"></span>

						<?php if ( isset( $meta['icon-link-two'] ) && isset( $meta['icon-two'] ) ) { ?>
						
						</a>

						<?php } ?>							

					</div>

				<?php } ?>

				<h4><?php echo $meta['column-two-title'] ?></h4>

				<div class="subline"><?php echo $meta['column-two-subline'] ?></div>

				<hr>          

				<p><?php echo $meta['column-two-content'] ?></p>

			</div><!-- col --> 

		<?php } ?>	

		<?php if ( isset( $meta['show-column-three'] ) ) { ?>

			<div class="col mobile-full <?php echo $gridclass ?>">

				<?php if ( isset( $meta['icon-three'] ) && $meta['icon-three'] != 'icon retroicon-prohibited' ) { ?>

					<div class="big-icon">			

						<?php if ( isset( $meta['icon-link-three'] ) && isset( $meta['icon-three'] ) ) { ?>

						<a class="big-icon-link" href="<?php echo esc_url( $meta['icon-link-three'] ); ?>">

						<?php } ?>

							<?php $iconbgcolor = retro_get_icons_background_color( $post->ID ) ?>

							<span class="<?php echo $meta['icon-three'] ?>" style="background-color: <?php esc_attr_e( $iconbgcolor ); ?>; -webkit-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -moz-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -o-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3;"></span>

						<?php if ( isset( $meta['icon-link-three'] ) && isset( $meta['icon-three'] ) ) { ?>
						
						</a>

						<?php } ?>							

					</div>

				<?php } ?>

				<h4><?php echo $meta['column-three-title'] ?></h4>

				<div class="subline"><?php echo $meta['column-three-subline'] ?></div>

				<hr>            

				<p><?php echo $meta['column-three-content'] ?></p>

			</div><!-- col --> 

		<?php } ?>	

		<?php if ( isset( $meta['show-column-four'] ) ) { ?>

			<div class="col mobile-full <?php echo $gridclass ?>">

				<?php if ( isset( $meta['icon-four'] ) && $meta['icon-four'] != 'icon retroicon-prohibited' ) { ?>

					<div class="big-icon">			

						<?php if ( isset( $meta['icon-link-four'] ) && isset( $meta['icon-four'] ) ) { ?>

						<a class="big-icon-link" href="<?php echo esc_url( $meta['icon-link-four'] ); ?>">

						<?php } ?>

							<?php $iconbgcolor = retro_get_icons_background_color( $post->ID ) ?>

							<span class="<?php echo $meta['icon-four'] ?>" style="background-color: <?php esc_attr_e( $iconbgcolor ); ?>; -webkit-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -moz-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; -o-box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3; box-shadow: inset 0 0 0 4px <?php esc_attr_e( $iconbgcolor ); ?>, inset 0 0 0 8px #F5EEE3;"></span>

						<?php if ( isset( $meta['icon-link-four'] ) && isset( $meta['icon-four'] ) ) { ?>
						
						</a>

						<?php } ?>							

					</div>

				<?php } ?>

				<h4><?php echo $meta['column-four-title'] ?></h4>

				<div class="subline"><?php echo $meta['column-four-subline'] ?></div>

				<hr>            

				<p><?php echo $meta['column-four-content'] ?></p>

			</div><!-- col --> 

		<?php } ?>							
                            
	</div><!-- row --> 

</div><!-- container -->

<hr class="bottom-dashed"> 
<?php global $unf_options; ?>
<?php if (isset($unf_options['unf_author_profile']) && $unf_options['unf_author_profile'] == 1) {?>
<!-- author info -->
<div id="author-info" class="clearfix ">
	<div class="row">
		<div class="author-img col-sm-3">
	    	<?php echo get_avatar( get_the_author_meta( 'ID' ), '96' ); ?>
	    </div>
	    <div class="author-desc col-sm-9">
	        <h4><?php printf( get_the_author() );?></h4>
	        <p><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></p>
	        <div class="profile-links clearfix">
	        	<ul class="social-links">
	            	<li>
	            		<a class="author-icon" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon icon-pencil"></i></a>
	            	</li>
	        		<?php if ( get_the_author_meta( 'twitter' ) != '' )  { ?>
	            	<li>
	            		<a class="author-icon" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>"><i class="icon icon-twitter"></i></a>
	            	</li>
	            	<?php } ?>
	            	<?php if ( get_the_author_meta( 'facebook' ) != '' )  { ?>
	            	<li>
	            		<a class="author-icon" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>"><i class="icon icon-facebook"></i></a>
	            	</li>
	            	<?php } ?>
	            	<?php if ( get_the_author_meta( 'linkedin' ) != '' )  { ?>
	            	<li>
	            		<a class="author-icon" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>"><i class="icon icon-linkedin"></i></a>
	            	</li>
	            	<?php } ?>
	            	<?php if ( get_the_author_meta( 'googleplus' ) != '' )  { ?>
	            	<li>
	            		<a class="author-icon" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'googleplus' ) ); ?>"><i class="icon icon-googleplus"></i></a>
	            	</li>
	            	<?php } ?>
	            	<?php if ( get_the_author_meta( 'pinterest' ) != '' )  { ?>
	            	<li>
	            		<a class="author-icon" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'pinterest' ) ); ?>"><i class="icon icon-pinterest-square"></i></a>
	            	</li>
	            	<?php } ?>
	    		</ul>
	        </div>
		</div>
	</div>
</div>
<?php } ?>
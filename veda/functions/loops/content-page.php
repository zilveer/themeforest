	<!-- #post-<?php the_ID(); ?> -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_content(); 
	  wp_link_pages( array(	
	  	'before'	=>	'<div class="page-link">',
	  	'after'		=>	'</div>',
	  	'link_before'	=>	'<span>',
	  	'link_after'	=>	'</span>',
	  	'next_or_number' =>	'number',
	  	'pagelink' =>	'%',
		'echo'	=>	1 ) );
		
		edit_post_link( esc_html__( ' Edit ','veda' ) );?>
</div><!-- #post-<?php the_ID(); ?> -->
<?php
#Page Comments
$page_comment = veda_option('general','show-pagecomments');
if( isset($page_comment) ):?>
	<div class="dt-sc-hr"></div>
	<div class="dt-sc-clear"></div>
	<!-- ** Comment Entries ** -->
	<section class="commententries">
		<?php  comments_template('', true); ?>
	</section>
<?php endif;?>
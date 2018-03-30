<?php
/**
 *  Single template page for bulk gallery horizontal scroll
 * 
 * @package Toranj
 * @author owwwlab
 */
?>






<div id="main-content" class="abs dark-template"> 

<?php if($config['sidebar']== 'on'): ?>

<!-- Page sidebar -->
<div class="page-side">
    <div class="inner-wrapper vcenter-wrapper">
        <div class="side-content vcenter">

            <!-- Page title -->
            <h1 class="title">
                <?php the_title(); ?>
            </h1>
            <!-- /Page title -->

            <?php 
            if ( !post_password_required() )
				echo $config['sidebar_content'];
			?>

        </div>
    </div>
</div>
<!-- /Page sidebar -->

<?php endif; ?>

<?php 
$nosideClass='';
if($config['sidebar']!= 'on'){
    $nosideClass = " no-side";
} 
?>

<!-- Page main content -->
<div class="page-main horizontal-folio-wrapper set-height-mobile tj-lightbox-gallery<?php echo $nosideClass ?>">

	<?php if ( post_password_required() ) : ?>
    	<?php include(locate_template(OWLAB_TEMPLATES . '/password-protect/form-center.php')); ?>
    <?php else: ?>      
	    <!-- Portfolio wrapper -->  
	    <div class="horizontal-folio">';
	      
	    
		    <?php foreach ($imgs as $img_id=>$img_data): ?>

				<?php 
					$thumb_url = wp_get_attachment_image_src( $img_id, 'blog-thumb' );
					$img_url = $img_data['src'];
				?>
				<!-- Portfolio Item -->     
				<div class="gp-item <?php echo $item_overlay['parent_class'] ?>">
					<a 
						href="<?php echo $img_url; ?>" 
						class="lightbox-gallery-item set-bg" 
						title="<?php echo $img_data['title'] ?>"
					>
						<?php owlab_lazy_image($thumb_url, $img_data['title'], true); ?>
						<?php echo $item_overlay['markup']  ?>
					</a>
				</div>
				<!-- /Portfolio Item -->

	    	<?php endforeach; ?>
	    </div>
	    <!-- /Portfolio wrapper -->
	<?php endif; ?>
</div>
<!-- Page main content -->

</div>
<?php do_action('owlab_after_content'); ?>
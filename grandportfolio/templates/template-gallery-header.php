<?php
	$grandportfolio_topbar = grandportfolio_get_topbar();
	
	//Get header alignment
	$tg_page_header_alignment = kirki_get_option('tg_page_header_alignment');
?>
<div id="page_caption" class="single_gallery <?php if(!empty($grandportfolio_topbar)) { ?>withtopbar<?php } ?>">
	<div class="page_title_wrapper <?php echo esc_attr($tg_page_header_alignment); ?>">
		<div class="page_title_inner">
			<h1><?php the_title(); ?></h1>
			<?php
				$gallery_excerpt = get_the_excerpt();

		    	if(!empty($gallery_excerpt))
		    	{
		    ?>
		    	<hr class="title_break"/>
		    	<div class="page_tagline">
		    		<?php echo wp_kses_post($gallery_excerpt); ?>
		    	</div>
		    <?php
		    	}
		    ?>
		</div>
	</div>
</div>

<!-- Begin content -->
<?php
$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
?>
<div id="page_content_wrapper" class="<?php if(!empty($grandportfolio_page_content_class)) { echo esc_attr($grandportfolio_page_content_class); } ?>">
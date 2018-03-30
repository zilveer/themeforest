<?php
//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------

if($show_header == 1){ // Show header / subetext?
	$meta_box_heading = get_post_meta($post->ID, $key.'_header', true ); // get heading
	$meta_box_subtext = get_post_meta($post->ID, $key.'_subtext', true ); // get subtext
	$meta_box_float = get_post_meta($post->ID, $key.'_header_float', true ); // get alignment

    // Return Icon Markup
    $glyphicon_markup = false;
    $glyphicon_markup = themo_do_glyphicons_markup(null,$themo_page_ID,$key,true);

    ?>
<div class="row">
    <div class="section-header col-xs-12 <?php echo sanitize_html_class($meta_box_float); ?>">
        <?php echo wp_kses_post($glyphicon_markup); ?>
        <?php if ($meta_box_heading > ""){ ?>
    	<h2><?php echo sanitize_text_field($meta_box_heading); ?></h2>
		<?php } ?>
    	<?php if ($meta_box_subtext > ""){ ?>
    	<?php echo themo_content($meta_box_subtext); ?>
		<?php } ?>
	</div><!-- /.section-header -->        
</div><!-- /.row -->   
<?php } ?>
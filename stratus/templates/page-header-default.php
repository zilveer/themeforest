<?php
//======================================================================
// Page Header Default Template
//======================================================================
?>

<?php	
//-----------------------------------------------------
// Default Header Styling
//-----------------------------------------------------
$page_subheader_default = '<div class="subheader"></div>';
$page_subheader_default_show = true; // Show subheader by default
?>
    
<?php
//-----------------------------------------------------
// Header and Subtext
//-----------------------------------------------------
if($show_header == 'on'){ // Show header / subetext?

	$page_subheader_default_show = false; // Don't show subheader, we'll replace with an image 
	echo wp_kses_post($page_subheader_default);
	$format = get_post_format();
	if($format !== 'aside' && $format !== 'image' && $format !== 'quote'){
	?>
    <div class="container">
        <div class="row">
            <section <?php if($key > ""){echo 'id="'.$key.'"';} ?> class="<?php echo 'page-title ' . $page_header_float; ?>">
                <?php  echo "<h1>" . roots_title() . "</h1>";?>
            </section>	
         </div>
    </div>
    <?php } ?>
<?php } ?>
<?php 
// Output subheader if no map or image
if ($page_subheader_default_show){echo wp_kses_post($page_subheader_default);}
?>


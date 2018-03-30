<?php
//======================================================================
// HTML
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'content-editor';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// HTML
//-----------------------------------------------------
if($show == 1){ // Show it?
	$content = get_post_meta($post->ID, $key.'_content', true ); // Get content
	if($content > ''){ // Is there content to show? ?>        
        <div class="row">
            <div class="col-md-12">
                <?php if ($content > ""){ ?>
                <?php echo themo_content($content); ?>
                <?php } ?>
            </div>                            	
        </div>
	<?php } ?>
<?php } ?>

<?php
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

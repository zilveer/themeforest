 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>

<div id="navigation">
	<ul>
    	<?php navigation($cz_exclude); ?>
    </ul>
</div>
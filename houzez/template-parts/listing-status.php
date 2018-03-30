<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 17/12/15
 * Time: 2:24 PM
 */
$term_id = '';
$term_list = wp_get_post_terms( get_the_ID(), 'property_status', array("fields" => "all"));
$label_id = '';
$term_label = wp_get_post_terms( get_the_ID(), 'property_label', array("fields" => "all"));

if($term_list){
    foreach($term_list as $term) {
        $term_id = $term->term_id;
    }
}

if($term_label){
    foreach($term_label as $label) {
        $label_id = $label->term_id;
    }
}

if( !empty($term_list) ) { ?>
<span class="label-status label-status-<?php echo intval(houzez_get_taxonomy_id('property_status')); ?> label label-default"><?php echo houzez_taxonomy_simple('property_status'); ?></span>
<?php } ?>

<?php if( !empty($term_label) ) { ?>
<span class="label label-default label-color-<?php echo intval(houzez_get_taxonomy_id('property_label')); ?>"><?php echo houzez_taxonomy_simple('property_label'); ?></span>
<?php } ?>
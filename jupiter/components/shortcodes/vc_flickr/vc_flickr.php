<?php

$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

if (empty($api_key)) {
    echo '<p>Flickr API key is empty in the shortcode options.</p>';
    return false;
}
?>
	
<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>

<div class="mk-flickr-feeds <?php echo mk_get_column_class($column); ?> <?php echo $el_class; ?>" data-count="<?php echo $count; ?>" data-userid="<?php echo $flickr_id; ?>" data-key="<?php echo $api_key; ?>"></div>

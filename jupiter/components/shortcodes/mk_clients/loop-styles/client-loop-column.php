<?php
switch ($view_params['column']) {
    case 1:
        $class[] = 'one-column';
        $per_row = 1;
        break;

    case 2:
        $class[] = 'two-column';
        $per_row = 2;
        break;

    case 3:
        $class[] = 'three-column';
        $per_row = 3;
        break;

    case 4:
        $class[] = 'four-column';
        $per_row = 4;
        break;

    case 5:
        $class[] = 'five-column';
        $per_row = 5;
        break;

    case 6:
        $class[] = 'six-column';
        $per_row = 6;
        break;

    default:
        $class[] = 'four-column';
        $per_row = 4;
}

$container_styles = '';
if(!empty($view_params['border_color']) && $view_params['gutter_space'] == 0 && $view_params['border_style'] != "opened_edges") {

 	$container_styles = ' style="border-left:1px solid ' . $view_params['border_color'] . ';border-top:1px solid ' . $view_params['border_color'] . ';" ';

}

$class[] = 'bg-cover-' . $view_params['cover'];
$class[] = $view_params['el_class'];
$class[] = 'border-' . $view_params['border_style'];

?>

<div id="clients-<?php echo $view_params['id']; ?>" class="mk-clients column-style <?php echo implode(' ', $class); ?>">

<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $view_params['title']]); ?>

<?php 
$row_counter = 0;
$item_counter = 0;
?>

<ul<?php echo $container_styles; ?>>

	<?php 
	while ($view_params['query']->have_posts()):
	    $view_params['query']->the_post();
	    
	    $loop_items = $view_params['query']->post_count;
	    $url = get_post_meta(get_the_ID() , '_url', true);
        $image_src = Mk_Image_Resize::resize_by_id( get_post_thumbnail_id(), 'full', false, false, $crop = false, $dummy = true);
	    ?>
	    <li>
		    <?php 
		    echo !empty($url) ? '<a target="' . $view_params['target'] . '" href="' . $url . '">' : '';
		    ?>
		    <div title="<?php the_title_attribute(); ?>" class="client-logo" style="background-image:url(<?php echo $image_src; ?>); <?php echo $view_params['height']; ?>"></div>
		    <?php 
		    echo !empty($url) ? '</a>' : '';
		    ?>
	    </li>
	    <?php
	    $row_counter++;
	    $item_counter++;
	    if (($row_counter % $per_row) == 0 && $item_counter != $loop_items) {
	        echo '</ul><ul' . $container_styles . '>';
	    }
	endwhile;
	wp_reset_query();
	?>

</ul></div>

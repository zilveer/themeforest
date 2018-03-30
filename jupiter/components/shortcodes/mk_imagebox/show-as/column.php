<?php
switch($view_params['column']) {
        case 1 :
        $column_class = 'one-column';
        break;
        case 2 :
        $column_class = 'two-column';
        break;
        case 3 :
        $column_class = 'three-column';
        break;
        case 4 :
        $column_class = 'four-column';
        break;
        case 5 :
        $column_class = 'five-column';
        break;
        case 6 :
        $column_class = 'six-column';
        continue;
    }
?>    

<div id="mk-imagebox-<?php echo $view_params['id']; ?>" class="mk-imagebox column-style <?php echo $view_params['el_class']; ?>">
    <div class="<?php echo $column_class; ?>"><?php echo wpb_js_remove_wpautop( $view_params['content'], true ); ?></div>
    <div class="clearboth"></div>
</div>
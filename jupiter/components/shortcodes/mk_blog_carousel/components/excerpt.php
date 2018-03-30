<?php 
if ($view_params['enable_excerpt'] != 'true') return false;

$except = get_the_excerpt();

if(!$except) return false;
?>
<p class="item-excerpt"><?php echo $except; ?></p>
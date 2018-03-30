<?php

if ($view_params['permalink_icon'] == 'false') return false;

//gets the permalink chosen in portfolio single item. if custom url is not selected, post single link will be returned
$href = mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true));

?>

<a class="hover-icon from-left project-load" target="<?php echo $view_params['target']; ?>" href="<?php echo $href; ?>" data-post-id="<?php the_ID(); ?>"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-circle', 32); ?></a>
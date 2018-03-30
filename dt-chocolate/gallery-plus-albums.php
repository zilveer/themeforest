<div id="content">

<?php if(! post_password_required()): ?>

<div id="multicol">

<?php
global $postgalleryplus, $wp_query;
$post_3p = $postgalleryplus->get_post_option('albums_3p');
$show = $postgalleryplus->get_post_option('show');
$arr = $postgalleryplus->get_post_option('show_'.$show);
$arr = explode(",", $arr);
$arr = (array)$arr;

//$myterms = get_terms('dt_gallery_cat');

if( !($paged = get_query_var('paged')) ) {
	$paged = get_query_var('page');
}

$args = array(
	"post_type"		=>"dt_gallery_plus",
	"paged"			=>$paged
);

if( !empty($post_3p) ) {
	$args['posts_per_page']	= $post_3p;
}

if( !empty($arr) ) {
	$args['tax_query'] = array(	
		array(
			'taxonomy'	=>'dt_gallery-category',
			'field'		=>'id',
			'terms'		=>$arr,
			'operator' 	=> ( 'only' == $show )?'IN':'NOT IN',
		)
	);
}

$wp_query = new Wp_Query($args);

while($wp_query->have_posts()) { $wp_query->the_post();
	get_template_part('gallery-plus-album-display');
	if( post_password_required() ) continue;
	get_template_part('gallery-plus-photos-display');
}

?>

   </div>
  <?php if (function_exists('dt_pagenavi') ) { ?>
	<?php dt_pagenavi(); ?>
	<?php } else { ?>
        
    <ul class="paginator">
      <li class="larr"><?php next_posts_link( __( 'Older posts', 'dt' ) ); ?></div>
      <div class="rarr"><?php previous_posts_link( __( 'Newer posts', 'dt' ) ); ?></div>
    </ul>
    
	<?php }
	wp_reset_query();
	wp_reset_postdata();	
?>
<?php else: ?>

<div class="article_box">
	<div class="article_t"></div>
	<div class="article">
<?php echo get_the_password_form(); ?>
	</div>
	<div class="article_b"></div> 
</div>

<?php endif; ?>
 </div>

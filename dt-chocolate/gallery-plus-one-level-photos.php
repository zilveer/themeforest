  <div id="content">
    
<?php
define('SHOW_NAVIGATION', true);

if(! post_password_required()):
?>

<div id="multicol">

<?php
global $postgalleryplus, $term;
$show = $postgalleryplus->get_post_option('show');
$arr = $postgalleryplus->get_post_option('show_'.$show);
$arr = explode(",", $arr);
$arr = (array)$arr;

//$myterms = get_terms('dt_gallery_cat');
$args = array(
	"post_type"			=>"dt_gallery_plus",
	"posts_per_page"	=>-1
);

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

global $myterms;
$myterms = new Wp_Query($args);

global $photos_count_gal;
$photos_count_gal = 0;

//var_dump($myterms);

if( !empty($myterms->posts) ) {
//	$myterms->the_post();
	get_template_part('gallery-plus-one-level-photos-display');
}

//var_dump($myterms);

global $wp_query;
//$posts_per_page = intval(get_query_var('posts_per_page'));
//$wp_query->max_num_pages = ceil( $photos_count_gal / $posts_per_page );
?>

   </div>
   
<?php //if ( count($myterms)>1 ) : ?>
<?php if (function_exists('dt_pagenavi') ) { ?>
	<?php dt_pagenavi(); ?>
	<?php } else { ?>
        
    <ul class="paginator">
      <li class="larr"><?php next_posts_link( __( 'Older posts', 'dt' ) ); ?></div>
      <div class="rarr"><?php previous_posts_link( __( 'Newer posts', 'dt' ) ); ?></div>
    </ul>
    
    <?php } ?>
	
<?php else: ?>

<div class="article_box">
	<div class="article_t"></div>
	<div class="article">
		<?php echo get_the_password_form(); ?>
	</div>
	<div class="article_b"></div> 
</div>

<?php endif; ?>

<?php //endif; ?>
   
  </div>

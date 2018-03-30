<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$cat = !empty($cat) ? $cat : $faq_cat;

$query = mk_wp_query(array(
    'post_type' => 'faq',
    'posts' => $posts,
    'count' => $count,
    'offset' => $offset,
    'categories' => $cat,
    'orderby' => $orderby,
    'order' => $order,
)); 

$r = $query['wp_query'];

$id = Mk_Static_Files::shortcode_id();

?>

<div class="mk-faq-wrapper <?php echo $el_class;?>" id="faq-list-<?php echo $id; ?>">

    <?php echo mk_get_shortcode_view('mk_faq', 'components/sortable', true, ['sortable' => $sortable, 'style' => $style, 'cat' => $cat, 'sortable_all_text' => $view_all_text]); ?>

    <section class="mk-faq-container <?php echo $style; ?>-style-wrapper" >
        <?php 
        if ( $r->have_posts() ):
            while ( $r->have_posts() ) :
                $r->the_post();
        ?>
            <div class="mk-toggle <?php echo $style; ?>-style mk-faq-toggle <?php echo implode(' ', mk_get_custom_tax(get_the_id(), 'faq', false, true)); ?>">
                <?php echo mk_get_shortcode_view('mk_faq', 'components/title');  ?>
                <?php echo mk_get_shortcode_view('mk_faq', 'components/content');  ?>
            </div>
        <?php 
        endwhile;
        endif;
        ?>
        <div class="clearboth"></div>
    </section>
    <div class="clearboth"></div>

</div>

<?php 


if(!empty($background_color)) {
    Mk_Static_Files::addCSS("
        #faq-list-{$id} .mk-toggle .mk-toggle-pane{
            background-color : {$background_color} !important;
        }
    ", $id);
}


wp_reset_query();

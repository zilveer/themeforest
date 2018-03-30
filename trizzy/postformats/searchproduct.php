<article id="post-<?php the_ID(); ?>" <?php post_class('post search-result'); ?>>
<?php if(has_post_thumbnail()) { ?>
 <div class="columns six alpha padding-minus">
  <figure class="post-img">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?>
      <div class="hover-icon"></div>
    </a>
  </figure>
</div>
<?php } ?>
<?php global $post; $product = get_product( $post->ID );  ?>
<div class="columns six omega">
  <section class="post-content no-data">
    <header class="meta">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
    <p>
    <?php  $excerpt = get_the_excerpt();
    $short_excerpt = strip_shortcodes( $excerpt ); echo $short_excerpt.'..'; ?>
    </p>
    <span class="price"><?php echo $product->get_price_html(); ?></span>
    <?php 
    $catalogmode = ot_get_option('pp_woo_catalog','off');
    if ($catalogmode == "off") { ?>
    <?php if ( !$product->is_in_stock() ) { ?>
        <a class="button gray"> <?php _e('Sold Out','trizzy'); ?></a>
    <?php } else {?>
        <?php if($product->product_type == 'simple') { ?>
          <a href="<?php echo esc_url( home_url( '/' ) ).'cart/?add-to-cart='.$product->id ?>" class="button"><i class="fa fa-shopping-cart"></i><?php echo $product->single_add_to_cart_text(); ?></a>
        <?php } else {  ?>
          <a href="<?php the_permalink(); ?>" class="button"><i class="fa fa-shopping-cart"></i><?php echo $product->add_to_cart_text(); ?></a>
        <?php } ?>
      <?php } ?>
    <?php } ?>
    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Read More','trizzy') ?></a>

  </section>
</div>
</article>





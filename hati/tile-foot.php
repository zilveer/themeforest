<div id="foot" class="wrap group">
  
  <div class="one-fourth">
  <?php if (!dynamic_sidebar( 'Footer Area I' )) : ?>
    <?php if ( $logoAlt = Acorn::get( 'logo-alt' ) ) : ?>
      <p class="logo">
        <img src="<?php echo $logoAlt ?>" alt="<?php bloginfo( 'name' ) ?>">
      </p>
    <?php endif; ?>
    <p><?php echo do_shortcode( Acorn::get( 'copy-1' ) ) ?></p>
  <?php endif; ?>
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth">
  <?php if (!dynamic_sidebar( 'Footer Area II' )) : ?>
    <?php get_template_part( 'tile', 'social' ) ?>
    <!-- /social-->
  <?php endif; ?>
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth">
  <?php if (!dynamic_sidebar( 'Footer Area III' )) : ?>
    <h4><?php Acorn::eget( 'heading-3' ) ?></h4>
    <p>
      <?php
        $name = Acorn::get( 'twitter-name', 'helloalaja' );
        echo do_shortcode("[tweet name='{$name}']");
      ?>
    </p>
  <?php endif; ?>
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth last">
  <?php if (!dynamic_sidebar( 'Footer Area IV' )) : get_post_class(); ?>
    <h4><?php Acorn::eget( 'heading-4' ) ?></h4>
    <p><?php echo do_shortcode( Acorn::get( 'copy' ) ) ?></p>
  <?php endif; ?>
  </div>
  <!-- /one-fourth last column-->
  
</div>
<!-- /foot-->
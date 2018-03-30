
<?php a_the_media_content() ?>

<div class="main wrap group post">

  <div class="headings">
    <h1>
    <?php if ( !is_singular('item') ) : ?>
      <a href="<?php the_permalink() ?>" class="permalink"><?php the_title() ?></a>
    <?php else : ?>
      <?php the_title() ?>
    <?php endif; ?>
    </h1>
    <h4>
    <?php echo do_shortcode(__('Created [client]for[/client] in [year]', A_DOMAIN)) ?>
    </h4>
  </div>
  <!-- /headings-->
  
  <div class="clear"></div>
  
  <div class="one-fourth mobile-centred">
    
    <?php if ($url = Acorn::getm('_project_url')) : ?>
    
    <h3><?php _e('Project site', A_DOMAIN) ?></h3>
    <?php
      if ( strpos ( $url, 'http://' ) !== false ) { // that's URL
        $url = trim($url);
        $nohttp = str_ireplace('http://', '', $url);
        $url = "<a href='{$url}'>{$nohttp}</a>";
      }
    ?>
    <p><?php echo $url ?></p>
    
    <?php endif; ?>
    
    <?php if ( $terms = get_the_terms(get_the_ID(), 'item-tag') ) : ?>
      
    <h3><?php _e('We have done', A_DOMAIN) ?></h3>
    <ol class="list">
    <?php
      foreach ($terms as $term) {
        if ( $link = get_term_link( $term ) )
          echo "<li><a href='{$link}'>{$term->name}</a></li>";
      }
    ?>
    </ol>
    
    <?php endif; ?>
    
  </div>
  <!-- /left column-->
  <div class="one-half content">
    <?php the_content( $btn = __('Continue Reading &hellip;', A_DOMAIN) ) ?>
  </div>
  <!-- /content column-->
  <div class="one-fourth last mobile-centred">
    
    <?php if ( get_adjacent_post() && is_singular('item') ) : ?>
      
    <h3><?php _e('Next Work', A_DOMAIN) ?></h3>
    <p class="list"><?php previous_post_link('%link', '%title') ?></p>
    
    <?php endif; ?>
    
    <?php get_template_part('tile', 'twitter-share') ?>
  </div>
  <!-- /right column-->

</div>

<?php comments_template() ?>

<?php

$is_year = is_year();
$is_type = is_tax('item-tag');
$is_client = is_tax('item-type');

?>
<?php get_header(); if (have_posts()) the_post(); ?>

<div class="main wrap group">

  <div class="one-fourth filter">
    
    <ol class="list">
      <!-- empty data tag used to clear filter -->
      <li data-tag="" class="active"><a><?php _e('All projects', A_DOMAIN) ?></a></li>
    </ol>
    
  <?php
    
    $args = array();

    if ($is_year) $args['year'] = get_the_time('Y');
    elseif ($o = get_queried_object()) $args[$o->taxonomy] = $o->slug;
    
    $query = AExtend::getWorksByPageMeta($args);
    
    $years = array();
    $types = array();
    $clients = array();
    
    while ($query->have_posts()) : $query->the_post();
    
      if ($Y = intval(get_the_time('Y'))) $years[$Y] = $Y;
      
      if ($terms = get_the_terms( get_the_ID(), 'item-tag' ))
        foreach ($terms as $type)
          $types[$type->slug] = $type;
      
      if ($terms = get_the_terms( get_the_ID(), 'item-type' ))
        foreach ($terms as $client)
          $clients[$client->slug] = $client;
      
    endwhile;
    
    ksort($types);
    ksort($clients);
    
  ?>
    
  <?php if (!$is_type && count($types)) : ?>
    <h3><?php _e('By Type', A_DOMAIN) ?></h3>
    <ol class="list">
      <!-- data tag used for search through data-tags attribute-->
    <?php
      foreach ($types as $type)
        echo "<li data-tag='{$type->slug}'><a>{$type->name}</a></li>\n";
    ?>
    </ol>
  <?php endif; ?>

  <?php if (!$is_client && count($clients)) : ?>
    <h3><?php _e('By Client', A_DOMAIN) ?></h3>
    <ol class="list">
    <?php
      foreach ($clients as $client)
        echo "<li data-tag='{$client->slug}'><a>{$client->name}</a></li>\n";
    ?>
    </ol>
  <?php endif; ?>

  <?php if (!$is_year && count($years)>1) : ?>
    <h3><?php _e('By Year', A_DOMAIN) ?></h3>
    <ol class="list">
    <?php
      foreach ($years as $year)
        echo "<li data-tag='year-{$year}'><a>{$year}</a></li>\n";
    ?>
    </ol>
  <?php endif; ?>
  
  </div>
  <!-- /filter-->

  <div class="three-fourth last">
    <div <?php if (!Acorn::get('portfolio-fx-off')) echo 'data-fx' ?> class="thumbs group">
    
  <?php rewind_posts(); while ($query->have_posts()) : $query->the_post(); ?>

    <?php
      
      $tags = array();
      
      if ($Y = intval(get_the_date('Y'))) $tags[] = "year-{$Y}";
      
      $types = get_the_terms( get_the_ID(), 'item-tag' );
      if ($types) foreach ($types as $type) { $tags[] = $type->slug; }
      
      $clients = get_the_terms( get_the_ID(), 'item-type' );
      if ($clients) foreach ($clients as $client) { $tags[] = $client->slug; }
      
      $tags = join(' ', $tags);
    
    ?>

    <a href="<?php the_permalink() ?>" data-tags="<?php echo $tags ?>" class="item">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail() ?>
      <h2><?php the_title() ?></h2>
    <?php else : ?>
      <span>
        <?php _e('Please set Featured Image<br>for', A_DOMAIN) ?> <?php the_title() ?>
      </span>
    <?php endif; ?>
    </a>

  <?php endwhile; wp_reset_query(); ?>
    
    </div>
    <!-- /thumbs-->
  </div>
  <!-- /last three-fourth col-->

</div>

<?php get_footer() ?>
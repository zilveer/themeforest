<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 
if ( ! post_password_required() ) { 
  $quote_content = get_post_meta($post->ID, '_format_quote_content', TRUE);
  $quote_source  = get_post_meta($post->ID, '_format_quote_source_url', TRUE);
  $quote_author  = get_post_meta($post->ID, '_format_quote_source_name', TRUE);
if(!empty($quote_content)) {?>
  <figure class="post-quote">
    <span class="icon"></span>
    <blockquote>
      <?php echo $quote_content ?>
      <?php if(!empty($quote_source)) { ?><a href="<?php echo get_post_meta($post->ID, '_format_quote_source_url', TRUE); ?>"> <?php } ?>
        <span>- <?php echo $quote_author; ?></span>
      <?php if(!empty($quote_source)) { ?></a> <?php } ?>
    </blockquote>
  </figure>
<?php } 
} ?>
  <section class="date">
    <span class="day"><?php echo get_the_date( 'j' ); ?></span>
    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
  </section>

  <section class="post-content">

    <header class="meta">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     <?php trizzy_posted_on(); ?>
    </header>

    <?php the_excerpt(); ?>

    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Read More','trizzy') ?></a>

  </section>

</article>





 <h1><?php the_title(); ?></h1>
    <h4><?php _e('You Canceled.', $bSettings->getPrefix()) ?></h4>
    
    
    <p>
        <?php _e('You cancelled the purchased of one thicket for the event '.get_the_title().'. We will not send you any email.', $bSettings->getPrefix()) ?>
    </p>

    <a href="<?php echo get_permalink() ?>" class="submit"><?php _e('Back to Event', $bSettings->getPrefix()) ?></a>
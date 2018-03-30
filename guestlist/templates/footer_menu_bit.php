<div class="event_row <?php echo $i == 1 ? 'event_row_first' : '' ?>">
    <p class="date"><?php echo date("F jS", $eventdate); ?> </p>
    <a href="<?php echo get_permalink() ?>"><h3><?php the_title(); ?></h3></a>
    <p class="content"><?php echo BebelUtils::shortenText(get_the_excerpt(), 120); ?></p>
</div>
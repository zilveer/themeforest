<?php

  // local variable, we will make this the title of the html block
  $current_rating = apply_filters('post_ratings_current_rating', sprintf('%.2F / %d', $rating, $max_rating), $rating, $max_rating);

?>

<div class="ratings <?php if(is_singular()) print 'hreview-aggregate'; ?>" data-post="<?php the_ID(); ?>">

  <?php if(is_singular()): // microdata only on singular pages, @see: http//support.google.com/webmasters/bin/answer.py?hl=en&answer=146645 ?>
  <span class="item"><span class="fn"><?php the_title(); ?></span></span>
  <?php endif; ?>

  <span style="float:left; line-height: 16px;"><?php _e( 'Rate this item', 'homeshop' ); ?></span>
  <ul <?php if(!PostRatings()->currentUserCanRate()) print 'class="rated"'; ?>  style="width:<?php print ($max_rating * 16); ?>px" title="<?php esc_attr($current_rating); ?>">
    
	<li class="rating" style="width:<?php print ($rating * 16); ?>px">
      <span class="average">
        <?php print $current_rating; ?>
      </span>
      <span class="best">
        <?php print $max_rating; ?>
      </span>
    </li>

    <?php if(PostRatings()->currentUserCanRate()): // only display links if the user can rate the post ?>

      <?php for($i = 1; $i <= $max_rating; $i++): ?>

        <?php $title = apply_filters('post_ratings_control_title', sprintf(__('Give %1$d out of %2$d stars', 'homeshop'), $i, $max_rating), $i, $max_rating); ?>

        <li class="s<?php print $i; ?>">
          <a title="<?php esc_attr($title); ?>"></a>
        </li>

      <?php endfor; ?>

    <?php endif; ?>
  </ul>

  <div class="meta">
	<span>(
     <?php
       printf(_n('%1$s vote', '%1$s votes', $votes, 'homeshop'),
         sprintf('%d', $votes));
     ?>
	 )</span>
  </div>

</div>

      
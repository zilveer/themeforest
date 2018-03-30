<?php // Previous/next post navigation.

if (function_exists("emm_paginate")) { ?>
  <?php emm_paginate(); ?>

<?php } else { // if it is disabled, display regular wp prev & next links ?>
  <nav class="wp-prev-next">
    <ul class="clearfix">
      <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', 'toddlers' )) ?></li>
      <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', 'toddlers' )) ?></li>
    </ul>
  </nav>
<?php }?>
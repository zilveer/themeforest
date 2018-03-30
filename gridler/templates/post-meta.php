<div class="entry-meta">
<span class="triangle"></span>
<time class="date" datetime="<?php the_time('Y-m-d')?>"><a href="<?php the_permalink(); ?>"><span class="date icon"></span><?php the_time( get_option('date_format') ); ?></a></time>
<div class="comment"><a href="<?php comments_link(); ?>"><span class="comment icon"></span><?php comments_number( '0', '1', '%' ); ?></a></div>
<div class="clear"></div>
</div>
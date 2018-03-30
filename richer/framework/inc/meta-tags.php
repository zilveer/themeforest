<?php global $options_data; if($options_data['check_tags'] != 0 && get_the_tags() ) :?>
<div class="post-meta"><span class="meta-tags"><?php the_tags('<i class="fa fa-tags"></i>',', ', ''); ?></span></div>
<?php endif;?>	
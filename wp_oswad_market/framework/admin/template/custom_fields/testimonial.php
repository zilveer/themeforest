<?php
global $post;
?>
<label>Username Twitter:</label>
<input type="text" name="username_twitter_testimonial" value="<?php echo get_post_meta($post->ID,THEME_SLUG.'username_twitter_testimonial',true);?>"/><br/>


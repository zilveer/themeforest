<?php
if(isset($title_tag)) {
    $title_tag = $title_tag;
} else {
    $title_tag = 'h2';
}

?>
<<?php echo esc_attr($title_tag); ?> class="mkd-post-title">
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</<?php echo esc_attr($title_tag); ?>>
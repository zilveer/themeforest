<?php
$meta = get_post_meta(get_the_ID());
$show_share = true;
if(!empty($meta['show_share']) && $meta['show_share'][0] != 'on')
{
    $show_share = false;
}
?>
<?php if(plsh_gs('show_post_share_counter') == 'on' && $show_share) : ?>
<div class="post-sharrre">
    <div class="sharrre-twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Tweet"></div>
    <div class="sharrre-facebook" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
    <div class="sharrre-pinterest" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Pin"></div>
    <div class="sharrre-linkedin" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
    <div class="sharrre-googleplus" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="+1"></div>
</div>
<?php endif; ?>
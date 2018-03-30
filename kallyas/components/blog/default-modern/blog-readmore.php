<?php if(! defined('ABSPATH')){ return; }
/*
 * Get readmore button
 * @since v4.0.12
 */
?>

<?php if(!empty($current_post['content'])): ?>
<div class="kl-blog-item-more">

    <a class="kl-blog-item-more-btn" href="<?php the_permalink(); ?>" title="<?php echo __( 'Read more', 'zn_framework' );?>">
        <svg width="59px" height="57px" viewBox="0 0 59 57" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" >
            <path d="M23,35 C23.5522847,35 24,35.4477153 24,36 C24,36.5522847 23.5522847,37 23,37 C22.4477153,37 22,36.5522847 22,36 C22,35.4477153 22.4477153,35 23,35 L23,35 Z M28,36 C28,36.5522847 27.5522847,37 27,37 C26.4477153,37 26,36.5522847 26,36 C26,35.4477153 26.4477153,35 27,35 C27.5522847,35 28,35.4477153 28,36 L28,36 Z M31,35 C31.5522847,35 32,35.4477153 32,36 C32,36.5522847 31.5522847,37 31,37 C30.4477153,37 30,36.5522847 30,36 C30,35.4477153 30.4477153,35 31,35 L31,35 Z" id="dots" fill="#333333"></path>
            <rect id="Rectangle-2" fill="#333333" x="22" y="21" width="16" height="2" class="svg-more-l1"></rect>
            <rect id="Rectangle-2" fill="#333333" x="22" y="25" width="10" height="2" class="svg-more-l2"></rect>
            <rect id="Rectangle-2" fill="#333333" x="22" y="29" width="16" height="2" class="svg-more-l3"></rect>
            <rect id="stroke" stroke="#333333" stroke-width="2" x="4" y="4" width="51" height="49" rx="5" fill="none" class="svg-more-bg"></rect>
        </svg>
    </a>

    <?php
    /* Uncomment if you want a simple lined button
    ?>
    <a class="kl-blog-item-more-btn btn btn-lined lined-dark text-uppercase" href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'zn_framework' );?></a>
    <?php */ ?>

</div><!-- end read more -->
<?php endif; ?>

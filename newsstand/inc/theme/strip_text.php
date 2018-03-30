<?php
	$strip_bg = get_post_meta( get_the_ID(), 'newsstand_strip_bg', 1, true );
	$strip_text = get_post_meta( get_the_ID(), 'newsstand_strip_text', 1, true );
	$strip_link = get_post_meta( get_the_ID(), 'newsstand_strip_link', 1, true );
	$strip_link_newtab = get_post_meta( get_the_ID(), 'newsstand_strip_link_newtab', 1, true );
?>

<?php if (!empty($strip_text)): ?>
    <section class="strip_text" style="background-color: <?php echo esc_attr($strip_bg); ?>">
        <div class="container">
            <p><?php echo esc_html($strip_text); ?></p>
            <?php if (!empty($strip_link)): ?>
                <?php if ($strip_link_newtab=='on'): ?>
                    <a href="<?php echo esc_url($strip_link); ?>" target="_blank"><i class="fa fa-plus"></i></a>
                <?php else: ?>
                    <a href="<?php echo esc_url($strip_link); ?>"><i class="fa fa-plus"></i></a>
                <?php endif ?>
            <?php endif ?>
        </div>
    </section>    
<?php endif ?>
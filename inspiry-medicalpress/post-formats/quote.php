<?php
/* For quote post format */
global $post;

$quote_author = get_post_meta($post->ID, 'MEDICAL_META_quote_author', true); // quote author
$quote_desc = get_post_meta($post->ID, 'MEDICAL_META_quote_desc', true); // quote text

if (!empty($quote_desc)) {
    ?>
    <blockquote class="quote">
        <p>
            <?php
            echo $quote_desc;

            if (!empty($quote_author)) {
                ?><cite><?php echo $quote_author ?></cite><?php
            }
            ?>
        </p>
    </blockquote>
<?php
} else {
    the_content('');
}
?>
<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Breadcrumbs default view
 * Parameters:
 *
 * @var array $items , array with pages ordered hierarchical
 * $items = array(
 *      0 => array(
 *          'name'  => 'Item name',
 *          'url'   => 'Item URL'
 *      )
 * )
 * Each $items array will contain additional information about item, e.g.:
 * 'items' => array (
 *        0 => array (
 *            'name' => 'Homepage',
 *          'type' => 'front_page',
 *            'url' => 'http://yourdomain.com/',
 *        ),
 *        1 => array (
 *            'type' => 'taxonomy',
 *            'name' => 'Uncategorized',
 *            'id' => 1,
 *            'url' => 'http://yourdomain.com/category/uncategorized/',
 *            'taxonomy' => 'category',
 *        ),
 *        2 => array (
 *            'name' => 'Post Article',
 *            'id' => 4781,
 *            'post_type' => 'post',
 *            'type' => 'post',
 *            'url' => 'http://yourdomain.com/post-article/',
 *        ),
 *    ),
 * @var string $separator , the separator symbol
 */
?>

<?php if ( ! empty( $items ) ) : ?>
	<div>
		<?php for ( $i = 0; $i < count( $items ); $i ++ ) : ?>
			<?php if ( $i == ( count( $items ) - 1 ) ) : ?>
				<?php echo esc_html($items[ $i ]['name']) ?>
			<?php elseif ( $i == 0 ) : ?>
				<?php if( isset( $items[ $i ]['url'] ) ) : ?>
					<a class="bread-link" href="<?php echo esc_url($items[ $i ]['url']); ?>"><?php echo esc_html($items[ $i ]['name']); ?></a>&nbsp;
				<?php else : echo esc_html($items[ $i ]['name']) . '&nbsp;'; endif ?>
                <span>
                    <span class="gr-color-l">|&nbsp;</span>
                </span>
                &nbsp;
			<?php
			else : ?>
                <?php if( isset( $items[ $i ]['url'] ) ) : ?>
                    <a class="bread-link" href="<?php echo esc_url($items[ $i ]['url']); ?>"><?php echo esc_html($items[ $i ]['name']) ?></a>&nbsp;
                <?php else : echo esc_html($items[ $i ]['name']) . '&nbsp;'; endif ?>
                <span>
                    <span class="gr-color-l">|&nbsp;</span>
                </span>
                &nbsp;
			<?php endif ?>
		<?php endfor ?>
	</div>
<?php endif ?>
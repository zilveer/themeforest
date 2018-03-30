<?php
/**
 * @var $pagination_links array
 */
$pagination_links = PGL_pagination(
    array(
        'next_text' => '<i class="fa fa-angle-right"></i>',
        'prev_text' => '<i class="fa fa-angle-left"></i>'
    )
);
if ( ! empty( $pagination_links ) ) :
    ?>
    <div class="page-ination onleft">
        <div class="page-in">
            <ul class="pager">
                <?php foreach($pagination_links as $link) :?>
                    <li><?php echo $link; ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <?php
endif;


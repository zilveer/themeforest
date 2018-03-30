<?php
global $post;
$id = '';
if (isset($post->post_name)) {
    $id = $post->post_name;
}
?>
<div class="element panel panel-default faq-item" id="<?php echo $id; ?>">
    <div class="panel-heading ">
        <h4 class="panel-title">
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo get_the_ID(); ?>">
                <i class=" icon-info"></i> <?php echo get_the_title(); ?>
            </a>
        </h4>
    </div>
    <div id="collapse<?php echo get_the_ID(); ?>" class="panel-collapse collapse">
        <div class="panel-body">
<?php echo get_the_content(); ?>
        </div>
    </div>
</div>

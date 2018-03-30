<?php
/**
 * The heading title component
 * Fields available :
 * @title string
 */

$heading_link = get_sub_field('heading_link');
$heading_link_new_tab = get_sub_field('heading_link_new_tab');

?>
<div class="heading  heading--main">
    <?php if(!empty($heading_link) && $heading_link != ''): ?>
    <h2 class="hN"><a href="<?php echo $heading_link; ?>" <?php if($heading_link_new_tab) echo 'target="_blank"'?>><?php the_sub_field("title"); ?></a></h2>
    <?php else: ?>
    <h2 class="hN"><?php the_sub_field("title"); ?></h2>
    <?php endif; ?>
</div>
<?php

<?php
/*
Template Name: The Team
*/
?>


<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>

<?php }; ?>
<?php $count = 1; ?>
<div class="loadpageajax"> </div> 
<div id="homepostswrapper">
<div id="teamwrap">
<?php
$args = array( 'post_type' => 'thefirm_team', 'posts_per_page' => -1 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
 <?php $thumb = get_post_thumbnail_id();
    if (has_post_thumbnail()) $image = vt_resize( $thumb,'' , 185, 175, true ); ?>

    <?php $subtitle = get_post_custom_values("title"); ?>
    <?php $content = get_post_custom_values("pex"); ?>
        <?php
        if ($count == 1) $class='boxhome bhomefirst';
        if ($count == 2) $class='boxhome';
        if ($count == 3) $class='boxhome boxhomelast';
        ?>
    <a rel="<?php the_ID(); ?>" href="<?php the_permalink() ?>" class="homeload" ><div class="teambox teamboxfirst">
        <div class="bhomewrap"><div class="whitebg"></div>
        <div class="imagetitle">
            <div class="whitebg"></div>
            <?php if (has_post_thumbnail()) { ?><img  class="imghBXteam" src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" /> <?php }; ?>
            <div class="clearfix"></div>
            <h1><?php the_title(); ?></h1>
            <h2><?php echo $subtitle[0]; ?></h2>
        </div>
        <p><?php echo $content[0]; ?></p></div>
        <div class="readmore"><span><?php echo $eet_option['eetcnt_tr_rm'] ?></span></div>

    </div></a>
    <?php $count++; ?>

<?php
endwhile;
?>
</div>
</div>
<?php if ($firmIsPage) { ?>
	<?php get_footer(); ?>
<?php }; ?>
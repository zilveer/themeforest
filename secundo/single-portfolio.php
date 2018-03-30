<?php if($pageTitle = ct_get_option('portfolio_single_page_title', '')):?>
	<div class="patBlue">
		<div class="container">
			<h1 class="twoLines"><span><?php echo $pageTitle; ?></span></h1>
		</div>
	</div>
<?php endif;?>

<div class="patStd nomrg">
    <div class="container">
        <div class="row-fluid">
            <div class="span6">
	        <?php if($worksPage = ct_get_option('portfolio_index_page')): ?>
                <br>
		          <?php
                if(function_exists('icl_object_id')){
                    $iclpageid = icl_object_id($worksPage, 'page', true, ICL_LANGUAGE_CODE);
                    $worksPage = $iclpageid ? $iclpageid : $worksPage;
                }
                ?>
                <a href="<?php echo get_permalink($worksPage);?>" class="arrowIcon vsmall"><i class="arrow-toTop"></i><?php _e('BACK TO WORK', 'ct_theme')?></a>
		    <?php endif;?>
            </div>
	        <?php $prev = get_previous_post();?>
	        <?php $next = get_next_post();?>

            <div class="span3 doRight">
                <br>
	            <?php if($next):?>
                <a href="<?php echo get_permalink($next->ID);?>" class="arrowIcon vsmall"><i class="arrow-tinyLeft"></i><?php _e('PREV PROJECT', 'ct_theme')?></a>
	            <?php endif;?>
            </div>

            <div class="span3 doRight">
                <br>
	            <?php if($prev):?>
                <a href="<?php echo get_permalink($prev->ID);?>" class="arrowIcon vsmall"><?php _e('NEXT PROJECT', 'ct_theme')?><i class="arrow-tinyRight"></i></a>
	            <?php endif;?>
            </div>
        </div>
        <!-- / row-fluid -->
    </div>
</div>

<div class="patStd nomrg">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="patStd">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<div class="rightPadd20">
					<?php get_template_part('templates/content', 'single-portfolio'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

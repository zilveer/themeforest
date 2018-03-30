<!-- BEGIN: comments -->
<div id="comments">
<?php if(have_comments()){ ?>
	<h4 id="comments-title">
		<?php echo get_comments_number().__(' Comments to ','ThisWay').get_the_title(); ?>
	</h4>
	
	<?php get_comment_nav();?>
	
	<ol class="commentslist">
		<?php wp_list_comments(array('callback' => 'comment_callback')); ?>
    </ol>
	
	<?php get_comment_nav();?>
	
	<?php if(comments_open()){ comment_form(); } ?>
	
<?php }elseif(!comments_open()){ ?>
	
<?php }else{ ?>
	<?php comment_form(); ?>
<?php } ?>
</div>
<!-- END: comments -->

<?php
function get_comment_nav()
{
?>

	<?php if(get_comment_pages_count()> 1){?>
	<div class="comments-nav">
		<div class="prev">
			<?php previous_comments_link(__('Prev Comments','ThisWay')); ?>
		</div>
		<div class="next">
			<?php next_comments_link(__('Next Comments','ThisWay')); ?>
		</div>
	</div>
	<?php } ?>

<?php
}
?>
<div class="divider"></div>
<?php /* COMMENTS TEMPLATE */ ?>
<div id="comments">

	<?php if ( post_password_required() ) : ?>
		  <p class="nopassword">
		  	<?php echo dt_CommentsPassword; ?>
		  </p>
          <!--end of comments -->
          </div>
    <?php return; endif; ?>
    
    <?php if ( have_comments() ) : ?>
		<h4><?php echo dt_Comments; ?></h4>     
       
        <ol class="commentlist">
			<?php wp_list_comments(array('callback' => 'comment_callback')); ?>
        </ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="comments-navigation clearfix">
                <div class="previous">
                    <?php previous_comments_link(dt_CommentsOlder); ?>
                <!--end of previous -->
                </div>
                <div class="next">
                    <?php next_comments_link(dt_CommentsNewer); ?>
                <!--end of next -->
                </div>
            <!--end of comments navigation -->
            </div>
        <?php endif; ?>
    <?php endif;?>
    <?php comment_form(); ?>
<!-- end of comments -->
</div>

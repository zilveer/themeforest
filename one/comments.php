<?php thb_comments_before(); ?>

<?php if( have_comments() ) : ?>
	<section id="comments">

		<?php if( post_password_required() ) : ?>
			<div class="thb-text">
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'thb_text_domain' ); ?></p>
			</div>
			<?php return; ?>
		<?php endif; ?>

		<?php if( have_comments() ) : ?>
			<h1 id="comments-title">
				<?php // _e( 'Comments', 'thb_text_domain' ); ?>
				<span>
					<?php thb_comments_number(); ?>
				</span>
			</h1>

			<?php thb_comments_navigation(); ?>

			<ol class="comments-container">
				<?php wp_list_comments( array( 'callback' => 'thb_comment' ) ); ?>
			</ol>

			<?php thb_comments_navigation(); ?>

			<?php if( !comments_open() ) : ?>
				<div class="thb-text">
					<p><?php _e( 'Comments are closed.', 'thb_text_domain' ); ?></p>
				</div>
			<?php endif; ?>

		<?php endif; ?>
	</section>
<?php endif; ?>

<?php thb_comments_after(); ?>
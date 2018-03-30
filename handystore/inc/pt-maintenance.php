<!DOCTYPE html>
<html>

<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/countdown.js"></script>

	<style>
	body {
		font-family: 'Roboto', sans-serif;
		font-size: 13px;
		padding: 0;
		margin: 0;
	}
	.site-logo {
		background: #fafafa;
		padding: 30px 0;
		display: block;
		width: 100%;
		text-align: center;
	}
	.site-logo img,
	.site-logo h1,
	.site-logo h2,
	.msg-wrapper img {
		display: inline-block;
		margin: 0 auto;
	}
	.msg-wrapper img {
		display: inline-block;
		margin: 0 auto;
	}
	.site-title {
		font-size: 20px;
		margin: 0;
	}
	.site-description {
		font-size: 16px;
		margin: 0;
	}
	.msg-wrapper {
		display: block;
		width: 100%;
		text-align: center;
	}
	.msg-wrapper h3 {
		font-size: 36px;
		text-align: center;
		color: #484747;
		font-weight: lighter;
	}
	.msg-wrapper p {
		border-top: 1px solid #f5f5f5;
	    color: #484747;
	    display: inline-block;
	    font-size: 20px;
	    font-weight: lighter;
	    padding: 20px;
	}
	.countdown-wrapper {
		display: inline-block;
		padding: 25px 0;
		margin: 0;
		width: 100%;
	}
	.countdown-wrapper p {
		font-size: 16px;
		margin: 0;
		font-weight: lighter;
	}
	.countdown-row {
		display: inline-block;
	}
	.countdown-section {
		display: inline-block;
		color: #484747;
		float: left;
		font-size: 14px;
		padding: 10px 5px;
		border-radius: 6px;
		-webkit-border-radius: 6px;
		background: #f7f8f8;
		box-shadow: 0 0 3px 1px rgba(0,0,0,0.15);
		-webkit-box-shadow: 0 0 3px 1px rgba(0,0,0,0.15);
		-ms-box-shadow: 0 0 3px 1px rgba(0,0,0,0.15);
		-moz-box-shadow: 0 0 3px 1px rgba(0,0,0,0.15);
		text-align: center;
		margin-right: 30px;
		position: relative;
	}
	.countdown-section:after {
		display: inline-block;
		content: ':';
		position: absolute;
	    font-size: 30px;
	    right: -18px;
	    top: 18px;
	}
	.countdown-section:last-of-type {
		margin-right: 0;
	}
	.countdown-section:last-of-type:after {
		display: none;
	}
	.countdown-amount {
		font-size: 36px;
	}
	.countdown-period {
		display: inline-block;
		text-transform: lowercase;
		font-weight: lighter;
		width: 100%;
	}
	</style>
</head>

	<body>

		<?php if (get_option('site_logo')): ?>
			<div class="site-logo">
				<img src="<?php echo esc_url(handy_get_option('site_logo')) ?>" alt="<?php esc_attr(bloginfo( 'description' )); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</div>
		<?php else: ?>
			<div class="site-logo">
				<h1 id="the-title" class="site-title"><?php esc_attr(bloginfo( 'name' )); ?></h1>
				<h2 class="site-description"><?php esc_attr(bloginfo( 'description' )); ?></h2>
			</div>
		<?php endif; ?>

		<div class="msg-wrapper">
			<h3><?php _e('We are working hard to finish our amazing new website!', 'plumtree'); ?></h3>
			<img src="<?php echo get_template_directory_uri(); echo '/images/maintenance.jpg'; ?>" title="<?php _e( "Site is under Construction", 'plumtree' ); ?>" alt="maintenance"/>
			<?php $target_date = handy_get_option('maintenance_countdown');
					$target = explode("-", $target_date);
					if ( $target && $target!='' ) : ?>

					<div class="countdown-wrapper">
						<div id="countdown"></div>
					</div>

					<script type="text/javascript">
						(function($) {
							$(document).ready(function() {

								var container = $("#countdown");
								var newDate = new Date(<?php echo esc_js($target[0]); ?>, <?php echo esc_js($target[1]); ?>-1, <?php echo esc_js($target[2]); ?>);
								container.countdown({
									until: newDate,
								});

							});
						})(jQuery);
					</script>
			<?php endif; ?>
			<p><?php echo sprintf( __('If you want to ask us a question - please, <a href="mailto:%1$s">send an e-mail</a> and we will answer ASAP', 'plumtree'), esc_url(get_bloginfo('admin_email')) ); ?></p>
		</div>


	</body>
</html>

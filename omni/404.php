<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package omni
 */

$bg_404 = cs_get_customize_option( 'bg_image_404' ) ? cs_get_customize_option( 'bg_image_404' ) : esc_url( get_template_directory_uri() . '/img/clouds.jpg' );

get_header(); ?>

<div class="canvas-overflow" style="background-image: url(<?php echo $bg_404 ?>);">
	<canvas class="canvas-background"></canvas>
	<div class="teaser-container table-view">
		<div class="row-view">
			<div class="cell-view">
				<div class="teaser-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( cs_get_customize_option( 'header_logo_404' ) ) ? esc_url( cs_get_customize_option( 'header_logo_404' ) ) : esc_url( get_template_directory_uri() . '/img/theme-1/logo-big.png' ); ?>"
						     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" <?php echo $logo_retina_style; ?>>
					</a>
				</div>
			</div>
		</div>
		<div class="row-view">
			<div class="cell-view">
				<div class="content-404">
					<div class="title">404</div>
					<div class="description"><?php esc_html_e( 'The page you are looking for is missing or currently unavailable. Please use the correct link or visit', 'omni' ); ?> <?php echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html__( 'Homepage', 'omni' ) . '...</a>' ?></div>
				</div>
			</div>
		</div>
		<div class="row-view">
			<div class="cell-view">
				<div class="teaser-copyright">
					<div class="copyright">
						<?php $footer_text = cs_get_customize_option( 'footer_copyright_text' );
						if ( isset( $footer_text ) && ! empty( $footer_text ) ) {
							global $allowedtags;
							echo wp_kses( do_shortcode( $footer_text ), $allowedtags );
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	jQuery(function($) {


		var canvas = document.querySelector('canvas'),
			ctx = canvas.getContext('2d'),
			color = 'white';
		redraw();


		function redraw(){
			canvas.width = window.innerWidth;
			canvas.height = window.innerHeight;
			canvas.style.display = 'block';
			ctx.fillStyle = color;
			ctx.lineWidth = 0.3;
			ctx.strokeStyle = color;
		}


		$(window).resize(function(){
			redraw();
		});
		window.addEventListener("orientationchange", function() {
			redraw();
		}, false);


		var mousePosition = {
			x: 30 * canvas.width / 100,
			y: 30 * canvas.height / 100
		};

		var dots = {
			nb: 150,
			distance: 80,
			d_radius: 150,
			array: []
		};

		function Dot() {
			this.x = Math.random() * canvas.width;
			this.y = Math.random() * canvas.height;

			this.vx = -.5 + Math.random();
			this.vy = -.5 + Math.random();

			this.radius = Math.random();
		}

		Dot.prototype = {
			create: function() {
				ctx.beginPath();
				ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
				ctx.fill();
			},

			animate: function() {
				for (i = 0; i < dots.nb; i++) {

					var dot = dots.array[i];

					if (dot.y < 0 || dot.y > canvas.height) {
						dot.vx = dot.vx;
						dot.vy = -dot.vy;
					} else if (dot.x < 0 || dot.x > canvas.width) {
						dot.vx = -dot.vx;
						dot.vy = dot.vy;
					}
					dot.x += dot.vx;
					dot.y += dot.vy;
				}
			},

			line: function() {
				for (i = 0; i < dots.nb; i++) {
					for (j = 0; j < dots.nb; j++) {
						i_dot = dots.array[i];
						j_dot = dots.array[j];

						if ((i_dot.x - j_dot.x) < dots.distance && (i_dot.y - j_dot.y) < dots.distance && (i_dot.x - j_dot.x) > -dots.distance && (i_dot.y - j_dot.y) > -dots.distance) {
							if ((i_dot.x - mousePosition.x) < dots.d_radius && (i_dot.y - mousePosition.y) < dots.d_radius && (i_dot.x - mousePosition.x) > -dots.d_radius && (i_dot.y - mousePosition.y) > -dots.d_radius) {
								ctx.beginPath();
								ctx.moveTo(i_dot.x, i_dot.y);
								ctx.lineTo(j_dot.x, j_dot.y);
								ctx.stroke();
								ctx.closePath();
							}
						}
					}
				}
			}
		};

		function createDots() {
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			for (i = 0; i < dots.nb; i++) {
				dots.array.push(new Dot());
				dot = dots.array[i];

				dot.create();
			}

			dot.line();
			dot.animate();
		}

		$('body').on('mousemove mouseleave', function(e) {
			if (e.type == 'mousemove') {
				mousePosition.x = e.pageX;
				mousePosition.y = e.pageY;
			}
			if (e.type == 'mouseleave') {
				mousePosition.x = canvas.width / 2;
				mousePosition.y = canvas.height / 2;
			}
		});
		setInterval(createDots, 1000 / 30);
	});
</script>
<?php wp_footer(); ?>

</body>
</html>

module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			dist: {
				files: {
					'js/vendor-min.js': [
						'js/jquery.mixitup.js',
						'js/jquery.stapel.js',
						'js/owl.carousel.js',
						'js/jquery.magnific-popup.js',
						'js/modals.js',
						'js/auth.js',
						'js/jquery.mousewheel.js',
						'js/jquery.mCustomScrollbar.js',
						'js/placeholder.js',
						'extensions/mail_subscription/js/mail_subscription.js',
						'js/plugins.js',
						'js/theme.js'

					],
					'js/widgets/min/jflickrfeed.min.js': [
						'js/widgets/jquery.jflickrfeed.js'
					]
				}
			}
		},
		watch: {
			scripts: {
				files: [
					'js/*.js',
					'extensions/mail_subscription/js/*.js'
				],
				tasks: ['uglify']
			},
			styles: {
				files: [
					'**/*.scss'
				],
				tasks: ['compass']
			}
		},
		jshint: {
			files: [
				'js/theme.js'
			],
			options: {
				globals: {
					jQuery: true
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');

	grunt.registerTask('default', ['watch']);

};
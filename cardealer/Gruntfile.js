module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			dist: {
				files: {
					'js/vendor-min.js': [
						'js/jquery.easing.min.js',
						'js/jquery.cookie.min.js',
						'js/respond.min.js',
						'js/jquery.cycle.all.min.js',
						'js/jquery.touchswipe.min.js',
						'js/jquery.mousewheel.min.js',
						'js/jquery.custom.scrollbar.min.js',
						'js/jflickrfeed.min.js',
						'js/twitterFetcher.js',
						'js/jquery.fancybox.pack.js',
						'js/theme.js',
						'extensions/cardealer/js/front.js',
						'extensions/cardealer/js/loan_calculator.js',
						'extensions/authentication/js/general.js'
					],
					'extensions/cardealer/js/add_new_car.min.js': [
						'extensions/cardealer/js/add_new_car.js'
					],
					'extensions/cardealer/js/user_profile.min.js': [
						'extensions/cardealer/js/user_profile.js'
					]
				}
			}
		},
		compass: {
			dist: {
				options: {
					sassDir: 'scss',
					cssDir: 'css'
				}
			}
		},
		watch: {
			scripts: {
				files: [
					'js/*.js',
					'extensions/cardealer/js/*.js',
					'extensions/authentication/js/*.js'
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
				'js/theme.js',
				'extensions/cardealer/js/front.js',
				'extensions/cardealer/js/loan_calculator.js',
				'extensions/authentication/js/general.js',
				'extensions/cardealer/js/add_new_car.js',
				'extensions/cardealer/js/user_profile.js'
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
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-jshint');

	grunt.registerTask('default', ['watch']);

};
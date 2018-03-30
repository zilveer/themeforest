module.exports = function (grunt) {
	'use strict';

	// Load all grunt tasks
	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );

	// Project configuration
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		compass: {
			dist: {
				options: {
					sassDir: 'assets/scss',
					cssDir : 'assets/css'
				}
			}
		},
		concat_css: {
			all: {
				src: ['assets/bower_components/venobox/venobox/venobox.css',
					'assets/bower_components/flexslider/flexslider.css'
				],
				dest: "assets/css/vendor-styles.css"
			},
		},
		copy: {
			all: {
				files: [
					// includes files within path
					{expand: true, flatten: true, src: ['assets/bower_components/flexslider/fonts/*'], dest: 'assets/font/flexslider/', filter: 'isFile'},
				],
			},
		},
		uglify : {
			dist: {
				files: {
					'assets/js/vendor.min.js': [
						'assets/bower_components/modernizr/modernizr.js',
						'assets/bower_components/foundation/js/foundation.js',
						'assets/bower_components/flexslider/jquery.flexslider-min.js',
						'assets/bower_components/isotope/dist/isotope.pkgd.min.js',
						'assets/bower_components/imagesloaded/imagesloaded.pkgd.js',
						'assets/bower_components/venobox/venobox/venobox.min.js',
						'assets/bower_components/html5shiv/dist/html5shiv.min.js'
					]
				}
			}
		},
		watch  : {
			css: {
				files  : ['assets/scss/**/*.scss', 'assets/scss/*.scss'],
				tasks  : ['compass'],
				options: {
					debounceDelay: 500
				}
			}
		}
	} );

	// Default task.
	grunt.registerTask( 'default', ['compass', 'watch'] );
	grunt.registerTask( 'build', ['uglify','copy', 'concat_css', 'compass']);
	grunt.util.linefeed = '\n';
};
'use strict';
module.exports = function(grunt) {

	grunt.initConfig({

		dirs: {
			js: 'js',
			wp_job_manager: 'inc/integrations/wp-job-manager/js',
			wp_job_manager_bookmarks: 'inc/integrations/wp-job-manager-bookmarks/js',
			facetwp: 'inc/integrations/facetwp/js',
			woocommerce: 'inc/integrations/woocommerce/js',
			jetpack: 'inc/integrations/jetpack/js'
		},

		watch: {
			options: {
				livereload: 12348,
			},
			js: {
				files: [
					'Gruntfile.js',
					'js/source/**/*.js',
					'js/**/*.coffee',
					'inc/integrations/wp-job-manager/js/*.coffee',
					'inc/integrations/wp-job-manager/js/*.js',
					'inc/integrations/wp-job-manager/js/**/*.coffee',
					'inc/integrations/wp-job-manager-bookmarks/js/source/*.js',
					'inc/integrations/facetwp/js/source/*.js',
					'inc/integrations/woocommerce/js/source/*.js',
					'inc/integrations/jetpack/js/*.coffee'
				],
				tasks: ['coffee', 'uglify']
			},
			css: {
				files: [
					'css/sass/**/*.scss',
					'css/sass/*.scss'
				],
				tasks: ['sass', 'concat', 'cssjanus', 'cssmin' ]
			}
		},

		// uglify to concat, minify, and make source maps
		uglify: {
			dist: {
				options: {
					sourceMap: true
				},
				files: {
					'<%= dirs.wp_job_manager %>/wp-job-manager.min.js': [
						'<%= dirs.wp_job_manager %>/vendor/jquery.timepicker.min.js',
						'<%= dirs.wp_job_manager %>/wp-job-manager.js',
						'<%= dirs.wp_job_manager %>/wp-job-manager-gallery.js',
					],
					'<%= dirs.wp_job_manager %>/map/app.min.js': [
						'<%= dirs.wp_job_manager %>/map/vendor/richmarker.js',
						'<%= dirs.wp_job_manager %>/map/vendor/infobubble.js',
						'<%= dirs.wp_job_manager %>/map/vendor/markerclusterer.js',
						'<%= dirs.wp_job_manager %>/map/app.js'
					],
					'<%= dirs.wp_job_manager %>/listing/app.min.js': [
						'<%= dirs.wp_job_manager %>/listing/app.js'
					],
					'<%= dirs.wp_job_manager_bookmarks %>/wp-job-manager-bookmarks.min.js': [
						'<%= dirs.wp_job_manager_bookmarks %>/source/wp-job-manager-bookmarks.js'
					],
					'js/app.min.js': [
						'<%= dirs.js %>/vendor/**.js',
						'<%= dirs.js %>/vendor/**/*.js',
						'!<%= dirs.js %>/vendor/salvattore.min.js',
						'!<%= dirs.js %>/vendor/flexibility/flexibility.min.js',
						'<%= dirs.wp_job_manager %>/wp-job-manager.min.js',
						'<%= dirs.facetwp %>/source/facetwp.js',
						'<%= dirs.woocommerce %>/source/woocommerce.js',
						'<%= dirs.jetpack %>/jetpack.js',
						'<%= dirs.js %>/source/app.js'
					]
				}
			}
		},

		coffee: {
			dist: {
				options: {
					sourceMap: true,
				},
				files: {
					'<%= dirs.wp_job_manager %>/map/app.js': [
						'<%= dirs.wp_job_manager %>/map/app.coffee'
					],
					'<%= dirs.wp_job_manager %>/listing/app.js': [
						'<%= dirs.wp_job_manager %>/listing/app.coffee'
					],
					'<%= dirs.js %>/admin/widget-features.js': [
						'<%= dirs.js %>/admin/widget-features.coffee'
					],
					'<%= dirs.jetpack %>/jetpack.js': [
						'<%= dirs.jetpack %>/jetpack.coffee'
					]
				}
			}
		},

		jsonlint: {
			dist: {
				src: [ 'inc/setup/import-content/**/*.json' ],
				options: {
					formatter: 'prose'
				}
			}
		},

		sass: {
			dist: {
				files: {
					'css/editor-style.css' : 'css/sass/modules/editor-style.scss',
					'css/style.css' : 'css/sass/style.scss'
				}
			}
		},

		concat: {
			dist: {
				files: {
					'css/style.css': ['css/vendor/*.css', 'css/style.css']
				}
			}
		},

		cssmin: {
			dist: {
				files: {
					'css/style.min.css': [ 'css/style.css' ],
					'css/style.min-rtl.css': [ 'css/style.rtl.css' ]
				}
			}
		},

		clean: {
			dist: {
				src: [
					'css/style.css',
					'css/style.rtl.css'
        ]
			}
		},

		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'css/style.css',
						dest: 'css/style.rtl.css'
					}
				]
			}
		},

		makepot: {
			theme: {
				options: {
					type: 'wp-theme'
				}
			}
		},

		exec: {
			txpull: {
				cmd: 'tx pull -af --skip --minimum-perc=65 --force'
			},
			txpush_s: {
				cmd: 'tx push -s --force'
			},
		},

		potomo: {
			dist: {
				options: {
					poDel: false // Set to true if you want to erase the .po
				},
				files: [{
					expand: true,
					cwd: 'languages',
					src: ['*.po'],
					dest: 'languages',
					ext: '.mo',
					nonull: true
				}]
			}
		}
	});

	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-coffee' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-cssjanus' );
	grunt.loadNpmTasks( 'grunt-exec' );
	grunt.loadNpmTasks( 'grunt-potomo' );
	grunt.loadNpmTasks( 'grunt-jsonlint' );

	// register task
	grunt.registerTask('default', ['watch']);
	grunt.registerTask( 'tx', ['exec:txpull', 'potomo']);
	grunt.registerTask( 'makeandpush', ['makepot', 'exec:txpush_s']);
	grunt.registerTask( 'makethepot', ['makepot'] );
	grunt.registerTask( 'clean', ['clean'] );

	grunt.registerTask('build', [ 'jsonlint', 'uglify', 'sass', 'concat', 'cssjanus', 'cssmin', 'makepot', 'tx', 'makeandpush', 'clean' ]);
};

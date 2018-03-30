module.exports = function ( grunt ) {
	// Auto-load the needed grunt tasks
	// require('load-grunt-tasks')(grunt);
	require( 'load-grunt-tasks' )( grunt, { pattern: ['grunt-*'] } );

	var config = {
		tmpdir:                  '.tmp/',
		phpFileRegex:            '[^/]+\.php$',
		phpFileInSubfolderRegex: '.*?\.php$',
		themeSlug:               'buildpress',
	};

	// configuration
	grunt.initConfig( {
		pgk: grunt.file.readJSON( 'package.json' ),

		config: config,

		// https://npmjs.org/package/grunt-contrib-compass
		compass: {
			options: {
				sassDir:        'assets/sass',
				cssDir:         config.tmpdir,
				imagesDir:      'assets/images',
				outputStyle:    'compact',
				relativeAssets: true,
				noLineComments: true,
				importPath:     ['bower_components/bootstrap-sass-official/assets/stylesheets']
			},
			dev: {
				options: {
					watch: true
				}
			},
			build: {
				options: {
					watch: false,
					force: true
				}
			}
		},

		// Parse CSS and add vendor-prefixed CSS properties using the Can I Use database. Based on Autoprefixer.
		// https://github.com/nDmitry/grunt-autoprefixer
		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 9', 'ie 10']
			},
			build: {
				expand: true,
				cwd:    config.tmpdir,
				src:    '*.css',
				dest:   './'
			},
		},

		// https://npmjs.org/package/grunt-contrib-watch
		watch: {
			options: {
				livereload: false,
			},

			// autoprefix the files
			autoprefixer: {
				files: ['<%= config.tmpdir %>*.css'],
				tasks: ['autoprefixer:build'],
			},

			// minify js files
			minifyjs: {
				files: ['assets/js/*.js'],
				tasks: ['requirejs:build'],
			},
		},

		// https://npmjs.org/package/grunt-concurrent
		concurrent: {
			dev: [
				'compass:dev',
				'watch'
			]
		},

		// http://www.browsersync.io/docs/grunt/
		browserSync: {
			options: {
				proxy:       'demo.proteusthemes.dev/buildpress',
				reloadDelay: 50,
				watchTask:   true
			},
			bsFiles: {
				src: [
					'*.php',
					'inc/*.php',
					'woocommerce/*.php',
					'*.css',
					'assets/js/*.js'
				]
			},
		},

		// requireJS optimizer
		// https://github.com/gruntjs/grunt-contrib-requirejs
		requirejs: {
			build: {
				// Options: https://github.com/jrburke/r.js/blob/master/build/example.build.js
				options: {
					baseUrl:                 '',
					mainConfigFile:          'assets/js/main.js',
					optimize:                'uglify2',
					preserveLicenseComments: false,
					useStrict:               true,
					wrap:                    true,
					name:                    'bower_components/almond/almond',
					include:                 'assets/js/main',
					out:                     'assets/js/main.min.js'
				}
			}
		},

		// https://github.com/gruntjs/grunt-contrib-copy
		copy: {
			// create new directory for deployment
			build: {
				expand: true,
				dot:    false,
				dest:   config.themeSlug + '/',
				src:    [
					'*.css',
					'*.php',
					'screenshot.{jpg,png}',
					'Gruntfile.js',
					'composer.json',
					'composer.lock',
					'package.json',
					'bower.json',
					'wpml-config.xml',
					'assets/**',
					'bower_components/acf/**',
					'bower_components/bootstrap-sass-official/assets/fonts/**',
					'bower_components/fontawesome/fonts/**',
					'bower_components/fontawesome/css/font-awesome.min.css',
					'bower_components/html5shiv/dist/html5shiv.min.js',
					'bower_components/mustache/mustache.min.js',
					'bower_components/respimage/respimage.min.js',
					'bower_components/respond/dest/respond.min.js',
					'bundled-plugins/**',
					'demo-content/**',
					'inc/**',
					'languages/**',
					'vendor/**',
					'woocommerce/**'
				],
				flatten: false
			}
		},

		// https://github.com/gruntjs/grunt-contrib-compress
		compress: {
			build: {
				options: {
					archive: config.themeSlug + '.zip',
					mode:    'zip'
				},
				src: config.themeSlug + '/**'
			}
		},

		// https://www.npmjs.com/package/grunt-wp-i18n
		makepot: {
			target: {
				options: {
					domainPath:      'languages/',
					include:         [config.phpFileRegex, '^inc/'+config.phpFileInSubfolderRegex, '^woocommerce/'+config.phpFileInSubfolderRegex],
					mainFile:        'style.css',
					potComments:     'Copyright (C) {year} ProteusThemes \n# This file is distributed under the GPL 2.0.',
					potFilename:     config.themeSlug + '.pot',
					potHeaders:      {
						poedit:                 true,
						'report-msgid-bugs-to': 'http://support.proteusthemes.com/',
					},
					type:            'wp-theme',
					updateTimestamp: false,
					updatePoFiles:   true,
				}
			}
		},

		// https://www.npmjs.com/package/grunt-wp-i18n
		addtextdomain: {
			options: {
				updateDomains: true
			},
			target: {
				files: {
					src: [
						'*.php',
						'inc/**/*.php',
						'woocommerce/**/*.php'
					]
				}
			}
		},

		// https://www.npmjs.com/package/grunt-po2mo
		po2mo: {
			files: {
				src:    'languages/*.po',
				expand: true,
			},
		},

		// https://github.com/yoniholmes/grunt-text-replace
		replace: {
			theme_version: {
				src:          'style.css',
				overwrite:    true,
				replacements: [{
					from: '0.0.0-tmp',
					to:   function () {
						grunt.option( 'version_replaced_flag', true );
						return grunt.option( 'longVersion' );
					}
				}],
			},
		},
	} );

	// DEV
	// browsersync, compass and watch
	grunt.registerTask( 'default', [
		'build',
		'browserSync',
		'concurrent:dev'
	] );

	// build assets
	grunt.registerTask( 'build', [
		'compass:build',
		'autoprefixer:build',
		'requirejs:build',
	] );

	// update languages files
	grunt.registerTask( 'theme_i18n', [
		'addtextdomain',
		'makepot',
		'po2mo',
	] );

	// CI
	// build assets
	grunt.registerTask( 'ci', 'Builds all assets on the CI, needs to be called with --theme_version arg.', function () {
		// get theme version, provided from cli
		var version = grunt.option( 'theme_version' ) || null;

		// check if version is string and is in semver.org format (at least a start)
		if ( 'string' === typeof version && /^v\d{1,2}\.\d{1,2}\.\d{1,2}/.test( version ) ) { // regex that version starts like v1.2.3
			var longVersion = version.substring( 1 ).trim(),
				shortVersion = longVersion.match( /\d{1,2}\.\d{1,2}\.\d{1,2}/ )[0],
				tasksToRun = [
					'build',
					'replace:theme_version',
					'check_theme_replace',
					'theme_i18n'
				];

			grunt.option( 'longVersion', longVersion );

			if ( shortVersion === longVersion ) { // perform TF update, add flag file
				grunt.log.writeln( 'Uploading a theme to the TF' );
				grunt.log.writeln( '===========================' );

				if ( grunt.file.isFile( './buildfortf' ) ) {
					grunt.fail.warn( 'File for flagging TF build already exists.', 1 );
				}
				else {
					// write a dummy file, if this one exists later on build a zip for the TF
					grunt.file.write( './buildfortf', 'lets go!' );
				}
			}

			grunt.task.run( tasksToRun );
		}
		else {
			grunt.fail.warn( 'Version to be replaced in style.css is not specified or valid.\nUse: grunt <your-task> --theme_version=v1.2.3\n', 3 );
		}
	} );

	// create installable zip
	grunt.registerTask( 'zip', [
		'copy:build',
		'compress:build',
	] );

	// check if the search-replace was performed
	grunt.registerTask( 'check_theme_replace', 'Check if the search-replace for theme version was preformed.', function () {
		if ( true !== grunt.option( 'version_replaced_flag' ) ) {
			grunt.fail.warn( 'Search-replace task error - no theme version replaced.' );
		}
	} );
};
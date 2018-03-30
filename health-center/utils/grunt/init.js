/* jshint node:true */
module.exports = function(grunt) {
	'use strict';

	var path = require('path');

	var basedir = path.dirname(grunt.file.findup('Gruntfile.js'));
	var theme_name = grunt.file.readJSON(path.join(basedir, 'package.json')).name;

	return {
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			front: {
				src: '<%= pkg.jsLocation %>all.js',
				dest: '<%= pkg.jsLocation %>all.min.js',
			},
			admin: {
				src: '<%= pkg.adminJsLocation %>admin-all.js',
				dest: '<%= pkg.adminJsLocation %>admin-all.min.js',
			}
		},
		jshint: {
			files: [
				'**/*.js',
				'!**/*.min.js',
				'!documentation/**',
				'!vamtam/plugins/*/**',
				'!style_switcher/**',
				'!vendor/**',
				'!vamtam/assets/js/all.js',
				'!vamtam/assets/js/plugins/thirdparty/**',
				'!node_modules/**',
				'!build/**',
				'!dist/**',
				'!utils/grunt/**',
			],
			options: {
				// 'curly': true,
				// 'quotmark': 'single',
				'eqeqeq': true,
				'eqnull': true,
				// 'es3': true,
				'expr': true,
				'immed': true,
				'multistr': true,
				'noarg': true,
				'strict': true,
				'trailing': true,
				'undef': true,
				'unused': true,

				'browser': true,
				'devel': true,

				'globals': {
					'_': false,
					'Backbone': false,
					'jQuery': false,
					'Modernizr': false,
					'wp': false,
					'ajaxurl': false,
					'autosave': false,
					'RetinaImage': false,
					'RetinaImagePath': false,
					'switchEditors': false,
					'quicktags': false,
					'tinyMCEPreInit': false,
					'tinyMCE': false,
					'tinymce': false,
					'wpActiveEditor': true,
					'WPV_ADMIN': false,
					'WpvTmceShortcodes': false,
					'send_to_editor': false,
					'WPVED_LANG': false,
				},
			}
		},
		concat: {
			options: {
				separator: '\n',
			},
			dist: {
				src: [
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.gmap.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.magnific.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.imagesloaded.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.smartresize.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.isotope.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.socialcount.js',
					'<%= pkg.jsLocation %>plugins/thirdparty/jquery.easypiechart.js',

					'<%= pkg.jsLocation %>plugins/vamtam/jquery.vamtam.doubletapclick.js',
					'<%= pkg.jsLocation %>plugins/vamtam/jquery.plugins.js',
					'<%= pkg.jsLocation %>plugins/vamtam/jquery.rawcontenthandler.js',
					'<%= pkg.jsLocation %>plugins/vamtam/jquery.jail.js',
					'<%= pkg.jsLocation %>plugins/vamtam/jquery.wpvanimatenumber.js',

					'<%= pkg.jsLocation %>countdown.js',
					'<%= pkg.jsLocation %>progress.js',
					'<%= pkg.jsLocation %>media.js',
					'<%= pkg.jsLocation %>lazyload.js',
					'<%= pkg.jsLocation %>lightbox.js',
					'<%= pkg.jsLocation %>isotope.js',
					'<%= pkg.jsLocation %>tabs-accordions.js',
					'<%= pkg.jsLocation %>ios-orientationchange-fix.js',
					'<%= pkg.jsLocation %>menu.js',
					'<%= pkg.jsLocation %>sticky-header.js',
					'<%= pkg.jsLocation %>column-animation.js',
					'<%= pkg.jsLocation %>column-parallax.js',
					'<%= pkg.jsLocation %>general.js',
					'<%= pkg.jsLocation %>woocommerce.js',
					'<%= pkg.jsLocation %>services-shrinking.js',
					'<%= pkg.jsLocation %>services-expandable.js',
					'<%= pkg.jsLocation %>portfolio.js',
					'<%= pkg.jsLocation %>layerslider-height.js',
					'<%= pkg.jsLocation %>ajax-navigation.js',
					'<%= pkg.jsLocation %>scrollable.js',
				],
				dest: '<%= pkg.jsLocation %>all.js',
				nonull: true,
			},
			admin: {
				src: [
					'<%= pkg.adminJsLocation %>plugins/jquery.wpv.colorpicker.js',
					'<%= pkg.adminJsLocation %>plugins/jquery.wpv.iconsselector.js',
					'<%= pkg.adminJsLocation %>plugins/jquery.wpv.backgroundoption.js',
					'<%= pkg.adminJsLocation %>custom-sidebars.js',
					'<%= pkg.adminJsLocation %>upload.js',
					'<%= pkg.adminJsLocation %>icon-manager.js',
					'<%= pkg.adminJsLocation %>horizontal-blocks.js',
					'<%= pkg.adminJsLocation %>social-links.js',
					'<%= pkg.adminJsLocation %>wpv_admin.js',
					'<%= pkg.adminJsLocation %>post-format-options.js',
				],
				dest: '<%= pkg.adminJsLocation %>admin-all.js',
				nonull: true,
			},
		},
		watch: {
			js: {
				files: ['<%= concat.dist.src %>', '<%= concat.admin.src %>'],
				tasks: ['buildjs']
			}
		},
		recess: {
			dist: {
				options: {
					noUniversalSelectors: false,
					noOverqualifying: false,
				},
				src: ['cache/all.css']
			}
		},
		compress: {
			theme: {
				options: {
					archive: path.join('dist', theme_name + '.zip'),
					mode: 'zip',
					pretty: true
				},
				files: [{
					expand: true,
					src: [
						'**/*',
					],
					cwd: 'build/'
				}]
			}
		},
		makepot: {
			target: {
				options: {
					domainPath: '/languages/',
					exclude: [ 'vamtam/plugins/.*', 'documentation/.*', 'build/.*' ],
					mainFile: 'style.css',
					potFilename: theme_name + '.pot',
					type: 'wp-theme',
					updateTimestamp: true,
				}
			}
		},
		parallel: {
			css: {
				options: {
					stream: true
				},
				tasks: [{
					cmd: 'php',
					args: ['<%= pkg.plessc %>', '-n', '-w', 'wpv_theme/assets/css/all.less', 'cache/all.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', '-n', '-w', 'vamtam-editor/assets/css/editor.less', 'vamtam-editor/assets/css/editor.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', '-n', '-w', 'vamtam/admin/assets/css/wpv_admin.less', 'vamtam/admin/assets/css/wpv_admin.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', '-n', '-w', 'vamtam/admin/assets/css/fonts.less', 'vamtam/admin/assets/css/fonts.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', '-n', '-w', 'wpv_theme/assets/css/magnific.less', 'wpv_theme/assets/css/magnific.css']
				}]
			},
			'css-once': {
				options: {
					stream: true
				},
				tasks: [{
					cmd: 'php',
					args: ['<%= pkg.plessc %>', 'wpv_theme/assets/css/all.less', 'cache/all.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', 'vamtam-editor/assets/css/editor.less', 'vamtam-editor/assets/css/editor.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', 'vamtam/admin/assets/css/wpv_admin.less', 'vamtam/admin/assets/css/wpv_admin.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', 'vamtam/admin/assets/css/fonts.less', 'vamtam/admin/assets/css/fonts.css']
				}, {
					cmd: 'php',
					args: ['<%= pkg.plessc %>', 'wpv_theme/assets/css/magnific.less', 'wpv_theme/assets/css/magnific.css']
				}]
			},
			dev: {
				options: {
					stream: true
				},
				tasks: [{
					grunt: true,
					args: ['parallel:css'],
				}, {
					grunt: true,
					args: ['watch:js'],
				}]
			},
			composer: {
				options: {
					stream: true
				},
				tasks: [{
					cmd: 'composer',
					args: ['install']
				}]
			},
			'fetch-wp-devel': {
				options: {
					stream: true
				},
				tasks: [{
					cmd: 'svn',
					args: ['co', 'http://develop.svn.wordpress.org/trunk/', path.join('/tmp', 'wp-devel')]
				}]
			},
		},
		clean: {
			build: 'build/',
			dist: 'dist/',
			'post-copy': {
				src: [
					'build/**/vamtam/plugins/**/*',
					'!build/**/vamtam/plugins/*.php',

					'!build/**/vamtam/plugins/revslider.zip',
					'!build/**/vamtam/plugins/timetable.zip',
					'!build/**/vamtam/plugins/vamtam-love-it.zip',
					'!build/**/vamtam/plugins/vamtam-push-menu.zip',
					'!build/**/vamtam/plugins/vamtam-twitter.zip',

					'build/**/node_modules',
					'build/**/desktop.ini',
					'build/**/style_switcher',
					'build/**/secrets.json',
				]
			}
		},
		copy: {
			theme: {
				src: '**/*',
				dest: path.join('build', theme_name) + path.sep
			},
			'layerslider-samples': {
				expand: true,
				src: ['**'],
				cwd: 'samples/layerslider/',
				dest: 'vamtam/plugins/layerslider/sampleslider/'
			}
		},
		replace: {
			'style-switcher': {
				options: {
					patterns: [{
						match: /\/\/ @todo remove everything after and including this comment when packaging for sale[\s\S]*/,
						replacement: ''
					}]
				},
				files: [{
					src: [ path.join('build', theme_name, 'functions.php') ],
					dest: path.join('build', theme_name, 'functions.php'),
				}]
			},
			lessc: {
				options: {
					patterns: [{
						match: /lessc/,
						replacement: 'WpvLessc'
					}]
				},
				files: [{
					src: [ path.join(basedir, 'vamtam', 'classes', 'lessc.php') ],
					dest: path.join(basedir, 'vamtam', 'classes', 'lessc.php'),
				}]
			}
		},
		'add-textdomain': {
			theme: [
				'**/*.php',
				'!vendor/**',
				'!vamtam/plugins/*/**',
				'!node_modules',
			]
		},
		phpcs: {
			application: {
				dir: [
					// '**/*.php',
					'vamtam/classes/*.php',
					'vamtam/admin/**/*.php',

					'!vamtam/admin/templates/*.php',
					'!vamtam/plugins/**',
					'!utils/**',
					'!vendor/**',
					'!vamtam/classes/mobile-detect.php',
					'!vamtam/classes/lessc.php',
					'!vamtam/classes/plugin-activation.php',
					'!node_modules/**',
					'!documentation/**',
				],
			},
			options: {
				bin: 'phpcs',
				standard: 'WordPress',
				report: 'summary',
			}
		},
		ucss: {
			local: {
				options: {
					// whitelist: [],
					// auth: null
				},
				pages: {
					crawl: 'http://health-center.demo.local',
					include: []
				},
				css: ['http://health-center.demo.local/wp-content/themes/health-center/cache/all.css']
			}
		}
	};
};
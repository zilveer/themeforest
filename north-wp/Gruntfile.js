'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
			theme_slugname: 'north',
      // let us know if our JS is sound
      jshint: {
	      options: {
          "bitwise": true,
          "browser": true,
          "curly": true,
          "eqeqeq": true,
          "eqnull": true,
          "es5": true,
          "esnext": true,
          "immed": true,
          "jquery": true,
          "latedef": true,
          "newcap": true,
          "noarg": true,
          "node": true,
          "strict": false,
          "undef": true,
          "globals": {
						"jQuery": true,
						"alert": true,
						"google": true,
						"InfoBox": true,
						"themeajax": true,
						"ajaxurl": true,
						"IScroll": true,
						"smoothScroll": true,
						"TimelineLite": true,
						"TimelineMax": true,
						"TweenLite": true,
						"TweenMax": true,
						"Quart": true,
						"Back": true,
						"_": true,
						"skrollr": true,
						"Favico": true,
						"onePageScroll": true,
						"OT_UI": true,
						"option_tree": true,
						"reinvigorate": true,
						"LazyLoad": true,
						"_gaq": true,
						"ga": true,
						"ocdi": true,
						"MobileDetect": true,
						"addthis": true,
						"adsbygoogle": true,
						"FB": true,
						"BezierEasing": true,
						"BackgroundCheck": true
          }
	      },
	      all: [
	        'Gruntfile.js',
	        'assets/js/plugins/app.js',
	        'assets/js/plugins/admin-meta.js'
	      ]
      },

      // concatenation and minification all in one
      uglify: {
	      dist: {
          files: {
      			'assets/js/admin-meta.min.js': [
      				'assets/js/plugins/admin-meta.js'
      			],
      			'assets/js/vendor.min.js': [
      				'assets/js/vendor/*.js'
      			],
      			'inc/tinymce/shortcode_generator/js/popup.min.js': [
      				'inc/tinymce/shortcode_generator/js/popup.js'
      			],
      			'inc/tinymce/thb.tinymce.min.js': [
      				'inc/tinymce/thb.tinymce.js'
      			]
          }
	      },
	      app: {
	      	options: {
	      		beautify: false,
	      		mangle: false
	      	},
	      	files: {
	      		'assets/js/app.min.js': [
	      			'assets/js/plugins/app.js'
	      		]
	      	}
	      }
      },
	
			concat: {
				options: {
					stripBanners: true
				},
				dist: {
					src: 'assets/js/vendor/*.js',
					dest: 'assets/js/vendor.min.js',
				},
			},
			
      // style (Sass) compilation via Compass
      compass: {
        dist: {
          options: {
            sassDir: 'assets/sass',
            cssDir: 'assets/css',
						noLineComments: true,
          }
        },
				dev: {
					options: {
						sassDir: 'assets/sass',
						cssDir: 'assets/css',
						noLineComments: true
					}
				}
      },

      // watch our project for changes
      watch: {
	      compass: {
          files: [
              'assets/sass/*'
          ],
          tasks: ['compass']
	      },
	      js: {
          files: [
              '<%= jshint.all %>'
          ],
          tasks: ['uglify']
	      }
      },
      
      // copy folder
      copy: {
        main: {
          expand: true,
          src: '**',
          dest: '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp',
        },
      },
      
      // clean folder
      clean: {
      	options: {
    	    'force': true
    	  },
        build: [
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/**/.git',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/**/.gitignore',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/**/.sass-cache',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/<%= theme_slugname %>-wp.esproj',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/**/.DS_Store',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/node_modules',
        	'/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/admin/assets/theme-mode'
        ],
      },
      // Strip Code
      strip_code: {
	      strip_theme_switcher: {
	        options: {
	          blocks: [{
	            start_block: "<!-- start theme switcher -->",
	            end_block: "<!-- end theme switcher -->"
	          }]
	        },
	        src: ['/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/footer.php', '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp/footer.php']
	      }
      },
      
			// Compress
			compress: {    
			  theme: {
			    options: {
			      archive: '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>-wp.zip'
			    },
			    files: [
			      {
			      	expand: true, 
			      	cwd: '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/', 
			      	src: ['<%= theme_slugname %>-wp/**/*']
			      } 
			    ]
			  },
			  all_files: {
			    options: {
			      archive: '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/<%= theme_slugname %>.zip'
			    },
			    files: [
			      {
			      	expand: true, 
			      	cwd: '/Users/anteksiler/Desktop/themeforest/<%= theme_slugname %>/',
			        src: [
			          '<%= theme_slugname %>-wp.zip',
			          '<%= theme_slugname %>-wp-child.zip',
			          'PSD.zip',
			          'Plugins.zip',
			          'Documentation.zip',
			          'Slider Exports.zip'
			        ]
			      },  
			    ]
			  } 
			}
  });

  // load tasks
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-strip-code');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compress');
	
  // register task
  grunt.registerTask('default', [
    'jshint',
    'compass:dev',
    'concat',
    'watch'
  ]);
	
	grunt.registerTask('release', [
    'jshint',
    'compass:dev',
    'uglify',
    'watch'
  ]);
  
  grunt.registerTask('pack', [
  	'copy',
  	'clean',
  	'strip_code',
  	'compress:theme',
  	'compress:all_files'
  ]);

};
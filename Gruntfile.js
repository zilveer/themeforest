/**
 * Grunt tasks file for RT-Theme 19 WordPress Theme
 * Created by RT-Themes
 * http://rtthemes.com
 *
 * use 'grunt release' for production
 * use 'grunt watch' for sass development
 * 
 * do js min
 * do css min
 * do compass compile
 * do combine css
 * do combine js
 */

module.exports = function(grunt) {

  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-compass-multiple');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.initConfig({

      //--------------------------
      // compass compile at multi threads.
      //--------------------------
      compassMultiple: {
        options : {
          javascriptsDir: 'rttheme19/js',
          imagesDir: 'rttheme19/images',
          sassDir: 'rttheme19/css/sass',
          cssDir: 'rttheme19/css',
          relativeAssets: true,
        },

        // Release
        release: {
          options: {
            environment: 'production', 
            outputStyle: 'expanded',
            multiple: [
              {
                // admin
                sassDir: 'rttheme19/rt-framework/admin/css/sass',
                cssDir: 'rttheme19/rt-framework/admin/css'
              },{
                // theme
                sassDir: 'rttheme19/css/sass',
                cssDir: 'rttheme19/css'
              }
            ],            
          }
        },

        // Debug
        debug: {
          options: {
            environment: 'development', 
            outputStyle: 'expanded',
            multiple: [
              {
                // admin
                sassDir: 'rttheme19/rt-framework/admin/css/sass',
                cssDir: 'rttheme19/rt-framework/admin/css'
              },{
                // theme
                sassDir: 'rttheme19/css/sass',
                cssDir: 'rttheme19/css'
              }
            ],            
          }
        } 

      },


      //--------------------------
      // css min
      //--------------------------
      cssmin: {
        all: {
          files: [{
            expand: true,
            cwd: 'rttheme19/css',
            src: ['*.css', '!*.min.css'],
            dest: 'rttheme19/css',
            ext: '.min.css'
          }]
        },
        layout1: {
          files: [{
            expand: true,
            cwd: 'rttheme19/css/layout1',
            src: ['*.css', '!*.min.css'],
            dest: 'rttheme19/css/layout1',
            ext: '.min.css'
          }]
        },  
        layout2: {
          files: [{
            expand: true,
            cwd: 'rttheme19/css/layout2',
            src: ['*.css', '!*.min.css'],
            dest: 'rttheme19/css/layout2',
            ext: '.min.css'
          }]
        },                 
        woo: {
          files: [{
            expand: true,
            cwd: 'rttheme19/css/woocommerce',
            src: ['*.css', '!*.min.css'],
            dest: 'rttheme19/css/woocommerce',
            ext: '.min.css'
          }]
        },      
        admin: {
          files: [{
            expand: true,
            cwd: 'rttheme19/rt-framework/admin/css',
            src: ['*.css', '!*.min.css'],
            dest: 'rttheme19/rt-framework/admin/css',
            ext: '.min.css'
          }]
        },                
       // combine: {
       //   files: {
       //     'rttheme19/css/app.min.css': ['rttheme19/css/!app.min.css','rttheme19/css/!*.css', 'rttheme19/css/*.min.css']
       //   }
       // }        
      },

      //--------------------------
      // concat 
      //--------------------------
      concat: {
        options: {
          separator: '',
        },
        layout1: {
          src: [
                'rttheme19/css/bootstrap.min.css',
                'rttheme19/css/owl-carousel.min.css',
                'rttheme19/css/layout1/style.min.css'
              ],
          dest: 'rttheme19/css/layout1/app.min.css',
        },
        layout2: {
          src: [
                'rttheme19/css/bootstrap.min.css',
                'rttheme19/css/owl-carousel.min.css',
                'rttheme19/css/layout2/style.min.css'
              ],
          dest: 'rttheme19/css/layout2/app.min.css',
        },        
        extras: {
          src: [
                'rttheme19/js/pace.js',
                'rttheme19/js/modernizr.min.js',
                'rttheme19/js/imagesloaded.min.js',
                'rttheme19/js/isotope.pkgd.min.js',
                'rttheme19/js/owl.carousel.min.js',
                'rttheme19/js/customselect.min.js',
                'rttheme19/js/jflickrfeed.min.js',
                'rttheme19/js/bootstrap.min.js',
                'rttheme19/js/waypoints.min.js',
                'rttheme19/js/placeholders.min.js',
                'rttheme19/js/jquery.vide.min.js',
                'rttheme19/js/scripts.min.js',
          ],
          dest: 'rttheme19/js/app.min.js',
        },        

      },

      //--------------------------
      // clean 
      //--------------------------
      clean: {
        css: [  
                'rttheme19/**/.DS_Store',
                'rttheme19/css/bootstrap.css',
                'rttheme19/css/layout1/style.css', 
                'rttheme19/css/layout2/style.css', 
                'rttheme19/css/layout1/rtl.css', 
                'rttheme19/css/layout2/rtl.css', 
                'rttheme19/css/ie9.css', 
                'rttheme19/css/woocommerce/rt-woocommerce.css', 
                "rttheme19/rt-framework/admin/css/admin.css"
              ]
      },

      //--------------------------
      // Uglify 
      //--------------------------
      uglify: {
        options: {
          preserveComments: 'some'
        },
        dist: {
            src: ['rttheme19/js/scripts.js'],
            dest: 'rttheme19/js/scripts.min.js'
        },
        admin: {
            files : {
              'rttheme19/rt-framework/admin/js/script.min.js' : 'rttheme19/rt-framework/admin/js/script.js',
              'rttheme19/rt-framework/admin/js/customizer.min.js' : 'rttheme19/rt-framework/admin/js/customizer.js',
              'rttheme19/rt-framework/admin/js/rt-skin-selector.min.js' : 'rttheme19/rt-framework/admin/js/rt-skin-selector.js',
              'rttheme19/rt-framework/admin/js/rt-font-control.min.js' : 'rttheme19/rt-framework/admin/js/rt-font-control.js',
              'rttheme19/rt-framework/admin/js/rt-color-control.min.js' : 'rttheme19/rt-framework/admin/js/rt-color-control.js', 
              'rttheme19/rt-framework/admin/js/editor_buttons.min.js' : 'rttheme19/rt-framework/admin/js/editor_buttons.js',
              'rttheme19/rt-framework/admin/js/rt_location_finder.min.js' : 'rttheme19/rt-framework/admin/js/rt_location_finder.js',
            }            
        }        
      },

      //--------------------------
      // watch
      //--------------------------
      watch: {
        dev: {
          files: [
            'rttheme19/rt-framework/admin/css/**/*.scss',
            'rttheme19/css/**/*.scss',
            '*.css',
            '!*.min.css'
          ],
          tasks: [
            'default'
          ]
        }    
      },
  });
 
  // Default Task
  grunt.registerTask('default', ['compassMultiple:debug']); 

  // Release Task
  grunt.registerTask('release', ['clean:css','compassMultiple:release','uglify','cssmin','concat']); 

};
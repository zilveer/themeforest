module.exports = function(grunt) {

  // Project configuration.
  // grunt.initConfig({
  //   pkg: grunt.file.readJSON('package.json'),
  //   uglify: {
  //     build: {
  //       src: 'assets/js/*.js',
  //       dest: 'assets/js/ubermenu.min.js'
  //     }
  //   }
  // });

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // uglify: {
    //   build: {
    //     src: 'assets/css/ubermenu.css',
    //     dest: 'assets/css/ubermenu.min.css'
    //   }
    // },

    cssmin: {
      options: {
        banner:
          "/*\n"+
           " * UberMenu 3 \n" +
           " * http://wpmegamenu.com \n" +
           " * Copyright 2011-2014 Chris Mavricos, SevenSpark \n" +
           " */"
      },
      minify: {
        files: {
          'assets/css/ubermenu.min.css' : ['assets/css/ubermenu.css'],
          'pro/assets/css/ubermenu.min.css' : ['pro/assets/css/ubermenu.css']
        }
      }
      /*
      minify: {
          expand: true,
          cwd: 'assets/css/',
          src: ['ubermenu.css'],
          dest: 'assets/css/',
          ext: '.min.css'
        }
      */
    },

    'closure-compiler': {
      frontend: {
        closurePath: '/usr/local/lib/closure-compiler',
        js: 'assets/js/*.js',
        jsOutputFile: 'assets/js/ubermenu.min.js',
        maxBuffer: 500,
        options: {
          compilation_level: 'SIMPLE_OPTIMIZATIONS',
          language_in: 'ECMASCRIPT5_STRICT'
        }
      }
    },

    less: {
      development: {
        options: {
          compress: false,
        },
        files: [
          {
            "assets/css/ubermenu.css": "assets/css/ubermenu.less"
          },
          {
            "pro/assets/css/ubermenu.css": "pro/assets/css/ubermenu.less"
          },
          {
            "custom/custom-sample-skin.css": "pro/assets/css/skins/custom-skin.less"
          },
          {
            expand: true,
            cwd: 'pro/assets/css/skins/',
            src: ['*.less'],
            dest: 'pro/assets/css/skins/',
            ext: '.css'
            // target.css file: source.less file
            //"pro/assets/css/skins/blackwhite2.css": "pro/assets/css/skins/blackwhite2.less"
          },
          {
            expand: true,
            cwd: 'pro/assets/css/skins/',
            src: ['blackwhite2.less','blackwhite.less','vanilla.less','vanilla_bar.less'],
            dest: 'assets/css/skins',
            ext: '.css'
            // target.css file: source.less file
            //"pro/assets/css/skins/blackwhite2.css": "pro/assets/css/skins/blackwhite2.less"
          }
        ]
      }
    }

  });

  // Load the plugin that provides the "uglify" task.
  //grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-closure-compiler');
  

  // Default task(s).
  //grunt.registerTask('default', ['uglify']);
  grunt.registerTask('default', ['less','cssmin','closure-compiler']);

  grunt.registerTask('css', ['less','cssmin']);

};
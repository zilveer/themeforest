module.exports = function (grunt) {

  var themeScripts = [
    "src/1.ie-version.js",
    "src/3.window-scroller.js",
    "src/4.header-sticky.js",
    "src/5.main-navigation.js",
    "src/6.secondary-header.js",
    "src/7.retina-images.js",
    "src/8.milestones.js",
    "src/9.google-map.js",
    "src/10.header-search.js",
    "src/11.jquery-colorbox.js",
    "src/12.edge-slider.js",
    "src/13.swipe-slider.js",
    "src/14.jquery.parallax.js",
    "src/15.tabs.js",
    "src/16.blog.js",
    "src/17.isotop.js",
    "src/18.fix-layout.js",
    "src/19.event-count-down.js",
    "src/20.instagram.js",
    "src/21.accordians.js",
    "src/22.social-share.js",
    "src/23.typer.js",
    "src/33.callout-action.js",
    "src/24.process-step.js",
    "src/25.page-section.js",
    "src/26.page-section-expand.js",
    "src/27.flicker.feed.js",
    "src/28.flexslider.js",
    "src/29.edge-one-pager.js",
    "src/30.animated-columns.js",
    "src/31.smooth-scroll.js",
    "src/32.fancy-box.js",
    "src/33.callout-action.js",

  ];

  var libs = [
  ];

  var plugins = [
    "plugins/1.unknown.js",
    "plugins/2.fullpage.js",
    "plugins/3.greensock.js",
    "plugins/4.typed.js",
    "plugins/5.flexslider.js",
    "plugins/6.waitforimage.js",
    "plugins/7.isotop.js",
    "plugins/8.jquery.transit.js",
    "plugins/9.infinitscroll.js",
    "plugins/10.megamenu.js",
    "plugins/11.aliaser.js",
    "plugins/12.unknown.js",
    "plugins/13.easy-pie-chart.js",
    "plugins/14.simple.count-down.js",
    "plugins/15.debounced-resize.js",
    "plugins/16.jquery.parallax.js",
    "plugins/17.jquery.frames.js",
    "plugins/18.jquery.jparallax.js",
    "plugins/19.jquery.tools.validator.js",
    "plugins/20.viewport.js",
    "plugins/21.chopscroll.js",
    "plugins/22.hoverintent.js",
    "plugins/23.swiper.js",
    "plugins/24.jquery.easing.js",
    "plugins/25.jquery.menu.js",
    "plugins/26.jquery.verticalMenu.js",
    "plugins/27.jquery.sectiontrans.js",
    "plugins/28.jquery.parallax.js",
    "plugins/resize-listener.js"
  ];

  grunt.initConfig({

    concat: {
      options: {
        separator: ";"
      },

      libs: {
          src: libs,
          dest: "tmp/libs.js"
      },

      plugins: {
        files: [
          {
            src: plugins,
            dest: "plugins.js"
          }
        ]
      },

      themeScripts: {
        files: [
          {
            src: ['src/refactored/*.js', 'src/in-progress/*.js', themeScripts],
            dest: "theme-scripts.js"
          }
        ]
      }
    },

    wrap: {
      basic: {
        src: ['theme-scripts.js'],
        dest: "theme-scripts.js",
        options: {
          wrapper: ['(function ($) {\n', '\n}(jQuery)); console.log("ready for rock");']
        }
      }
    },

    clean: {
      tmp: {
        src: ["tmp"]
      }
    },

    less: {
      development: {
        files: {
          '../stylesheet/css/theme-styles.css': '../stylesheet/less/theme-styles.less',
          '../stylesheet/css/mk-woocommerce.css': '../stylesheet/less/mk-woocommerce.less',
          '../stylesheet/css/theme-font-icons.css': '../stylesheet/less/theme-font-icons.less',
        }
      }
    },

    watch: {
      liveDevelop: {
        files: ['src/refactored/*.js', 'src/in-progress/*.js', 'src/*.js', 'plugins/*.js'],
        tasks: ['build'],
        options: {
          spawn: false
        }
      },
      theme: {
        files: ['../stylesheet/less/*.less'],
        tasks: ['less:development', 'build'],
        options: {
          spawn: false
        }
      }
    },

    uglify: {
    
      themeScripts: {
        options: {
          compress: false
        },
        files: {
          'min/theme-scripts-ck.js': ['theme-scripts.js']
        }
      },

      plugins: {
        options: {
          compress: false
        },
        files: {
          'min/plugins-ck.js': ['plugins.js']
        }
      }

    },

    cssmin: {
      my_target: {
        options : {
          report : 'gzip'
        },
        files: [{
          expand: true,
          cwd: '../stylesheet/css/',
          src: ['*.css', '!*.min.css'],
          dest: '../stylesheet/css/',
          ext: '.min.css'
        }]
      }
    },

    bless: {
      css: {
        options: {
          logCount: true,
          cacheBuster : false
        },
        files: {
          '../stylesheet/css/styles.min.css': '../stylesheet/css/theme-styles.min.css',
          '../stylesheet/css/styles.css': '../stylesheet/css/theme-styles.css'
        }
      }
    }

	});

  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-wrap");
  grunt.loadNpmTasks("grunt-contrib-clean");
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-bless');

	//task registration
  grunt.registerTask("default", [
      "concat:themeScripts",
      "wrap:basic",
      "concat:plugins",
      "concat:libs",
      "less",
      "cssmin",
      "bless",
      "uglify:themeScripts",
      "uglify:plugins",
      "clean:tmp"
  ]);

  grunt.registerTask( "build", [
      "concat:themeScripts",
      "wrap:basic",
      "concat:plugins",
      "concat:libs",
      "less",
      "cssmin",
      "bless",
      "uglify:themeScripts",
      "uglify:plugins",
      "clean:tmp"
  ]);

};

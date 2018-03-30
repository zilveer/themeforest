module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
     
            

      concat: {
           dist: {
                   src: [
                       'js/all/*.js',
                   ],
                   dest: 'js/plugins.js',
               }
            },
            /*
       concat: {
            dist: {
                   src: [
                       'css/all/*.css',
                   ],
                   dest: 'css/plugins.css',
               }
            },               
    */
     uglify: {
      build: {
        src: 'js/plugins.js',
        dest: 'js/plugins.min.js',
      }
    }, 
    'cssmin': {
    'dist': {
        /* Plugins */
        'src': ['css/plugins.css'],
        'dest': 'css/plugins.min.css'

    }
    },
    copy: {
      main: {
        src: 'css/media.css',
        dest: '../../../../organized/wp-content/themes/goodnews5/css/media.css',
      },
    },
    
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-yui-compressor');
  grunt.loadNpmTasks('grunt-sync');
  grunt.loadNpmTasks('grunt-contrib-copy');

  // Default task(s).
  grunt.registerTask('css', ['concat', 'cssmin']);
  grunt.registerTask('js', ['concat', 'uglify']);
  grunt.registerTask('copy', ['copy']);

};
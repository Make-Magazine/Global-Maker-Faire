module.exports = function(grunt) {
  var watchFiles = ['less/**/*.less', 'js/**/*.js', '!js/*.js', 'js/angular/*.js'];
  var lessSrcFiles = {
    'css/style.css': ['less/style.less']
  };
  // All configurations go here
  grunt.initConfig({

    // Reads the package.json file
    pkg: grunt.file.readJSON('package.json'),

    // Each Grunt plugins configurations will go here
    less: {
      prod: {
        options: {
          compress: true
        },
        files: lessSrcFiles
      },
      dev: {
        options: {
          compress: false,
          dumpLineNumbers: 'comments'
        },
        files: lessSrcFiles
      }
    },

    watch: {
      prod: {
        files: watchFiles,
        tasks: ['less:prod']
      },
      dev: {
        files: watchFiles,
        tasks: ['less:dev']
      },
      reload: {
        files: watchFiles,
        tasks: ['less'],
        options: {
          livereload: true
        }
      }
    }
  });

  // Simplify the repetivite work of listing each plugin in grunt.loadNomTasks(), just get the list from package.json and load them...
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Register the tasks with Grunt
  // To only watch for less changes and process without browser reload type in "grunt"
  grunt.registerTask('default', ['less:prod', 'watch:prod']);
  // Dev mode build task
  grunt.registerTask('dev', ['less:dev', 'watch:dev']);
  // To watch for less changes and process them with livereload type in "grunt reload"
  grunt.registerTask('reload', ['less', 'watch:reload']);

};

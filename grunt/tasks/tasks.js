module.exports = function(grunt) {
  grunt.registerTask('default', [ 'clean:dist', 'less', 'bower', 'uglify', 'version', 'autoprefixer' ]);
  grunt.registerTask('dev', [ 'watch' ]);
};

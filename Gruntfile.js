'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.min.js'
      ]
    },
    less: {
      dist: {
        files: {
          'assets/css/main.min.css': [
            'assets/less/app.less', 'assets/css/vendor/animate.css/animate.min.css', 'assets/less/vc_elements.less'
          ],
          'assets/css/vc_styles.css': [ 'assets/less/vc_customized.less'],
          'admin/assets/css/vc_admin_styles.css': [
            'assets/less/vc_admin.less',
            'admin/assets/vendor/**/*.css',
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.min.css.map',
          sourceMapRootpath: '/wp-content/themes/timber-starter-theme/'
        }
      }
    },
    autoprefixer: {
      no_dest: {
        src: 'admin/assets/css/vc_admin_styles.css'
      }
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'assets/js/plugins/**/*.js',
            '!assets/js/plugins/parallax/*.js',
            'assets/js/_*.js'
          ],
          'admin/assets/js/admin-scripts.js': [
            'admin/assets/js/*.js',
            '!admin/assets/js/vc-icons.js',
            '!admin/assets/js/vc-settings-slider.js',
            'admin/assets/vendor/**/*.js',
            '!admin/assets/vendor/**/*.min.js'
            //'admin/assets/js/vendor/**/js/*.js',
          ]
        },
        options: {
          compress: false,
          mangle: false
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'assets/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/roots/assets/js/scripts.min.js.map'
        }
      }
    },
    version: {
      options: {
        file: 'lib/scripts.php',
        css: 'assets/css/main.min.css',
        cssHandle: 'roots_main',
        js: 'assets/js/scripts.min.js',
        jsHandle: 'roots_scripts'
      }
    },
    watch: {
      less: {
        files: [
          'assets/less/*.less',
          'assets/less/bootstrap/*.less'
        ],
        tasks: ['less', 'version', 'autoprefixer']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify', 'version']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          'assets/css/main.min.css',
          'assets/js/scripts.min.js',
          'templates/*.php',
          'vc_templates/*.php',
          '*.php',
          'Gruntfile.js',
          'admin/assets/js/*.js',
          '!admin/assets/js/admin-scripts.js'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/js/scripts.min.js',
        'admin/assets/js/admin-scripts.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-wp-version');
  grunt.loadNpmTasks('grunt-autoprefixer');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'less',
    'uglify',
    'version',
    'autoprefixer'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};

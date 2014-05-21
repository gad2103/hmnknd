'use strict';
module.exports = function(grunt) {

  // Load task config files
  var configs, 
  options = {
    "config": {
      "src": "grunt/configs/*.json"
    }
  };
  configs = require('load-grunt-configs')(grunt, options);
  grunt.initConfig(configs);

  // Load tasks
  require('load-grunt-tasks')(grunt);

  // Register tasks
  grunt.loadTasks('grunt/tasks/');
};

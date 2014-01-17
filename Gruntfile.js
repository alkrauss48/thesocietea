module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
          'assets/js/lib/*.js',
          'assets/js/_*.js'
		  ]
		}
	  }		  
	},
    compass: {
	  dist: {
	    options: {
	      config: 'config.rb',
	      sassDir: 'assets/sass',
	      cssDir: 'assets/css',
	      environment: 'production',
	      outputStyle: 'compressed',
	      relativeAssets: true
	    }
	  }
	},
	connect: {
	  server: {
	    options: {
	      port: 9001,
	      base: ''
	    }
	  }
	},
	watch: {
	  options: {
		livereload: true
      },
	  sass: {
		files: [
		  'assets/sass/*.scss'
		],
		tasks: [
		  'compass'
		], 
	  }
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-connect');

  // Default task(s).
  grunt.registerTask('default', [
  	'uglify',
  	'compass',
  	'connect',
  	'watch'
  	]);

};
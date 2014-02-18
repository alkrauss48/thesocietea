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
    sass: {
	  dist: {
	    options: {
	      style: 'compressed',
	      compass: 'true',
	      sourcemap: false
	    },
	    files: {
		    'assets/css/screen.css' : [
		    'assets/sass/screen.scss'
		   ]
	    }
	  }
	},
	watch: {
	  options: {
		livereload: true
      },
	  sass: {
		files: [
		  'assets/sass/*.scss',
		  'assets/sass/partials/*.scss'
		],
		tasks: [
		  'sass'
		], 
	  }
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');

  // Default task(s).
  grunt.registerTask('default', [
  	'uglify',
  	'sass',
  	'watch'
  	]);

};
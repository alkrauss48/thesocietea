module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        coffee: {
          compile: {
            files: {
              'assets/js/_coffee.js': ['assets/coffee/_*.coffee']
            }
          }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/scripts.min.js': [ 'assets/js/_*.js'   ],
                    'assets/js/ie.min.js':      [ 'assets/js/ie/*.js' ]
                },
                options: {
                  sourceMap: true
                }
            },
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    bundleExec: true,
                    compass: true,
                    sourcemap: false,
                    lineNumbers: true,
                    require: 'susy'
                },
                files: {
                    'assets/css/screen.css': [ 'assets/sass/concat.scss' ]
                }
            }
        },
        concat: {
          options: {
            separator: ';',
          },
          dist: {
            src: ['assets/sass/_*.scss'],
            dest: 'assets/sass/concat.scss'
          }
        },
        imagemin: {
          dynamic: {
            files: [{
              expand: true,               // Enable dynamic expansion
              cwd: 'assets/images/src/',  // Src matches are relative to this path
              src: ['*.{png,jpg,gif}'],   // Actual patterns to match
              dest: 'assets/images/dist/' // Destination path prefix
            }]
          }
        },
        watch: {
            options: {
                livereload: true
            },
            concat: {
              files: ['assets/sass/_*.scss', 'assets/sass/partials/*.scss'],
              tasks: [ 'concat:dist' ]
            },
            sass: {
                files: [ 'assets/sass/concat.scss' ],
                tasks: [ 'sass' ]
            },
            coffee: {
              files: [ 'assets/coffee/_*.coffee' ],
              tasks: ['coffee']
            },
            uglify: {
	            files: [
	            	'assets/js/_*.js'
	            ],
	            tasks: [
	            	'uglify:dist'
	            ]
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-newer');

    // Default task(s).
    grunt.registerTask('default', [
        'coffee',
        'uglify:dist',
        'concat:dist',
        'sass',
        'watch'
      ]);
    grunt.registerTask( 'images', [ 'newer:imagemin'] );
};

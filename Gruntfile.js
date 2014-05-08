module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        rig: {
          coffee: {
            files: { 'assets/coffee/build/application.build.coffee': [ 'assets/coffee/application.coffee' ] },
          },
          js: {
            files: {
              'assets/js/build/application.build.js': [ 'assets/js/application.js' ],
              'assets/js/ie/build/application.build.js': [ 'assets/js/ie/application.js' ]
            },
          }
        },
        coffee: {
          compile: {
            files: {
              'assets/js/coffee.js': ['assets/coffee/build/application.build.coffee']
            }
          }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/min/scripts.min.js': [ 'assets/js/build/application.build.js'   ],
                    'assets/js/min/ie.min.js':      [ 'assets/js/ie/build/application.build.js' ]
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
                    'assets/css/screen.css': [ 'assets/sass/application.scss' ]
                }
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
            sass: {
                files: [ 'assets/sass/*.scss' ],
                tasks: [ 'sass' ]
            },
            coffee: {
              files: [ 'assets/coffee/*.coffee' ],
              tasks: ['rig:coffee', 'coffee']
            },
            uglify: {
	            files: [
	            	'assets/js/*.js'
	            ],
	            tasks: [
	            	'rig:js', 'uglify:dist'
	            ]
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-rigger');

    // Default task(s).
    grunt.registerTask('default', [
        'rig',
        'coffee',
        'uglify:dist',
        'sass',
        'watch'
      ]);
    grunt.registerTask( 'images', [ 'newer:imagemin'] );
};

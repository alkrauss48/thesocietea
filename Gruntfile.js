module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        coffee: {
          compile: {
            files: {
              'assets/js/_coffee.js': ['assets/coffee/*.coffee']
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
            src: ['assets/sass/*.scss', '!assets/sass/concat.scss'],
            dest: 'assets/sass/concat.scss'
          }
        },
        watch: {
            options: {
                livereload: true
            },
            concat: {
              files: ['assets/sass/*.scss', '!assets/sass/concat.scss'],
              tasks: [ 'concat:dist' ]
            },
            sass: {
                files: [ 'assets/sass/concat.scss' ],
                tasks: [ 'sass' ]
            },
            coffee: {
              files: [
                'assets/coffee/*.coffee'
              ],
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

    // Default task(s).
    grunt.registerTask('default', [
        'coffee',
        'uglify:dist',
        'concat:dist',
        'sass',
        'watch'
    ]);

};

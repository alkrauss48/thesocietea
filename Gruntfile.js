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
                    'assets/js/scripts.min.js': [
                        'assets/js/lib/*.js',
                        'assets/js/_*.js'
                    ],
                    'assets/js/ie.min.js': [
                        'assets/js/ie/*.js'
                    ]
                }
            },
            dev: {
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
                    compass: true,
                    sourcemap: false,
                    lineNumbers: true,
                    require: 'susy'
                },
                files: {
                    'assets/css/screen.css': [
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
                ]
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
	            	'uglify:dev'
	            ]
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-coffee');

    // Default task(s).
    grunt.registerTask('default', [
        'coffee',
        'uglify:dist',
        'sass',
        'watch'
    ]);

};

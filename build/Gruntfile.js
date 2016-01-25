module.exports = function(grunt) {
	var themePath = '../packages/concrete5_theme/themes/concrete5';

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		less: {
			production: {
				options: {
					yuicompress: true,
				},
				files: {
					'../packages/concrete5_theme/themes/concrete5/css/main.css': themePath + '/css/build/main.less'
				}
			}
		},
		uglify: {
			production: {
				files: [{
					expand: true,
					cwd: themePath + '/js/build',
					src: '**/*.js',
					dest: themePath + '/js'
				}]
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.registerTask('default', ['less:production','uglify:production']);


};

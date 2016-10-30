module.exports = function (grunt) {
    var pkg = grunt.file.readJSON('package.json');
    grunt.initConfig({
        concat: {
            options:{
                banner: '$(function(){\n',
                footer: '\n});'
            },
            dist: {
                // 元ファイルの指定
                src : './show/*.js',
                // 出力ファイルの指定
                dest: './show.js'
            }
        },

        uglify: {
            dist: {
                files: {
                    // 出力ファイル: 元ファイル
                    './show-min.js': './show.js'
                }
            }
        },

        watch: {
            js: {
                files: './show/*.js',
                tasks: ['concat', 'uglify']
            }
        }
    });

    // プラグインのロード・デフォルトタスクの登録
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['concat', 'uglify']);
};
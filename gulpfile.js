// Require Plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    sort = require('gulp-sort'),
    del = require('del');

// Configure Paths
var path = {
    sass: './assets/scss',
    images: './assets/images',
    js: './assets/js',
    font: './assets/fonts'
}

// Styles
gulp.task('styles', function() {
    return sass(path.sass + '/style.scss', {
        loadPath: [
                path.sass,
            ]
        })
        .on('error', sass.logError)
        .pipe(autoprefixer())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
});

// Clean
gulp.task('clean', function() {
  return del(['./style.css']);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('styles');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch(path.sass + '/**/*.scss', ['styles']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in assets/, reload on change
  gulp.watch(['./**']).on('change', livereload.changed);

});

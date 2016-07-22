// Require Plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    bower = require('gulp-bower'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
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
    font: './assets/fonts',
    bower: './assets/bower_components'
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

// Scripts
gulp.task('scripts', function() {
  return gulp.src([
      path.bower + '/foundation-sites/dist/plugins/**/*.js',
      path.bower + '/what-input/what-input.js'
    ])
    .pipe(concat(path.js + '/main.js'))
    .pipe(gulp.dest('./'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('./'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function() {
  return del(['./style.css', path.js + '/main.js', path.js + '/main.min.js']);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('bower', 'styles', 'scripts');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch(path.sass + '/**/*.scss', ['styles', 'scripts']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in assets/, reload on change
  gulp.watch(['./**']).on('change', livereload.changed);

});

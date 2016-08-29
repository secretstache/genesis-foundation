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
    sourcemaps = require('gulp-sourcemaps'),
    imagemin = require('gulp-imagemin'),
    changed = require('gulp-changed'),
    svgo = require('gulp-svgo'),
    svgstore = require('gulp-svgstore'),
    svgmin = require('gulp-svgmin'),
    path = require('path'),
    del = require('del');

// Config
var config = require('./config');

// Foundation Files Array
var f6Arr = config.f6.map(function(el) {
  return config.paths.bower + '/foundation-sites/js/foundation.' + el + '.js';
})

// Styles
gulp.task('styles', function() {
    return sass(config.css.src + '/style.scss', {
        loadPath: [
                config.css.src,
            ],
        defaultEncoding: 'UTF-8',
        sourcemap: true
        })
        .on('error', sass.logError)
        .pipe(sourcemaps.init())
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete', onLast: true }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src(f6Arr, [config.paths.bower + '/what-input/what-input.js'])
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(config.js.dest))
    .pipe(rename({ suffix: '.min' }))
    //.pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.js.dest))
    .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

// Images
gulp.task('images', function() {
  return gulp.src(config.images.src + '/**/*')
    .pipe(changed(config.images.dest)) // Ignore unchanged files
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest(config.images.dest))
    .pipe(notify({ message: 'Images task complete', onLast: true }));
});

// SVG
gulp.task('svg', function () {
    return gulp
        .src(config.images.svg + '/*.svg')
        .pipe(svgo())
        .pipe(gulp.dest(config.images.dest + '/svg'))
        .pipe(svgmin(function (file) {
            var prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore())
        .pipe(gulp.dest(config.images.dest + '/svg/combined'));
});

// Clean
gulp.task('clean', function() {
  return del([config.paths.dist]);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('styles', 'scripts', 'images', 'svg');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch([config.css.src + '/**/*.scss', config.paths.bower + '/foundation-sites/scss/**/*.scss' ], ['styles']);

  // Watch Images
  gulp.watch([config.images.src + '/**/*' ], ['images']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in assets/, reload on change
  gulp.watch(['./**']).on('change', livereload.changed);

});

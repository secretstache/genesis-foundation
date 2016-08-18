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

// Configure Paths
var paths = {
    dist: './assets/dist',
    sass: './assets/scss',
    images: './assets/images',
    js: './assets/js',
    font: './assets/fonts',
    bower: './assets/bower_components'
}

// CSS Paths
var css = {
    src: './assets/src/scss',
    dest: './assets/dist/css',
    autoprefixer: {
        'browsers': ['last 3 version']
    },
    sourcemaps: {
        'includeContent': false,
        'sourceRoot': 'source'
    }
}

// JS Paths
var js = {
    src: './assets/src/scripts',
    dest: './assets/dist/js'
}

// Image Paths
var images = {
    src: './assets/src/images',
    dest: './assets/dist/images',
    svg: './assets/src/svg'
}

// Styles
gulp.task('styles', function() {
    return sass(css.src + '/style.scss', {
        loadPath: [
                css.src,
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
  return gulp.src([
      paths.bower + '/foundation-sites/dist/foundation.js',
      paths.bower + '/what-input/what-input.js'
    ])
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(js.dest))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(js.dest))
    .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

// Images
gulp.task('images', function() {
  return gulp.src(images.src + '/**/*')
    .pipe(changed(images.dest)) // Ignore unchanged files
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest(images.dest))
    .pipe(notify({ message: 'Images task complete', onLast: true }));
});

// SVG
gulp.task('svg', function () {
    return gulp
        .src(images.svg + '/*.svg')
        .pipe(svgo())
        .pipe(gulp.dest(images.dest + '/svg'))
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
        .pipe(gulp.dest(images.dest + '/svg/combined'));
});

// Clean
gulp.task('clean', function() {
  return del([paths.dist]);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('styles', 'scripts', 'images', 'svg');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch([css.src + '/**/*.scss', paths.bower + '/foundation-sites/scss/**/*.scss' ], ['styles']);

  // Watch Images
  gulp.watch([images.src + '/**/*' ], ['images']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in assets/, reload on change
  gulp.watch(['./**']).on('change', livereload.changed);

});

// Include Gulp
var gulp = require('gulp');

// Include plugins
var uncss = require('gulp-uncss');
var rename = require('gulp-rename');
var minifyCss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var livereload = require('gulp-livereload');


// Uncss
gulp.task('uncss', function() {
    gulp.src('stylesheets/style.css')
        .pipe(uncss({
            html: ["http:\/\/localhost\/gulp-theme-dev\/2015\/10\/15\/hello-world\/","http:\/\/localhost\/gulp-theme-dev\/sample-page\/"],
            ignore: [
                // Lazysizes
                "lazyload",
                "lazyloading",
                "lazyloaded"
            ]
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('stylesheets'));
});

// Concat JS & Uglify
gulp.task('scripts', function() {
  gulp.src([
      /*
      JQuery will be included through functions.php,
      to reduce plugin conflicts.
      */
      'bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
      'bower_components/lazysizes/lazysizes.min.js',
      'bower_components/picturefill/dist/picturefill.min.js',
      'javascripts/scripts.js'
  ])
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('javascripts'));
});

// Watch
gulp.task('watch', function() {
    livereload.listen(35729);
    // Watch .php files
    // gulp.watch('**/*.php', ['theme']);
    gulp.watch('**/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });

    // Watch .js files
    //gulp.watch('javascripts/*.js', ['scripts']);

    // Watch .scss files
    // gulp.watch('stylesheets/*.scss', ['uncss']);
    gulp.watch('stylesheets/*.css').on('change', function(file) {
        livereload.changed(file.path);
    });


    // Watch image files
    gulp.watch('images/**/*', ['images']);
 });

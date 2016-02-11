// Include Gulp
var gulp = require('gulp');

// Include plugins
var uncss = require('gulp-uncss');
var rename = require('gulp-rename');
var cssnano = require('gulp-cssnano');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var livereload = require('gulp-livereload');
var shell = require('gulp-shell');

// Generate Sitemap JSON
gulp.task('sitemap', shell.task(['curl --silent --output sitemap.json http://localhost/current-obsession.com/\?show_sitemap']));

// Uncss
gulp.task('uncss', function() {
    gulp.src('stylesheets/style.css')
        .pipe(uncss({
            // html: ["http://www.neti.ee"],
            html: JSON.parse(require('fs').readFileSync('sitemap.json', 'utf-8')),
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
        .pipe(cssnano())
        .pipe(gulp.dest('stylesheets'));
});

// Concat JS & Uglify
gulp.task('scripts', function() {
  gulp.src([
      /**
      * JQuery will be included through functions.php, to reduce plugin conflicts.
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

 // Build
 gulp.task('build', ['sitemap', 'uncss', 'scripts'], function (){
   console.log('Building files');
 })

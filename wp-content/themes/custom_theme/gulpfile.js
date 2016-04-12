// grab our packages
var gulp       = require('gulp');
var sass       = require('gulp-sass');
var rename     = require('gulp-rename');

// default task
gulp.task('default', ['sass:watch']);

// Global styles
gulp.task('sass', function () {
  return gulp.src('sass/import.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('layout.css'))
    .pipe(gulp.dest('styles'));
});

// Watcher
gulp.task('sass:watch', function () {
  gulp.watch('sass/**/*.scss', ['sass']);
});
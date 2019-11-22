var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
var cleanCSS = require('gulp-clean-css');
var autoprefix = require('gulp-autoprefixer');
var browserSync = require('browser-sync');
var plumber = require('gulp-plumber');

browserSync.create();

const projectURL = 'http://valet.test';
const themeURL = 'web/app/themes/frogspark/';

gulp.task('js', () => {
  return gulp.src(`${themeURL}js/src/*.js`)
    .pipe(concat('bundle.min.js'))
    .pipe(sourcemaps.init())
    .pipe(sourcemaps.write())
    .pipe(uglify())
    .pipe(rename('bundle.min.js'))
    .pipe(gulp.dest(`${themeURL}js/dist`));
});

gulp.task('sass', () => {
  const onError = (err) => {
    notify({
      title: 'Gulp Task Error',
      message: 'Gulp Task errored, check console',
    }).write(err);
    console.log(err.toString());
  };

  return gulp.src(`${themeURL}scss/src/styles.scss`)
    .pipe(concat('bundle.min.scss'))
    .pipe(sourcemaps.init())
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sass())
    .pipe(sourcemaps.write())
    .pipe(cleanCSS())
    .pipe(rename('bundle.min.css'))
    .pipe(gulp.dest(`${themeURL}scss/dist`))
    .pipe(browserSync.stream());
});

gulp.task('font', () => {
  return gulp.src('node_modules/@fortawesome/fontawesome-pro/webfonts/*')
    .pipe(gulp.dest(`${themeURL}scss/webfonts`));
});

gulp.task('browserSync', () => {
  browserSync.init({
    proxy: projectURL,
  });
});

gulp.task('sass:watch', () => {
  gulp.watch(`${themeURL}scss/src/**/*.scss`, ['sass']);
  gulp.watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
});

gulp.task('js:watch', () => {
  gulp.watch(`${themeURL}js/src/*.js`, ['js']);
  gulp.watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
  gulp.watch(`${themeURL}**/*.js`).on('change', browserSync.reload);
});

gulp.task('development', ['font', 'browserSync', 'sass:watch', 'js:watch']);

gulp.task('production', ['font', 'sass', 'js']);

gulp.task('default', ['development']);
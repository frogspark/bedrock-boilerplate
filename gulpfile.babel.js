import gulp from 'gulp';
import sass from 'gulp-sass';
import concat from 'gulp-concat';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';
import notify from 'gulp-notify';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import babel from 'gulp-babel';
import gulpif from 'gulp-if';
import browserify from 'gulp-browserify';
import autoprefix from 'gulp-autoprefixer';
import browserSync from 'browser-sync';
import plumber from 'gulp-plumber';

browserSync.create();

const autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR'],
};

// By default assume that the environment is production
const ENVIRONMENT = process.env.NODE_ENV || 'production';
const projectURL = 'http://head-high:4234';
const themeURL = 'web/app/themes/frogspark/';


gulp.task('js', () => {
  return gulp.src(`${themeURL}js/src/*.js`)
    .pipe(browserify({
      insertGlobals: true,
    }))
    .pipe(concat('bundle.min.js'))
    .pipe(gulpif(ENVIRONMENT, sourcemaps.init()))
    .pipe(babel())
    .pipe(gulpif(ENVIRONMENT, sourcemaps.write()))
    .pipe(gulpif(!ENVIRONMENT, uglify()))
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
    .pipe(gulpif(ENVIRONMENT, sourcemaps.init()))
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sass())
    .pipe(gulpif(ENVIRONMENT, sourcemaps.write()))
    .pipe(autoprefix(autoprefixerOptions))
    .pipe(gulpif(!ENVIRONMENT, cleanCSS()))
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

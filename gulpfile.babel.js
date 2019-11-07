import sass from 'gulp-sass';
import concat from 'gulp-concat';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';
import notify from 'gulp-notify';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import babel from 'gulp-babel';
import gulpif from 'gulp-if';
// import browserify from 'gulp-browserify';
import browserify from 'gulp-bro';
import autoprefix from 'gulp-autoprefixer';
import browserSync from 'browser-sync';
import plumber from 'gulp-plumber';
import gulp from 'gulp';

const {series} = require('gulp');
browserSync.create();

const autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR'],
};

const ENVIRONMENT = process.env.NODE_ENV || 'production';
const projectURL = '';
const themeURL = 'web/app/themes/frogspark/';

function js() {
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
}
function sassfn() {
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
    .pipe(cleanCSS())
    .pipe(rename('bundle.min.css'))
    .pipe(gulp.dest(`${themeURL}scss/dist`))
    .pipe(browserSync.stream());
}

function font() {
  return gulp.src('node_modules/@fortawesome/fontawesome-pro/webfonts/*')
    .pipe(gulp.dest(`${themeURL}scss/webfonts`));
}

function browsersync() {
  browserSync.init({
    proxy: projectURL,
  });

  gulp.watch(`${themeURL}scss/src/**/*.scss`, sassfn);
  gulp.watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
  gulp.watch(`${themeURL}js/src/*.js`, js);
  gulp.watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
  gulp.watch(`${themeURL}**/*.js`).on('change', browserSync.reload);
}

const development = series(font, sassfn, js, browsersync);
const production = series(font, sassfn, js);

exports.production = production;
exports.default = development;
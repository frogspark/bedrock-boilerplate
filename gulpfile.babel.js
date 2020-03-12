const {series, parallel, src, dest, watch} = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const notify = require('gulp-notify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const browserify = require('gulp-browserify');
const browserSync = require('browser-sync');
const plumber = require('gulp-plumber');

browserSync.create();

const projectURL = 'http://blank.test';
const themeURL = 'web/app/themes/frogspark/';

function js() {
  return src(`${themeURL}js/src/Global.js`)
    .pipe(browserify({
      insertGlobals: true,
    }))
    .pipe(concat('bundle.min.js'))
    .pipe(sourcemaps.init())
    .pipe(sourcemaps.write())
    // .pipe(uglify())
    // .pipe(rename('bundle.min.js'))
    .pipe(dest(`${themeURL}js/dist`));
}
function sassfn() {
  const onError = (err) => {
    notify({
      title: 'Gulp Task Error',
      message: 'Gulp Task errored, check console',
    }).write(err);
    console.log(err.toString());
  };

  return src(`${themeURL}scss/src/styles.scss`)
    .pipe(concat('bundle.min.scss'))
    .pipe(sourcemaps.init())
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sass())
    .pipe(sourcemaps.write())
    .pipe(cleanCSS())
    .pipe(rename('bundle.min.css'))
    .pipe(dest(`${themeURL}scss/dist`))
    .pipe(browserSync.stream());
}

function font() {
  return src('node_modules/@fortawesome/fontawesome-pro/webfonts/*')
         .pipe(dest(`${themeURL}scss/webfonts`));
}

function browsersync() {
  browserSync.init({
    proxy: projectURL,
  });

  watch(`${themeURL}scss/src/**/*.scss`, sassfn);
  watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
  watch(`${themeURL}js/src/*.js`, js);
  watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
  watch(`${themeURL}**/*.js`).on('change', browserSync.reload);
}

const development = series(font, sassfn, js, browsersync);
const production = parallel(font, sassfn, js);

exports.production = production;
exports.default = development;
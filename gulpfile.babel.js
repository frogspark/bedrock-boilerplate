const {series, parallel, src, dest, watch} = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const notify = require('gulp-notify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync');
const plumber = require('gulp-plumber');

browserSync.create();

const projectURL = 'http://blank.test';
const themeURL = 'web/app/themes/frogspark/';

function js() {
  const onError = (err) => {
    notify({
      title: "Gulp JavaScript Error",
      message: "JavaScript compilation task failed, check the console!"
    }).write(err);
    console.log(err.toString());
  };

  browserSync.notify('Compiling JavaScript');

  return src(`${themeURL}js/src/Global.js`)
    .pipe(babel())
    .pipe(concat('bundle.min.js'))
    .pipe(sourcemaps.init())
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.write())
    .pipe(uglify())
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

  browserSync.notify('Compiling SCSS');

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
  watch(`${themeURL}js/src/*.js`, js);
  watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
}

const development = series(font, sassfn, js, browsersync);
const production = parallel(font, sassfn, js);

exports.production = production;
exports.default = development;
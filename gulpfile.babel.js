const {series, parallel, src, dest, watch} = require('gulp');
const gulp = require('gulp');
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
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const babelify = require('babelify');
const browserify = require('browserify');
const through = require('through2');
const globby = require('globby');
const log = require('gulplog');

browserSync.create();

const projectURL = 'http://calumboilerplate.test';
const themeURL = 'web/app/themes/frogspark/';

let javascript = () => {
  var bundledStream = through();

  bundledStream
    .pipe(source(`bundle.min.js`))
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps:true }))
      .pipe(uglify())
      .on('error', log.error)
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(`${themeURL}js/dist/`))

  globby([`${themeURL}js/src/Global.js`]).then((entries) => {
    let b = browserify({
      entries: entries, 
      debug: true, 
      insertGlobals: true
    }).transform("babelify", {
      presets: ["@babel/preset-env"]
    });

    b.bundle().pipe(bundledStream);
  }).catch((err) => {
    bundledStream.emit('error', err);
  });

  return bundledStream;
}

function styles() {
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

function fonts() {
  return src('node_modules/@fortawesome/fontawesome-pro/webfonts/*')
         .pipe(dest(`${themeURL}scss/webfonts`));
}

function browsersync() {
  browserSync.init({
    proxy: projectURL,
  });

  watch(`${themeURL}scss/src/**/*.scss`, styles);
  watch(`${themeURL}js/src/*.js`, javascript);
  watch(`${themeURL}**/*.php`).on('change', browserSync.reload);
}

const development = series(fonts, styles, javascript, browsersync);
const production = parallel(fonts, styles, javascript);

exports.production = production;
exports.default = development;

/* function js() {
  const onError = (err) => {
    notify({
      title: "Gulp JavaScript Error",
      message: "JavaScript compilation task failed, check the console!"
    }).write(err);
    console.log(err.toString());
  };

  const bundler = browserify({
    entries: `${themeURL}js/src/Global.js`, 
    debug: true, 
    insertGlobals: true, 
  }).transform(babelify.configure({ presets: ['@babel/preset-env'] }));
  
  return bundler.bundle()
    .pipe(source(`${themeURL}js/src/Global.js`))
    .pipe(buffer())
    .pipe(concat('bundle.min.js'))
    .pipe(babel())
    .pipe(sourcemaps.init({loadMaps: true}))
      .pipe(uglify())
      .pipe(plumber({ errorHandler : onError }))
    .pipe(sourcemaps.write())
    .pipe(dest(`${themeURL}js/dist/`));
} */
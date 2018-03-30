var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    gutil = require('gulp-util'),
    rimraf = require('gulp-rimraf');

gulp.task('get_select2',function() {
  return gulp.src('bower_components/select2/src/scss/core.scss',  { style: 'nested' })
        .on('error', sass.logError)
        .pipe(autoprefixer('last 2 version'))   
        .pipe(minifycss())    
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('css'));
});

gulp.task('remove-style', function() {
  return gulp.src('css/style.css', { read: false })
    .pipe(rimraf({ force: true }));
});

gulp.task('remove-styles',['remove-style'], function() {
  return gulp.src('css/*.min.css', { read: false })
    .pipe(rimraf({ force: true }));
});

gulp.task('bbpress-styles',['remove-styles'], function() {
  return sass('css/scss/bbpress.scss', { style: 'nested' })
    .on('error', sass.logError)
    .pipe(autoprefixer('last 2 version'))    
    .pipe(minifycss())    
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'WPLMS Styles task complete' }));
});

gulp.task('woocommerce-styles',['bbpress-styles'], function() {
  return sass('css/scss/woocommerce.scss', { style: 'nested' })
    .on('error', sass.logError)
    .pipe(autoprefixer('last 2 version'))    
    .pipe(minifycss())    
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'WPLMS Styles task complete' }));
});

gulp.task('elegant-styles',['woocommerce-styles'], function() {
  return sass('css/scss/skins/elegant.scss', { style: 'nested' })
    .on('error', sass.logError)
    .pipe(autoprefixer('last 2 version'))    
    .pipe(minifycss())    
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'WPLMS Elegant Styles task complete' }));
});

gulp.task('minimal-styles',['elegant-styles'], function() {
  return sass('css/scss/skins/minimal.scss', { style: 'nested' })
    .on('error', sass.logError)
    .pipe(autoprefixer('last 2 version'))    
    .pipe(minifycss())    
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'WPLMS Minimal Styles task complete' }));
});

gulp.task('front-styles',['minimal-styles'], function() {
  return sass('css/scss/style.scss', { style: 'nested' })
    .on('error', sass.logError)
    .pipe(autoprefixer('last 2 version'))    
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'WPLMS Styles task complete' }));
});

gulp.task('styles',['front-styles'], function() {
  return gulp.src(['css/old_files/animate.css',
    'css/old_files/fonticons.css',
    'css/style.css'])    
    .pipe(concat('style.css'))
    .pipe(minifycss())    
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'Concatenation task complete' }));
});

gulp.task('remove-scripts', function() {
  return gulp.src('js/*.min.js', { read: false })
    .pipe(rimraf({ force: true }));
});

gulp.task('scripts',['remove-scripts'], function() {
  return gulp.src(['bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    'bower_components/flexslider/jquery.flexslider.js',
    'bower_components/jquery.fitvids/jquery.fitvids.js',
    'bower_components/flexmenu/flexmenu.js',
    'bower_components/js-cookie/src/js.cookie.js',
    'bower_components/magnific-popup/dist/jquery.magnific-popup.js',
    'bower_components/select2/dist/js/select2.full.js','js/*.js'])
    .pipe(uglify().on('error', gutil.log))
    .pipe(concat('wplms.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify().on('error', gutil.log))
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'WPLMS Scripts task complete' }));
});


gulp.task('front', ['styles','scripts']);
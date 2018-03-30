var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var merge = require('merge-stream');
var concat = require('gulp-concat');
var del = require('del');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

gulp.task('default', ['main-css', 'buddypress-css', 'assets-css', 'backend-css', 'clean:ds_stores', 'compress', 'dashboard-js']);

// Style.css
gulp.task('main-css', function () {
    return gulp.src('./scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({ advanced : true }))
        .pipe(gulp.dest('./'));
});

// Buddypress.css
gulp.task('buddypress-css', function () {
    return gulp.src('./css/buddypress.css')
        .pipe(cleanCSS({ advanced : true }))
        .pipe(gulp.dest('./css/'));
});

// Assets.css
gulp.task('assets-css', function () {

    // Bootstrap
    var scssStream = gulp.src(['./scss/assets.scss'])
    .pipe(sass({
            outputStyle: 'nested',
            precison: 3,
            includePaths: [
                './../node_modules/bootstrap-sass/assets/stylesheets',
                './../node_modules/font-awesome/scss'
            ]
        }))
        .pipe(cleanCSS({ advanced : true }))
        .pipe(concat('scss-asssets.scss'));

    // Animate CSS & Bootstrap
    var cssStream = gulp.src([
        './../node_modules/animate.css/animate.min.css',
        './css/buddypress.css'
    ])
    .pipe(concat('css-asssets.css'));

    var mergedStream = merge(scssStream, cssStream)
        .pipe(concat('assets.min.css'))
        .pipe(gulp.dest('./css'));

    return mergedStream;

});

// Backend.css
gulp.task('backend-css', function () {

    return gulp.src(['./scss/backend.scss'])
        .pipe(sass())
        .pipe(cleanCSS({ advanced : true }))
        .pipe(concat('backend.min.css'))
        .pipe(gulp.dest('./css'));

});

// Removing all ds_stores files
gulp.task('clean:ds_stores', function () {
    return del([
        '.DS_store',
        '*/.DS_store',
        '*/**/.DS_store'
    ]);
});

// Scripts.js
gulp.task('compress', function () {
    // returns a Node.js stream, but no handling of error messages
    return gulp.src(['js/scripts.js','js/plugins.js'])
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('js/'));
});

// Dashboard.js
gulp.task('dashboard-js', function () {
    // returns a Node.js stream, but no handling of error messages
    return gulp.src([
            './../node_modules/draggabilly/dist/draggabilly.pkgd.min.js',
            './../node_modules/packery/dist/packery.pkgd.min.js'
        ])
        .pipe(uglify())
        .pipe(concat('dashboard.min.js'))
        .pipe(gulp.dest('js/'));
});


gulp.task('watch', function () {
    gulp.watch('./scss/**/*.scss', ['main-css'] );
});
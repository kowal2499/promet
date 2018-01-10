    // include necessary modules
    
    var gulp = require('gulp'),
        browserSync = require('browser-sync'),
        sass = require('gulp-sass');

    // configure browserSync
    gulp.task('browser-sync', function() {
        var files = [
            './style.css',
            './*.php'
        ];

        browserSync.init(files, {
            proxy: "http://promet.local/"
        })
    });

    // configure sass task
    gulp.task('sass', function() {
        return gulp.src('sass/*.scss')
            .pipe(sass({
                'outputStyle': 'compressed'
            }))
            .pipe(gulp.dest('./'))
            .pipe(browserSync.stream());
    });

    // create the default task
    gulp.task('default', ['sass', 'browser-sync'], function() {
        gulp.watch("sass/**/*.scss", ['sass'])
    });
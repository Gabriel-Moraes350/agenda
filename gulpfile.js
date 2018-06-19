const gulp = require('gulp');
const minify = require('gulp-minify');
var concat = require('gulp-concat');

var jsFiles = 'public/js/controller/*.js',
    jsDest = 'public/js/controller/min/';
 
gulp.task('compress', function() {
	gulp.src(jsFiles)
    .pipe(minify({
        ext:{
            min:'.min.js'
        },
        noSource:true ,
    }))
    .pipe(gulp.dest(jsDest))
});

gulp.task('compress-css', function() {
	gulp.src('public/css/*.css')
    .pipe(minify({
        ext:{
            min:'.min.css'
        },
        noSource:true ,
    }))
    .pipe(gulp.dest('public/css/min/'))
});
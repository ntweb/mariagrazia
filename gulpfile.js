var gulp = require('gulp');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var order = require("gulp-order");

// create task
gulp.task('min-css', function(){
    gulp.src('public/css/**/*.css')
        .pipe(cleanCSS())
        .pipe(concat('style.min.css'))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(gulp.dest('public/minify/'))
});

gulp.task('min-js', function () {
   	gulp.src([
	    	"public/js/jquery-1.12.4.js",
	    	"public/js/bootstrap.js",
	    	"public/js/geocomplete/jquery.geocomplete.min.js",
	    	"public/js/alertify/alertify.min.js",
	    	"public/js/_site_library.js",
	    	"public/js/_site_cart.js"
	  	])
      	.pipe(uglify())
      	.pipe(concat('code.min.js'))
      	.pipe(gulp.dest('public/minify/'))
});
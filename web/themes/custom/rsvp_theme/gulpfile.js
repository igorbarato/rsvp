'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
 
sass.compiler = require('node-sass');
 
gulp.task('sass', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass())
    .on('error', console.log.bind(console))
    .pipe(cleanCSS())
    .on('error',console.log.bind(console))
    .pipe(concat('style.css'))
    .on('error',console.log.bind(console))
    .pipe(gulp.dest('./css'))
    .on('error',console.log.bind(console));
});
 
gulp.task('sass:watch', function () {
  gulp.watch('./scss/**/*.scss', ['sass']);
});
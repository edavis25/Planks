var gulp = require('gulp');
var sass = require('gulp-sass');

// Compile SASS
gulp.task('sass', function() {
    return gulp.src('resources/assets/sass/main.scss')
               .pipe(sass())
               .pipe(gulp.dest('public/css'));
});

// Watch changes
gulp.task('watch', function() {
    gulp.watch('resources/assets/sass/*.scss', ['sass']);
    gulp.watch('resources/assets/sass/*/*.scss', ['sass']);
});

// Default task
gulp.task('default', ['sass']);

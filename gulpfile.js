const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
//js compile
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const rename = require("gulp-rename");

function compileSass() {
  return gulp
    .src("stylesheets/scss/**/*.scss") // Path to your SCSS files
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("stylesheets/css")); // Output directory for CSS files
}

function compileJS() {
  return gulp
    .src(["js/**/*.js", "!js/**/*.min.js"])
    .pipe(
      babel({
        presets: ["@babel/preset-env"],
      })
    )
    .pipe(uglify())
    .pipe(
      rename(function (path) {
        path.basename = path.basename.replace(/(\.min)?$/, ".min");
      })
    )
    .pipe(gulp.dest("js")); // Output directory for JS files
}

function watchSass() {
  gulp.watch("stylesheets/scss/**/*.scss", compileSass);
  gulp.watch("js/**/*.js", compileJS);
}

gulp.task("js", compileJS);
gulp.task("watch", watchSass);
gulp.task("sass", compileSass);
gulp.task("default", gulp.series(compileSass, compileJS,))

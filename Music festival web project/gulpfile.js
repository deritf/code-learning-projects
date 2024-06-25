import { src, dest, watch, series } from "gulp";
import * as dartSass from "sass";
import gulpSass from "gulp-sass";

const sass = gulpSass(dartSass);

/* Esta función lo que hará es coger una copia del archivo app.js y llevarla a la carpeta build para poderla agregar.*/
export function js(done) {
  src("src/js/app.js").pipe(dest("build/js"));

  done();
}

export function css(done) {
  src("src/scss/app.scss", { sourcemaps: true })
    .pipe(sass().on("error", sass.logError))
    .pipe(dest("build/css", { sourcemaps: "." }));
  done();
}

export function dev(done) {
  watch("src/scss/**/*.scss", css);
  watch("src/js/**/*.js", js);
  done();
}

export default series(js, css, dev);

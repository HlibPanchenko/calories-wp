// import del from 'del';
import browserSync from "browser-sync";
import named from 'vinyl-named';
import webpack from 'webpack-stream';
import {deleteAsync}  from "del";
import imagemin from 'gulp-imagemin';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import gulp from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';


const PRODUCTION = process.argv.includes('--prod') ? process.argv.includes('--prod') : false;

const server = browserSync.create();
export const serve = done => {
    server.init({
        proxy: "http://wp-calories.loc/"
        // server: {
        //     baseDir: "http://wp-calories.loc/"
        // }
    });
    done();
};
export const reload = done => {
    server.reload();
    done();
};

// delete folder dist
export const clean = () => {
    // return del(['dist']);
    return deleteAsync(['dist']);
}

export const styles = () => {
    // return gulp.src(['assets/scss/bundle.scss', 'assets/scss/admin.scss', 'assets/scss/libs/**/*.{css, scss}'])
    return gulp.src(['assets/scss/bundle.scss', 'assets/scss/admin.scss'])
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
        .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(gulp.dest('dist/css'));

}

export const libStyles = () => {
    return gulp.src('assets/scss/libs/**/*.{css, scss}')
        .pipe(gulp.dest('dist/css/libs'));
};


export const images = () => {
    return gulp.src('assets/images/**/*.{jpg,jpeg,png,svg,gif,webp}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(gulp.dest('dist/images'));
}

export const copy = () => {
    return gulp.src(['assets/**/*','!assets/{images,js,scss}','!assets/{images,js,scss}/**/*'])
        .pipe(gulp.dest('dist'));
}


export const scripts = () => {
    return gulp.src(['assets/js/bundle.js','assets/js/admin.js'])
        .pipe(named())
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: []
                            }
                        }
                    }
                ]
            },
            mode: PRODUCTION ? 'production' : 'development',
            devtool: !PRODUCTION ? 'inline-source-map' : false,
            output: {
                filename: '[name].js'
            },
            externals: {
                jquery: 'jQuery'
            },
        }))
        .pipe(gulp.dest('dist/js'));
}

export const libScripts = () => {
    return gulp.src(['assets/js/libs/**/*.js'])
        .pipe(gulp.dest('dist/js/libs'));
};

/*в терминал пишем  gulp watchForChanges - постоянно отслеживать изменения в этих директориях, будет запускать сам команды.*/
export const watchForChanges = () => {
    gulp.watch('assets/scss/**/*.scss', styles);
    gulp.watch('assets/images/**/*.{jpg,jpeg,png,svg,gif}', images);
    gulp.watch(['assets/**/*','!assets/{images,js,scss}','!assets/{images,js,scss}/**/*'], copy);
    // gulp.watch('assets/js/**/*.js', scripts);
    gulp.watch(['assets/js/**/*.js', '!assets/js/libs/**/*.{js}'], scripts);
    gulp.watch("**/*.php", reload);
}

export const dev =  gulp.series(clean, gulp.parallel(styles, images, copy, scripts, libStyles, libScripts), serve, watchForChanges);
export const build = gulp.series(clean, gulp.parallel(styles, images, copy, scripts, libStyles, libScripts));
export default dev;

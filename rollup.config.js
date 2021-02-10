import babel from 'rollup-plugin-babel';
import filesize from 'rollup-plugin-filesize';
import resolve from 'rollup-plugin-node-resolve';
import replace from '@rollup/plugin-replace';
import commonjs from 'rollup-plugin-commonjs';
import { terser } from "rollup-plugin-terser";

import pkg from './package.json';

export default {
    input: 'src/index.js',
    output: {
        name: 'BladeXLoader',
        file: "C:\\Laragon\\www\\blade-x-loader-v2-demo\\public\\vendor\\makhweb\\blade-x-loader\\js\\app.js",
        // file: 'dist/blade-x-engine.js',
        format: 'iife',
    },
    plugins: [
        replace({
            "process.env.NODE_ENV": "'production'",
            "process.env.PKG_VERSION": `"${pkg.version}"`
        }),
        resolve(),
        filesize(),
        babel({
            exclude: 'node_modules/**', 
            plugins: ["@babel/plugin-proposal-class-properties", "@babel/plugin-transform-classes"]
        }),
        commonjs({
            include: 'node_modules/**', // Default: undefined
        }),
        terser()
    ]
}

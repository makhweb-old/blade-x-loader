import babel from 'rollup-plugin-babel';
import filesize from 'rollup-plugin-filesize';
import resolve from 'rollup-plugin-node-resolve';
import replace from '@rollup/plugin-replace';
import commonjs from 'rollup-plugin-commonjs';
import { terser } from "rollup-plugin-terser";

import path from 'path';

import pkg from './package.json';

export default {
    input: 'resources/js/index.js',
    output: {
        name: 'BladeXLoader',
        file: path.resolve('publishable', 'js', 'app.js'),
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

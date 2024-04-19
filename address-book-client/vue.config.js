// const path = require(`path`);

// module.exports = {
//     configureWebpack: {
//         resolve: {
//             symlinks: false,
//             alias: {
//                 vue: path.resolve(`./node_modules/vue`)
//             }
//         }
//     }
// };

export const devServer = {
    proxy: {
        '/api': {
            target: 'http://localhost:8000', // Replace with your backend API URL
            changeOrigin: true,
            pathRewrite: { '^/api': '' },
        },
    },
};
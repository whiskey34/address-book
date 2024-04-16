export const devServer = {
    proxy: {
        '/api': {
            target: 'http://localhost:8000', // Replace with your backend API URL
            changeOrigin: true,
            pathRewrite: { '^/api': '' },
        },
    },
};
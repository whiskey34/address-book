const { startDevServer } = require('@cypress/vite-dev-server');

module.exports = (on, config) => {
  on('dev-server:start', (options) => startDevServer({ options, viteConfig: { server: { open: false }}}));
  return config;
}

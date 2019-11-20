
module.exports = {
  devServer: {
    port: 9000,
    proxy: {
      '^/api': {
        target: 'http://localhost:8080/friends/backend/'
      },
      '^/uploads': {
        target: 'http://localhost:8080/friends/backend/'
      }
    },

  }
}

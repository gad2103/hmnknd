module.exports = {
  'page title is correct you fucking nigger': function(test) {
    test
    .open('http://timber-test.dev/wp-admin/')
    .assert.title().is('Google', 'It has title')
    .done();
  }
};

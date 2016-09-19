var q = require('q');

module.exports = {

  doubleSay: function (sayWhat) {
    return sayWhat + ', ' + sayWhat;
  },

  capitalize: function (text) {
    return text[0].toUpperCase() + text.substring(1);
  },

  exclaim: function (text) {
    return text + '!';
  },

  capitalizeAsync: function (text) {
    var deferred = q.defer();
    deferred.resolve(text[0].toUpperCase() + text.substring(1));
    return deferred.promise;
  },

  doubleSayAsync: function (sayWhat) {
    var deferred = q.defer();
    deferred.resolve(sayWhat + ', ' + sayWhat);
    return deferred.promise;
  },

  exclaimAsync: function (text) {
    var deferred = q.defer();
    deferred.resolve(text + '!');
    return deferred.promise;
  }
};
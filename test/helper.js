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
    return new Promise(function (resolve) {
      return resolve(text[0].toUpperCase() + text.substring(1))
    });
  },

  doubleSayAsync: function (sayWhat) {
    return new Promise(function (resolve) {
      return resolve(sayWhat + ', ' + sayWhat);
    });
  },

  exclaimAsync: function (text) {
    return new Promise(function (resolve) {
      return resolve(text + '!');
    });
  }
};
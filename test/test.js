"use strict";

var assert = require('assert');
var Pipeline = require('../');
var helpers = require('./helper');

describe('pipeline', function () {

  // Helpers for normal testing
  var doubleSay = helpers.doubleSay,
    capitalize = helpers.capitalize,
    exclaim = helpers.exclaim;

  // Helpers for async testing
  var doubleSayAsync = helpers.doubleSayAsync,
    capitalizeAsync = helpers.capitalizeAsync,
    exclaimAsync = helpers.exclaimAsync;

  it('can process pipelines created using pipe', function (done) {

    var excited = new Pipeline();

    excited.pipe(doubleSay)
      .pipe(capitalize)
      .pipe(exclaim);

    assert.equal(excited.process('hello'), 'Hello, hello!');

    done();
  });

  it('can process pipelines passed using constructor', function (done) {

    var excited = new Pipeline([
      doubleSay,
      capitalize,
      exclaim
    ]);

    assert.equal(excited.process('hello'), 'Hello, hello!');

    done();
  });

  it('can reuse pipelines', function (done) {

    var excited = new Pipeline();

    excited.pipe(doubleSay)
      .pipe(capitalize)
      .pipe(exclaim);

    assert.equal(excited.process('hello'), 'Hello, hello!');
    assert.equal(excited.process('world'), 'World, world!');
    assert.equal(excited.process('it works'), 'It works, it works!');

    done();
  });

  it('can process any pipelines with all stages returning promises', function (done) {
    var excited = new Pipeline([
      doubleSayAsync,
      capitalizeAsync,
      exclaimAsync
    ]);

    excited.process('hello')
      .then(function (value) {
        assert.equal(value, 'Hello, hello!');
      })
      .catch(function (error) {
      });

    done();
  });


  it('can process any pipelines with some stages returning promises and some not', function (done) {
    var excited = new Pipeline([
      doubleSayAsync,
      capitalize,
      exclaim
    ]);

    excited.process('hello')
      .then(function (value) {
        assert.equal(value, 'Hello, hello!');
      })
      .catch(function (error) {
      });

    done();
  });

  it('calls preStage function before stage runs', function () {
    var excited = new Pipeline([doubleSay, capitalize]);

    let testCounter = 0;

    excited.setPreStageFunction(function (stageOutput, stage, counter) {
      testCounter++;
      switch (counter) {
        case 0:
          {
            assert.equal(stageOutput, 'hello');
            assert.equal(counter, 0);
          }
          break;
        case 1:
          {
            assert.equal(stageOutput, 'hello, hello');
            assert.equal(counter, 1);
          }
          break;
      }
    });

    assert.equal(excited.process('hello'), 'Hello, hello');
    assert.equal(testCounter, 2);
  });

  it('calls preStage function after previous stage promise resolves', function (done) {
    var excited = new Pipeline([doubleSayAsync, capitalizeAsync]);

    let testCounter = 0;

    excited.setPreStageFunction(function (stageOutput, stage, counter) {
      testCounter++;
      switch (counter) {
        case 0:
          {
            assert.equal(stageOutput, 'hello');
            assert.equal(counter, 0);
          }
          break;
        case 1:
          {
            assert.equal(stageOutput, 'hello, hello');
            assert.equal(counter, 1);
          }
          break;
      }
    });

    excited
      .process('hello')
      .then((result) => {
        assert.equal(result, 'Hello, hello');
        assert.equal(testCounter, 2);
        done();
      })
      .catch(console.error);
  });

});

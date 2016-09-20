'use strict';

/**
 * Creates a new pipeline. Optionally pass an array of stages
 *
 * @param presetStages[]
 * @constructor
 */
function Pipeline(presetStages) {

  var stages = presetStages || [],
    stageOutput;

  /**
   * Adds a new stage. Stage can be a function or some literal value. In case
   * of literal values. That specified value will be passed to the next stage and the
   * output from last stage gets ignored
   *
   * @param stage
   * @returns {Pipeline}
   */
  this.pipe = function (stage) {
    stages.push(stage);

    return this;
  };

  /**
   * Processes the pipeline with passed arguments
   *
   * @param args
   * @returns {*}
   */
  this.process = function (args) {

    if (stages.length === 0) {
      return args;
    }

    // Set the stageOutput to be args
    // as there is no output to start with
    stageOutput = args;

    stages.forEach(function (stage, counter) {

      // Output from the last stage was promise
      if (stageOutput && typeof stageOutput.then === 'function') {
        // Call the next stage only when the promise is fulfilled
        stageOutput = stageOutput.then(stage);
      } else {

        // Otherwise, call the next stage with the last stage output
        if (typeof stage === 'function') {
          stageOutput = stage(stageOutput);
        } else {
          stageOutput = stage;
        }
      }

    });

    return stageOutput;
  };
}

module.exports = Pipeline;

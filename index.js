"use strict";

/**
 * Creates a new pipeline. Optionally pass an array of stages
 *
 * @param presetStages[]
 * @constructor
 */
function Pipeline(presetStages) {
  // Stages for the pipeline, either received through
  // the constructor or the pipe method in prototype
  this.stages = presetStages || [];
}

/**
 * Adds a new stage. Stage can be a function or some literal value. In case
 * of literal values. That specified value will be passed to the next stage and the
 * output from last stage gets ignored
 *
 * @param stage
 * @returns {Pipeline}
 */
Pipeline.prototype.pipe = function (stage) {
  this.stages.push(stage);

  return this;
};

/**
 * Processes the pipeline with passed arguments
 *
 * @param args
 * @returns {*}
 */
Pipeline.prototype.process = function (args) {
  // Output is same as the passed args, if
  // there are no stages in the pipeline
  if (this.stages.length === 0) {
    return args;
  }

  // Set the stageOutput to be args
  // as there is no output to start with
  var stageOutput = args;

  this.stages.forEach((stage, counter) => {
    // Output from the last stage was promise
    if (stageOutput && typeof stageOutput.then === "function") {
      // Call the next stage only when the promise is fulfilled
      stageOutput = stageOutput
        .then((stageOutput) => {
          // If a preStage function was set, run it
          if (this._preStageFunction)
            this._preStageFunction(stageOutput, stage, counter);

          return stageOutput;
        })
        .then(stage);
    } else {
      // If a preStage function was set, run it
      if (this._preStageFunction)
        this._preStageFunction(stageOutput, stage, counter);

      // Otherwise, call the next stage with the last stage output
      if (typeof stage === "function") {
        stageOutput = stage(stageOutput);
      } else {
        stageOutput = stage;
      }
    }
  });

  return stageOutput;
};

/**
 * Sets a function that will run before each pipeline
 * stage. If previous stage output is a Promise,
 * the preStageFunction will wait for the promise
 * to resolve before running.
 *
 * @param fn
 */
Pipeline.prototype.setPreStageFunction = function (fn) {
  this._preStageFunction = fn;
};

module.exports = Pipeline;

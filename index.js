'use strict';

function Pipeline() {

    var stages = [],
        stageOutput;

    this.pipe = function (stage) {
        stages.push(stage);

        return this;
    };

    this.process = function (args) {

        if (stages.length === 0) {
            return args;
        }

        // Set the stageOutput to be args
        // as there is no output to start with
        stageOutput = args;

        stages.forEach(function (stage) {

            //Call the next stage with the last stage output
            if (typeof stage === 'function') {
                stageOutput = stage(stageOutput);
            } else {
                stageOutput = stage;
            }

        });

        return stageOutput;
    };
}

module.exports = Pipeline;

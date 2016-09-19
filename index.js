'use strict';

function Pipeline() {

    var stages = [],
        stageOutput;

    this.pipe = function (stage) {
        stages.push(stage);
        return this;
    };

    this.process = function (args) {
        stageOutput = args;
        stages.forEach(function (stage, counter) {
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

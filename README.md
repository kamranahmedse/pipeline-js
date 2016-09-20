# pipeline-js

![Build Status](https://travis-ci.org/kamranahmedse/pipeline-js.svg)
![Package Version](https://img.shields.io/npm/v/pipeline-js.svg)

> Hassle free pipeline pattern implementation with the support for sync and async stages


## Introduction

Pipeline JS allows you to implement the pipeline pattern while creating **reusable pipelines** in your Javascript applications. You can create pipelines consisting of one or more stages once and then **process them using different payloads**. Pipeline processing is initiated by some payload and this payload will be passed from stage to stage in order to complete the required process.

### General Pipeline Example

To demonstrate it using an example, consider a request made to access user by id; the pipeline may consist of stages including `getUserById`, `transformUser`, `convertToJson` and return. And for each next stage, the input comes from the last stage i.e.

```javascript
->(User ID)>>getUserById()
    ->(User Detail)>>transformUser()
          ->(Transformed Detail)>>convertToJson()
                  ->(User Detail.json)>>return
```

### Sample Programmatic implementation

While using Pipeline JS, it can be written programmatically as

```javascript
// First syntax
var userPipeline = new Pipeline([
    getUserById,
    transformUser,
    convertToJson
]);

// Alternatively, you may write the same using the pipe method
var userPipeline = (new Pipeline()).pipe(getUserById)
                                   .pipe(transformUser)
                                   .pipe(convertToJson);

// Then this pipeline can be used with any payload i.e.
var userJson = userPipeline.process(10);  // JSON detail for the user with ID 10
var userJson = userPipeline.process(23);  // JSON detail for the user with ID 23
```

Where **stages shown above can be anything invokable**. The sample implementation for the stages may be something like below

```javascript
// For example, methods from some objects
var getUserById   = UserModel.getUserById,
    transformUser = Transformers.transformUser,
    convertToJson = Utility.convertToJson;

// Or functions
var getUserById = function (userId) {
    //..
    return promise;
};

var transformUser = function (userDetail) {
    // ..
    return transformedObject;
};

var convertToJson = function(userDetail) {
    // ..
    return jsonString;
};

```

Using pipeline will not only allow constructing reusable pipelines but also **result in comparatively cleaner and readable code** i.e. consider the following example

```javascript
  var output = JSON.stringify(transformFilters(getSelectedFilters()));
  
  // It can be transformed to
  var pipeline = new Pipeline([
    getSelectedFilters,
    transformFilters,
    JSON.stringify
  ]);
  
  // Or maybe use the alternate syntax
  var pipeline = (new Pipeline()).pipe(getSelectedFilters)
                                 .pipe(transformFilters)
                                 .pipe(JSON.stringify);

  // Get the output by processing the pipeline 
  var output = pipeline.process();
```

## Installation

Run the below command to install using NPM

```
npm install --save pipeline-js
```

## Usage

Operations in a pipeline i.e. stages can be **anything that is callable** i.e. closures and anything that's invokable is good.

In order to create a pipeline, you can either pass the stages as an array parameter to constructor

```javascript
var pipeline = require('pipeline-js');

// Creating pipeline using constructor parameterå
var pipeline = new Pipeline([
  invokableStage1,
  invokableStage2,
  invokableStage3
]);

// Process pipeline with payload1
var output1 = pipeline.process(payload1);
var output2 = pipeline.process(payload2);
```

Or you can create a pipeline object and call the `pipe` method on it to successively add the invokable stages

```javascript
var pipeline = require('pipeline-js');

// Creating pipeline using pipe method
var pipeline = (new Pipeline()).pipe(invokableStage1)
                               .pipe(invokableStage2)
                               .pipe(invokableStage3

// Process pipeline with payload1
var output1 = pipeline.process(payload1);
var output2 = pipeline.process(payload2);
```


## Sync/Async Usage

The only difference between the synchronous usage and asynchronous usage is how the output is handled. For both types of usages, **pipelines are created the same way**. The difference is when you call the `process()` method, if the pipeline has all the stages returning concrete output the process method returns concrete value, however if any of the stages returns a promise then the `process` method returns promise and you will have to use `.then()` to get the output.

Examples for both the sync and async usage are given below

## Sync Example

> How to use when all the stages return concrete values?

> If none of the stages return promise then `process(payload)` will return concrete value

```javascript
var addOne = function (x) {
  return x + 1;
};

var square = function (x) {
  return x * x;
};

var minusTwo = function (x) {
  return x - 2;
};

// Without pipeline
// - Not reusable
// - Not that clean
var output1 = minusTwo(square(addOne(10)));
var output2 = minusTwo(square(addOne(10)));

// With Pipeline
// Reusable with different payload
// Cleaner
var someFormula = new Pipeline([
  addOne,
  square,
  minusTwo
]);

var result = someFormula.process(10);   // 10 + 1  => 11
                                        // 11 * 11 => 121
                                        // 121 - 2 => 119
console.log(result);  // (int) 119

var result = someFormula.process(20);   // 20 + 1  => 21
                                        // 21 * 21 => 441
                                        // 441 - 2 => 339
console.log(result); // (int) 339
```

Or maybe you can write the same example as

```javascript
var someFormula = (new Pipeline()).pipe(addOne)
                                  .pipe(square)
                                  .pipe(minusTwo);

var output1 = someFormula.process(20);
var output2 = someFormula.process(20);

```

## Async Example

> How to use when one or all of the stages return promise?

> If any single of the stages returns a promise, `process(payload)` will return a promise

```javascript
var Pipeline = require('pipeline-js');

// Gets the user by ID and returns promise
var getUserById = function (userId) {
  var q = q.defer();
  // ..
  return q.promise;
};

// Transforms the user
var transformUser = function (userDetai) {
  return {
    name: userDetail.name,
    email: userDetail.email,
    password: '*****'
  };
};

// Converts to JSON
var createJson = function (object) {
  return JSON.stringify(object);
};

var pipeline = new Pipeline([
    getUserById,    // Returns promise
    transformUser,
    createJson
]);

// process() will return promise; since one of the stages returns a promise
var output = pipeline.process(142)
                     .then(function(userJson){
                        console.log(userJson);    // (string) {"name": "John Doe", "email": "johndoe@gmail.com", "password": "****"}
                     })
                     .catch(function(error) {
                        console.log(error);
                     });

var output = pipeline.process(263)  // promise will be returned
                     .then(function(userJson){
                        console.log(userJson);    // (string) {"name": "Jane Doe", "email": "janedoe@gmail.com", "password": "****"}
                     })
                     .catch(function(error) {
                        console.log(error);
                     });
```

Altneratively,

```javascript
// Same pipeline using `pipe` method
var pipeline = (new Pipeline()).pipe(getUserById)     // Returns promise
                               .pipe(transformUser)
                               .pipe(createJson);

var output = pipeline.process(142)  // promise will be returned; since one of the stages returns a promise
                     .then(function(userJson){
                        console.log(userJson);    // (string) {"name": "John Doe", "email": "johndoe@gmail.com", "password": "****"}
                     })
                     .catch(function(error) {
                        console.log(error);
                     });
```

## Sidenote

You may also want to check this [pipeline proposal](https://github.com/mindeavor/es-pipeline-operator)

## Contribution

Feel free to fork, extend, create issues, create PRs or spread the word.

## License

MIT &copy; [Kamran Ahmed](http://kamranahmed.info)

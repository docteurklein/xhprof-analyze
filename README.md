# xhprof-analyze

## What ?

A suite of tools to store, analyze and compare output of [tideways xhprof extension](https://github.com/tideways/php-profiler-extension).

## Why ?

This could help you find bottlenecks and follow the performance evolution continuously.


## How ?

### Import a profile dump in neo4j

 - Install and activate the `tidewawys_xhprof.so` extension
 - Generate some profiling data in your application
 - Pass it to `bin/import-xhprof`'s stdin (will be `json_decode`d!)

Example:

    php example/bench1.php | bin/import-xhprof "profile1"
    # improve stuff...
    php example/bench1.php | bin/import-xhprof "profile2"


### Compare 2 profiles by wall time for calls that take more than 100ms

    bin/compare profile1 profile2 wt 100000 | xdot -

### Display one profile graph

    bin/profile profile1 wt 100000 | xdot -

## Metrics:

You can provide a comma-separated list of metrics to the scripts.
This will generate separate arrows for each metric.

Example:

    bin/profile profile1 wt,ct,cpu,mu 100000 | xdot -

For [xhprof](https://github.com/tideways/php-profiler-extension/blob/master/README.md#data-format):

 - `wt` The summary wall time of all calls of this parent ==> child function pair.
 - `ct` The number of calls between this parent ==> child function pair.
 - `cpu` The cpu cycle time of all calls of this parent ==> child function pair.
 - `mu` The sum of increase in `memory_get_usage` for this parent ==> child function pair.
 - `pmu` The sum of increase in `memory_get_peak_usage` for this parent ==> child function pair.


For [memprof](https://github.com/arnaud-lb/php-memory-profiler#memprof_dump_array):

 - `memory_size`: exclusive memory usage of function call
 - `memory_size_inclusive`: inclusive memory usage of function call
 - `blocks_count`: exclusive blocks count of function call (number of allocated)
 - `blocks_count_inclusive`: inclusive blocks count of function call (number of allocated)
 - `calls`: number of calls made by the caller

## Environment variables

- `NEO4J_URL`: a valid `bolt` URL pointing to a neo4j instance

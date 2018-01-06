# xhprof-analyze

## What ?

A suite of tools to store, analyze and compare output of [tideways xhprof extension](https://github.com/tideways/php-profiler-extension).

## Why ?

This could help you find bottlenecks and follow the performance evolution continuously.


## How ?

### Import a profile dump in neo4j

 - Install and activate the `tidewawys_xhprof.so` extension
 - Generate some profiling data in your application
 - Pass it to `bin/import` stdin

Example:

    php example/bench1.php | bin/import "profile1"
    # improve stuf...
    php example/bench1.php | bin/import "profile2"


### Compare 2 profiles

    bin/compare profile1 profile2 | xdot -


## Environment variables

- `NEO4J_URL`: a valid `bolt` URL pointing to a neo4j instance

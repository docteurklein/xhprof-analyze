<?php

tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_CPU);
//tideways_xhprof_enable();

function one() {
    two();
}

function two() {
    three();
    three();
    three();
    six();
}

function three() {
    new four;
    five();
}

function five() {
}

function six() {
    sleep(0.5);
}

class four {
    public function __construct()
    {
        range(0, 1000000);
        range(0, 1000000);
    }
}


one();

echo serialize(tideways_xhprof_disable());


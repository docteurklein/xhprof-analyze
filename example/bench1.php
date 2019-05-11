<?php

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
        range(0, 2000000);
        range(0, 2000000);
}

function six() {
    sleep(0.5);
}

class four {
    public function __construct()
    {
        range(0, 2000000);
    }
}

while(true) {
    one();
    sleep(1);
}

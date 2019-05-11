<?php declare(strict_types=1);

function dump_xhprof($signo) {
    $path = getenv('XHPROF_PATH') ?: strval(microtime(true)).'-xhprof.json';
    error_log('dumping xhprof profile at path: '.$path);
    file_put_contents($path, json_encode(tideways_xhprof_disable()));
    tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY_ALLOC | TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_CPU);
}

(function() {
    pcntl_async_signals(true);
    $signal = getenv('XHPROF_SIGNAL') ?: SIGUSR1;
    pcntl_signal($signal, 'dump_xhprof');
    error_log('xhprof dump at signal: '.strval($signal));
    register_shutdown_function('dump_xhprof', 0);
    tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY_ALLOC | TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_CPU);
})();

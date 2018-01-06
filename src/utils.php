<?php

declare(strict_types=1);

function format_micro_seconds(int $duration)
{
    if (abs($duration) >= 1000000) {
        return sprintf('%.2f s', $duration / 1000000);
    }

    if (abs($duration) >= 1000) {
        return sprintf('%.2f ms', $duration / 1000);
    }

    return sprintf('%d μs', $duration);
}

function format_bytes(int $bytes)
{
    if (abs($bytes) >= 1000000) {
        return sprintf('%.2f MB', $bytes / 1000000);
    }

    if (abs($bytes) >= 1000) {
        return sprintf('%.2f KB', $bytes / 1000);
    }

    return sprintf('%d B', $bytes);
}

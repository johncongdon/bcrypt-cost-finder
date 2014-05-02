<?php

# Uncomment and change the path to your version of password_compat.php
# This can be obtained at https://github.com/ircmaxell/password_compat
require '../password_compat/lib/password.php';

print "Starting\n";
$start = (int)$argv[1] ? (int)$argv[1] : 4;
$end = (int)$argv[2] ? (int)$argv[2] : 20;
run_tests($start, $end);

function run_tests($start = 4, $end = 20) {
    for ($cost=$start; $cost<=$end; $cost++) {
        $time = run_test($cost);
        echo "Cost of $cost took an average of $time seconds\n";
        flush();
        if ($time > 2)
        {
            exit;
        }
    }
}

function run_test($cost) {
    $start = microtime(1);
    $max_loops = 100;
    for ($loop = 1; $loop <= $max_loops; $loop++) {
        password_hash('DumbExample', PASSWORD_DEFAULT, array("cost" => $cost));
    }
    $end = microtime(1);
    $total_time = $end - $start;
    $avg_time = $total_time / $max_loops;

    return $avg_time;
}


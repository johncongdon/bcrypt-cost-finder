<?php

# Uncomment and change the path to your version of password_compat.php
# This can be obtained at https://github.com/ircmaxell/password_compat
require '../password_compat/lib/password.php';

print "Starting\n";
run_tests();

function run_tests() {
    for ($cost=4; $cost<=20; $cost++) {
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


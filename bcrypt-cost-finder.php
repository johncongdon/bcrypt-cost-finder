<?php

# If you are running PHP < 5.5 change the path to your version of password_compat.php
# This can be obtained at https://github.com/ircmaxell/password_compat
if ( ! function_exists('password_hash')) {

require '../password_compat/lib/password.php';
}

ob_end_flush();
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
            echo "At this point the time is over 2 seconds, let's not get carried away\n";
            exit;
        }
    }
}

function run_test($cost) {
    $start = microtime(1);
    $hash = password_hash('DumbExample', PASSWORD_DEFAULT, array("cost" => $cost));
    $end = microtime(1);
    $total_time = $end - $start;
    $avg_time = $total_time / $max_loops;

    return $total_time;;
}


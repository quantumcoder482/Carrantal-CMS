<?php
use Crunz\Schedule;

$schedule = new Schedule();

$schedule->run('/usr/bin/php system/controllers/console_kernel.php')
    ->everyMinute()
    ->description('Create a backup of the project directory.');

$schedule->run(function(){
    echo getcwd();
})
    ->everyMinute()
    ->description('Copying the project directory');

return $schedule;
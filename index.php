<?php
use helpers\PackageLossDetector;
require_once 'helpers/PackageLossDetector.php';
/**
 * calling new class instance
*/
$detector = new PackageLossDetector();

$testArr = range(1,50);
/**
 * imitaion of package losing
*/
$testArr[] = 52;
$testArr[] = 54;
$testArr[] = 58;
$testArr[] = 63;
$testArr[] = 64;
$testArr[] = 66;
$testArr[] = 72;
$testArr[] = 74;
$testArr[] = 78;
$testArr[] = 83;
$testArr[] = 84;
$testArr[] = 86;
$testArr[] = 87;
$testArr[] = 89;
$testArr[] = 91;
$testArr[] = 92;
$testArr[] = 93;
$testArr[] = 94;
$testArr[] = 96;
$testArr[] = 97;
$testArr[] = 99;
$testArr[] = 101;
$testArr[] = 103;
$testArr[] = 105;
$testArr[] = 106;
$testArr[] = 108;
$testArr[] = 109;
$testArr[] = 112;
$testArr[] = 116;


foreach ($testArr as $item) {

    $detector->onPacketReceived($item);
    /**
     * deleyed adding to array by 100000 microseconds (0.1s)
    */
    usleep(100000);
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Where is my packages, Dude???</title>
</head>
<body>
    <h1>UDP Package transfer emulation</h1>
<!--    Professor Puss for a good mood-->
    <img src="https://memegenerator.net/img/instances/33241354.jpg" alt="UDP Joke">
<!--    -->
   <p>In Last 2 seconds: <?= $detector->getCurrentLoss();?></p>
   <p>All: <?= $detector->getAverageLoss();?></p>
</body>
</html>

<?php


namespace helpers;


class PackageLossDetector
{
    private array $packagesArr = [];
    private int $startTime;


    public function __construct()
    {
        $this->startTime = time();
        /** you coul add this to look at time of class initialization
         * $formatedStart = date("d-m-Y hh:ii",$this->startTime);
         * echo "Script starts at $formatedStart \n";
        */
    }
    /**
     * Calling this one on package receiving to store data
     * in associative array $packagesArr as [[id] => timestamp]
     * @var int $id
    */
    public function onPacketReceived(int $id){
        $this->packagesArr[$id] = time();
    }

    /**
     * Call this to see how many packages lost in last 2 sec
     * @return string
    */
    public function getCurrentLoss(): string
    {
        /**
         * getting -2 sec timestamp*
         */
        $scanningTime = time() - 2;
        /**
         * filtering array of all received IDs by timestamp
         */
        $scannedArr = array_filter($this->packagesArr,function($n) use($scanningTime){ return $n >= $scanningTime;} );


        /**
         * You also could get missed keys (IDs) by using array_diff
         * $missedArr = array_diff($completedArr,$allIds);
        */
        return $this->lossCalculation($scannedArr);
    }

    /**
     * Call this to see how many packages lost over all
     * @return string
     */

    public function getAverageLoss(): string
    {

        /**
         * no filtering just passing all IDs we got
         */
        return $this->lossCalculation($this->packagesArr);
    }

    /**
     * Calculation of loss in percentile by passing:
     * @var array $received
     * @return string
     */
    private function lossCalculation(array $received): string
    {

        /**
         * getting array of received IDs
         */
        $receivedArr = array_keys ($received);
        /**
         * getting array of expected IDs by taking min ID and max ID from received IDs
         */
        $expectedArr = $expectedArr = range(min($receivedArr),max($receivedArr));

        $percentileLost = round ((1 - count($received)/count($expectedArr))*100);
        return "We have lost {$percentileLost}% of our packages, Sir...";
    }
}

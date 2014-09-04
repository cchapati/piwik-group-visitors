<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 03.09.14
 * Time: 11:50
 */

namespace Piwik\Plugins\GroupVisitors;
use Piwik\DataTable;
use Piwik\Metrics;

class Archiver extends \Piwik\Plugin\Archiver {


    public function aggregateDayReport() {

        $logAggregator = $this->getLogAggregator();

        $data = $logAggregator->queryVisitsByDimension(
            $dimensions = array('visitor_localtime')
        );

        $arr = array(
            array("label" => "even", "nb_visits" => 0),
            array("label" => "uneven", "nb_visits" => 0)
        );

        $dataTable = new DataTable();

        while ($row = $data->fetch()) {

            $time = $row['visitor_localtime'];
            $visits = $row[Metrics::INDEX_NB_VISITS];

            $dateTime = new \DateTime($time);

            $hour = $dateTime->format("H") + 1;

            if ($hour % 2 == 0)
                $arr[0]["nb_visits"] += $visits;
            else
                $arr[1]["nb_visits"] += $visits;


        }


        $dataTable->addRowsFromSimpleArray($arr);


        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord('GroupVisitors_report', $dataTable->getSerialized(500));

    }

    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();
        $archiveProcessor->aggregateDataTableRecords('GroupVisitors_report', 500);
    }

} 
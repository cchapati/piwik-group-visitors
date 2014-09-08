<?php

namespace Piwik\Plugins\GroupVisitors;
use Piwik\DataTable;
use Piwik\Metrics;

class Archiver extends \Piwik\Plugin\Archiver {


    public function aggregateDayReport() {

        $dataTable = new DataTable();

        $logAggregator = $this->getLogAggregator();

        $results = $logAggregator->queryVisitsByDimension(
            $dimensions = array(
                'md' => 'MOD(HOUR(log_visit.visitor_localtime), 2)'
            )
        );

        $rows = $results->fetchAll();

        $records = array(
            array("label" => "even", "nb_visits" => $rows[1][Metrics::INDEX_NB_VISITS]),
            array("label" => "uneven", "nb_visits" => $rows[0][Metrics::INDEX_NB_VISITS])
        );

        $dataTable->addRowsFromSimpleArray($records);

        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord('GroupVisitors_report', $dataTable->getSerialized($this->maximumRows));

    }

    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();
        $archiveProcessor->aggregateDataTableRecords('GroupVisitors_report', $this->maximumRows);
    }

} 
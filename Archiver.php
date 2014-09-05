<?php

namespace Piwik\Plugins\GroupVisitors;
use Piwik\DataTable;

require_once PIWIK_INCLUDE_PATH . '/plugins/GroupVisitors/ArchiveDataTableFactory.php';

class Archiver extends \Piwik\Plugin\Archiver {


    public function aggregateDayReport() {

        $logAggregator = $this->getLogAggregator();

        $results = $logAggregator->queryVisitsByDimension(
            $dimensions = array('visitor_localtime'),
            $where = '',
            $additionalSelects = array('HOUR(visitor_localtime)')
        );

        $provider = new ArchiveDataTableFactory($results);

        while ($row = $results->fetch())
            $provider->calculate($row);


        $dataTable = $provider->getDataTable();

        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord('GroupVisitors_report', $dataTable->getSerialized($this->maximumRows));

    }

    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();
        $archiveProcessor->aggregateDataTableRecords('GroupVisitors_report', $this->maximumRows);
    }

} 
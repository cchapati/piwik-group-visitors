<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\GroupVisitors;
use Piwik\DataTable;
use Piwik\Metrics;

/**
 * Class Archiver
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class Archiver extends \Piwik\Plugin\Archiver
{

    const ARCHIVE_NAME = "GroupVisitors_report";

    public function aggregateDayReport()
    {

        $dataTable = new DataTable();

        $logAggregator = $this->getLogAggregator();

        $results = $logAggregator->queryVisitsByDimension(
            $dimensions = array(
                'md' => 'MOD(HOUR(log_visit.visitor_localtime), 2)'
            )
        );

        $rows = $results->fetchAll();

        $records = array(
            array(
                "label" => "even",
                "nb_visits" => $rows[1][Metrics::INDEX_NB_VISITS]),
            array(
                "label" => "uneven",
                "nb_visits" => $rows[0][Metrics::INDEX_NB_VISITS])
        );

        $dataTable->addRowsFromSimpleArray($records);

        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord(
            self::ARCHIVE_NAME,
            $dataTable->getSerialized($this->maximumRows)
        );

    }

    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();
        $archiveProcessor->aggregateDataTableRecords(
            self::ARCHIVE_NAME,
            $this->maximumRows
        );
    }

} 
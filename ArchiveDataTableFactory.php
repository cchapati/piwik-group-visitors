<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 04.09.14
 * Time: 16:06
 */

namespace Piwik\Plugins\GroupVisitors;


use Piwik\DataAccess\LogAggregator;
use Piwik\DataTable;
use Piwik\Metrics;

class ArchiveDataTableFactory {

    private $dataTable;
    private $calcVisits;

    public function __construct() {

        $this->dataTable = new DataTable();

        $this->calcVisits = array(
            array("label" => "even", "nb_visits" => 0),
            array("label" => "uneven", "nb_visits" => 0)
        );

    }

    public function calculate($row) {

        $hour = $row['visitor_localtime'] + 1;
        $visits = $row[Metrics::INDEX_NB_VISITS];

        if ($hour % 2 == 0)
            $this->calcVisits[0]["nb_visits"] += $visits;
        else
            $this->calcVisits[1]["nb_visits"] += $visits;

    }


    public function getDataTable() {

        $this->dataTable->addRowsFromSimpleArray($this->calcVisits);

        return $this->dataTable;
    }


}


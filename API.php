<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\GroupVisitors;

use Piwik\Piwik;
use Piwik\DataTable;
use Piwik\Archive;

/**
 * Class API
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class API extends \Piwik\Plugin\API
{


    /**
     * @param int      $idSite
     * @param string   $period
     * @param string   $date
     * @param bool     $segment
     * @param bool     $expanded
     *
     * @return DataTable|DataTable\Map
     */
    protected function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable('GroupVisitors_report');

        $dataTable->queueFilter(
            "ColumnCallbackReplace",
            array("label", function ($label) {
                return Piwik::translate("GroupVisitors_" . $label);
            })
        );

        return $dataTable;
    }


    /**
     * @param int      $idSite
     * @param string   $period
     * @param string   $date
     * @param bool     $segment
     *
     * @return DataTable|DataTable\Map
     */
    public function getGroupVisitors($idSite, $period, $date, $segment = false)
    {

        return $this->getMyReport(
            $idSite,
            $period,
            $date,
            $segment,
            $expanded = false
        );

    }

}

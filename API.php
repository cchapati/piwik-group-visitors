<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;

use Piwik\Piwik;
use Piwik\DataTable;
use Piwik\DataTable\Row;
use Piwik\Archive;

/**
 * API for plugin GroupVisitors
 */
class API extends \Piwik\Plugin\API
{


    protected function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable('GroupVisitors_report');

        $dataTable->queueFilter("ColumnCallbackReplace", array("label", function($label) {
            return Piwik::translate("GroupVisitors_" . $label);
        }));

        return $dataTable;
    }


    public function getGroupVisitors($idSite, $period, $date, $segment = false) {

        return $this->getMyReport($idSite, $period, $date, $segment, $expanded = false);

    }

}

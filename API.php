<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;

use Piwik\DataTable;
use Piwik\DataTable\Row;
use Piwik\Archive;

/**
 * API for plugin GroupVisitors
 *
 * @method static \Piwik\Plugins\GroupVisitors\API getInstance()
 */
class API extends \Piwik\Plugin\API
{


    public function getMyReport($name, $idSite, $period, $date, $segment = false, $expanded = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable('GroupVisitors_report');

        return $dataTable;
    }


    public function getGroupVisitors($idSite, $period, $date, $segment = false) {

        return $this->getMyReport("GroupVisitors_report", $idSite, $period, $date, $segment, $expanded = false);

    }

}

<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;


use Piwik\Menu\MenuReporting;

/**
 * Class Menu
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class Menu extends \Piwik\Plugin\Menu
{

    /**
     * @param MenuReporting $menu
     */
    public function configureReportingMenu(MenuReporting $menu)
    {

        $params = array('module' => 'GroupVisitors', 'action' => 'index');

        $menu->addVisitorsItem('GroupVisitors_submenu', $params);

    }

} 
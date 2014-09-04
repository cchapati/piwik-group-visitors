<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 03.09.14
 * Time: 11:24
 */

namespace Piwik\Plugins\GroupVisitors;


use Piwik\Menu\MenuAdmin;
use Piwik\Menu\MenuReporting;
use Piwik\Piwik;



class Menu extends \Piwik\Plugin\Menu {

    public function configureReportingMenu(MenuReporting $menu) {
        $menu->addVisitorsItem('GroupVisitors_submenu', array('module' => 'GroupVisitors', 'action' => 'index'));
    }

} 
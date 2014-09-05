<?php

namespace Piwik\Plugins\GroupVisitors;


use Piwik\Menu\MenuReporting;


class Menu extends \Piwik\Plugin\Menu {

    public function configureReportingMenu(MenuReporting $menu) {
        $menu->addVisitorsItem('GroupVisitors_submenu', array('module' => 'GroupVisitors', 'action' => 'index'));
    }

} 
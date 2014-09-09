<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;

use Piwik\View;


/**
 * Class Widgets
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class Widgets extends \Piwik\Plugin\Widgets
{

    protected $category = 'VisitsSummary_VisitsSummary';

    protected function init()
    {
        $this->addWidget('GroupVisitors_widget', $method = 'index');
    }

}

<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;

use Piwik\View;
use Piwik\WidgetsList;

/**
 * This class allows you to add your own widgets to the Piwik platform. In case you want to remove widgets from another
 * plugin please have a look at the "configureWidgetsList()" method.
 * To configure a widget simply call the corresponding methods as described in the API-Reference:
 * http://developer.piwik.org/api-reference/Piwik/Plugin\Widgets
 */
class Widgets extends \Piwik\Plugin\Widgets
{
    /**
     * Here you can define the category the widget belongs to. You can reuse any existing widget category or define
     * your own category.
     * @var string
     */
    protected $category = 'VisitsSummary_VisitsSummary';

    /**
     * Here you can add one or multiple widgets. You can add a widget by calling the method "addWidget()" and pass the
     * name of the widget as well as a method name that should be called to render the widget. The method can be
     * defined either directly here in this widget class or in the controller in case you want to reuse the same action
     * for instance in the menu etc.
     */
    protected function init() {
       $this->addWidget('GroupVisitors_widget', $method = 'index');
    }


    /**
     * Here you can remove any widgets defined by any plugin.
     *
     * @param WidgetsList $widgetsList
     */
    public function configureWidgetsList(WidgetsList $widgetsList) {
        // $widgetsList->remove('NameOfWidgetCategory'); // will remove all widgets having this category
        // $widgetsList->remove('NameOfWidgetCategory', 'Widget name'); // will only remove a specific widget
    }
}

<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors\Reports;

use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\View;


/**
 * Class GetGroupVisitors
 *
 * @package Piwik\Plugins\GroupVisitors\Reports
 */
class GetGroupVisitors extends Report
{

    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('GroupVisitorsName');
        $this->dimension     = null;
        $this->documentation = Piwik::translate('GroupVisitorsDocumentation');

        $this->order = 1;

    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        if (!empty($this->dimension)) {
            $view
                ->config
                ->addTranslations(array('label' => $this->dimension->getName()));
        }


        $view->config->addTranslations(
            array('label' => Piwik::translate("GroupVisitors_label"))
        );

        $view->config->show_search = true;
        $view->requestConfig->filter_sort_column = 'nb_visits';

        $view->config->columns_to_display = array('label', 'nb_visits');
    }

    /**
     * @return array|\Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
         return array();
    }


}

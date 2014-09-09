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
 * Class Controller
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class Controller extends \Piwik\Plugin\Controller
{

    /**
     * @return string
     */
    public function index()
    {
        $view = new View('@GroupVisitors/index.twig');
        $this->setBasicVariablesView($view);
        $view->groupVisitors = $this->getGroupVisitors();

        return $view->render();
    }

    /**
     * @return string|void
     */
    public function getGroupVisitors()
    {
        return $this->renderReport(__FUNCTION__);
    }
}

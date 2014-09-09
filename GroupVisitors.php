<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\GroupVisitors;

/**
 * Class GroupVisitors
 *
 * @package Piwik\Plugins\GroupVisitors
 */
class GroupVisitors extends \Piwik\Plugin
{

    /**
     * @return array
     */
    public function getListHooksRegistered()
    {

        return array(
            'AssetManager.getJavaScriptFiles' => 'getJsFiles',
        );

    }

    /**
     * @param array &$jsFiles
     */
    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = '';
    }
}

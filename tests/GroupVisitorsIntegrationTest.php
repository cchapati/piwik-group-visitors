<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\GroupVisitors\tests;


use Piwik\Tests\IntegrationTestCase;
use Piwik\Plugins\GroupVisitors\tests\Fixtures\VisitsFixture;

/**
 * Class GroupVisitorsIntegrationTest
 *
 * @package Piwik\Plugins\GroupVisitors\tests
 * @group GroupVisitors
 * @group GroupVisitorsIntegrationTest
 * @group Plugins
 */
class GroupVisitorsIntegrationTest extends IntegrationTestCase
{

    public static $fixture = null;


    /**
     * @return mixed|string
     */
    public static function getOutputPrefix()
    {
        return "";
    }

    /**
     * @param $api
     * @param $params
     * @dataProvider getApiForTesting
     * @group GroupVisitorsIntegrationTest
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    /**
     * @return array
     */
    public function getApiForTesting()
    {

        $apiToCall = array("GroupVisitors.getGroupVisitors");


        $apiToTest = array();
        $apiToTest[] = array($apiToCall,
                            array(
                                'idSite' => 1,
                                'date' => self::$fixture->dateTime,
                                'periods' => array('day'),
                            )
                        );

        return $apiToTest;

    }


    /**
     * @return string
     */
    public static function getPathToTestDirectory()
    {
        return dirname(__FILE__);
    }

}

GroupVisitorsIntegrationTest::$fixture = new VisitsFixture();
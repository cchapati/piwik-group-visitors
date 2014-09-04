<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 04.09.14
 * Time: 09:39
 */

namespace Piwik\Plugins\GroupVisitors\tests;


use Piwik\Tests\IntegrationTestCase;
use Piwik\Plugins\GroupVisitors\tests\Fixtures\VisitsFixture;

/**
 * @group GroupVisitors
 * @group GroupVisitorsIntegrationTest
 * @group Plugins
 */
class GroupVisitorsIntegrationTest extends IntegrationTestCase {

    public static $fixture = null;


    public static function getOutputPrefix() {
        return "";
    }

    /**
     * @dataProvider getApiForTesting
     * @group GroupVisitorsIntegrationTest
     */
    public function testApi($api, $params) {
        $this->runApiTests($api, $params);
    }

    public function getApiForTesting() {

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


    public static function getPathToTestDirectory() {
        return dirname(__FILE__);
    }

}

GroupVisitorsIntegrationTest::$fixture = new VisitsFixture();
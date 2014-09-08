<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\GroupVisitors\tests\Fixtures;

use Piwik\Tests\Fixture;
use Piwik\Date;

/**
 * Class VisitsFixture
 * @package Piwik\Plugins\GroupVisitors\tests\Fixtures
 */
class VisitsFixture extends Fixture
{

    public $dateTime = '2014-09-04 00:00:00';
    public $idSite = 1;


    public function setUp()
    {

        $this->setUpWebsite();
        $this->trackVisits();
    }

    public function tearDown()
    {

    }


    public function setUpWebsite()
    {

        if (!self::siteCreated($this->idSite)) {
            $idSite = self::createWebsite($this->dateTime);
            $this->assertSame($this->idSite, $idSite);
        }
 
    }

    public function trackVisits()
    {

        $tracker = self::getTracker(
            $this->idSite,
            $this->dateTime,
            $defaultInit = false
        );

        $hours = array(2, 4, 6, 8, 10, 1, 3, 5, 7);

        foreach($hours as $hour)
        {
            $tracker->setForceVisitDateTime(
                Date::factory($this->dateTime)->addHour($hour)->getDatetime()
            );
            $tracker->setUrl('http://example.com/');
            self::checkResponse($tracker->doTrackPageView('Viewing homepage'));
        }

    }


} 
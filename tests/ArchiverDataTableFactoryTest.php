<?php

namespace Piwik\Plugins\GroupVisitors\tests;

use Piwik\Plugins\GroupVisitors\ArchiveDataTableFactory;
use Piwik\Plugins\GroupVisitors\tests\Fixtures\VisitsFixture;
use Piwik\Db;
use Piwik\Metrics;

/**
 * @group GroupVisitors
 * @group Plugins
 */
class ArchiverDataTableFactoryTest extends \PHPUnit_Framework_TestCase {


    private $records;
    private $expected;

    public function setUp()
    {
        $this->expected = array("even" => 0, "uneven" => 0);

        $this->generateRecords();

    }

    private function generateRecords() {

        $this->records = array();

        $hours = array(2 => 2, 4 => 5, 6 => 1, 8 => 10,
                       10 => 3, 1 => 0, 3 => 8, 5 => 1,
                       7 => 3);

        foreach ($hours as $hour => $visit) {
            $hourShift = $hour + 1;
            $this->records[] = array("visitor_localtime" => $hour, Metrics::INDEX_NB_VISITS => $visit);
            $this->expected[$hourShift % 2 == 0 ? 'even' : 'uneven'] += $visit;
        }

    }

    public function testCalculate() {

        $factory = new ArchiveDataTableFactory();

        foreach ($this->records as $row) {
            $factory->calculate($row);
        }

        $rows = $factory->getDataTable()->getRows();

        $this->assertEquals($rows[0]->c[0]['nb_visits'], $this->expected['even']);
        $this->assertEquals($rows[1]->c[0]['nb_visits'], $this->expected['uneven']);
    }

    public function tearDown()
    {

    }


}
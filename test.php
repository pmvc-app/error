<?php
namespace PMVC\App\error;

use PMVC;
use PHPUnit_Framework_TestCase;

PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
PMVC\l(__DIR__.'/vendor/pmvc-plugin/controller/tests/resources/FakeView.php');

class ErrorActionTest extends PHPUnit_Framework_TestCase
{
    function testPlugin()
    {
        $view = \PMVC\plug(
            'view',
            [
                _CLASS => '\PMVC\FakeView',
            ]
        );
        $c = \PMVC\plug('controller');
        $c->setApp('error');
        $c->plugApp(['./']);
        $r = $c->getRequest();
        $r['errors'][] = 1001;
        $result = $c->process();
        $actual = \PMVC\value($result,[0,'v','errors','0']);
        $expected = new Error('1001', [
            'message'=>'Username can\'t empty, and must be at least 6 characters long',
            'field'=>'username',
        ]);
        $this->assertEquals($expected, $actual);
    }

}



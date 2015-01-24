<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 24/01/15
 * Time: 16:48
 */

namespace tests\Models;
use app\models\ParticipateModel;

class ParticipationModelTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var \app\models\ParticipateModel
     */
    private $model;

    public function testGetAll()
    {
        $this->model = new ParticipateModel();

        $state = $this->model->getEventsParticipations();

        $this->assertEmpty($state);
    }

    public function testAll()
    {
        $this->model = new ParticipateModel();

        $array  = ['id'=>1,'user'=>1,'joindate'=>date('Y-m-d G:i:s')];
        $state = $this->model->insertEventParticipation($array);
        $this->assertEquals(true,$state);

        $state = $this->model->getEventParticipation(1);
        $this->assertNotEmpty($state);

        $state = $this->model->deleteEventParticipation(1,1);
        $this->assertEquals(true,$state);
    }

}
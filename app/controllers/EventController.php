<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 13/01/15
 * Time: 15:11
 */

namespace app\controllers;


use app\exceptions\EventNotFoundException;
use app\exceptions\NotAuthenticatedException;
use app\helpers\Authentication;
use app\models\EventModel;
use app\models\UserModel;
use SwagFramework\Helpers\Form;
use SwagFramework\mvc\Controller;

class EventController extends Controller
{

    /**
     * @var EventModel
     */
    private $eventModel;

    /**
     * @var UserModel
     */
    private $userModel;

    private function getInfos($event)
    {
        $event['user'] = $this->userModel->getUser($event['user']);

        $createtime = new \DateTime($event['createtime']);
        $event['createtime'] = $createtime->format('d/m/Y à H:i');

        $eventtime = new \DateTime($event['eventtime']);
        $event['eventtime'] = $eventtime->format('d/m/Y à H:i');

        return $event;
    }

    function __construct()
    {
        $this->eventModel = new EventModel();
        $this->userModel = new UserModel();
        parent::__construct();
    }

    public function index()
    {
        $events = $this->eventModel->getAll();

        foreach($events as &$event)
            $event = $this->getInfos($event);

        $this->getView()->render('event/index', array(
            'events' => $events
        ));
    }

    public function show()
    {
        $id = (int)$this->getParams()[0];

        $event = $this->eventModel->get(1);

        if (empty($event)) {
            throw new EventNotFoundException($id);
        }

        $event = $this->getInfos($event);

        $this->getView()->render('event/show', array(
            'event' => $event
        ));
    }

    public function performAdd()
    {
        if(!Authentication::getInstance()->isAuthenticated())
            throw new NotAuthenticatedException();

        $formHelper = new Form('/event/perfomAdd');
        $form = $formHelper->generate('event', '/event/performAdd');

        $result = $form->validate(array(
            'name' => 'Nom de l\'évènement',
            'description' => 'Description',
            'address' => 'Adresse',
            'eventtime' => 'Date de l\'évènement',
            'money' => 'Prix',
            'personsmax' => 'Nombre maximum de participants'
        ));

        $this->eventModel->insertEvent(
            $result['name'],
            Authentication::getInstance()->getUserId(),
            $result['personsmax'],
            $result['description'],
            $result['address'],
            $result['eventtime'],
            $result['money']
        );
    }

    public function add()
    {
        if(!Authentication::getInstance()->isAuthenticated())
            throw new NotAuthenticatedException();

        $formHelper = new Form('/event/perfomAdd');
        $form = $formHelper->generate('event', '/event/performAdd');

        $form->setAction('/event/perfomAdd');
        $form->setClass('pure-form pure-form-stacked');

        $html = $form->getFormHTML(array(
            'name' => 'Nom de l\'évènement',
            'description' => 'Description',
            'address' => 'Adresse',
            'eventtime' => 'Date de l\'évènement',
            'money' => 'Prix',
            'personsmax' => 'Nombre maximum de participants'
        ));

        $this->getView()->render('event/add', array(
            'form' => $html
        ));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Radosław
 * Date: 2016-01-14
 * Time: 14:39
 */

namespace TimeManager\Controller;

use Zend\Form\Element\Date;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class TimeManagerController extends AbstractActionController{

    protected $_taskTable;
    protected $_scheduleTable;

    public function getTaskTable(){
        if(!$this->_taskTable){
            $sm = $this->getServiceLocator();
            $this->_taskTable = $sm->get('TimeManager\Model\TaskTable');
        }
        return $this->_taskTable;
    }

    public function getScheduleTable(){
        if(!$this->_scheduleTable){
            $sm = $this->getServiceLocator();
            $this->_scheduleTable = $sm->get('TimeManager\Model\ScheduleTable');
        }
        return $this->_scheduleTable;
    }

    public function indexAction(){
        $lastTask = $this->getTaskTable()->getLastTask();
        $schedule = $this->getScheduleTable()->fetchAllDefault();
        $running = empty($lastTask->getEnd()) ? 1 : 0;
        $dateDiff = 0;
        if($running){
            $dateDiff = (strtotime(date("Y-m-d H:i:s")) - strtotime($lastTask->getStart())) * 1000;
        }
        return new ViewModel(array(
            'tasks' => $this->getTaskTable()->fetchAll(),
            'running' => $running,
            'dateDiff' => $dateDiff,
            'schedule' => $schedule
        ));
    }

    public function startAction(){
        $request = $this->getRequest();
        $response = $this->getResponse();

        if($request->isPost()){
            $task = new \TimeManager\Model\Entity\Task();
            if($note = $request->getPost('note')){
                $task->setNote($note);
            }
            if(!$id = $this->getTaskTable()->saveTask($task)){
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            }else{
                $response->setContent(\Zend\Json\Json::encode(array('response' => $id)));
            }
        }
        return $response;
    }

    public function stopAction(){
        $request = $this->getRequest();
        $response = $this->getResponse();

        if($request->isPost()){
            $lastTask = $this->getTaskTable()->getLastTask();
            if(!$id = $this->getTaskTable()->endTask($lastTask)){
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            }else{
                $response->setContent(\Zend\Json\Json::encode(array('response' => $id)));

            }
        }
        return $response;
    }

    public function testAction(){
        return new ViewModel();
    }

}
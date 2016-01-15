<?php
/**
 * Created by PhpStorm.
 * User: Radosław
 * Date: 2016-01-14
 * Time: 14:39
 */

namespace TimeManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class TimeManagerController extends AbstractActionController{

    protected $_taskTable;

    public function getTaskTable(){
        if(!$this->_taskTable){
            $sm = $this->getServiceLocator();
            $this->_taskTable = $sm->get('TimeManager\Model\TaskTable');
        }
        return $this->_taskTable;
    }

    public function indexAction(){
        return new ViewModel(array(
            'tasks' => $this->getTaskTable()->fetchAll()
        ));
    }
    public function testAction(){
        return new ViewModel();
    }

}
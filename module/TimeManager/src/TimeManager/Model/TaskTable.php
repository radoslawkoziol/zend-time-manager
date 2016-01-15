<?php

namespace TimeManager\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class TaskTable extends  AbstractTableGateway{

    protected $table = 'task';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll(){
        $resultSet = $this->select(function (Select $select) {
            $select->order('id DESC');
        });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Task();
            $entity->setId($row->id)
                ->setNote($row->note)
                ->setStart($row->start)
                ->setEnd($row->end);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getTask($id){
        $row = $this->select(array('id' => (int) $id))->current();
        if(!$row) return false;

        $task = new Entity\Task(
          array(
              'id' => $row->id,
              'start' => $row->start,
              'end' => $row->end,
              'note' => $row->note
          )
        );

        return $task;
    }

    public function saveTask(Entity\Task $task){
        $data = array(
            'note' => $task->getNote(),
            'start' => $task->getStart(),
            'end' => $task->getEnd()
        );

        $id = (int) $task->getId();

        if($id == 0){
            $data['start'] = date("Y-m-d H:i:s");
            if(!$this->insert($data)) return false;

            return $this->getLastInsertValue();

        }elseif($this->getTask($id)){
            if(!$this->update($data, array('id' => $id))) return false;

            return $id;

        }else{
            return false;
        }
    }
}
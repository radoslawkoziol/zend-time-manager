<?php

namespace TimeManager\Model;

use TimeManager\Model\Entity\Task;
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
            $entity = new Task();
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

        $task = new Task(
          array(
              'id' => $row->id,
              'start' => $row->start,
              'end' => $row->end,
              'note' => $row->note
          )
        );

        return $task;
    }

    public function saveTask(Task $task){
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

    public function endTask(Task $task){
        $id = $task->getId();
        if($id){
            if(!$task->getEnd()){
                $data['end'] = date("Y-m-d H:i:s");
                if(!$this->update($data, array('id' => $id))){
                    return false;
                }else{
                    return $id;
            }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getLastTask(){
        $result = $this->select(function (Select $select){
            $select->order('id DESC');
            $select->limit(1);
        });

        $result = $result->current();

        $entity = new Task();

        $entity->setId($result->id)
                ->setNote($result->note)
                ->setStart($result->start)
                ->setEnd($result->end);

        return $entity;
    }
}
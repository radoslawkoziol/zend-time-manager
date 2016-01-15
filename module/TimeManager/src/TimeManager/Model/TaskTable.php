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
            $select->order('id ASC');
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
}
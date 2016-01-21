<?php

namespace TimeManager\Model;

use TimeManager\Model\Entity\Schedule;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class ScheduleTable extends  AbstractTableGateway{

    protected $table = 'schedule';

    public function __construct(Adapter $adapter){
        $this->adapter = $adapter;
    }

    public function fetchAllDefault(){
        $resultSet = $this->select(function (Select $select) {
            $select->where('dayOfWeek IS NOT NULL');
            $select->order('dayOfWeek ASC');
        });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Schedule();
            $entity ->setId($row->id)
                    ->setDayOfWeek($row->dayOfWeek)
                    ->setCustomDate($row->customDate)
                    ->setStart($row->start)
                    ->setEnd($row->end)
                    ->setComment($row->comment);
            $entities[] = $entity;
        }
        return $entities;
    }
}
<?php

namespace TimeManager\Model\Entity;

class Schedule{

    protected $_id;
    protected $_dayOfWeek;
    protected $_customDate;
    protected $_workTime;
    protected $_comment;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return Schedule
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayOfWeek()
    {
        return $this->_dayOfWeek;
    }

    /**
     * @param mixed $dayOfWeek
     * @return Schedule
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->_dayOfWeek = $dayOfWeek;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomDate()
    {
        return $this->_customDate;
    }

    /**
     * @param mixed $customDate
     * @return Schedule
     */
    public function setCustomDate($customDate)
    {
        $this->_customDate = $customDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkTime()
    {
        return $this->_workTime;
    }

    /**
     * @param mixed $workTime
     * @return Schedule
     */
    public function setWorkTime($workTime)
    {
        $this->_workTime = $workTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param mixed $comment
     * @return Schedule
     */
    public function setComment($comment)
    {
        $this->_comment = $comment;
        return $this;
    }

}
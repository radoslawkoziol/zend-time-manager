<?php

namespace TimeManager\Model\Entity;

class Schedule{

    protected $_id;
    protected $_dayOfWeek;
    protected $_customDate;
    protected $_start;
    protected $_end;
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
    public function getStart()
    {
        return $this->_start;
    }

    /**
     * @param mixed $start
     * @return Schedule
     */
    public function setStart($start)
    {
        $this->_start = $start;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->_end;
    }

    /**
     * @param mixed $end
     * @return Schedule
     */
    public function setEnd($end)
    {
        $this->_end = $end;
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
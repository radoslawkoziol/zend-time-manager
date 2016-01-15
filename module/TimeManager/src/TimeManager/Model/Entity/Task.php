<?php

namespace TimeManager\Model\Entity;

class Task{
    protected $_id;
    protected $_start;
    protected $_end;
    protected $_note;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new \Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new \Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
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
     * @param $start
     * @return $this
     */
    public function setStart($start)
    {
        $this->_start = $start;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->_note;
    }


    /**
     * @param $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->_note = $note;
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
     * @param $end
     * @return $this
     */
    public function setEnd($end)
    {
        $this->_end = $end;
        return $this;
    }

}
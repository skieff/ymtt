<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class CreateGoalsTask {
    /**
     * @Assert\NotBlank()
     * @var
     */
    protected $counter;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $eventPrefix;

    /**
     * @return mixed
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param mixed $counter
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;
    }

    /**
     * @return string
     */
    public function getEventPrefix()
    {
        return $this->eventPrefix;
    }

    /**
     * @param string $eventPrefix
     */
    public function setEventPrefix($eventPrefix)
    {
        $this->eventPrefix = $eventPrefix;
    }
}
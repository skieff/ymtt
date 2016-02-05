<?php

namespace AppBundle\Metrica\Management\Models;

use Yandex\Metrica\Management\Models\Goal as YandexGoal;
use Yandex\Metrica\Management\Models\Goals;

class Goal extends YandexGoal
{
    protected $steps = null;

    protected $mappingClasses = [
        'conditions' => 'Yandex\Metrica\Management\Models\Conditions',
        'steps' => 'Yandex\Metrica\Management\Models\Goals'
    ];

    /**
     * @return Goals|null
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param Goals $steps
     * @return $this
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
        return $this;
    }

}
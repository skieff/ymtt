<?php

namespace  AppBundle\Templates;

use Yandex\Metrica\Management\Models\Goal;

interface GoalBuilderInterface {
    /**
     * @return Goal[]
     */
    public function createGoal();
}
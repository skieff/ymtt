<?php

namespace  AppBundle\Util\GoalBuilder;

use AppBundle\Metrica\Management\Models\Goal;
use AppBundle\Entity\CreateGoalsTask;

interface BuilderInterface {
    const GOAL_NAME = 'goalName';

    /**
     * @param CreateGoalsTask $createTask
     * @param array $options
     * @return Goal[]|\Iterator
     */
    public function build(CreateGoalsTask $createTask, array $options = []);
}
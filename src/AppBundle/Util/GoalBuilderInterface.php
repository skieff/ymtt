<?php

namespace  AppBundle\Util;

use AppBundle\Metrica\Management\Models\Goal;
use AppBundle\Entity\CreateGoalsTask;

interface GoalBuilderInterface {
    const GOAL_NAME = 'goalName';

    /**
     * @param CreateGoalsTask $createTask
     * @param array $options
     * @return Goal[]|\Iterator
     * @todo move builders to subfolder
     */
    public function build(CreateGoalsTask $createTask, array $options = []);
}
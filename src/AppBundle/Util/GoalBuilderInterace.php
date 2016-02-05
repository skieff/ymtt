<?php

namespace  AppBundle\Util;

use AppBundle\Metrica\Management\Models\Goal;

interface GoalBuilderInterface {
    const GOAL_NAME = 'goalName';

    /**
     * @param array $options
     * @param string $prefix
     * @return Goal[]|\Iterator
     */
    public function build(array $options = [], $prefix = '');
}
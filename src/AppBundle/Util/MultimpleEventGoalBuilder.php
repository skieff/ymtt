<?php

namespace AppBundle\Util;

use AppBundle\Metrica\Management\Models\Goal;

class MultipleEventGoalBuilder implements GoalBuilderInterface {
    const EVENT_NAME_TEMPLATE = 'eventNameTemplate';
    const STEP_NAME_TEMPLATE = 'stepNameTemplate';
    const EVENTS = 'events';

    /**
     * @param array $options
     * @param string $prefix
     * @return Goal[]|\Iterator
     */
    public function build(array $options = [], $prefix = '')
    {
        if (!isset($options[self::EVENTS])) {
            throw new \RuntimeException(self::EVENTS . ' option is not set.');
        }

        $goalName = isset($options[self::GOAL_NAME]) ? $options[self::GOAL_NAME] : uniqid('Goal-');

        $goalConfig = [
            'name' => $goalName,
            'type' => 'step',
            'steps' => [
            ],
            'class' => 0,
        ];

        $position = 1;
        foreach ($options[self::EVENTS] as $eventOptions) {
            $goalConfig['steps'][] = $this->buildStep($eventOptions, $position++, $prefix);
        }

        return new \ArrayIterator([
            new Goal($goalConfig),
        ]);
    }

    private function buildStep(array $eventOptions, $position, $eventPrefix) {
        $eventNameTemplate = isset($eventOptions[self::EVENT_NAME_TEMPLATE])
                ? $eventOptions[self::EVENT_NAME_TEMPLATE]
                : '';

        $stepNameTemplate = isset($eventOptions[self::STEP_NAME_TEMPLATE])
                ? $eventOptions[self::STEP_NAME_TEMPLATE]
                : 'step %s';

        return [
            'name' => str_replace('%position%', $position, $stepNameTemplate),
            'type' => 'action',
            'conditions' => [
                ['type' => 'exact', 'url' => str_replace('%prefix%', $eventPrefix, $eventNameTemplate)],
            ]
        ];
    }
}
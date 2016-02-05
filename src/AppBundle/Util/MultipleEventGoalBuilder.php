<?php

namespace AppBundle\Util;

use AppBundle\Metrica\Management\Models\Goal;

class MultipleEventGoalBuilder implements GoalBuilderInterface {
    const EVENT_NAME_TEMPLATE = 'eventNameTemplate';
    const STEP_NAME_TEMPLATE = 'stepNameTemplate';
    const EVENTS = 'events';
    /**
     * @var array
     */
    private $defaultEventOptions;

    public function __construct(array $defaultEventOptions = [])
    {
        $this->defaultEventOptions = $defaultEventOptions;
    }

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
        $eventOptions = array_merge($this->defaultEventOptions, $eventOptions);

        $eventNameTemplate = isset($eventOptions[self::EVENT_NAME_TEMPLATE])
                ? $eventOptions[self::EVENT_NAME_TEMPLATE]
                : 'event%position%';

        $stepNameTemplate = isset($eventOptions[self::STEP_NAME_TEMPLATE])
                ? $eventOptions[self::STEP_NAME_TEMPLATE]
                : 'step %position%';

        return [
            'name' => str_replace('%position%', $position, $stepNameTemplate),
            'type' => 'url',
            'conditions' => [
                ['type' => 'action', 'url' => str_replace(
                    ['%prefix%', '%position%'],
                    [$eventPrefix, $position],
                    $eventNameTemplate
                )],
            ]
        ];
    }
}
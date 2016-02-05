<?php

namespace AppBundle\Util;

use AppBundle\Metrica\Management\Models\Goal;

class SimpleEventBuilder implements GoalBuilderInterface {
    const EVENT_NAME_TEMPLATE = 'eventNameTemplate';

    /**
     * @inheritdoc
     */
    public function build(array $options = [], $prefix = '')
    {
        $eventNameTemplate = isset($options[self::EVENT_NAME_TEMPLATE])
            ? $options[self::EVENT_NAME_TEMPLATE]
            : 'eventName';

        $goalName = isset($options[self::GOAL_NAME]) ? $options[self::GOAL_NAME] : uniqid('Goal-');

        $goalConfig = [
            'name' => $goalName,
            'type' => 'action',
            'conditions' => [
                ['type' => 'exact', 'url' => sprintf($eventNameTemplate, $prefix)],
            ],
            'class' => 0,
        ];

        return new \ArrayIterator([
            new Goal($goalConfig),
        ]);
    }
}
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
            : '%prefix%Event';

        $goalName = isset($options[self::GOAL_NAME]) ? $options[self::GOAL_NAME] : uniqid('Goal-');

        $goalConfig = [
            'name' => $goalName,
            'type' => 'action',
            'conditions' => [
                ['type' => 'exact', 'url' => str_replace('%prefix%', $prefix, $eventNameTemplate)],
            ],
            'class' => 0,
        ];

        return new \ArrayIterator([
            new Goal($goalConfig),
        ]);
    }
}
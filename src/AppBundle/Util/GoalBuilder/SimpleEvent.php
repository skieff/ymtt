<?php

namespace AppBundle\Util\GoalBuilder;

use AppBundle\Entity\CreateGoalsTask;
use AppBundle\Metrica\Management\Models\Goal;

class SimpleEvent implements BuilderInterface {
    const EVENT_NAME_TEMPLATE = 'eventNameTemplate';

    /**
     * @inheritdoc
     */
    public function build(CreateGoalsTask $createTask, array $options = [])
    {
        $eventNameTemplate = isset($options[self::EVENT_NAME_TEMPLATE])
            ? $options[self::EVENT_NAME_TEMPLATE]
            : '%prefix%Event';

        $goalName = isset($options[self::GOAL_NAME]) ? $options[self::GOAL_NAME] : uniqid('Goal-');

        $goalConfig = [
            'name' => $goalName,
            'type' => 'action',
            'conditions' => [
                [
                    'type' => 'exact',
                    'url' => str_replace('%prefix%', $createTask->getEventPrefix(), $eventNameTemplate)
                ],
            ],
            'class' => 0,
        ];

        return new \ArrayIterator([
            new Goal($goalConfig),
        ]);
    }
}
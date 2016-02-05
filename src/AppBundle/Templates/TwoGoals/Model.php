<?php

namespace AppBundle\Templates\TwoGoals;

use AppBundle\Metrica\Management\Models\Goal;
use AppBundle\Templates\GoalBuilderInterface;
use AppBundle\Templates\Simple\PrefixedEventGoal;
use Doctrine\Common\Collections\ArrayCollection;

class Model implements GoalBuilderInterface{
    /**
     * @var PrefixedEventGoal
     */
    protected $firstGoal;

    protected $goals;

    public function __construct() {
        $this->goals = new ArrayCollection([
            new PrefixedEventGoal(),
            new PrefixedEventGoal(),
            new PrefixedEventGoal(),
        ]);
    }

    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @return PrefixedEventGoal
     */
    public function getFirstGoal()
    {
        return $this->firstGoal;
    }

    /**
     * @param PrefixedEventGoal $firstGoal
     */
    public function setFirstGoal($firstGoal)
    {
        $this->firstGoal = $firstGoal;
    }

    /**
     * @return Goal[]
     */
    public function createGoal()
    {
        return array_merge(
            $this->getFirstGoal()->createGoal(),
            [
                new Goal([
                    'name' => 'complex',
                    'type' => 'step',
                    'steps' => [
                        [
                            'name' => 'step1',
                            'type' => 'action',
                            'conditions' => [
                                ['type' => 'exact', 'url' => 'step1'],
                            ]
                        ],
                    ]
                ]),
            ]
        );
    }
}
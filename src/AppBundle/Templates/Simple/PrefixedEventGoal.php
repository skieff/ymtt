<?php

namespace AppBundle\Templates\Simple;

use AppBundle\Templates\GoalBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Yandex\Metrica\Management\Models\Goal;

class PrefixedEventGoal implements GoalBuilderInterface{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $prefix;

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return Goal[]
     */
    public function createGoal()
    {
        return [
            new Goal([
                'name' => 'simple goal 1234',
                'type' => 'action',
                'conditions' => [
                    ['type' => 'exact', 'url' => $this->getPrefix()],
                ],
                'class' => 0,
            ]),
        ];
    }
}
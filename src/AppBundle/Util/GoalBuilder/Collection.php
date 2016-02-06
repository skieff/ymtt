<?php

namespace AppBundle\Util\GoalBuilder;

use AppBundle\Entity\CreateGoalsTask;

class Collection implements BuilderInterface{
    /** @var  BuilderInterface */
    protected $builders;

    /**
     * @var array
     */
    private $defaultOptions;

    public function __construct(array  $defaultOptions = []) {
        $this->defaultOptions = $defaultOptions;
    }

    /**
     * @inheritdoc
     */
    public function build(CreateGoalsTask $createTask, array $options = []) {
        $options = array_merge($this->defaultOptions, $options);

        $result = new \AppendIterator();

        foreach ($options as $builderAlias => $builderOptions) {
            $result->append($this->findBuilder($builderAlias)->build($createTask, $builderOptions));
        }

        return $result;
    }

    /**
     * @param $alias
     * @param BuilderInterface $builder
     */
    public function registerBuilder($alias, BuilderInterface $builder) {
        $this->builders[$alias] = $builder;
    }

    /**
     * @param $builderAlias
     * @return BuilderInterface
     */
    private function findBuilder($builderAlias) {
        if (!isset($this->builders[$builderAlias])) {
            throw new \RuntimeException('Builder ' . $builderAlias . ' is not registered.');
        }

        return $this->builders[$builderAlias];
    }
}
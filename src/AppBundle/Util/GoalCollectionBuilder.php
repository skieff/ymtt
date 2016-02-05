<?php

namespace AppBundle\Util;

class GoalCollectionBuilder implements GoalBuilderInterface{
    /** @var  GoalBuilderInterface */
    protected $builders;

    /**
     * @inheritdoc
     */
    public function build(array $options = [], $prefix = '') {
        $result = new \AppendIterator();

        foreach ($options as $builderAlias => $builderOptions) {
            $result->append($this->findBuilder($builderAlias)->build($builderOptions, $prefix));
        }

        return $result;
    }

    /**
     * @param $alias
     * @param GoalBuilderInterface $builder
     */
    protected function registerBuilder($alias, GoalBuilderInterface $builder) {
        $this->builders[$alias] = $builder;
    }

    /**
     * @param $builderAlias
     * @return GoalBuilderInterface
     */
    private function findBuilder($builderAlias) {
        if (!isset($this->builders[$builderAlias])) {
            throw new \RuntimeException('Builder ' . $builderAlias . ' is not registered.');
        }

        return $this->builders[$builderAlias];
    }
}
<?php

namespace AppBundle\Templates\Simple;

use AppBundle\Templates\BuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;

class Builder implements BuilderInterface {

    public function build($alias, FormBuilderInterface $builder)
    {
        $builder->add($alias, GoalType::class);
    }
}
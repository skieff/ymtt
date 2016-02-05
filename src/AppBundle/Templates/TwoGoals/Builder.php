<?php

namespace AppBundle\Templates\TwoGoals;

use AppBundle\Templates\BuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;

class Builder implements BuilderInterface {

    public function build($alias, FormBuilderInterface $builder)
    {
        $builder->add($alias, FormType::class, ['data' => new Model()]);
    }
}
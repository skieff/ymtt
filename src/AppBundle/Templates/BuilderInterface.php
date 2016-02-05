<?php

namespace AppBundle\Templates;

use Symfony\Component\Form\FormBuilderInterface;

interface BuilderInterface {
    public function build($alias, FormBuilderInterface $builder);
}
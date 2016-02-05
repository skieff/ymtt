<?php

namespace AppBundle\Templates\TwoGoals;

use AppBundle\Templates\Simple\GoalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstGoal', GoalType::class)
            ->add('goals', CollectionType::class, ['entry_type' => GoalType::class]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Model::class);
    }


}
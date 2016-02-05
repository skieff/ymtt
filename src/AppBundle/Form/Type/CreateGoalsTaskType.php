<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\CreateGoalsTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateGoalsTaskType extends AbstractType {
    const COUNTER_CHOICES = 'counterChoices';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('counter', ChoiceType::class, [
                'choices' => array_flip($options[self::COUNTER_CHOICES]),
                'choices_as_values' => true,
                'placeholder' => 'Select counter',
            ])
            ->add('eventPrefix')
            ->add('create', SubmitType::class, ['label' => 'Create']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', CreateGoalsTask::class);
        $resolver->setRequired([self::COUNTER_CHOICES]);
        $resolver->setAllowedTypes(self::COUNTER_CHOICES, ['array']);
    }
}
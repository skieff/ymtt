<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectTemplateType extends AbstractType {
    const TEMPLATE_CHOICES = 'templateChoices';
    const COUNTER_CHOICES = 'counterChoices';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('counter', ChoiceType::class, [
                'choices' => array_flip($options[self::COUNTER_CHOICES]),
                'choices_as_values' => true,
                'required' => true,
                'placeholder' => 'Select counter',
//                'choice_label' => function($value) {
//                    return ucfirst($value);
//                },
            ])
            ->add('template', ChoiceType::class, [
                'choices' => $options[self::TEMPLATE_CHOICES],
                'choices_as_values' => true,
                'required' => true,
                'placeholder' => 'Select template',
                'choice_label' => function($value) {
                    return ucfirst($value);
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([self::TEMPLATE_CHOICES, self::COUNTER_CHOICES]);
        $resolver->setAllowedTypes(self::TEMPLATE_CHOICES, ['array']);
        $resolver->setAllowedTypes(self::COUNTER_CHOICES, ['array']);
    }


}
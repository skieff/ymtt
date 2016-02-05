<?php

namespace AppBundle\Util;

use AppBundle\Form\Type\SelectTemplateType;
use AppBundle\Templates\BuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class FormBuilder {

    /**
     * @var BuilderInterface[]
     */
    protected $templateBuilders = [];

    public function build(FormBuilderInterface $formBuilder, array $counterList) {
        $formBuilder->add(
            'selectTemplate',
            SelectTemplateType::class,
            [
                SelectTemplateType::TEMPLATE_CHOICES => $this->getTemplateChoices(),
                SelectTemplateType::COUNTER_CHOICES => $counterList,
            ]
        );

        foreach ($this->templateBuilders as $alias => $templateBuilder) {
            $templateBuilder->build($alias, $formBuilder);
        }

        $formBuilder->add('create', SubmitType::class, ['label' => 'Create']);

        return $formBuilder;
    }

    public function getSelectForm(FormInterface $form) {
        return $form->get('selectTemplate');
    }

    public function getSelectedTemplateForm(FormInterface $form) {
        $selectedTemplateId = $this->getSelectForm($form)->get('template')->getData();
        return $form->get($selectedTemplateId);
    }

    public function registerTemplateBuilder($alias, BuilderInterface $builderInstance) {
        $this->templateBuilders[$alias] = $builderInstance;
    }

    protected function getTemplateChoices() {
        return array_keys($this->templateBuilders);
    }
}
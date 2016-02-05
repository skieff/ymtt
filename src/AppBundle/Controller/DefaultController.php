<?php

namespace AppBundle\Controller;

use AppBundle\Templates\GoalBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $apiWrapper = $this->get('app.util.api_wrapper');
        $counters = $apiWrapper->getCounterList();
        $formBuilder = $this->get('app.utils.form_builder');
        $form = $formBuilder->build($this->createFormBuilder(), $counters)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $selectForm = $formBuilder->getSelectForm($form);
            if ($selectForm->isValid()) {
                /** @var GoalBuilderInterface $template */
                $template = $formBuilder->getSelectedTemplateForm($form)->getData();

                $apiWrapper->addGoals($selectForm->get('counter')->getData(), $template->createGoal());
            }

        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CreateGoalsTask;
use AppBundle\Form\Type\CreateGoalsTaskType;
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
        $form = $this->createForm(
            CreateGoalsTaskType::class,
            null,
            [CreateGoalsTaskType::COUNTER_CHOICES => $counters]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateGoalsTask $createTask */
            $createTask = $form->getData();
            $goals      = $this->get('app.util.goal_collection_builder')->build([], $createTask->getEventPrefix());

            $apiWrapper->addGoals($createTask->getCounter(), $goals);

            $this->addFlash('notice', 'Goals added.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

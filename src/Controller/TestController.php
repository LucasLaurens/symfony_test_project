<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Post;
use App\Form\MessageType;
use App\Form\PostType;
use App\Message\MailNotification;
use App\Repository\MessageRepository;
use App\Repository\PostRepository;
use App\Services\Calculator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

class TestController extends AbstractController
{
    public function __construct(protected Calculator $calculator)
    {
    }

    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request, EntityManagerInterface $em, MessageBusInterface $bus, MessageRepository $messageRepository): Response
    {
        $task = new Message();
        $task->setCreatedAt(new DateTime('now'))
             ->setUpdatedAt(new DateTime('now'));
 
        $form = $this->createForm(MessageType::class, $task);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
 
            $em->persist($task);
            $em->flush();

            try {
                $bus->dispatch(new MailNotification($task->getId(), $task->getSubject(), $task->getContent(), $task->getIsOnline()));
            } catch (\LogicException $e) {
                throw new \Exception("The dispatch has encountered a problem: " . $e->getMessage());
            }
 
            return $this->redirectToRoute('test');
        }

        return $this->render('test/index.html.twig', [
            'form' => $form->createView(),
            'messages' => $messageRepository->findAll()
        ]);
    }

    /**
     * @Route("/homepage", name="homepage", methods={"GET","POST"})
     */
    public function homePageAction(Request $request, EntityManagerInterface $em, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
 
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('homepage/index.html.twig', [
            'form' => $form->createView(),
            'posts' => $postRepository->findAll()
        ]);
    }

    /**
     * @Route("/second-test/{age<\d+>?1}", name="second.test")
     */
    public function secondTest(Request $req, $age) {
        // query = param url
        // $age = $req->query->get('age', 0);
        // attributes = attribute slug
        // $age = $req->attributes->get('age');
        
        // return new Response("Vous avez $age ans", 200);
        $tva = $this->calculator->tva(100, 20);
        dd($tva);
    }
}

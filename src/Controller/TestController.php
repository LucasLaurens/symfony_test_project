<?php

namespace App\Controller;

use DateTime;

use App\Services\Calculator;
use App\Message\MailNotification;

use App\Entity\Message;
use App\Entity\Post;

use App\Form\MessageType;
use App\Form\PostType;

use App\Repository\PostRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Messenger\MessageBusInterface;

class TestController extends AbstractController
{
    public function __construct(
        protected Calculator $calculator,
        private MailerInterface $mailer,
        private MessageRepository $messageRepository,
        private EntityManagerInterface $em
    )
    {
    }

    // #[Route('/autowiring/message/{id}', name: 'autowiring.message.test')]
    // #[ParamConverter('message', class: 'SensioBlogBundle:Post')]
    public function autowiringMessageTest(?Message $message): Response
    {
        if (null === $message) {
            return new Response('There are no messages that match this id', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new Response($message->getSubject(), Response::HTTP_OK);
    }

    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request, MessageBusInterface $bus, MessageRepository $messageRepository): Response
    {
        $message = new Message();
        $message->setCreatedAt(new DateTime('now'))
             ->setUpdatedAt(new DateTime('now'));

        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();

            try {
                // * Before using symfony messenger with queues
                // $email = (new Email())
                //     ->from('me@example.com')
                //     ->to('you@example.com')
                //     ->subject('test')
                //     ->html('<p>test</p>');

                // $this->mailer->send($email);

                // sleep(10);

                // try {
                //     $message = new Message();
                //     $message->setIsOnline(true);
                //     $message->setContent($notification->getContent());
                //     $message->setSubject($notification->getSubject());

                //     $this->em->persist($message);
                //     $this->em->flush();
                // } catch (\Exception $e) {
                //     dd($e->getMessage());
                // }


                // @todo Explain in commentary what the bus is for
                $bus->dispatch(new MailNotification($message));
            } catch (\LogicException $e) {
                throw new \Exception("The dispatch has encountered a problem: " . $e->getMessage());
            }

            return $this->redirectToRoute('test');
        }

        // @todo Recover messenger logs to see which messages have not been consumed
        $messages = $messageRepository->findBy(['is_online' => true], ['id' => 'DESC']);

        return $this->render('test/index.html.twig', [
            'form' => $form->createView(),
            'messages' => $messages,
            'count' => count($messages)
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
            'posts' => $postRepository->findAll(),
            'lastPost' => $postRepository->findBy([], ['id' => 'DESC'], 1, 0)[0]
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

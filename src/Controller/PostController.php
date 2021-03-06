<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Entity\PostInterface;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * @Route("/post")
 */
class PostController extends AbstractController
{
    public function __construct(private WorkflowInterface $postRequestWorkflow)
    {
    }

    /**
     * @Route("/", name="post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods={"GET","POST"})
     */
    // public function new(Request $request): Response
    // {
    //     $post = new Post();
    //     $form = $this->createForm(PostType::class, $post);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $post = $form->getData();
    //         $post->setState('new');
    //         $this->getDoctrine()->getManager()->persist($post);
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('post/new.html.twig', [
    //         'post' => $post,
    //         'form' => $form,
    //     ]);
    // }

    /**
     * @Route("/{id}", name="post_show", methods={"GET"})
     */
    // #[ParamConverter('post', class: Post::class)]
    // public function show(PostInterface $post): Response
    // {
    //     return $this->render('post/show.html.twig', [
    //         'post' => $post,
    //     ]);
    // }

    /**
     * @Route("/{id}/edit", name="post_edit", methods={"GET","POST"})
     */
    // #[ParamConverter('post', class: Post::class)]
    // public function edit(Request $request, PostInterface $post): Response
    // {
    //     $form = $this->createForm(PostType::class, $post);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $post = $form->getData();
    //         $post->setState('pending');

    //         dd($this->postRequestWorkflow->can($post, 'to_pending'));

    //         dd($this->postRequestWorkflow->apply($post, 'to_pending'));
    //         try {
    //             dd($post);
    //             $this->postRequestWorkflow->apply($post, 'to_pending');
    //         } catch (\LogicException $e) {
    //             dd($e->getMessage());
    //         }

    //         dd($post);

    //         $this->getDoctrine()->getManager()->persist($post);
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('post/edit.html.twig', [
    //         'post' => $post,
    //         'form' => $form,
    //     ]);
    // }

    /**
     * @Route("/{id}", name="post_delete", methods={"POST"})
     */
    // #[ParamConverter('post', class: Post::class)]
    // public function delete(Request $request, PostInterface $post): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($post);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
    // }

    /**
     * @Route("/test-1", name="test_1", methods={"GET"})
     */
    public function test1(): Response
    {
        $post = new Post();
        $post->setContent('lorem');
        // $post->setAuthor('lorem');
        $post->setState('online');
        $post->setTitle('test');

        return $this->render('post/test.html.twig', [
            'post' => $post,
        ]);
    }
}

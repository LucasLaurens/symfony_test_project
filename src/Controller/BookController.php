<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books
        ]);
    }

    #[Route('/book/add', name: 'app_book_add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $this->getDoctrine()->getManager()->persist($book);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_book');
        }

        return $this->renderForm('book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

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
}

<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Services\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository,
        private CartService $cartService
    )
    {}

    #[Route('/books', name: 'app_books')]
    public function index(): Response
    {
        return $this->render('cart/books.html.twig', [
            'controller_name' => 'CartController',
            'books' => $this->bookRepository->findAll()
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('cart/cart.html.twig', [
            'items' => $this->cartService->getFullItems(),
            'totalAmount' => $this->cartService->getTotalAmount()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_add_book')]
    public function add(int $id): Response
    {
        $this->cartService->add($id);

        return $this->redirectToRoute('app_books');
    }

    #[Route('/cart/remove/{id}', name: 'app_remove_book')]
    public function remove(int $id): Response
    {
        $this->cartService->remove($id);

        return $this->redirectToRoute('app_cart');
    }

    public function isGreaterThanZero()
    {
        return false;
    }
}

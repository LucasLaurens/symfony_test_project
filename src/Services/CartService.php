<?php

namespace App\Services;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    public function __construct(
        private BookRepository $bookRepository,
        private SessionInterface $session
    )
    {}

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            if (1 < $panier[$id]) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $this->session->set('panier', $panier);
    }

    public function getFullItems(): array
    {
        $panier = $this->session->get('panier', []);

        $datas = [];
        foreach ($panier as $id => $quantity) {
            $datas[] = [
                'book' => $this->bookRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $datas;
    }

    public function getTotalAmount(): float
    {
        $total = 0;
        foreach ($this->getFullItems() as $item) {
            $total += $item['book']->getPrice() * $item['quantity'];
        }

        return $total;
    }
}

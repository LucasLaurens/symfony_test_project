<?php

namespace App\Controller;

use App\Services\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    protected $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;    
    }

    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
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

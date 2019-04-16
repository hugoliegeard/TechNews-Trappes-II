<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{

    /**
     * Page d'Accueil
     */
    public function index()
    {
        return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
    }

    /**
     * Page de Contact
     */
    public function contact()
    {
        return new Response("<html><body><h1>PAGE CONTACT</h1></body></html>");
    }

    /**
     * Page permettant d'afficher
     * les articles d'une catégorie
     * @Route("/categorie/{slug<[a-zA-Z0-9\-_\/]+>}",
     *     defaults={"slug"="default"},
     *     methods={"GET"},
     *     name="default_categorie")
     */
    public function categorie($slug)
    {
        return new Response("<html><body><h1>PAGE CATEGORIE : $slug</h1></body></html>");
    }

}
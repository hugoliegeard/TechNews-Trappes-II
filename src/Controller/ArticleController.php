<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * Démonstration de l'ajout d'un
     * Article avec Doctrine.
     * @Route("/demo/article", name="article_demo")
     */
    public function demo()
    {
        # Création d'une Catégorie
        $categorie = new Categorie();
        $categorie->setNom("Politique");
        $categorie->setSlug("politique");

        # Création d'un Auteur (Membre)
        $membre = new Membre();
        $membre->setPrenom("Hugo")
                ->setNom("LIEGEARD")
                ->setEmail("hugo@technews.com")
                ->setPassword("test")
                ->setRoles(['ROLE_AUTEUR'])
                ->setDateInscription(new \DateTime());

        # Création de l'Article
        $article = new Article();
        $article->setTitre("Notre-Dame de Paris : pourra-t-on la reconstruire en 5 ans ?")
                ->setSlug("notre-dame-de-paris-pourra-t-on-la-reconstruire-en-5-ans")
                ->setContenu("<p>Bâtie en presque 200 ans, la cathédrale Notre-Dame de Paris se prépare à un chantier pharaonique pour retrouver son éclat. Mais quand pouvoir débuter les travaux ? Pour le moment, l'heure est au diagnostic. La structure a été fragilisée par les tonnes d'eau déversée pour éteindre l'incendie. Il faudra ensuite démonter l'immense échafaudage.</p>")
                ->setFeaturedImage("19113767.jpg")
                ->setSpotlight(1)
                ->setSpecial(0)
                ->setMembre($membre)
                ->setCategorie($categorie)
                ->setDateCreation(new \DateTime())
        ;

        /*
         * Récupération du Manager de Doctrine
         * ------------------------------------
         * Le EntityManager est une classe qui
         * sait comment persister d'autres
         * classes. (Effectuer des opérations
         * CRUD sur nos Entités).
         */

        $em = $this->getDoctrine()->getManager(); // Permet récuperer le EntityManager de Doctrine.

        $em->persist($categorie); // J'enregistre dans ma base la catégorie
        $em->persist($membre); // Le Membre
        $em->persist($article); // Et l'article

        $em->flush(); // J'execute le tout.

        # Retourner une réponse à la vue
        return new Response('Nouvel Article ajouté avec ID : '
            . $article->getId()
            . 'et la nouvelle categorie '
            . $categorie->getNom()
            . 'de Auteur : '
            . $membre->getPrenom()
        );

    }

}
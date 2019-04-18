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
        $categorie->setNom("Sport");
        $categorie->setSlug("Sport");

        /*$categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->find(1);*/

        # Création d'un Auteur (Membre)
        /*$membre = new Membre();
        $membre->setPrenom("Hugo")
                ->setNom("LIEGEARD")
                ->setEmail("hugo@technews.com")
                ->setPassword("test")
                ->setRoles(['ROLE_AUTEUR'])
                ->setDateInscription(new \DateTime());*/

        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find(1);

        # Création de l'Article
        $article = new Article();
        $article->setTitre('Foot : Liverpool et Tottenham se qualifient pour les demi-finales de la Ligue des champions')
                ->setSlug("foot-liverpool-et-tottenham-se-qualifient-pour-les-demi-finales-de-la-ligue-des-champions")
                ->setContenu('<p>Tout droit vers les demi-finales ! Liverpool et Tottenham se sont qualifiés pour les demi-finales de la Ligue des champions, mercredi 17 avril. Après leur victoire 2-0 au match aller, les coéquipiers de Mohamed Salah ont facilement battu le FC Porto 1 à 4. Les Reds affronteront le FC Barcelone au prochain tour.</p>')
                ->setFeaturedImage("19123863.jpg")
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
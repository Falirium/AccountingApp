<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit", name="produit.")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="consultAll")
     * @param ProduitRepository $produitRepository
     * @return Response
     */
    public function index(ProduitRepository $produitRepository)
    {
        // Fetch all the clients
        $produits = $produitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
       
    }
    /**
     * @Route("/consulter/{idProduit}", name="consultOne")
     * @param Produit $produit
     * @return Response
     */
    public function consultOne(Produit $produit) {
        // We have already have $produit from paramConverter

        return $this->render('produit/consult.html.twig', [
            'produit'      =>$produit ,

        ]);
    }

    /**
     * 
     * @Route("/modifier/{idProduit}" , name="update")
     * @param Request $request
     * @param Produit|null $produit
     * @return Response
     */
    public function add(Request $request, Produit $produit= null) {
        // create produit
        if (!$produit){
            $produit = new Produit();
        }
        //
        //create a form
        $form = $this->createForm(ProduitType::class , $produit);


        $form->handleRequest($request);
        dump($produit);

        if ($form->isSubmitted() && $form->isValid()) {
            // create the manager
            $e_m = $this->getDoctrine()->getManager();

            // the chages have already done


            // Prepare + Push
            $e_m->persist($produit);
            $e_m->flush();

            // Return to produit single page
            return $this->render('produit/consult.html.twig', [
                'idProduit'  =>$produit->getIdProduit()
            ]);

        }

        return $this->render('produit/update.html.twig',[
            "form_produit"      =>$form->createView()
        ]);
    }

}

<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/achat", name="achat.")
 */

class AchatController extends AbstractController
{


    /**
     * @Route("/", name="consultAll")
     * @param AchatRepository $achatRepository
     * @return Response
     */
    public function index(AchatRepository $achatRepository)
    {
        // Fetch all the clients
        $achats = $achatRepository->findAll();

        return $this->render('achat/index.html.twig', [
            'achats' => $achats
        ]);
    }

    /**
     * @Route("/consulter/{idAchat}", name="consultOne")
     * @param Achat $achat
     * @return Response
     */
    public function consultOne(Achat $achat) {
        // We have already have $achat from paramConverter

        // Fetch the achat's products
        $produitsAchats = $achat->getCommande()->getProduits()->toArray();
        return $this->render('achat/consult.html.twig', [
            'achat'      =>$achat ,
            'produits'  => $produitsAchats
        ]);
    }

    /**
     * @Route("/consulter/{idAchat}", name="consultPerClient")
     * @param Achat $achat
     * @return Response
     */
    /*
    public function consultPerFornisseur(Achat $achat) {
        // We have already have $achat from paramConverter

        //Fetch all client's ventes
        $ventes = $client->getVentes()->toArray();
        return $this->render('client/consult.html.twig', [
            'ventes'      =>$ventes
        ]);
    }
    */
}

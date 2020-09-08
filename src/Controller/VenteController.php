<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Vente;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/vente", name="vente.")
 */
class VenteController extends AbstractController
{
    /**
     * @Route("/", name="consultAll")
     * @param VenteRepository $venteRepository
     * @return Response
     */
    public function index(VenteRepository $venteRepository)
    {
        // Fetch all the clients
        $ventes = $venteRepository->findAll();

        return $this->render('vente/index.html.twig', [
            'ventes' => $ventes,
        ]);
    }




    /**
     * @Route("/consulter/{idVente}", name="consultOne")
     * @param Vente $vente
     * @return Response
     */
    public function consultOne(Vente $vente) {
        // We have already have $vente from paramConverter

        // Fetch all the products
        $produitsVentes = $vente->getCommande()->getProduits()->toArray();

        return $this->render('vente/consult.html.twig', [
            'vente'      =>$vente ,
            'produits'  =>$produitsVentes
        ]);
    }

    /**
     * @Route("/consulter/{idClient}", name="consultPerClient")
     * @param Client $client
     * @return Response
     */
    public function consultPerClient(Client $client) {
        // We have already have $client from paramConverter

        //Fetch all client's ventes
        $ventes = $client->getVentes()->toArray();
        return $this->render('client/consult.html.twig', [
            'ventes'      =>$ventes
        ]);
    }


}

<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande", name="commande.")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="consultAll")
     * @param CommandeRepository $commandeRepository
     * @return Response
     */
    public function index(CommandeRepository $commandeRepository)
    {
        // Fetch all the commandes
        $commandes = $commandeRepository->findAll();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("/ajouter" , name="add")
     * @Route("/modifier/{idCommande}" , name="update")
     * @param Request $request
     * @param Commande|null $commande
     * @return Response
     */
    public function add(Request $request, Commande $commande= null) {
        // create commande
        if (!$commande){
            $commande = new Commande();
        }
        //
        //create a form
        $form = $this->createForm(CommandeType::class , $commande);


        $form->handleRequest($request);
        dump($commande);

        if ($form->isSubmitted() && $form->isValid()) {
            // create the manager
            $e_m = $this->getDoctrine()->getManager();

            // Pass some conditions on the commande

            // Add other attributes to $commande
            $idCommande = "";
            $commande->setIdCommande($idCommande);

            // Get the form data

            $formData = $form->getData();
            dump($formData);

            // Create an achat | vente object


            // Prepare + Push
            $e_m->persist($commande);
            $e_m->flush();

            // Return to commande single page
            return $this->render('commande/consult.html.twig' , [
                'idCommande'  =>$commande->getIdCommande()
            ]);

        }

        return $this->render('commande/consult.html.twig',[
            "form_commande"      =>$form->createView()
        ]);
    }

    /**
     * @Route("/consulter/{idCommande}", name="consultOne")
     * @param Commande $commande
     * @return Response
     */
    public function consultOne(Commande $commande) {
        // We have already have $commande from paramConverter

        return $this->render('commande/consult.html.twig', [
            'commande'      =>$commande
        ]);
    }
    /**
     * @Route("supprimer/{idCommande}", name="delete")
     * @param Commande $commande
     * @return Response
     */
    public function deleteOne(Commande $commande){

        // We have already $commande to delete

        //Check if $commande not null
        if($commande){

            // import doctrine manager
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);

            //Remove the accociated vente | achat
            // Check if it is a vente | achat

            // Push to the database
            $em->flush();
        }
        return $this->redirect($this->generateUrl('commande.consultAll'));
    }

    /**
     * @Route("/client/{idClient}" , name="consultClientVentes")
     * @param Client $client
     * @return Response
     */
    public function consultClientVentes(Client $client) {
        // Fetch the client's ventes
        $clientVentes = $client->getVentes()->toArray();

        return $this->render('vente/index.html.twig', [
            'ventes'    =>$clientVentes
        ]);
    }

    /**
     * @Route("/achats/{idFornisseur}" , name="consultFornisseurAchats")
     */
}

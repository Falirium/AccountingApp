<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Produit;


use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idCommande')
            ->add('createdAt')

            ->add('nomProduit', EntityType::class , [
                'class' =>  Produit::class,
                'choice_label'  =>  'nomProduit'
            ])
            ->add('isVente', CheckboxType::class , [
                'label'    => 'Est une Vente?',
                'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}

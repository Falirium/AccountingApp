<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProduit')
            ->add('categoryProduit')
            ->add('typeProduit')
            ->add('prixUnitProduit')
            ->add('nomProduit')
            ->add('descriptionProduit')
            ->add('designationProduit')
            ->add('stockProduit')
            ->add('taxeProduit')
            ->add('commandes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Froute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FrouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('animateur')
            ->add('producteur')
            ->add('technicien')
            ->add('tempsDirect')
            ->add('tempsEnregistrement')
            ->add('source')
            ->add('theme')
            ->add('format')
            ->add('qui')
            ->add('duréeTotal')
            ->add('notes')
            ->add('image')
            ->add('createdAt')
            ->add('date')
            ->add('invitePrincipal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Froute::class,
        ]);
    }
}

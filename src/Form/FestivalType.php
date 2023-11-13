<?php

namespace App\Form;

use App\Entity\Festival;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel', TextType::class)
           // ->add('slug')
            ->add('discription', TextareaType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"]
            ])
           // ->add('createdAt')
            ->add('authore', TextType::class,[
                'label' => 'auteur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\CatSoutien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatSoutienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => ' Nom de  l\'article'
            ])
            ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => ' l\'article',
            ])
            ->add('soustitre', TextType::class,[
                'label' => ' Nom du sous titre'
            ])
            ->add('action', TextType::class,[
                'label' => ' Nom de  l\'action'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CatSoutien::class,
        ]);
    }
}

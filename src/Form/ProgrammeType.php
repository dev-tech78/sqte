<?php

namespace App\Form;

use App\Entity\Programme;
use App\Entity\CategorieProgramme;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label' => ' Titre de  l\'votre programme'
            ])
            ->add('auther',TextType::class,[
                'label' => ' Responsable de  programme'
            ])
            ->add('text',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => ' Discription du  programme'
            ])
           // ->add('slug')
            ->add('createdAt',DateTimeType::class,[
                'label' => ' ',
                'date_widget' =>'single_text',
                'label' => ' Planing de  programme'
            ])
            ->add('categorieProgramme', EntityType::class,[
                'class' => CategorieProgramme::class,
                    'choice_label' => 'nom',
                    'attr' => [
                        'class' => 'select2'
                    ]
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Fiction;
use App\Entity\CategoriFiction;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class FictionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[

                'label' => 'Titre de film',
            ])
            ->add('type', TextType::class,[

                'label' => 'Genre',
            ])
            ->add('categoriFiction',EntityType::class, [
                'class' => CategoriFiction::class,
                'choice_label' => 'nom',
                'label' => 'La categorie du film',
                'attr' => [
                    'class' => 'select2'
                ]
              
             
               ])
               ->add('realisateur',TextType::class,[

                'label' => 'Nom  de Réalisateur',
            ])
            ->add('content', CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => 'Synopsis',
            ])
            ->add('image', FileType::class, [
                'label' => ' Télécharger La photo du film',
                'mapped' => false,  
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1048576K',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                           
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image ',
                    ])
                ],
            ]) 
           
          //  ->add('createdAt')
           // ->add('slug')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fiction::class,
        ]);
    }
}

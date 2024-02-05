<?php

namespace App\Form;

use App\Entity\Musique;
use App\Entity\CategorieMusique;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MusiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel', TextType::class,[

                'label' => 'Titre de l\'activité',
            ])
            //->add('slug')
            ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => 'Discription',
            ])
           // ->add('createdAt')
           ->add('image', FileType::class, [
            'label' => ' Télécharger La photo de votre activité',
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
            ->add('categorieMusique', EntityType::class, [
                'class' => CategorieMusique::class,
                'choice_label' => 'nom',
                'label' => 'Categorie de l\'activité',
                'attr' => [
                    'class' => 'select2'
                ]
              
             
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musique::class,
        ]);
    }
}

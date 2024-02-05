<?php

namespace App\Form;

use App\Entity\Image;


use App\Entity\Fiction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[

                'label' => 'Nom du comédien',
            ])
            ->add('fiction',EntityType::class, [
                'class' => Fiction::class,
                'choice_label' => 'title',
                'label' => 'Dans quel fiction a joué',
               // 'required' =>false,
                'attr' => [
                    'class' => 'select2'
                ]
              
             
               ])
               ->add('lien', FileType::class, [
                'label' => ' Télécharger votre photo',
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
               ->add('faceboock')
               ->add('instagram')
               ->add('snap')
               ->add('youtube')  
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Fiction;
use App\Entity\UtilsFilm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UtilsFilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('image', FileType::class, [
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
            ->add('nom', TextType::class)
           // ->add('fiction')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UtilsFilm::class,
        ]);
    }
}

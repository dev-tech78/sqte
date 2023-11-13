<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\CategorieAtelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel',TextType::class)
            ->add('discription',TextareaType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"]
            ])
            ->add('author',TextType::class)
            ->add('programme',TextType::class)
            //->add('createdAt')
           // ->add('slug')
            ->add('categorieAtelier', EntityType::class,[
                'class' => CategorieAtelier::class,
                    'choice_label' => 'nom'
                
            ])
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}

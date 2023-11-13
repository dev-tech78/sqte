<?php

namespace App\Form;

use App\Entity\Actualites;
use App\Entity\CategorieActu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ActualitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('categorieActu', EntityType::class, [
                'class' => CategorieActu::class,
                'choice_label' => 'nom',
               // 'required' =>false,
                'attr' => [
                    'class' => 'select2'
                ]
              
             
               ])
            ->add('content', HiddenType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"]
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
            //->add('createdAt')
            //->add('slug')
           // ->add('categorieActu')
          
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actualites::class,
        ]);
    }
}

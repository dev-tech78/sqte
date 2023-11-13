<?php

namespace App\Form;

use App\Entity\CategorieDoc;
use App\Entity\Documentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DocumentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('categorieDoc', EntityType::class, [
                'class' => CategorieDoc::class,
                'choice_label' => 'nom',
              
             
               ])
            ->add('content',TextareaType::class,[

               
                'label' => ' Synopsis'
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
           //->add('slug')
           // ->add('createdAt')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documentaire::class,
        ]);
    }
}

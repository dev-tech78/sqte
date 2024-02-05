<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\CategorieAtelier;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel',TextType::class,[
                'label' => ' Titre de  l\'atelier'
            ])
            ->add('discription',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"]
            ])
            ->add('author',TextType::class,[
                'label' => ' Auteur de  l\'atelier'
            ])
            ->add('programme',TextType::class)
            //->add('createdAt')
           // ->add('slug')
            ->add('categorieAtelier', EntityType::class,[
                'class' => CategorieAtelier::class,
                    'choice_label' => 'nom',
                    'attr' => [
                        'class' => 'select2'
                    ]
                
            ])
            ->add('image', FileType::class, [
                'label' => ' Image d\'en-tête  ',
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

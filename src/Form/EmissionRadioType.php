<?php

namespace App\Form;

use App\Entity\EmissionRadio;
use App\Entity\CategorieRadio;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EmissionRadioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('presentateur',TextType::class)
            ->add('lien',TextType::class)
            //->add('createdAt')
            ->add('discription',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"]
            ])
            ->add('categorieRadio',EntityType::class, [
                'class' => CategorieRadio::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
              
             
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
          //  ->add('createdAt')
            ->add('duree')
           // ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmissionRadio::class,
        ]);
    }
}

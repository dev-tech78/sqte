<?php

namespace App\Form;

use App\Entity\Festival;
use App\Entity\ImageFestival;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\All;

class ImageFestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('image', FileType::class, [
            'label' => ' Télécharger votre photo',
            'multiple' => true,
            'required' => false,
            'mapped' => false,
            'constraints' =>[
                new All([
                    'constraints' => [
                        new File([
                           'maxSize' => '1048576K'])

                    ]])
                            
            
            ]
                   
       ] )
         
           // ->add('content',CKEditorType::class,[

              //  'attr' =>['placeholder' => "Contenu de l'article"]
          //  ])
          
            ->add('festival', EntityType::class, [
                'class' => Festival::class,
                'choice_label' => 'authore',
               // 'required' =>false,
                'attr' => [
                    'class' => 'select2'
                ]
              
             
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageFestival::class,
        ]);
    }
}

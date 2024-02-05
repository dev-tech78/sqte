<?php

namespace App\Form;

use App\Entity\Sponsoring;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SponsoringType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => ' Titre du sponsor'
            ])
            ->add('image', FileType::class, [
                'label' => ' Image d\'en-tête  de votre sponsor',
           // 'multiple' => true,
            'required' => false,
            'mapped' => false,
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
            ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "text"],
                'label' => ' Discription',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsoring::class,
        ]);
    }
}

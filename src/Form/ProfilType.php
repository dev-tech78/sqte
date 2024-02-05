<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('avatar', FileType::class, [
                'label' => ' Image d\'en-tête  de votre article',
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
            ->add('poste')
            ->add('contact')
            ->add('experience')
            ->add('formation')
           // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}

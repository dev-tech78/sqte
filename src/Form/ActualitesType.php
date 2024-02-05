<?php

namespace App\Form;

use App\Entity\Actualites;
use App\Entity\CategorieActu;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ActualitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => ' Titre de  l\'article'
            ])
             ->add('categorieActu', EntityType::class, [
                'class' => CategorieActu::class,
                 'choice_label' => 'nom',
                 'required' =>false,
                 'attr' => [
                     'class' => 'select2'
                 ]
              
             
                ])
               ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => ' l\'article',
            ])
            ->add('image', FileType::class, [
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

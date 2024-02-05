<?php

namespace App\Form;

use App\Entity\Soutien;
use App\Entity\CatSoutien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class SoutienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label' => ' Titre de  l\'article'
            ] )
            ->add('price',MoneyType::class)
            //->add('slug')
            ->add('relstn', EntityType::class, [
                'class' => CatSoutien::class,
                 'choice_label' => 'nom',
                 'required' =>false,
                 'attr' => [
                     'class' => 'select2',
                 ]
              
             
                 ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soutien::class,
        ]);
    }
}

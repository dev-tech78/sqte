<?php

namespace App\Form;

use App\Entity\UserNewsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserNewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class)
           // ->add('createdAt')
            ->add('is_rgpd', CheckboxType::class,[
                'constraints' =>[
                    new IsTrue([
                        'message' => ''
                    ])

                    ],
                    'label' => ''
            ])
           // ->add('validation_token')
            //->add('isValid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserNewsletter::class,
        ]);
    }
}

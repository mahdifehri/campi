<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description',TextareaType::class,[
                "attr" =>[
                    "class" =>"form-control"
                ]
            ])
            ->add('image', FileType::class, array('data_class'=> null, 'required' => false))
            ->add('date',DateType::class)
            ->add('destination',TextType::class,[
                "attr"=>[
                    "class"=>"form-control"
                ]
            ])
            ->add('prix',TextType::class,[
                "attr" =>[
                    "class" =>"form-control"
                ]
            ])
            ->add('nbr_participants',HiddenType::class)
            ->add('nbr_participants_max',TextType::class,[
                "attr" =>[
                    "class" =>"form-control"
                ]
            ])
            ->add('etat',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}

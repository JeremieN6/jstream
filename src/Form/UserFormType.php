<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('email')
            // ->add('roles')
            // ->add('password')
            // ->add('firstname')
            // ->add('lastname')
            // ->add('created_at')
                // ->add('imageFile', VichImageType::class, [
                //     'label' => false,
                //     'label_attr' =>[
                //         'class' => 'rounded-circle img-fluid d-block mx-auto mb-3'
                //     ],
                //     'mapped' => false,
                //     'required' => false,
                //     'empty_data' => 'images/user/user.jpg',
                    
                // ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'attr' => ['placeholder' => 'Entre ton nouveau pseudo 🙂']
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de Naissance',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control date-input basicFlatpickr mb-0',
                    'id' => 'exampleInputPassword2'
                ]
            ])
            ->add('genre', ChoiceType::class,[
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => "homme",
                    'Femme' => 'femme',
                    'Non binaire' => 'non-binaire'
                ],
                'label' => false,
                'attr' => [
                    'class' => 'form-control pro-dropdown'
                ],
            ])
            ->add('favLangue', ChoiceType::class,[
                'label' => 'Langue préféré',
                'choices' => [
                    'Français' => "Français",
                    'Anglais' => 'Anglais',
                    'Espagnol' => 'Espagnol',
                    'Autre' => 'Autre'
                ],
                'label' => false,
                'attr' => [
                    'class' => 'form-control pro-dropdown'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Entre une courte description de toi 📰']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}

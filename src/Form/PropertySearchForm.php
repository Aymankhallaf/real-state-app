<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\PropertyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PropertySearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => false,
            ])
            ->add('purpose', ChoiceType::class, [
                'label' => 'Purpose',
                'choices' => [
                    '' => '',
                    'For Sale' => 'For Sale',
                    'For Rent' => 'For Rent',
                ],
            ])
            ->add('type',EntityType::class, [
                'class' => PropertyType::class,
                'choice_label' => 'name',
                'label' => 'Type',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

}
<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\PropertyType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\ImageForm;


class PropertyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('price')
            ->add('address')
            ->add('createdAt')
            ->add('room')
            ->add('bed')
            ->add('area')
            ->add('purpose')
            ->add('bathroom')
            ->add('type', EntityType::class, [
                'class' => PropertyType::class,
                'choice_label' => 'name',
            ])
            ->add('createdBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('ownedBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageForm::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Images',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}

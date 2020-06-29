<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Destination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_ville')
            ->add('des_ville')

            ->add('code_dest',EntityType::class,
            ['class'=>Destination::class,
            'choice_label'=>'des_dest',
            'label'=>'Destination'])
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}

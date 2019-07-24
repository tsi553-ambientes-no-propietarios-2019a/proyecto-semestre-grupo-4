<?php

namespace App\Form;

use App\Entity\Incidencia;
use App\Entity\Categoria;
use App\Entity\Denuncias;
use App\Form\EventListener\AddIncidenciaFieldListener;
use App\Form\EventListener\AddCategoriaFieldListener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class DenunciasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion')
            ->add('fecha')
            ->add('direccion')
            ->add('imageFile', VichImageType::class)

            ->addEventSubscriber(new AddCategoriaFieldListener())
            ->addEventSubscriber(new AddIncidenciaFieldListener());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Denuncias::class,
        ]);
    }
}

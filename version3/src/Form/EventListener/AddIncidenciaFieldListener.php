<?php
namespace App\Form\EventListener;
use App\Entity\Incidencia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;

class AddIncidenciaFieldListener implements EventSubscriberInterface {
    public static function getSubscribedEvents(){
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }
    private function addIncidenciaForm($form, $categoria_id){
        $formOptions = array(
            'class'         => Incidencia::class,
            'query_builder' => function (EntityRepository $repository) use ($categoria_id) {
                return $repository->createQueryBuilder('incidencia')
                    ->innerJoin('incidencia.categoria', 'categoria')
                    ->where('categoria.id = :categoria')
                    ->setParameter('categoria', $categoria_id)
                ;
            },
            'placeholder' => 'Debe seleccionar una Categoria primero',
            
            'choice_label' => 'nombre'
        );
        $form->add('incidencia', EntityType::class, $formOptions);
    }
    public function preSetData(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        if (null === $data) {
            return;
        }
        $accessor    = PropertyAccess::createPropertyAccessor();
        $incidencia        = $accessor->getValue($data, 'incidencia');
        $categoria_id = ($incidencia) ? $incidencia->getCategoria()->getId() : null;
        $this->addIncidenciaForm($form, $categoria_id);
    }
    public function preSubmit(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        $categoria_id = array_key_exists('categoria', $data) ? $data['categoria'] : null;
        $this->addIncidenciaForm($form, $categoria_id);
    }
}
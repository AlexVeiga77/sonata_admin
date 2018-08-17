<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name', TextType::class,[
            'label'=>''
        ]);
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name', TextType::class, [
            'label' => 'Nome',
            'attr' => [
                'placeholder' => 'informe a categoria'
            ]
        ]);
    }

    public function toString($object)
    {
        return $object instanceof Category ? $object->getName() : "Categoria";
    }
}
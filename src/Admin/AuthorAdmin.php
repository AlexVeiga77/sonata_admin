<?php
/**
 * Created by PhpStorm.
 * User: Veiga
 * Date: 07/08/2018
 * Time: 14:20
 */

namespace App\Admin;


use App\Entity\Author;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AuthorAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name'
                );
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name', TextType::class, [
                'label' => "Nome",
                'attr' => [
                    'placeholder' => 'informe seu nome'
                ]
            ]);
    }


    public function toString($object)
    {
        return $object instanceof Author ? $object->getName() : "Categoria";
    }
}
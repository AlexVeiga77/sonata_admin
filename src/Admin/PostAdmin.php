<?php
/**
 * Created by PhpStorm.
 * User: Veiga
 * Date: 06/08/2018
 * Time: 13:52
 */

namespace App\Admin;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use phpDocumentor\Reflection\Types\Boolean;
use function PHPSTORM_META\type;
use function Sodium\add;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->
            addIdentifier('title', TextType::class, [
                'label' => 'Titulo
            '])
            ->
            add('category', null, [
                'label' => 'Categoria',
                'associated_property' => 'name',
                'multiple' => true
            ])
            ->
            add('status', 'boolean', [
                'editable' => true,
                'inverse' => true
            ]);
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('Conteudo')
            ->with('Conteudo', ['class' => 'col-md-8'])
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('status', null, [
                'required' => false
            ])
            ->end()
            ->end()

            ->tab('Auxiliar')
            ->with('Auxiliar', ['class' => 'col-md-8'])
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name',
                'multiple' => true
            ])
            ->add('author', ModelType::class, [
                'class' => Author::class,
                'property' => 'name',
                'multiple' => true
            ])
            ->end()
            ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('title')
            ->add('status')
            ->add('category', null, [], EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('author', null, [], EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'name'
            ]);

    }

    public function toString($object)
    {
        return $object instanceof Post ? $object->getTitle() : "Postagem";
    }
}
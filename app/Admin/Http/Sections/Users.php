<?php

namespace App\Admin\Http\Sections;

use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use \App\User as User;

/**
 * Class Users
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    public function getTitle()
    {
        return 'Users';
    }

    public function getIcon()
    {
        return 'fa fa-group';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#'),
                AdminColumn::text('name', 'Name'),
                AdminColumn::text('email', 'email'),
                AdminColumn::custom('isAdmin', function ($instance) {
                    return $instance->isAdmin ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
                }),
                AdminColumn::datetime('created_at')->setLabel('Created')->setFormat('d.m.Y'),
                AdminColumn::datetime('updated_at')->setLabel('Update')->setFormat('d.m.Y')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'name')->required(),
            AdminFormElement::text('email', 'email')->required()->unique(),
            AdminFormElement::password('password', 'password')->required()->hashWithBcrypt(),
            AdminFormElement::password('password_confirmation', 'Password confirmation')
                ->setValueSkipped(true)
                ->required()
                ->addValidationRule('same:password', 'Passwords must match!'),
            AdminFormElement::checkbox('isAdmin', 'isAdmin'),
        ]);

        $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'cancel' => new Cancel(),
        ]);

        return $form;
    }

    /**++
     * @return FormInterface
     */
    public function onCreate()
    {
        $form = AdminForm::panel()
            ->addBody([
                AdminFormElement::text('name', 'name')->required(),
                AdminFormElement::text('email', 'email')->required()->unique(),
                AdminFormElement::password('password', 'password')->required()->hashWithBcrypt(),
                AdminFormElement::password('password_confirmation', 'Password confirmation')
                    ->setValueSkipped(true)
                    ->required()
                    ->addValidationRule('same:password', 'Passwords must match!'),
                AdminFormElement::checkbox('isAdmin', 'isAdmin'),
            ]);

        $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'cancel' => new Cancel(),
        ]);

        return $form;
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}

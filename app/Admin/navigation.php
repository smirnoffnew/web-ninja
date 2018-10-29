<?php

use SleepingOwl\Admin\Navigation\Page;

AdminSection::addMenuPage(\App\User::class);

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    [
        'title' => 'Information',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],


    [
        'title' => 'Выход',
        'icon' => 'fa fa-sign-out-alt',
        'url' => route('admin.logout'),
    ],
];
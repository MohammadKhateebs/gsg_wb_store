<?php
return [
    // name of page
    'Dashboard'=>[
        'title'=>'Dashboard',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/admin/dashboard'
    ],
    'Categories'=>[
        'title' => 'Categories',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'admin/dashboard/categories'
    ],
    'Products'=>[
        'title' => 'Products',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'admin/dashboard/products',
        'badge'=>[
            'class'=>'primary',
            'title'=>'new',
        ]
    ],
    'Order'=>[
        'title' => 'Orader',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'admin/dashboard/order'
    ],
    'Setting'=>[
        'title' => 'Setting',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'admin/dashboard/setting'
    ],

];

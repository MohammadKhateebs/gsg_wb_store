<?php
return [
    'DashBoard'=>[
        'title' => 'Dashboard',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard'
    ],
    // name of page
    'Categories'=>[
        'title' => 'Categories',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard/categories'
    ],
    'Products'=>[
        'title' => 'Products',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard/products',
        'badge'=>[
            'class'=>'primary',
            'title'=>'new',
        ]
    ],
    'Order'=>[
        'title' => 'Orader',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard/order'
    ],
    'Setting'=>[
        'title' => 'Setting',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard/setting'
    ],

];

<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'projects' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'clients' => 'c,r,u,d',

        ],
        'planning' => [
            'users' => 'r,u',
            'projects' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
        ],
        'user' => [
            'users' => 'r,u',
            'projects' => 'r, u',
            'tasks' => 'r, u',
            'clients' => 'r, u',

        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];

<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ],
    ],

    'all_movies' => [
        'name' => 'All Movies',
        'index_title' => 'AllMovies List',
        'new_title' => 'New Movies',
        'create_title' => 'Create Movies',
        'edit_title' => 'Edit Movies',
        'show_title' => 'Show Movies',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
            'date' => 'Date',
            'genres_id' => 'Genres',
        ],
    ],

    'all_liked_movies' => [
        'name' => 'All Liked Movies',
        'index_title' => 'AllLikedMovies List',
        'new_title' => 'New Liked movies',
        'create_title' => 'Create LikedMovies',
        'edit_title' => 'Edit LikedMovies',
        'show_title' => 'Show LikedMovies',
        'inputs' => [
            'movies_id' => 'Movies',
            'user_id' => 'User',
        ],
    ],

    'all_genres' => [
        'name' => 'All Genres',
        'index_title' => 'AllGenres List',
        'new_title' => 'New Genres',
        'create_title' => 'Create Genres',
        'edit_title' => 'Edit Genres',
        'show_title' => 'Show Genres',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'comments' => [
        'name' => 'Comments',
        'index_title' => 'Comments List',
        'new_title' => 'New Comment',
        'create_title' => 'Create Comment',
        'edit_title' => 'Edit Comment',
        'show_title' => 'Show Comment',
        'inputs' => [
            'text' => 'Text',
            'movies_id' => 'Movies',
            'user_id' => 'User',
        ],
    ],
];

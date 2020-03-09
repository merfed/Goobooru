<?php

return [

    // Site Settings
    'name' => 'Goobooru',

    // Display settings
    'counter_type' => 'graphic', // graphic or text
    'counter_style' => 'normal', // normal or colorful,
    'counter_colors' => [
        0 => '#c7bc20',
        1 => '#8ec720',
        2 => '#20c796',
        3 => '#209ec7',
        4 => '#2420c7',
        5 => '#9220c7',
        6 => '#c7208e',
        7 => '#c72047',
        8 => '#c74720',
        9 => '#c77e20',
    ],
    'user_classes' => [
        0 => 'Member',
        1 => 'Power User',
        2 => 'Elite',
        3 => 'Legend',
        4 => 'Master',
        99 => 'Moderator',
        100 => 'Admin',
        101 => 'Op'
    ],
    'paginate' => 24, // We do columns of 8, so a divisible value makes it look nice
    'hot_threshold' => 25, // Number of views to show up on the hot page

    // Upload Settings
    'max_file_size' => '12000', // In MB
    'allowed_filetypes' => 'jpeg,png,gif,jpg,bmp,webm,gifv,svg',
    'min_tags' => '5', // Mininum number of tags to upload a post. Cannot be 0.
    'upload_path' => 'uploads/', // Directory in public folder
    'upload_path_thumb' => 'thumbnails/',
    'avatar_upload_path' => 'avatars', // Directory in public folder
];

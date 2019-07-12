# Goobooru

Goobooru is a booru much like Moebooru, except it's written in PHP on Laravel.

This is mostly for personal use, but feel free to use it and write any issues you encounter.

# Install instructions
This is just for dev installations, I don't advice production ones since this is likely broken.

* ```composer install```
* ```npm install```
* Copy ```.env.example``` to ```.env```
    * Replace the following: ```APP_URL, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD```.
* Edit ```webpack.mix.js``` replace url in ```browserSync()``` with whatever you set in ```APP_URL```.
* On windows edit hosts file to match your IP and ```APP_URL```. You're on your own for linux and mac, as I'm not actively developing on any of those systems.
* ```php artisan migrate```
* ```npm run watch```
* ```npm run watch``` again, usually because the first time it installs browserSync. Ignore this if your browser opens up to the page.

# Todo
* General
    * Tag ? link to wiki for that tag
* Posts
    * DCMA creates something staff can see.
    * URLs page with indicator for dead urls
    * Saved searches
    * Help page
    * Redesign upload
* Post
    * Size statistics
    * Up and down vote
    * Rating styling
    * Edit
    * Delete
    * Flag for deletion
    * Add note
    * Fav
    * Lock
* Tags
    * Edit
    * Delete
    * Hide bulk add for staff only
    * Implications
    * Saved searches
* Pools
    * Better design
    * View all images in pools
    * Edit
    * Delete
* Notes
* Comments
* Wiki
* Forum
    * Pagination on thread
    * Searching
    * View all posts in a category
* User
    * Settings
    * Better dropdown options
    * Profile
        * Stats work
        * Recent favorites
        * Somehow get 2 masonrys working on one page

# Roadmap

This is for stuff that isn't obvious because there's currently nothing in the views to suggest it should be there.

* Bulk add comments of specific types.
* Color staff links as yellow.
* User class system
* Search

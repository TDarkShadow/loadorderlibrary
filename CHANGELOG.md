# Load Order Library

# Table of Contents

<!-- TOC depthto:1 -->

- [v2.2.0](#v220)
- [v2.1.2](#v212)
- [v2.1.1](#v211)
- [v2.1.0](#v210)
- [v2.0.2](#v202)
- [v2.0.1](#v201)
- [v2.0.0](#v200)
- [v1.10.1](#v1101)
- [v1.10.0](#v1100)
- [v1.9.2](#v192)
- [v1.9.1](#v191)
- [v1.9.0](#v190)
- [v1.8.1](#v181)
- [v1.8.0](#v180)
- [v1.7.2](#v172)
- [v1.7.1](#v171)
- [v1.7.0](#v170)
- [v1.6.3](#v163)
- [v1.6.2](#v162)
- [v1.6.1](#v161)
- [v1.6.0](#v160)
- [v1.5.0](#v150)
- [v1.4.2](#v142)
- [v1.4.1](#v141)
- [v1.4.0](#v140)
- [v1.3.5](#v135)
- [v1.3.4](#v134)
- [v1.3.3](#v133)
- [v1.3.2](#v132)
- [v1.3.1](#v131)
- [v1.3.0](#v130)
- [v1.2.8](#v128)
- [v1.2.7](#v127)
- [v1.2.6](#v126)
- [v1.2.5](#v125)
- [v1.2.4](#v124)
- [v1.2.3](#v123)
- [v1.2.2](#v122)
- [v1.2.1](#v121)
- [v1.2.0](#v120)
- [v1.1.2](#v112)
- [v1.1.1](#v111)
- [v1.1.0](#v110)
- [v1.0.3](#v103)
- [v1.0.2](#v102)
- [v1.0.1](#v101)
- [v1.0.0](#v100)
- [Subheading definitions](#subheading-definitions)

<!-- /TOC -->

# v2.2.1
> 2021-03-13

## Added
- Added edit button to lists that are yours, beside delete button

## Fixed
- Fixed being able to view edit page of lists that aren't yours

# v2.2.0
> 2021-03-13

## Added
- Added `lists/{slug}/edit` route to `web.php` for showing the list edit view
- Added `edit-load-order.blade.php` view and `edit-load-order-form.blade.php` component to show the form for editing a list
- Added code in `update()` method of `LoadOrderController` to handle updating a list
- Added helper info for unchecking a file to remove it

## Fixed
- Fixed where `old('description')` is placed in the upload form for if it errors

# v2.1.2
> 2021-03-12

## Fixed
- Fixed file upload. I had to add `clean_name` and `size_in_bytes` to the fillable array in the `File.php` model

# v2.1.1
> 2021-03-12

## Added
- Added a total count of orphaned files.

## Fixed
- Fixed upload to also calculate `clean_name` and `size_in_bytes`

# v2.1.0
> 2021-03-12

## Added
- Added an "Orphaned Files" section to admin stats to show me files that are no longer in a list. The idea is it *should* be empty
- Added a "Files In Lists" section to show how many lists a given file is in
- Added a `clean_name` column to the `files` table and populated it (migration: `add_clean_name_column_to_files_table`). Currently unused in the rest of code, but will be implemented for v2.2.0
- Added a `size_in_bytes` column to the files table and populated it (migration: `add_size_in_bytes_column_to_files_table`)

## Fixed
- Fixed title of Admin Stats page

## Changed
- Changed admin filesize stat to add from DB instead of reading files directly


# v2.0.2
> 2021-03-12

## Fixed
- Added `falloutcustom.ini` to acceptable files to upload as it should have been to start

## Removed
- Removed a period after my name in the footer

# v2.0.1
> 2021-03-12

## Fixed
- Fixed `ComparisonController` to use the new database structure

# v2.0.0
> 2021-03-12

## Added
- Added `File.php` model for files
- Added `create_files_table` migration, also adding all existing files on disk to the table
- Added `create_file_load_order` migration for the pivot table between `files` and `load_orders`, also creating all relations
- Added `drop_files_column_from_load_orders_table` migration to remove the now uneeded files column

## Changed
- Decided to bump to v2.0.0 as I feel a major change to the DB structure, effectively breaking backwards compatibility if this was a proper application/api release, warrants it
- Changed `getFileNames()` method in `LoadOrderController` to return an array of filenames instead of a string
- `store()` method in `LoadOrderController` now adds filenames to the `Files` table if they don't exist, and returns IDs, which are then used to connect to a list in the pivot table
- Changed `show()` methodi n `LoadOrderController` to work with the new database structure
- Changed file downloading to make use of new database structure

## Removed
- Removed `protected $factory = 'ListFactory';` from `LoadOrder.php` is it's the wrong name

## Internals
- Composer
	- Added `laracasts/generators` to help with generating migrations
	- Added `barryvdh/laravel-debugbar`

# v1.10.1
> 2021-03-11

## Added
- Added `skyrimvr.ini` to acceptable files

# v1.10.0
> 2021-03-09

## Added
- Added in `FakerPHP/faker` composer packages
- Added `HasFactory` trait to `LoadOrder.php`
- Added `LoadOrderFactory`
- Added `HasFactory` trait to `User.php`

## Changed
- Updated `phpunit.xml` to use testing mysql DB
- Updated `.gitignore` with `.env.testing` file
- Updated `UserFactory` to be how it should be

## Removed
- Deleted example tests

# v1.9.2
> 2021-03-06

## Changed
- Changed up layout of footer and added reddit and patreon links
- Changed links to open in a new tab

## Closed
- https://github.com/phinocio/loadorderlibrary/issues/38

# v1.9.1
> 2021-03-06

## Fixed
- Fixed typo on `use` of `ValidFiles` helper in `ValidFilename.php` rule

# v1.9.0
> 2021-03-06

## Added
- Added `ValidFilenames` rule to check that the files being uploaded are valid names. This prevents the issue of files being uploaded as `modlist(1).txt` for example
- Created a `ValidFiles` helper to give a list of all valid files, or by game
- Added list of valid files to the upload page
- Added `ValidFiles::all()` to data sent to the upload page in `LoadOrderController.php`

## Internals
- NPM
	- Updated `jquery` from `v3.5.1` -> `v3.6.0`
	- Updated `browser-sync-webpack-plugin` from `v2.2.2` -> `v2.3.0`

# v1.8.1
> 2021-03-05

## Added
- Added `tmp` disk to `config/filesystems.php`
- Added stat to admin stats page to show size of all `tmp` files
- Added artisan command `tmp:clear` to clear the `app/storage/tmp` directory
- Added task to run `tmp:clear` every 24h

# v1.8.0
> 2021-03-05

## Added
- Added download buttons for downloading individual file from a list, or all files in a list
- Added `DownloadController` to handle downloading of files
- Added `/lists/{load_order:slug}/download/{file}` route to `web.php` to handle file downloading
- `DownloadController` handles leting the user download a single file or all of them together depending on if the `{file}` sent is `all` or a specific file

## Changed
- Changed `Delete` text for deleting a list to be more explicit: `Delete List`
- Changed display of `Delete List` button to be `btn-outline`


# v1.7.2
> 2021-03-05

## Added
- Added version info to `config/app.php` and `package.json`

# v1.7.1
> 2021-03-05

## Added
- Added an indicator of if a list is private or not to the `My Lists` page and the direct list view

## Changed
- Changed list view page to show 2 per line as 3 felt a bit squished

# v1.7.0
> 2021-03-05

## Fixed
- Fixed `show disabled` function only toggling the *first* disabled item in modlist.txt. Toggling now works as intended

# v1.6.3
> 2021-03-05

## Changed
- Moved all testing files to a git ignored `test-files` folder so clean up repo a bit

# v1.6.2
> 2021-03-05

## Fixed
- Fixed regex again

# v1.6.1
> 2021-03-05

## Fixed
- Fixed a bad regex to find all line break characters and replace them with `\n`. All uploaded files should now be converted to LF on upload as intended

# v1.6.0
> 2021-03-04

## Added
- Added TODO entry to implement a much more robust solution to line endings

## Fixed
- Fixed issues with comparing plugins.txt by just removing `*` from the file before compare (doesn't touch the file on disk)
- Implemented a temporary fix of comparison showing things that appear to be the same when the files being tested are of differing line endings. Current fix is `array_map('trim', $file)`

## Closed
- https://github.com/phinocio/loadorderlibrary/issues/37

# v1.5.0
> 2021-03-04

## Changed
- Changed comparison page to be "disabled" with a note I found an issue and am working on it

# v1.4.2
> 2021-03-02

## Added
- Added pagination links to main page when logged in

## Fixed
- Fixed 500 error on main page when logged in by adding the same pagination to it that I added to browse lists page

## Removed
- Removed `$compare` from `HomeController` as it was unused

# v1.4.1
> 2021-03-02

## Changed
- Gave the filter input more margin on `view-load-order.blade.php`

# v1.4.0
> 2021-03-02

## Added
- Added pagniation view files so I can edit them
- Added Pagination to the list view page so it doesn't get too big

## Changed
- Removed spaces between subheader and content to be consistent
- Changed `->get()` to `->paginate(15)` when getting lists in `LoadOrderController`

# v1.3.5
> 20201-03-02

## Internals
- Composer
	- Added `fruitcake/laravel-cors`. Apparently it's required. Oops

# v1.3.4
> 2021-03-02

## Fixed
- Fixed display of counter in list view on phones (I hope, only have so many to test on)
- Fixed display of files in general on mobile. Compare results page still looks bad-ish, but it's good enough for now and not a priority

## Changed
- Changed subheading `Updates` to `Internals`
- Moved both the list filter input and the `show disabled` switch into the file collapse itself as they're only needed when viewing a specific file
- Changed the &#11166; arrow on files to a bold `+` since phones weren't displaying it

## Internals
- NPM
	- Added `browser-sync`
	- Added `browser-sync-webpack-plugin`
- Composer
	- Removed `fruitcake/laravel-cors`
	- Updated `laravel/framework` from `v8.29.0` -> `v8.30.0`
	- Updated `laravel/tinker` from `v2.6.0` -> `v2.6.1`

# v1.3.3
> 2021-03-01

## Added
- Added `Differences` and `No Differences` badge to files on comparison results for a quick glance at what is different

## Fixed
- Fixed wrong date on previous changelog entry
- Fixed heading saying `files` on the line by line results for files. It should have said `lines` instead

## Changed
- Changed comment on line 75 of `ComparisonController` to better indicate what it's doing
- Change comparison results page to show all files that are in both lists
- Changed card footer note on comparison results page to match now showing all files that are in both lists

## Removed
- Removed commented out code on `compare-load-orders-results.blade.php`

## Closed
- https://github.com/phinocio/loadorderlibrary/issues/32


# v1.3.2
> 2021-03-01

## Fixed
- Fixed alternating BG for list items on admin stats page, compare page, and compare results page
- Fixed compare page list of lists looking ugly
- Fixed removing first letter of a plugin name if plugins in `plugins.txt` do not start with `*`

## Changed
- Changed filter to use `remove()` and `add()` `classList` methods so I don't need to use the wrapping `<span>` hack
- Changed all `list-group-item-dark` to `list-group item list-group-item-dark` as that's what it's meant to be. Oops
- Changed file name display on compare results page to be the same as list view
- Changed the hover BG color for list items to be lighter as it was matching the BG on other pages

## Removed
- Removed leftover debugging `console.log` in `view-load-order.blade.php`
- Removed wrapping `<span>` around each list item in `view-load-order.blade.php`
- Removed hacky if statement to apply `list-group-item-dark` or `list-group-item-dark-odd` classes on list items in `view-load-order.blade.php`
- Removed `.list-group-item-dark-odd` class

## Closed

- https://github.com/phinocio/loadorderlibrary/issues/34
- https://github.com/phinocio/loadorderlibrary/issues/35
- https://github.com/phinocio/loadorderlibrary/issues/36

# v1.3.1
> 2021-02-28

## Fixed
- Fixed separators not being parsed properly by changing `trim()` to `str_replace()`

# v1.3.0
> 2021-02-28

## Added
- Added IDEAS.md for ideas that may or may not becom actual features
- Added the removal of the `automatically generated` text that is present in certain files. The text still exists in the files themselves as I don't want to touch those, this is simply for display purposes
- Added parsing of `modlist.txt` file in `LoadOrderController::show` to determine if a line is disabled or a separator and not use JS in front-end. Disabled mods in `modlist.txt` start hidden, with a toggle to view them
- Added `.list-separator` and `.list-disabled` classes to style separators differently than the other items
- Added a parent `<span>` around each `<li>` on `view-load-order.blade.php` for purposes of filtering and keeping classes. Bad fix, but eventual re-write will make it better
- Added flex related settings to `.counter` to prevent bad looking spaces showing for lines that are too tall
- Added a `list-group-item-dark-odd` class to alternate background because I'm too lazy to figure out a better method when I'm going to re-write anyway
- Added a button to toggle hidden `modlist.txt` mods and accompanying JS to `view-load-order.blade.php` for it
- Added an indicator that the file names are dropdowns

## Fixed
- Fixed typo of `insatances` to correct `instances` in [v1.2.1](#v121)

## Changed
- Changed `modlist.txt`, `loadorder.txt` and `plugins.txt` to reflect a more complex list for testing (TPF 4.3.2)
- `view-load-order.blade.php` no longer does the logic of converting the txt of a file into an array, that is now done in `LoadOrderController::show` method
- Changed top and bottom padding of `.counter` to 5 so each entry doesn't feel so big
- Changed all `lo-list-item` classes to `list-group-item-dark` across multiple files to be more consistent
- Cleaned up classes in `app.scss` to be more consistent
- By changing to `list-group-item-dark`, lines are now more compact to view
- Changed filter on `view-load-order.blade.php` to work somewhat better by not removing classes on elements but dealing with a parent `<span>`

## Removed
- Removed `lo-list` and `lo-list-item` classes

# v1.2.8
> 2021-02-25

## Added
- Added removed subheading definition
- Added `laravel-mix-purgecss` package

## Changed
- Changed previous changelog entry to add removed section.
- Changed up `webpack.mix.js` file to try an minimize file sizes even more

## Removed
- Deleted `resources/js/bootstrap.js` file

# v1.2.7
> 2021-02-25

## Fixed
- Fixed bootstrap import to hopefully not give popper error on server

# v1.2.6
> 2021-02-25

## Added
- Added `manifest.js` and `vendor.js` files to js includes in `app.blade.php`

## Changed
- Change Laravel Mix to version files and create sourcemaps
- Updated gitignore to ignore `mix-manifest.json`
- Updated `app.blade.php` to use mix include for versioned files
- Moved JS includes to bottom of body tag
- Changed `app.js` to not include `bootstrap.js` (the file, not the framework) and manually defined includes

## Removed
- Removed commented out font include in `app.scss`
- Removed ignored files from git cache

## Internals
- NPM
	- Removed `popper.js`
	- Removed `axios`
	- Removed `lodash`

# v1.2.5
> 2021-02-25

## Fixed
- Fixed wrong date on last 2 changelog entries. Oops
- Fixed TOC

## Changed
- Updated TODO to reflect recent updates
	- Moved `Implement Admin Page` to compelted
	- Moved add more supported games to end of future as MO2 support isn't fully there
	- Move `Better Filtering Of Lists` to in-progress

# v1.2.4
> 2021-02-25

## Changed

- Changed the file size display on stats page to be 2 decimals

# v1.2.3
> 2021-02-25

## Fixed
- Fixed trying to load IDE Helper on testing by removing it from `AppServiceProvider`

# v1.2.2
> 2021-02-25

## Fixed
- Fixed the display of percents for anonymous/private lists to be fixed to 2 decimals

## Changed
- Changed CHANGELOG subheadings (added/changed/etc) to only display if there was something in it so as to not clutter the changelog
- Added subheadings to the rest of the CHANGELOG file


# v1.2.1
> 2021-02-25

## Changed
- Changed all instances of `env()` in non config files to `config()`
- Capitalized all instances of `nothing` in CHANGELOG file
- Removed ending period from every line in CHANGELOG file
- Updated `package.json` scripts to reflect updates to `laravel-mix`

## Internals
- NPM
	- Update `laravel-mix` from `v5.0.9` -> `v6.0.13`
	- Update `sass-loader` from `v10.1.1` -> `v11.0.1`
	- Removed `vue` as it's not used
	- Removed `vue-template-compiler` as it's not used

# v1.2.0
> 2021-02-25

## Added
- Added `/admin/stats` route pointing to `AdminController::stats()`
- Added `AdminController` for handling Admin routes
- Created an `IsAdmin` middleware check if user is admin and redirect back to `/` if not
- Added `admin-stats` view page
- Added stats of the following
	- User Stats
		- Total number of Users
		- Total number of Admins
		- How long ago the last user registered
	- List Stats
		- Total number of Lists
		- Total number of Private Lists
		- Percent of lists that are Private
		- Total number of Anonymous Lists
		- Percent of lists that are Anonymous
	- File Stats
		- Total Files
		- Total size of Files (not same as "size on disk")
- Added a cast to the `User` model to cast created_at into a timestamp
- Added CSS class for `.list-group-item-dark` to make it actually dark, and alternate color
- Added link to stats page in user drop down if the user is an Admin

# v1.1.2
> 2021-02-24

## Changed
- Update TODO with info on Admin page future addition and re-order in-progress to reflect working on Admin page currently

# v1.1.1
> 2021-02-24

## Changed
- Updated README and added Discord links to README and site footer

# v1.1.0
> 2021-02-24

Users are now able to delete accounts. Deleting an account completely deletes it and any associated lists with it from the database. 

## Added
- Added `Delete Account` link to user drop down
- Added a divider between account actions and log out button in user drop down
- Added `/account/delete` route with confirmation that deleting the account will also delete lists and will not be able to be reversed
- Added `DeleteAccountController` to handle showing the previously added page (`index()` method), and handle deleting user accounts (`destroy()` method). 
- Added view `delete-account.blade.php`
- Added simple try/catch error handling to account deletion

## Internals
- Updated composer deps

# v1.0.3
> 2021-02-18

## Added
- Added CHANGELOG.md and previous entries

# v1.0.2
> 2021-02-18

## Added
- Added a route to intentionally provide an `HTTP 500` error for testing purposes with Azura's Star

# v1.0.1 
> 2021-02-18

## Fixed
- Fixed users not being able to see delete button on their own modlists as I was checking the wrong attribute. `$loadOrder->user` instead of `$loadOrder->author`

# v1.0.0 
> 2021-02-18

- Initial release

# Subheading definitions

## Added
Used for additions that did not already exist.

## Fixed
Used for fixes to existing things that don't function as intended. 

Example: in [v1.2.2](#v122) I listed changing the decimals to be 2 spaces as a fix as that was the intended result but I forgot to implement that. Whereas in [v1.2.4](#v124) I listed the change as a change instead, as it was already working as intended and I decided to change it to 2 decimal places.

## Changed
Used for updates/changes to existing things that doesn't fall under fixes. (Eg: adding headings to changelog, or changing the color of an element).

## Removed
Used for indicating things that were removed and not changed into something else. Like removing commenting code in a file, full functions, or entire files.

## Internals
Used for updates to NPM/Composer dependencies, whether updated, added, or removed.

## Closed
Used to link to closed Github issues, if applicable.
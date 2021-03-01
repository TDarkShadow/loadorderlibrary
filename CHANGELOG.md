# Load Order Library

# Table of Contents

<!-- TOC depthto:1 -->

- [Load Order Library](#load-order-library)
- [Table of Contents](#table-of-contents)
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

## Updates
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

## Updates
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

## Updates
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

## Updates
Used for updates to NPM/Composer dependencies, whether updated, added, or removed.
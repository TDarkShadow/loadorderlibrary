# Load Order Library

# Table of Contents

<!-- TOC -->

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

# v1.2.3
> 2021-02-25

# Fixed
- Fixed trying to load IDE Helper on testing by removing it from `AppServiceProvider`. 

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
- Capitalized all insatances of `nothing` in CHANGELOG file
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

## Changed
Used for updates/changes to existing things that doesn't fall under fixes. (Eg: adding headings to changelog, or changing the color of an element).

## Updates
Used for updates to NPM/Composer dependencies, whether updated, added, or removed.
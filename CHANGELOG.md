# Load Order Library

# Table of Contents

<!-- TOC -->

- [v1.1.1](#v111)
- [v1.1.0](#v110)
- [v1.0.3](#v103)
- [v1.0.2](#v102)
- [v1.0.1](#v101)
- [v1.0.0](#v100)

<!-- /TOC -->

# v1.1.1
> 2021-02-24

- Updated README and added Discord links to README and site footer.

# v1.1.0
> 2021-02-24

Users are now able to delete accounts. Deleting an account completely deletes it and any associated lists with it from the database. 

- Added `Delete Account` link to user drop down.
- Added a divider between account actions and log out button in user drop down.
- Added `/account/delete` route with confirmation that deleting the account will also delete lists and will not be able to be reversed.
- Added `DeleteAccountController` to handle showing the previously added page (`index()` method), and handle deleting user accounts (`destroy()` method). 
- Added view `delete-account.blade.php`.
- Added simple try/catch error handling to account deletion.
- Updated composer deps.

# v1.0.3
> 2021-02-18

- Added CHANGELOG.md and previous entries.

# v1.0.2
> 2021-02-18

- Added a route to intentionally provide an `HTTP 500` error for testing purposes with Azura's Star.

# v1.0.1 
> 2021-02-18

- Fixed users not being able to see delete button on their own modlists as I was checking the wrong attribute. `$loadOrder->user` instead of `$loadOrder->author`.

# v1.0.0 
> 2021-02-18

- Initial release.
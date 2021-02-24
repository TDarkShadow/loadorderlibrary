# Load Order Library TODO

A list of things to do, ordered by priority.

<!-- TOC -->

- [Account Deletion](#account-deletion)
- [Add More Supported Games](#add-more-supported-games)
- [Pagination For Browse Lists Page](#pagination-for-browse-lists-page)
- [Better Filtering Of Lists](#better-filtering-of-lists)
- [Delete Files From Disk](#delete-files-from-disk)
- [Compare List From Its Page](#compare-list-from-its-page)
- [Re-Write To Be More API Driven](#re-write-to-be-more-api-driven)
- [List Search By Game/Author](#list-search-by-gameauthor)
- [Downloading Of List Files.](#downloading-of-list-files)
- [Password Recovery Forgot Password](#password-recovery-forgot-password)
- [Editing Lists](#editing-lists)
- [Implement 2FA](#implement-2fa)
- [Verified Users/Lists](#verified-userslists)

<!-- /TOC -->

# Account Deletion
Create a method of deleting accounts and lists associated with those accounts. Account recovery will not be possible.

# Add More Supported Games
Mod Organizer recently updated and added support for more games. Add those as options for lists, to be more in-line with MO2.

# Pagination For Browse Lists Page
Implement pagination, showing ~20 lists per page so it doesn't become too big.

# Better Filtering Of Lists
For example, hiding disabled mods and separators in modlist.txt by default, and giving a toggle to show them.

# Delete Files From Disk
Implement a method were if a list is deleted and it's the only one associated with any files in it, also delete those files from disk.

# Compare List From Its Page
Implement a method of starting a list compare from a specific list's page, without having to first go to the list compare page explicitly. Likely by pre-populating a `/compare/list1` route with a page then asking to select a second list to compare against.

# Re-Write To Be More API Driven
Re-write the entire back-end to be an API separate from the front-end. Making it much easier to interface with other tools such as [Azura's Star](https://github.com/RingComics/azuras-start). This task will be going on in parallel to others in this document.

# List Search By Game/Author
Add /games/$game and /$author/ routes to then view lists by game or author. Likely won't include anonymous uploads as there'd be a lot.

# Downloading Of List Files.
Implement a way to download individual files, or all of them as a .zip.

# Password Recovery (Forgot Password)
Find a cheap enough mail provider to be able to then make use of Laravel's built-in password reset flow.

# Editing Lists
Allow editing the name, description, and game of lists. This will require and account and obviously one can only edit their own lists.

# Implement 2FA
Self-explanatory.

# Verified Users/Lists
For example, Dylan Perry (creator of Ultimate Skyrim) could have an account verified and upload an official Ultimate Skyrim for people to compare against with confidence. Verified users will have a checkmark similar to Twitter. Official lists (which will be determined as such on upload by a verified user) will have a badge indicating it's an official list. The idea is to help users be confident that the list they're comparing against in the compare tool is the actual list as it's meant to be.
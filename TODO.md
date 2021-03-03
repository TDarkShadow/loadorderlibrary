# Load Order Library TODO

A list of things to do, ordered by priority.

<!-- TOC depthfrom:1 depthto:2 -->

- [**In Progress**](#in-progress)
	- [**Downloading Of List Files**](#downloading-of-list-files)
- [**Future**](#future)
	- [**Parse File Names On Upload**](#parse-file-names-on-upload)
	- [**Delete Files From Disk**](#delete-files-from-disk)
	- [**Compare List From Its Page**](#compare-list-from-its-page)
	- [**Re-Write To Be More API Driven**](#re-write-to-be-more-api-driven)
	- [**List Search By Game/Author**](#list-search-by-gameauthor)
	- [**Password Recovery Forgot Password**](#password-recovery-forgot-password)
	- [**Editing Lists**](#editing-lists)
	- [**Implement 2FA**](#implement-2fa)
	- [**Verified Users/Lists**](#verified-userslists)
	- [**Add More Supported Games**](#add-more-supported-games)
- [**Completed**](#completed)
	- [**Account Deletion**](#account-deletion)
	- [**Implement Admin Page**](#implement-admin-page)
	- [**Better Filtering Of Lists**](#better-filtering-of-lists)
	- [**Pagination For Browse Lists Page**](#pagination-for-browse-lists-page)

<!-- /TOC -->

# **In Progress**

## **Downloading Of List Files**

Implement a way to download individual files, or all of them as a .zip.

---

# **Future**

## **Parse File Names On Upload**

Currently, files uploaded as `modlist(1).txt` and the like, don't get changed into `modlist.txt` which is breaking some things as I rely on the filename. To fix that I'll probablby validate names on upload compared to a masterlist of relevant files for lists. Including but not limited to

-   modlist.txt
-   plugins.txt
-   skyrim.ini
-   skyrimprefs.ini
-   mwse-version.txt
-   mge.ini

## **Delete Files From Disk**

Implement a method were if a list is deleted and it's the only one associated with any files in it, also delete those files from disk.

## **Compare List From Its Page**

Implement a method of starting a list compare from a specific list's page, without having to first go to the list compare page explicitly. Likely by pre-populating a `/compare/list1` route with a page then asking to select a second list to compare against.

## **Re-Write To Be More API Driven**

Re-write the entire back-end to be an API separate from the front-end. Making it much easier to interface with other tools such as [Azura's Star](https://github.com/RingComics/azuras-start). This task will be going on in parallel to others in this document.

## **List Search By Game/Author**

Add /games/$game and /$author/ routes to then view lists by game or author. Likely won't include anonymous uploads as there'd be a lot.

## **Password Recovery (Forgot Password)**

Find a cheap enough mail provider to be able to then make use of Laravel's built-in password reset flow.

## **Editing Lists**

Allow editing the name, description, and game of lists. This will require and account and obviously one can only edit their own lists.

## **Implement 2FA**

Self-explanatory.

## **Verified Users/Lists**

For example, Dylan Perry (creator of Ultimate Skyrim) could have an account verified and upload an official Ultimate Skyrim for people to compare against with confidence. Verified users will have a checkmark similar to Twitter. Official lists (which will be determined as such on upload by a verified user) will have a badge indicating it's an official list. The idea is to help users be confident that the list they're comparing against in the compare tool is the actual list as it's meant to be.

## **Add More Supported Games**

Mod Organizer recently updated and added support for more games. Add those as options for lists, to be more in-line with MO2.

---

# **Completed**

## **Account Deletion**

> Completed 2021-02-24

Created a method of deleting accounts and lists associated with those accounts. Account recovery is not possible.

## **Implement Admin Page**
> Completed 2021-02-25

Added an admin only page that shows some minor stats such as

-   Total number of anonymous lists
-   Total number of lists with exact same name uploaded within say, ~5m of each other (to give me a slight idea on if people are having trouble uploading the first time)
-   Total number of registered users (no other info, literally just total number)
-   Total number of lists
-   Total number of files stored on the server and the total size (good to see at a glance for space reasons - server only has 25GB storage)
-   Few other generic numbers I forget I want at the time of writing

## **Better Filtering Of Lists**
> Completed 2021-02-28

Modlist.txt now shows in the "proper" order, the `automatically generated` line is removed for display, separators are supported, and disabled mods in modlist.txt are hidden by default, with a toggle to show them. Also removed the `*` pre-fixing plugins in `plugins.txt`.

## **Pagination For Browse Lists Page**
> Completed 2021-03-02

Pagination for the Browse Lists page shows 15 per page.
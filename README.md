#My Library

Contributors: Ludovic Roland ([http://www.rolandl.fr](http://www.rolandl.fr)), Axel de Sainte Marie ([http://www.apponthebeach.com](http://www.apponthebeach.com))<br/>
Stable tag: 1.4.3.1<br/>
License: GNU GPL v2.0<br/>
License URI: http://www.gnu.org/licenses/gpl-2.0.html

##Description

My Library is a light PHP website to manage your virtual library. 

Each member can :
* add / remove / edit authors
* add / remove / edit book styles
* add / remove / edit books
* tag a book as read
* tag a book as got
* tag a book as wanted
* export the list of book he gets / read / wants in PDF
* see a list of suggested books

You also have the possibility to :
* do a research by author, title, year, style, etc
* export the list of books that all the user have in PDF

##Installation & configuration

###The database

In order to create the database, open your SGBD and execute the SQL script 'Documents/sql/my_library_x.x.sql'.

Open the php file 'Library/PDOFactory.class.php' and edit the line 9 with your own database information.

###The website

Copy the following directories on your FTP :
* Applications
* Errors
* Library
* Web

###Configuration

In order to work, your domain name has to target the directory 'Web'.

###Add a user

Users have to be add directly in the database. Passwords have to be encrypted with SHA1.

##Changelog

###1.4.3.1
WARNING : If you already have My Library set up on your server, you MUST update your database for this version to work. Check Documents/sql/my_library_1.4.3.1.sql to see the updates

* Add a button to add a new book directly from the home page
* Bug fixed on the link to go back to the books list from a book details page when the bool title start with a number
* Update the book table to add a flag in order to specify if a book is an eBook or a real one - Update to version 1.4.3.1

###1.4.3

* New entry "All" in the books list, to see all the books recorded at one place
* Added a new book directly from the detail view of another one
* View the lists (Want, Read, Get) of all the users of the library
* Added a new entry in the books list : Book you didn't read yet

###1.4.2.1
* Fixed syntax error

###1.4.2

* Updated the SQL script
* Added the missing 'upload' directory


###1.4.1

* Updated the code with the latest version of the rolandl PHP Framework (v1.1.1)

###1.4

* UI improvement
* Fixed the issue with the generated PDF files
* Cleaned up the code
* Added the possibility to export a list of all the books users have

###1.3.3

* First public version of the project

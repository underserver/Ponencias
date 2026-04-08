# Ponencias

## Overview

**Author:** Justin Vincent ([justin@visunet.ie](mailto:justin@visunet.ie))  
**Web:** [php.justinvincent.com](http://php.justinvincent.com)  
**Name:** ezSQL  
**Description:** Class to make it very easy to deal with database connections.  
**License:** FREE / Donation (LGPL - You may do what you like with ezSQL - no exceptions.)

## Important

Please send me an email telling me what you think of ezSQL and what you're using it for! Cheers. [justin@visunet.ie](mailto:justin@visunet.ie)  

If ezSQL has been helpful to you why not make a donation!?  
[PayPal Donation Link](https://www.paypal.com/xclick/business=justin%40justinvincent.com&item_name=ezSQL&no_note=1&tax=0)

Also, you should check [php.justinvincent.com](http://php.justinvincent.com) from time to time as I will be adding new PHP widgets and also a forum to support those widgets.

## Change Log

### 2.02
- Please note, this change log is no longer being used. Please see change_log.htm for changes later than 2.02.

### 2.01
- Added Disk Caching & Multiple DB connection support

### 2.00
- Re-factored ezSQL for Oracle, mySQL & SQLite
  - DB Object is no longer initialized by default (makes it easier to use multiple connections)
  - Core ezSQL functions have been separated from DB specific functions (makes it easier to add new databases)
  - Errors are being piped through `trigger_error` (using standard PHP error logging)
  - Abstracted error messages (enabling future translation)
  - Upgraded `$db->query` error return functionality
  - Added `$db->systdate` function to abstract mySQL NOW() and Oracle SYSDATE

Note: For other DB Types please use version 1.26

### 1.26
- Fixed the pesky regular expression that tests for an insert/update etc. Now works even for the most weirdly formatted queries! (Thanks dille)

### 1.25
- Optimized `$db->query` function in both mySQL and Oracle versions. Now the return value is working 'as expected' in ALL cases so you are always safe using:
  ```php
  if ( $db->query("some query") )
  ```
  No matter if an insert or a select.

### 1.24
- Now includes tutorial for using EZ Results with Smarty templating engine - thanks Steve Warwick

### 1.23
- Fixed the age-old problem of returning false on successful insert. `$db->query()` now returns the `insert_id` if there was a successful insert or false if not.
- Added new variable `$db->debug_all`

### 1.22
- Added new variable `$db->num_queries` to keep track of exactly how many 'real' (not cached) queries were executed.

### 1.21
- Now 'replace' really does return an insert id.

### 1.20
- C++ SQLite version added. Look at `ez_demo.cpp`.

### 1.19
- Fixed bug where any string containing the word 'insert', 'delete' or 'update' was causing unexpected results.
- Added new SQL word 'replace' to match pattern for `$db->insert_id` on 'replace' queries (thanks Rolf Dahl)

### Rest of the changelog...

[See more changelog details in the readme.txt file in includes/ezsql]

## Contributions

This library has been contributed to by several developers over its lifetime. If you wish to contribute, check the repository on [GitHub](https://github.com/underserver/Ponencias).

## License

This project is licensed under the LGPL License - see the LICENSE file for details.



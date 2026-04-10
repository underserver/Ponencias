# ezSQL Library

## Overview
This directory contains the ezSQL library, a PHP class that simplifies database interactions. Created by Justin Vincent, ezSQL provides an abstraction layer to work seamlessly with databases such as MySQL, Oracle, PostgreSQL, SQLite, and MS-SQL.

## Features
- Simplified database connection handling
- Supports multiple database types
- Query execution and result handling
- Debugging capabilities
- Data caching

## Usage
Include the ezSQL library in your project by referencing it in your PHP files:
```php
include_once 'ez_sql.php';
```
Create a new database object for interactions:
```php
$db = new db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
```
Execute queries using the provided methods, such as `get_results()`, `get_row()`, `get_var()`, and others.

## Debugging
Enable debugging to track SQL queries and their results in your scripts:
```php
$db->debug_all = true;
```
Control debug output with `vardump()` and `debug()` methods for customized handling.

## Contribution
Please email Justin Vincent at [justin@visunet.ie](mailto:justin@visunet.ie) with feedback or for contributing to the project. Consider making a donation to support further development.

## License
This library is licensed under LGPL. You are free to utilize and modify ezSQL as required for your projects.


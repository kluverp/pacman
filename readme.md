PacMan CMS
==========

The goal of this CMS is to provide a very simple user-friendly CMS for building websites in PHP. It's built entirely on native PHP code, as to be as independant and future-proof as possible.

Most of the tools today are based on many libraries/frameworks. And how modern these CMS's and tools might be, the more 3rd party software gets put in your product to more dependant you become for these packages to be updated/maintained over time. How often does it not happen that a interface to a package get's overhauled, changed, modified so you to have to adapt your software to keep it working.

Looking at the software landscape today, many libraries and frameworks exist for PHP. Some 'old' ones, some new ones, some very good ones. However one also finds that many of these frameworks/libraries get abandoned over time. The software landscape is very dependant on fashion and popularity. Many frameworks last no more than 5/6 years before some other framework takes over in popularity. And as one framework/library loses popularity it loses development and interest. 

One major factor however remains stable, and that is the base language used. In this case PHP. Sure PHP gets version updates, but keeping up with PHP over time is much easier that keeping up with 3rd party frameworks and tools.

This is the reason behind this CMS. To provide a CMS that can be uses on most sites, without being too dependant on other software. The reason is simple: my time is limited and I don't have time for keeping up with every update for every library/framework used. So with this CMS you can use your framework of choice to built your site/app in without worrying about the CMS. Also speed is an important factor. Some frameworks out there provide many great advanced features, at the cost of speed. User satisfaction of software is for a great deal bases on the speed of usage. Fast is most of the times better, and results in less frustration. Using plain PHP makes the CMS as fast as possible so you have some time left during the day to play with your kids.

### Goals
* Framework independant;
* Library independant;
* Easy to use;
* Robust;
* Future-proof;
* For programmers;
* crossbrowser compatible;

### Features
* configure your custom CMS;
* flexible;
* simple;
* fast;
* customizable - create your own CMS look by modifying the stylesheet, or use the default;
* mobile friendly;


How to use
==========

It is assumed your are familiar with common web techniques and have a basic understanding of PHP. This CMS is not a full framework like Drupal, Wordpress etc. It's a standalone CMS for use in combination with your own code and/or framework of choice.

### Installation

### CMS Configuration

The CMS is configured using a configuration file for each table you have in your database that you want to manage using the CMS. You add a config file in the "/app/config/tables" directory for each table you want to make available trough the CMS.


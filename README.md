#imva_devguide
==============
##Developer's Guide // "Entwicklungshelfer" for OXID eShop Developers

*	Important note! If you already use an older version of the module, please read the (really short) update section.
*	Installation instructions below.



##Purpose

This module provides quick-access to functionalities often required by module and theme developers. Please
familiarise with the configuration before using the module.





##Update

*	If you already use an older version of this module, open the shop admin and go to `Extensions => Modules`
*	Select "imva.biz: Developer's Guide" and disable the module.
*	Remove the existing directory (`imva.biz/imva_devguide`) from your shop's module directory.
*	Refresh the module administration page and if asked if you wish to remove existing associations, confirm.

##Install
*	Copy the contents of `copy_this` to your shop's root directory (where `bootstrap.php` is located.
*	The `metadata.php` file should be located in: `modules/imva.biz/imva_devguide`.
*	In the shop admin, go to `Extensions => Modules` and select "imva.biz: Developer's Guide"
*	In the section below click "activate".

The available features will appear in the admin menu on the left hand side. If they don't appear, log in again.



##Description and user manual
Available at http://www.ackis-oxid.de/2013/entwicklungshelfer-fr-oxid-entwickler-developers-guide/ .



##Features



###Clear cache

*	Clears the compile directory of the shop, database file cache and compiled smarty templates.



###Rebuild views

*	Updates the database views. This is necessary after modifying the database layout.



###Reset modules

*	Most powerful feature of this module
*	Deletes the whole module configuration. Useful if it became impossible to load a module.
*	Also clears the template block associations
*	Contains an auto-revive feature to automatically enable this module again. Recommended.
*	Can also re-activate 3rd party modules. Use this feature with precaution!



##Updating from versions below 0.7.x
If problems occur, please follow the steps described in http://www.ackis-oxid.de/2013/module-kann-nicht-aktiviert-werden-in-oxid-eshop-beheben-modulkonfiguration-zurcksetzen/ .

##System Requirements
*	Created for OXID eShop 4.9 and higher. (CE, PE, EE)
*	Might also work in OXID eShop 4.7 and 4.8.

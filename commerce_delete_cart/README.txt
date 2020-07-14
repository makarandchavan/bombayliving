CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers


Introduction
------------

This project lets you delete a cart out of the database at any step in the process except once they've checked out. This is useful if for some reason your users need the ability to delete their own cart and going back through the steps or adding more items to the cart isn't the solution.

Example use case:
Your Commerce site is used for sales reps to place orders, they're half way through with an order and the customer changes their mind about wanting the product. Now that sales rep needs to restart the whole order so there is no leftover information from the previous customer.


REQUIREMENTS
------------
Must have Commerce for this to work.
https://www.drupal.org/project/commerce


INSTALLATION
------------

1. Download & Install as you usually would


CONFIGURATION
-------------

* Go to /admin/commerce/config/delete-cart-config to change where use is redirected to after deleting cart
* Create a link wherever you need it that links to /cart/$user->uid/delete


MAINTAINERS
-----------

Currently this project is maintained only by Josh Fabean, as it's small enough it will most likely only ever be maintained by me
Drupal: https://www.drupal.org/user/1724888
Twitter: @joshfabean
GitHub: fabean

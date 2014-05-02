Run this script
---------------

php bcrypt-cost-finder.php

By default, this will test all costs between 4 and 20.

php bcrypt-cost-finder.php [start] [end]


To test all costs between 10 and 13 use:
php bcrypt-cost-finder.php 10 13

Current best practices state that you should be targeting .25 to .50 seconds per computation.

# WordPress_Project

### DEV environment vs PRODUCTION environment

| DEV environment            | PRODUCTION environment    |
| -------------------------- | ------------------------- |
| separate copy of your site | Your real ,public website |
| Only you can see it.       | Everyone can see it       |
| Private                    | Known as `live`           |
| sandbox/playground         |
| Your work in progress      |

### Your Computer vs Server

| Your Computer                   | Server                              |
| ------------------------------- | ----------------------------------- |
| Can install wordpress on our pc | Where public website files are live |
| Don't need Internet to work     | Left on 24/7                        |
| Only you can see it             | Where Wordpress usually live        |
| Working Locally                 |

#### Work Locally within a dev environment

### taste of php

```php
<?php
echo 'Hello World';
$myName = 'John Doe';
?>
<h1>This is page is all about
<?php
    echo $myName;
?>
</h1>
<?php
echo 2 + 4;

?>
<h2>All about <?php echo $myName ?></h2>

##### php and html can intertwine
```

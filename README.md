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

```php
<!-- Functions -->

<?php
    function myFirstFunction() {
        echo "<p>Hello ,This is my first php fun</p>";
    }


    function mySecondFunction($name) {
        echo "<p>Hello $name</p>";
    }
    mySecondFunction("John");
    mySecondFunction("Jane");

?>

<h1><?php
 bloginfo('name');
  ?>
  </h1>

  <p>

  <?php
 bloginfo('description');
  ?>
  </p>
  <!-- Arrays -->
<?php
    $myName="Brad";
?>
<p>Hi ,my name is <?php
    echo $myName; ?>
</p>

<?php
    $names = array("Brad","John","Jane","Doe");
    $count=1;
    $c=1;
    while($count<=100){
        echo "<li>$count</li>";
        $count++;
    }
    while($c<count($names)){
        echo "<li>Hi my name is $names[$c]. </li>";
        $c++;
    }
?>

<p>Hi my name is <?php echo $names[2] ?> </p>


//index.php

<!--  How to display our blogpost in the homepage-->
  <?php
  while(have_posts()){
      the_post();
      ?>

      <h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
      <p><?php the_content(); ?></p>
      <?php

}
?>
```

//single.php

##### In order to display the post in their respective router,wordpress will look for single.php absence of which It will rendered in index.php

<?php
  while(have_posts()){
      the_post();
      ?>

      <h2><?php the_title(); ?></h2>
      <p><?php the_content(); ?></p>
      <?php

}
?>

//page.php

## Page has their own url,it doesn't use index.php as fallback...

```php
  <?php
  while(have_posts()){
      the_post();
      ?>

      <h2><?php the_title(); ?></h2>
      <p><?php the_content(); ?></p>
      <?php

}
?>

  <h2>This is a page not a post</h2>
```

#### Key takeaways (functions)

- **`have_posts()`**:  
  Checks if there are any posts to display in the loop.

- **`the_title()`**:  
  Displays the title of the current post.

- **`the_content()`**:  
  Outputs the content of the current post.

- **`bloginfo('name')`**:  
  Retrieves the name of the website (usually the site title).

- **`bloginfo('description')`**:  
  Retrieves the website's tagline or description.

#### Retrieves url of the images

```php
<?php
  echo get_theme_file_uri('/images/bus.jpg')
 ?>
```

#### Functions to configure css or scripts file

```php
<?php

function university_files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);//hey wordpress, please output the main.js file
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));//hey wordpress, please output the style.css file(default stylesheet in wordpress)
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}
add_action('wp_enqueue_scripts', 'university_files');//hey wordpress, when you are about to output the scripts, please run this function
```

#### key takeaways

- **wp_enqueue_script**: This function is used to safely add JavaScript files to a WordPress site. It ensures that the scripts are loaded in the proper order and only when needed, avoiding conflicts.

- **wp_enqueue_style**: This function is used to safely add CSS files to a WordPress site. It helps in managing the order of stylesheets and avoids duplication or conflicts.

- **add_action**: This function is used to hook custom functions into specific actions or events in WordPress, such as loading scripts, creating custom post types, or adding content to specific sections of the site.

- **get_theme_file_uri**: This function returns the URI (Uniform Resource Identifier) to a file located within the theme's directory, allowing you to link assets such as images, JavaScript, or CSS files.

###### wp_head() and wp_footer() are essential WordPress functions that allow WordPress and plugins to inject necessary code (like styles, scripts, and meta tags) into the header and footer sections of a theme. They ensure proper functionality of features like the admin bar, plugin resources, and WordPress core features. Without these functions, critical functionality may break or not load as intended.

key takeaways:
`site_url()`
`the_permalink`

#### Associative Arrays :

```php
<?php

  $animalSounds=array(
    'cat'=>'meow',
    'dog'=>'bark',
    'pig'=>'oink'
  );

  echo $animalSounds['dog'];
?>
```

####

```php

    <?php
    $theParent = wp_get_post_parent_id(get_the_ID());
    if ($theParent) {
    ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href=<?php echo get_permalink($theParent) ?>><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent) ?></a> <span class="metabox__main"><?php echo the_title(); ?></span>
        </p>
      </div>
      <p></p>
    <?php
    }
    ?>
    <?php
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));
    if ($theParent or $testArray){
    ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href=<?php echo get_permalink($theParent) ?>><?php echo get_the_title($theParent) ?></a></h2>
      <ul class="min-list">

        <?php
        if ($theParent) {
          $findChildrenOf = $theParent;
        } else {
          $findChildrenOf = get_the_ID();
        }
        wp_list_pages(array(

          'title_li' => NULL,
          'child_of' => $findChildrenOf,
          'sort_column' => 'menu_order'
        ));
        ?>
      </ul>
    </div>

  <?php }
  ?>

```

# WordPress Key Takeaways Cheatsheet

### `$theParent = wp_get_post_parent_id(get_the_ID());`

- **Purpose**: Retrieves the ID of the parent post of the current post.
- **Usage**:
  ```php
  $theParent = wp_get_post_parent_id(get_the_ID());
  ```
- **Example**:
  For a page with a parent, `$theParent` will store the parent page's ID.

---

### `echo get_permalink($theParent);`

- **Purpose**: Outputs the permalink (URL) of the parent post.
- **Usage**:
  ```php
  echo get_permalink($theParent);
  ```
- **Example**:
  Displays the URL to the parent page of the current page.

---

### `echo get_the_title($theParent);`

- **Purpose**: Outputs the title of the parent post.
- **Usage**:
  ```php
  echo get_the_title($theParent);
  ```
- **Example**:
  Displays the title of the parent page of the current page.

---

### `wp_list_pages(array('title_li' => NULL, 'child_of' => $findChildrenOf, 'sort_column' => 'menu_order'));`

- **Purpose**: Lists the child pages of a specific page.
- **Parameters**:
  - `title_li`: Removes the default title for the list.
  - `child_of`: Specifies the parent page ID whose children are to be listed.
  - `sort_column`: Sorts the pages based on menu order.
- **Usage**:
  ```php
  <?php
    theParent = wp_get_post_parent_id(get_the_ID());
    if ($theParent) {
      $findChildrenOf = $theParent;
    } else {
        $findChildrenOf = get_the_ID();
    }
    wp_list_pages(array(
      'title_li' => NULL,
      'child_of' => $findChildrenOf,
      'sort_column' => 'menu_order'
    ));
  ```
- **Example**:
  Displays a list of child pages ordered by their menu position.

---

### `$testArray = get_pages(array('child_of' => get_the_ID()));`

- **Purpose**: Retrieves an array of child pages for the current post.
- **Parameters**:
  - `child_of`: Specifies the ID of the parent page to find children for.
- **Usage**:
  ```php
  $testArray = get_pages(array('child_of' => get_the_ID()));
  ```
- **Example**:
  Stores an array of child pages of the current page into `$testArray` for further processing.

---

### General Notes

- These functions are particularly useful for creating hierarchical navigation or custom menus in WordPress themes.
- Always ensure to check for edge cases, such as when a page does not have a parent or children, to avoid errors.
- Use WordPress Codex for detailed documentation on these functions: [WordPress Developer Resources](https://developer.wordpress.org).

### Generalized form of menu

##### steps:

- create menus
  ```php
  function university_features(){
    register_nav_menu('headerMenuLocation', 'Header Menu Location'); //hey wordpress, please add the header menu location
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');//hey wordpress, please add the title tag to the head of the document
  }
  add_action( 'after_setup_theme','university_features');
  ```
- navigate to the location in wp-admin page appearance -> menu(menu will be added once you trigger `register_nav_menu` )
- create menu and set its page and their order
- then set the respective menu-list in their respective html position

  ```php
    <nav class="nav-list">
          <?php wp_nav_menu(array("theme_location" => "footerLocationTwo")) ?>
    </nav>

  ```

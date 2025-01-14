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

## Page has their own url,it doesn't use index.php as fallback...It

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

#### Functions to configure css or scripts file 
```php
<?php
  echo get_theme_file_uri('/images/bus.jpg') 
 ?>
```
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
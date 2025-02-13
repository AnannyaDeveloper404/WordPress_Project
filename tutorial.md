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
 //This function returns the name of the site, which is set in the WordPress dashboard → Settings → General → Site Title.

  ?>
  </h1>

  <p>

  <?php
 bloginfo('description');
 //This function returns the tagline (site description), set in WordPress dashboard → Settings → General → Tagline.
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

#### Retrieves url of the images present in your local repo

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

#### Wordpress/php code snippet

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
    if ($theParent or $testArray){///Used to check if the page has any child or if the page is child of any parent within the if statement
    ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href=<?php echo get_permalink($theParent) ?>><?php echo get_the_title($theParent) ?></a></h2>
      <ul class="min-list">

        <?php
        if ($theParent) {
          $findChildrenOf = $theParent; //list all the child of the parent(e.g,parent(about)=>children(our history ,our goal))
        } else {
          $findChildrenOf = get_the_ID();//list all the child of its own since the routed page is the parent itself
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

### Directory Management in Wordpress's perspective

- condition : In reading section of setting set home page set Home and set post page as blog

For Home page ,Select front-page.php to render the home page by default.Router will be

- ```php
     <?php echo site_url() ?>
  ```

For Blog page ,render all the posts in the blog will be rendered in the router

- ```php
  <?php echo site_url('blog') ?>
  ```

- Blog renders the index.php as its main page and its archives such as **CATEGORY** or **AUTHOR** page will look for separate concerned page called archive.php
  - For category ,You can get category `Posts` > `Categories`
  - For Author,Wordpress usually takes the publicly available ,which is stored in USer

For rendering posts in their respective page,Wordpress will find single.php to render the post.

- ```php
      <?php echo site_url('blog/postname') ?>
  ```

For Pages,Wordpress will look for single.php to render the respective page with the respective content

- ```php
        <?php echo site_url('/page-name') ?>
  ```

```

```

For custom posts ,wordpress will look for the file single-<custom-post-name>(e.g,single-event.php)

- Custom posts main page (where all the custom posts being rendered) ,wordpress look for archive-<custom-post-name>.php and load the custom post's content accordingly
- In order to rendering Each single custom post,Wordpress will look for single-<custom-post-name>.php (e.g,single-event.php)

#### Code snippets 1:

```php
  <?php
      $homepageEvents = new WP_Query(array(
          'posts_per_page' => 2,
          'post_type' => 'event'
      ));
      while ($homepageEvents->have_posts()) {
          $homepageEvents->the_post(); ?>
          <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                  <span class="event-summary__month">Mar</span>
                  <span class="event-summary__day">25</span>
              </a>
              <div class="event-summary__content">
                  <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                  <p><?php if (has_excerpt()) {
                          echo get_the_excerpt();
                      } else {
                          echo  wp_trim_words(get_the_content(), 18);
                      }
                      ?> <a href=<?php the_permalink(); ?> class="nu gray">Learn more</a></p>
              </div>
          </div>
      <?php
      }
      ?>

```

### Key takeaways from the above snippet:

#### Main goal is to render some posts(only the title and excerpt) on the home page

#### `$homepageEvents = new WP_Query(array(...))`

- **Purpose**: Creates a new custom query to fetch posts.
- **Details**:
  - `posts_per_page`: Limits the number of posts retrieved (2 in this case).
  - `post_type`: Specifies the type of posts to retrieve (`event` in this case).

#### `$homepageEvents->have_posts()`

- **Purpose**: Checks if there are more posts available in the custom query.
- **Returns**: `true` if posts are available; `false` otherwise.

#### `$homepageEvents->the_post()`

- **Purpose**: Prepares the current post data for use in the loop.
- **Effect**: Sets up global post data (`$post`) so template tags like `the_title()` and `the_content()` work.

#### `<a href="<?php the_permalink() ?>">`

- **Function**: `the_permalink()`
  - **Purpose**: Outputs the URL for the current post.
  - **Use**: Creates a link to the detailed view of the post.

#### `<?php the_title(); ?>`

- **Purpose**: Outputs the title of the current post.

#### `has_excerpt()`

- **Purpose**: Checks if the current post has a manually defined excerpt.
- **Returns**: `true` if an excerpt exists; `false` otherwise.

#### `get_the_excerpt()`

- **Purpose**: Retrieves the manually defined excerpt of the current post.

#### `get_the_content()`

- **Purpose**: Retrieves the full content of the current post.

#### `wp_trim_words(get_the_content(), 18)`

- **Purpose**: Trims the full content of the post to 18 words.
- **Use**: Provides a shortened version of the content if no excerpt exists.

#### `<a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>`

- **Purpose**: Creates a link labeled "Learn more" to the post's detail page.

##### Notes

- The loop structure (`while`) ensures that all posts from the query are processed.
- This code fetches and displays a summary of the latest two `event` posts, including their titles, excerpts (or trimmed content), and a "Learn more" link.

```

```

### SNIPPET CODE

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


function university_features(){
    // register_nav_menu('headerMenuLocation', 'Header Menu Location'); //hey wordpress, please add the header menu location
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');//hey wordpress, please add the title tag to the head of the document
    add_theme_support('post-thumbnails');//hey wordpress, please add the post thumbnail feature
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorLandscape', 480, 650, true);

}
add_action( 'after_setup_theme','university_features');

function university_adjust_queries($query){
    if(!is_admin() && is_post_type_archive('program') && is_main_query()){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' =>$today,
                'type' => 'numeric'
            )
        ));
    }
}


add_action('pre_get_posts', 'university_adjust_queries');
```

#### Explanation of above code

---

### **Function 1: Enqueuing Scripts and Styles**

```php
function university_files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
```

- **`wp_enqueue_script`**: Registers and enqueues a JavaScript file in WordPress.
- `'main-university-js'`: A unique handle to identify this script.
- **`get_theme_file_uri('/build/index.js')`**: Retrieves the URL for the `index.js` file located in the `/build` directory of the theme.
- **`array('jquery')`**: Specifies `jquery` as a dependency for this script, ensuring it loads first.
- **`'1.0'`**: Version number for cache busting.
- **`true`**: Indicates the script should be loaded in the footer (`false` would load it in the header).

```php
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
```

- **`wp_enqueue_style`**: Registers and enqueues a CSS file in WordPress.
- `'font-awesome'`: Unique handle for this stylesheet.
- **URL**: Loads Font Awesome from a CDN.

```php
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
```

- Loads custom Google Fonts via a URL.

```php
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
```

- Loads the theme's primary stylesheet (`style-index.css`).

```php
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
```

- Loads an additional stylesheet (`index.css`).

```php
}
add_action('wp_enqueue_scripts', 'university_files');
```

- **`add_action('wp_enqueue_scripts', 'university_files')`**: Hooks `university_files` into the `wp_enqueue_scripts` action to load styles and scripts when WordPress outputs scripts on the front end.

---

### **Function 2: Adding Theme Features**

```php
function university_features(){
```

- Defines the `university_features` function to add theme-related features.

```php
    add_theme_support('title-tag');
```

- Enables WordPress to manage the `<title>` tag dynamically.

```php
    add_theme_support('post-thumbnails');
```

- Enables support for featured images (post thumbnails).

```php
    add_image_size('professorLandscape', 400, 260, true);
```

- Registers a custom image size:
  - `'professorLandscape'`: The handle for this image size.
  - `400, 260`: Width and height in pixels.
  - `true`: Crops the image to these exact dimensions.

```php
    add_image_size('professorPortrait', 480, 650, true);
```

- Registers another custom image size for portrait images.

```php
}
add_action( 'after_setup_theme','university_features');
```

- Hooks `university_features` into the `after_setup_theme` action to initialize theme features when the theme is set up.

---

### **Function 3: Adjusting Queries**

```php
function university_adjust_queries($query){
```

- Defines the `university_adjust_queries` function to customize WordPress queries.

```php
    if(!is_admin() && is_post_type_archive('program') && is_main_query()){
```

- Checks if:
  - **`!is_admin()`**: The request is not for the admin dashboard.
  - **`is_post_type_archive('program')`**: The query is for the archive page of the custom post type `program`.
  - **`is_main_query()`**: It’s the primary query (not a custom or secondary query).

```php
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
```

- Modifies the query:
  - Orders posts by title (`orderby`).
  - Sets ascending order (`ASC`).
  - Displays all posts (`-1` means no pagination).

```php
    if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
```

- Similar to the first condition but for the custom post type `event`.

```php
        $today = date('Ymd');
```

- Gets the current date in `YYYYMMDD` format.

```php
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' =>$today,
                'type' => 'numeric'
            )
        ));
```

- Customizes the query:
  - Sorts posts by a meta key (`event_date`) numerically (`meta_value_num`).
  - Includes only posts where `event_date` is greater than or equal to today’s date (`>=`).
  - Uses a meta query to filter posts based on the `event_date` meta key.

```php
    }
}
add_action('pre_get_posts', 'university_adjust_queries');
```

- Hooks `university_adjust_queries` into the `pre_get_posts` action, allowing it to modify the query before WordPress retrieves posts.

---

### **Summary**

This script:

1. Loads JavaScript and CSS files for the theme.
2. Adds theme features like title tags, post thumbnails, and custom image sizes.
3. Customizes queries for specific post type archives (`program` and `event`).

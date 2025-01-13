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
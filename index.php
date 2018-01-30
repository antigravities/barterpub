<?php

if( ! @isset($_POST['page']) || ! is_numeric($_POST['page'])) $page = 1;
else $page = $_POST['page'];

if( @isset($_POST['name']) && ! empty($_POST['name']) && ( ! @isset($_POST['sel']) || ($_POST['sel'] != "developer" && $_POST['sel'] != "publisher" ) ) ) die("Please select 'developer' or 'publisher'");

if( @isset($_POST['name']) && ! empty($_POST['name']) ){
  $html = file_get_contents("http://store.steampowered.com/search/?". $_POST['sel'] . "=" . urlencode($_POST['name']) . "&page=" . ((int) $_POST['page']));
  
  if( empty($html) ) die("Could not contact Steam right now. Please try again later.");
  
  $dom = new DOMDocument();
  libxml_use_internal_errors(TRUE);
  $dom->loadHTML($html);
  
  libxml_clear_errors();
  $xpath = new DOMXPath($dom);
  
  $query = $xpath->query("//a[@data-ds-appid]");
  
  if( $query->length < 1 ) die("No apps found for that publisher or developer. Please try again.");
  
  $apps = array();
  $names = array();
  
  foreach( $query as $item ){
    $names[] = trim(explode("\n", $item->nodeValue)[4]);
    $apps[] = $item->getAttribute("data-ds-appid");
  }
  
}
?>
<html>
  <head>
    <title>
      Publisher List Utility
    </title>
  </head>
  <body>
    <h1>Publisher List Utility</h1>
    
    <?php
      if( @isset($apps) ){
        echo "<h3>Result</h3>Clicking a button below will add the following apps to a list (showing page <b>$page</b>):<br><br>";
        foreach( $apps as $k => $a ){
        ?>
          <img src="http://cdn.edgecast.steamstatic.com/steam/apps/<?php echo $a; ?>/capsule_sm_120.jpg"></a> <?php echo $names[$k] ?> [<?php echo $a; ?>]<br>
        <?php
        }
        ?>
          <br><br>
          <form action="https://barter.vg/u/me/b/e/#modified" method="POST" style="display: inline;">
            <input type="hidden" name="bulk_AppIDs" value="<?php echo implode($apps, ','); ?>"></input>
            <input type="hidden" name="action" value="Edit"></input>
            <input type="hidden" name="change_attempted" value="1"></input>
            <input type="submit" value="Add to Blacklist"></input>
          </form>
          
          <form action="https://barter.vg/u/me/l/e/#modified" method="POST" style="display: inline;">
            <input type="hidden" name="bulk_AppIDs" value="<?php echo implode($apps, ','); ?>"></input>
            <input type="hidden" name="action" value="Edit"></input>
            <input type="hidden" name="change_attempted" value="1"></input>
            <input type="submit" value="Add to Library"></input>
          </form>
          
          <form action="https://barter.vg/u/me/t/e/#modified" method="POST" style="display: inline;">
            <input type="hidden" name="bulk_AppIDs" value="<?php echo implode($apps, ','); ?>"></input>
            <input type="hidden" name="action" value="Edit"></input>
            <input type="hidden" name="change_attempted" value="1"></input>
            <input type="submit" value="Add to Tradable"></input>
          </form>
        <?php
      }
      ?>
    <?php
    ?>
    
    <h3>Search</h3>
    
    <form action="" method="POST">
      <input type="text" name="name" placeholder="Developer/publisher"></input><br><br>
      
      <input type="radio" name="sel" value="developer"></input> Developer<br>
      <input type="radio" name="sel" value="publisher"></input> Publisher<br><br>
      <input type="text" name="page" placeholder="Page"></input> (If in doubt, don't type anything)<br><br>
      
      <input type="submit" value="Search"></input><br>
      Note: this may take a moment...
    </form>
  </body>
</html>
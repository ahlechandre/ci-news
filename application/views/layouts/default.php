<?php 
  if (!defined('BASEPATH')) exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title><?php echo $title; ?> - Eduwiki</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <main>
      <header class="ava-header">
        <h1>Eduwiki</h1>
        <ul>
          <li>
            <a href="<?php echo base_url('/') ?>">Home</a>
          </li>
          <li>
            <a href="<?php echo base_url('/news') ?>">News</a>
          </li>
        </ul>
      </header>
      <section class="ava-page">
        <?php
          echo $page;
        ?>
      </section>
    </main>
    <script src="<?php echo base_url() . 'public/js/app.js' ?>"></script>
  </body>
</html>

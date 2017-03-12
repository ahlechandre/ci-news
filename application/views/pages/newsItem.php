<div class="ava-news">
  <h1 class="ava-news__title">
    <?php 
      echo $newsItem->title
    ?>
  </h1>
  <p class="ava-news__content">
    <?php
      echo $newsItem->text
    ?>
  </p>
</div>

<div>
  <form name="form-news-destroy" action="<?php echo current_url() ?>" method="post">
    <input type="hidden" name="_method" value="delete">
    <button type="submit" name="submit-destroy">Remove</button>
    <a href="<?php echo current_url() . '/edit' ?>">Edit news</a>
  </form>
</div>

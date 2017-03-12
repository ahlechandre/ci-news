<ul class="ava-newslist">
  <?php 
    foreach($newsItems as $id => $news) : 
  ?>
    <li class="ava-news__item">
      <a href="<?php echo base_url("/news/{$news['slug']}"); ?>" id="news_<?php echo $id; ?>" class="ava-news__title">
        <?php echo $news['title']; ?>
      </a>
    </li>
  <?php 
    endforeach;
  ?>
</ul>
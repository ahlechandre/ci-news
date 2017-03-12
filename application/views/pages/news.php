<h1>
  News page
</h1>

<?php
  echo $this->july::partial('news/list', [
    'newsItems' => $newsItems,
  ]);
?>

<div>
  <a href="<?php echo base_url() . 'news/add' ?>">Create a news</a>
</div>
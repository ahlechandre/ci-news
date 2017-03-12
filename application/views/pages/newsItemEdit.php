<h1>Edit news</h1>

<?php 
  echo $this->july::partial('forms/newsItem', [
    'newsItem' => $newsItem,
    'isUpdate' => true,
  ]);
?>

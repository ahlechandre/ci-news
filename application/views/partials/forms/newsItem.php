<?php
$getNewsUrl = function ($newsEditUrl) {
  $url = explode('/', $newsEditUrl);
  array_pop($url);
  return implode('/', $url);
};

$getNewsValues = function ($news) {
  $getValue = function ($value) {
      return (isset($value) and $value) ? $value : null;
  };
  $values = [];
  $values['id'] = $getValue($news->id);
  $values['title'] = $getValue($news->title);
  $values['content'] = $getValue($news->text);
  $values['slug'] = $getValue($news->slug);
  return $values;
};

$values = $isUpdate && isset($newsItem) ? $getNewsValues($newsItem) : [
  'id' => '',
  'title' => '',
  'content' => '',
  'slug' => '',
];
?>

<form name="form-news-<?php echo $isUpdate ? 'edit' : 'create' ?>" action="<?php echo current_url() ?>" method="POST">
  <?php if ($isUpdate) : ?>
    <!-- HTTP REQUEST VIRTUAL METHOD -->
    <input type="hidden" name="_method" value="PUT" />
  <?php endif; ?>
  <div>
    <div>
      <label for="news-title">Title</label>
    </div>
    <div>
      <input type="text" name="news-title" id="news-title" value="<?php echo $values['title'] ?>">
    </div>
  </div>
  <div>
    <div>
      <label for="news-content">Content</label>  
    </div>
    <div>
      <textarea name="news-content" id="news-content"><?php 
          echo $values['content']
        ?></textarea>
    </div>
  </div>
  <div>
    <a href="<?php echo $getNewsUrl(current_url()) ?>">Cancel</a>
    <button type="submit" name="submit-update">Save changes</button>
  </div>
</form>
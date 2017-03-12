<h1>Create a news</h1>

<?php 
  echo $this->july::partial('forms/newsItem', [
    'isUpdate' => false,
  ]);
?>

<?php if (isset($validationErrors) && !empty($validationErrors)) : ?>
  <h1>Validation errors: </h1>
  <ul style="color:red">
    <?php foreach ($validationErrors as $error) : ?>
      <li>
        <?php echo $error['message']; ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
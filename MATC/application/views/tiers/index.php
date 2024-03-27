<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MATC</title>
  <link rel='stylesheet' href='application/assets/css/tiers.css'/>
  <script src='application/assets/js/tiers.js' async></script>
</head>
<body>
  
<div class='title'>
  <label class='title-label' for='title-input'>My TierList</label>
  <input type='text' id='title-input' />
</div>

<!-- <input id='load-img-input' type='file' accept='image/*' multiple/> -->

<section class='main-content'>
  <div class='tierlist'></div>

  <div class='bottom-container'>
    <a href="<?php echo URL.'Search' ?>"><button class='button'>Add</button></a>
            
    <section class='images'></section>
  </div>
</section>

</body>
</html>
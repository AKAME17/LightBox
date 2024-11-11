<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', Verdana, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
      color: #333;
    }

    * {
      box-sizing: border-box;
    }

    h2 {
      text-align: center;
      padding: 20px 0;
      background-color: #444;
      color: white;
      margin: 0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 10px;
    }

    .column {
      padding: 8px;
      width: 25%;
      height: 40vh;
      overflow: hidden;
    }

    .column img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 5px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .column img:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
      position: relative;
      background-color: white;
      margin: auto;
      padding: 0;
      width: 90%;
      max-width: 1200px;
      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .close {
      color: #aaa;
      position: absolute;
      top: 10px;
      right: 25px;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      cursor: pointer;
    }

    .mySlides {
      display: none;
    }

    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: auto;
      padding: 16px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.3s;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 3px;
    }

    .prev {
      left: 10px;
    }

    .next {
      right: 10px;
    }

    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    .caption-container {
      text-align: center;
      padding: 10px 20px;
      background-color: #222;
      color: white;
      font-size: 14px;
    }

    .demo {
      opacity: 0.6;
      border-radius: 5px;
      transition: 0.3s;
    }

    .demo:hover,
    .active {
      opacity: 1;
    }
  </style>
</head>
<body>

<h2>Lightbox Gallery</h2>

<div class="row">
  <?php
    $image_dir = "img/"; 
    $images = glob($image_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE); 

    foreach ($images as $index => $image) {
        echo '<div class="column">
                <img src="' . $image . '" onclick="openModal();currentSlide(' . ($index + 1) . ')" class="hover-shadow cursor">
              </div>';
    }
  ?>
</div>

<div id="myModal" class="modal">
  <span class="close" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    <?php
      foreach ($images as $index => $image) {
          echo '<div class="mySlides">
                  <div class="numbertext">' . ($index + 1) . ' / ' . count($images) . '</div>
                  <img src="' . $image . '" style="width:100%">
                </div>';
      }
    ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <div class="row">
      <?php
        foreach ($images as $index => $image) {
            echo '<div class="column">
                    <img class="demo cursor" src="' . $image . '" onclick="currentSlide(' . ($index + 1) . ')" alt="Image ' . ($index + 1) . '">
                  </div>';
        }
      ?>
    </div>
  </div>
</div>

<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");

  if (n > slides.length) slideIndex = 1;
  if (n < 1) slideIndex = slides.length;

  for (i = 0; i < slides.length; i++) slides[i].style.display = "none";
  for (i = 0; i < dots.length; i++) dots[i].className = dots[i].className.replace(" active", "");

  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  captionText.innerHTML = dots[slideIndex - 1].alt;
}
</script>

</body>
</html>

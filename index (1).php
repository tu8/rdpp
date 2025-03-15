<?php
// اسم الملف النصي لتخزين عدد الزوار
$visitors_file = 'visitors_count.txt';

// التحقق من وجود الملف، إذا لم يكن موجودًا، قم بإنشائه وضبط القيمة الابتدائية إلى 200
if (!file_exists($visitors_file)) {
    file_put_contents($visitors_file, '0');
}

// قراءة عدد الزوار الحالي من الملف
$visitors_count = (int)file_get_contents($visitors_file);

// زيادة العدد بمقدار 1 مع كل زيارة
$visitors_count++;
file_put_contents($visitors_file, $visitors_count);
?>
<html lang="en" data-qb-installed="true"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mplay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 32px;
            color: #e50914;
            margin-bottom: 30px;
        }
        .search-form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            border: none;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #e50914;
            color: white;
            font-weight: bold;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #b00710;
        }
        .movie-card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .movie-card {
            background-color: #222;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);
        }
        .movie-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
        .movie-title {
            font-size: 1.2rem;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .rating {
            color: #FFD700;
            text-align: center;
            padding-bottom: 10px;
        }
        .btn-watch {
            display: block;
            width: 80%;
            margin: 10px auto;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #e50914;
            color: white;
            font-weight: bold;
        }
        .btn-watch:hover {
            background-color: #b00710;
        }
    </style>
<style type="text/css">.lf-progress {
  -webkit-appearance: none;
  -moz-apperance: none;
  width: 100%;
  /* margin: 0 10px; */
  height: 4px;
  border-radius: 3px;
  cursor: pointer;
}
.lf-progress:focus {
  outline: none;
  border: none;
}
.lf-progress::-moz-range-track {
  cursor: pointer;
  background: none;
  border: none;
  outline: none;
}
.lf-progress::-webkit-slider-thumb {
  -webkit-appearance: none !important;
  height: 13px;
  width: 13px;
  border: 0;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress::-moz-range-thumb {
  -moz-appearance: none !important;
  height: 13px;
  width: 13px;
  border: 0;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress::-ms-track {
  width: 100%;
  height: 3px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
.lf-progress::-ms-fill-lower {
  background: #ccc;
  border-radius: 3px;
}
.lf-progress::-ms-fill-upper {
  background: #ccc;
  border-radius: 3px;
}
.lf-progress::-ms-thumb {
  border: 0;
  height: 15px;
  width: 15px;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress:focus::-ms-fill-lower {
  background: #ccc;
}
.lf-progress:focus::-ms-fill-upper {
  background: #ccc;
}
.lf-player-container :focus {
  outline: 0;
}
.lf-popover {
  position: relative;
}

.lf-popover-content {
  display: inline-block;
  position: absolute;
  opacity: 1;
  visibility: visible;
  transform: translate(0, -10px);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  transition: all 0.3s cubic-bezier(0.75, -0.02, 0.2, 0.97);
}

.lf-popover-content.hidden {
  opacity: 0;
  visibility: hidden;
  transform: translate(0, 0px);
}

.lf-player-btn-container {
  display: flex;
  align-items: center;
}
.lf-player-btn {
  cursor: pointer;
  fill: #999;
  width: 14px;
}

.lf-player-btn.active {
  fill: #555;
}

.lf-popover {
  position: relative;
}

.lf-popover-content {
  display: inline-block;
  position: absolute;
  background-color: #ffffff;
  opacity: 1;

  transform: translate(0, -10px);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  transition: all 0.3s cubic-bezier(0.75, -0.02, 0.2, 0.97);
  padding: 10px;
}

.lf-popover-content.hidden {
  opacity: 0;
  visibility: hidden;
  transform: translate(0, 0px);
}

.lf-arrow {
  position: absolute;
  z-index: -1;
  content: '';
  bottom: -9px;
  border-style: solid;
  border-width: 10px 10px 0px 10px;
}

.lf-left-align,
.lf-left-align .lfarrow {
  left: 0;
  right: unset;
}

.lf-right-align,
.lf-right-align .lf-arrow {
  right: 0;
  left: unset;
}

.lf-text-input {
  border: 1px #ccc solid;
  border-radius: 5px;
  padding: 3px;
  width: 60px;
  margin: 0;
}

.lf-color-picker {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  height: 90px;
}

.lf-color-selectors {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.lf-color-component {
  display: flex;
  flex-direction: row;
  font-size: 12px;
  align-items: center;
  justify-content: center;
}

.lf-color-component strong {
  width: 40px;
}

.lf-color-component input[type='range'] {
  margin: 0 0 0 10px;
}

.lf-color-component input[type='number'] {
  width: 50px;
  margin: 0 0 0 10px;
}

.lf-color-preview {
  font-size: 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  padding-left: 5px;
}

.lf-preview {
  height: 60px;
  width: 60px;
}

.lf-popover-snapshot {
  width: 150px;
}
.lf-popover-snapshot h5 {
  margin: 5px 0 10px 0;
  font-size: 0.75rem;
}
.lf-popover-snapshot a {
  display: block;
  text-decoration: none;
}
.lf-popover-snapshot a:before {
  content: '⥼';
  margin-right: 5px;
}
.lf-popover-snapshot .lf-note {
  display: block;
  margin-top: 10px;
  color: #999;
}
.lf-player-controls > div {
  margin-right: 5px;
  margin-left: 5px;
}
.lf-player-controls > div:first-child {
  margin-left: 0px;
}
.lf-player-controls > div:last-child {
  margin-right: 0px;
}
</style><style type="text/css">.lf-progress {
  -webkit-appearance: none;
  -moz-apperance: none;
  width: 100%;
  /* margin: 0 10px; */
  height: 4px;
  border-radius: 3px;
  cursor: pointer;
}
.lf-progress:focus {
  outline: none;
  border: none;
}
.lf-progress::-moz-range-track {
  cursor: pointer;
  background: none;
  border: none;
  outline: none;
}
.lf-progress::-webkit-slider-thumb {
  -webkit-appearance: none !important;
  height: 13px;
  width: 13px;
  border: 0;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress::-moz-range-thumb {
  -moz-appearance: none !important;
  height: 13px;
  width: 13px;
  border: 0;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress::-ms-track {
  width: 100%;
  height: 3px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
.lf-progress::-ms-fill-lower {
  background: #ccc;
  border-radius: 3px;
}
.lf-progress::-ms-fill-upper {
  background: #ccc;
  border-radius: 3px;
}
.lf-progress::-ms-thumb {
  border: 0;
  height: 15px;
  width: 15px;
  border-radius: 50%;
  background: #0fccce;
  cursor: pointer;
}
.lf-progress:focus::-ms-fill-lower {
  background: #ccc;
}
.lf-progress:focus::-ms-fill-upper {
  background: #ccc;
}
.lf-player-container :focus {
  outline: 0;
}
.lf-popover {
  position: relative;
}

.lf-popover-content {
  display: inline-block;
  position: absolute;
  opacity: 1;
  visibility: visible;
  transform: translate(0, -10px);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  transition: all 0.3s cubic-bezier(0.75, -0.02, 0.2, 0.97);
}

.lf-popover-content.hidden {
  opacity: 0;
  visibility: hidden;
  transform: translate(0, 0px);
}

.lf-player-btn-container {
  display: flex;
  align-items: center;
}
.lf-player-btn {
  cursor: pointer;
  fill: #999;
  width: 14px;
}

.lf-player-btn.active {
  fill: #555;
}

.lf-popover {
  position: relative;
}

.lf-popover-content {
  display: inline-block;
  position: absolute;
  background-color: #ffffff;
  opacity: 1;

  transform: translate(0, -10px);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  transition: all 0.3s cubic-bezier(0.75, -0.02, 0.2, 0.97);
  padding: 10px;
}

.lf-popover-content.hidden {
  opacity: 0;
  visibility: hidden;
  transform: translate(0, 0px);
}

.lf-arrow {
  position: absolute;
  z-index: -1;
  content: '';
  bottom: -9px;
  border-style: solid;
  border-width: 10px 10px 0px 10px;
}

.lf-left-align,
.lf-left-align .lfarrow {
  left: 0;
  right: unset;
}

.lf-right-align,
.lf-right-align .lf-arrow {
  right: 0;
  left: unset;
}

.lf-text-input {
  border: 1px #ccc solid;
  border-radius: 5px;
  padding: 3px;
  width: 60px;
  margin: 0;
}

.lf-color-picker {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  height: 90px;
}

.lf-color-selectors {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.lf-color-component {
  display: flex;
  flex-direction: row;
  font-size: 12px;
  align-items: center;
  justify-content: center;
}

.lf-color-component strong {
  width: 40px;
}

.lf-color-component input[type='range'] {
  margin: 0 0 0 10px;
}

.lf-color-component input[type='number'] {
  width: 50px;
  margin: 0 0 0 10px;
}

.lf-color-preview {
  font-size: 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  padding-left: 5px;
}

.lf-preview {
  height: 60px;
  width: 60px;
}

.lf-popover-snapshot {
  width: 150px;
}
.lf-popover-snapshot h5 {
  margin: 5px 0 10px 0;
  font-size: 0.75rem;
}
.lf-popover-snapshot a {
  display: block;
  text-decoration: none;
}
.lf-popover-snapshot a:before {
  content: '⥼';
  margin-right: 5px;
}
.lf-popover-snapshot .lf-note {
  display: block;
  margin-top: 10px;
  color: #999;
}
.lf-player-controls > div {
  margin-right: 5px;
  margin-left: 5px;
}
.lf-player-controls > div:first-child {
  margin-left: 0px;
}
.lf-player-controls > div:last-child {
  margin-right: 0px;
}
</style></head>
<body>
    <div class="container">
        <h1>Mplay</h1>
        <form action="results.php" method="get" class="search-form">
            <input type="text" name="movie" placeholder="Search for a series" required="">
            <button type="submit">Search</button>
        </form>
      

<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 32px;
            color: #e50914;
            margin-bottom: 30px;
        }
        .search-form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            border: none;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #e50914;
            color: white;
            font-weight: bold;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #b00710;
        }
        .movie-card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .movie-card {
            background-color: #222;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);
        }
        .movie-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
        .movie-title {
            font-size: 1.2rem;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .rating {
            color: #FFD700;
            text-align: center;
            padding-bottom: 10px;
        }
        .btn-watch {
            display: block;
            width: 80%;
            margin: 10px auto;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #e50914;
            color: white;
            font-weight: bold;
        }
        .btn-watch:hover {
            background-color: #b00710;
        }
        .visitors-count {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2rem;
            color: #e50914;
        }
    </style>
        <!-- عرض عدد الزوار -->
        <div class="visitors-count">
            عدد الزوار: <?php echo $visitors_count; ?>
        </div>

   
        <div class="movie-card-container">
            <div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/iShiXPsBLiB3mK0pKptYkXuUSx4.jpg" alt="Movie Poster">
                        <div class="movie-title">العتاولة</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2024-2025</p>
                            <p><strong>Rating:</strong> 4.4</p>
                        </div>
                        <a href="series.php?id=18888" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/fRyhOMG7laMiR3s5YcZjcnj1DNF.jpg" alt="Movie Poster">
                        <div class="movie-title">النص</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.9</p>
                        </div>
                        <a href="series.php?id=23186" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/tAGeShJBHZFYVQIChPbXzA9JYcY.jpg" alt="Movie Poster">
                        <div class="movie-title">ولاد الشمس</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.7</p>
                        </div>
                        <a href="series.php?id=23126" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/uWGjGpUHvqllRreeBRrewRQSX8f.jpg" alt="Movie Poster">
                        <div class="movie-title">المداح</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2021</p>
                            <p><strong>Rating:</strong> 4.5</p>
                        </div>
                        <a href="series.php?id=4724" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/hfMc8Tbm73FonKAIfrePOaJyzPH.jpg" alt="Movie Poster">
                        <div class="movie-title">سيد الناس</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.5</p>
                        </div>
                        <a href="series.php?id=23197" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/sRdP6Jl5xStaKbbOMAJ80WCFR6F.jpg" alt="Movie Poster">
                        <div class="movie-title">حكيم باشا</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.3</p>
                        </div>
                        <a href="series.php?id=23187" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/8hXAQl2IIu9zR2odPc3IfPrZz5Z.jpg" alt="Movie Poster">
                        <div class="movie-title">فهد البطل</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.3</p>
                        </div>
                        <a href="series.php?id=23196" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/tIhEKfpzWA12Z0xCjyuFhiZZIKH.jpg" alt="Movie Poster">
                        <div class="movie-title">قلبي ومفتاحه</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.4</p>
                        </div>
                        <a href="series.php?id=23195" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/r5DeQUTPOk1twVYz3g1bEVrdSKG.jpg" alt="Movie Poster">
                        <div class="movie-title">جريمة منتصف الليل</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 3</p>
                        </div>
                        <a href="series.php?id=23188" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/losJ5G0S7e7Vo0e4GguReXTsbke.jpg" alt="Movie Poster">
                        <div class="movie-title">إخواتي</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.4</p>
                        </div>
                        <a href="series.php?id=23185" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/m3mRjVyNTeRrufbyGG9KXz0nM9K.jpg" alt="Movie Poster">
                        <div class="movie-title">الحلانجي</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 3.8</p>
                        </div>
                        <a href="series.php?id=23184" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/hFdnevmX0bu0H7uAWOvB7IyTja3.jpg" alt="Movie Poster">
                        <div class="movie-title">رامز إيلون مصر</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 3.5</p>
                        </div>
                        <a href="series.php?id=23183" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/6ePYAIfWzy3GrOkxjh61UNrpMnp.jpg" alt="Movie Poster">
                        <div class="movie-title">برنامج مدفع رمضان</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 3.3</p>
                        </div>
                        <a href="series.php?id=23182" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/sSQdpwhQOEukYgPRCi47XqKn8xo.jpg" alt="Movie Poster">
                        <div class="movie-title">وتقابل حبيب</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.3</p>
                        </div>
                        <a href="series.php?id=23178" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/fRRxehOqUOdlKZKZSevt6IvSjbR.jpg" alt="Movie Poster">
                        <div class="movie-title">عقبال عندكوا</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4</p>
                        </div>
                        <a href="series.php?id=23177" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/sSaszQEkmLpKEosmmE7YcqfB1Bl.jpg" alt="Movie Poster">
                        <div class="movie-title">إش إش</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.1</p>
                        </div>
                        <a href="series.php?id=23172" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/5xae88P5mIQulsksQchioCi8XWD.jpg" alt="Movie Poster">
                        <div class="movie-title">80 باكو</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.4</p>
                        </div>
                        <a href="series.php?id=23128" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/g2LtpbvQtesFnALnwy3nxzvgIQu.jpg" alt="Movie Poster">
                        <div class="movie-title">شهادة معاملة أطفال</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.4</p>
                        </div>
                        <a href="series.php?id=23127" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/tAGeShJBHZFYVQIChPbXzA9JYcY.jpg" alt="Movie Poster">
                        <div class="movie-title">ولاد الشمس</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.7</p>
                        </div>
                        <a href="series.php?id=23126" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/m8mxuhgMjW7pCdMg70Y0f1bEN50.jpg" alt="Movie Poster">
                        <div class="movie-title">الكابتن</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.8</p>
                        </div>
                        <a href="series.php?id=23125" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/thyjoTwA67uBrL7C8Ir25QhHLGY.jpg" alt="Movie Poster">
                        <div class="movie-title">الشرنقة</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 4.2</p>
                        </div>
                        <a href="series.php?id=23102" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/caO5yB44KrLKJCCxtqfwzUf2j7V.jpg" alt="Movie Poster">
                        <div class="movie-title">أشغال شقة</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2024</p>
                            <p><strong>Rating:</strong> 4.6</p>
                        </div>
                        <a href="series.php?id=18857" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/yVVNElOQ25RpOrcdsIOKlvdXK5D.jpg" alt="طريق البداية"><div class="movie-title">طريق البداية (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23206" class="btn-watch">Watch Now</a></div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/iExied4C9OOpz19pRCyAYMIRtUT.jpg" alt="Movie Poster">
                        <div class="movie-title">كامل العدد</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2023</p>
                            <p><strong>Rating:</strong> 4.7</p>
                        </div>
                        <a href="series.php?id=14195" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/ioCl2FuOdzk5IvfpRoJXwjYYhG3.jpg" alt="Movie Poster">
                        <div class="movie-title">معاوية</div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> 2025</p>
                            <p><strong>Rating:</strong> 3.9</p>
                        </div>
                        <a href="series.php?id=23198" class="btn-watch">Watch Now</a>
                    </div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/rCWWLfE8EI5qnnajB2iYkQVAYLK.jpg" alt="تحت الأرض: موسم حار"><div class="movie-title">تحت الأرض: موسم حار (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23203" class="btn-watch">Watch Now</a></div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/1YawkrNo3YH1AArm7bdS86DAcQ5.jpg" alt="زهرة عمري"><div class="movie-title">زهرة عمري (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23202" class="btn-watch">Watch Now</a></div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/nleSISgSAQlm28ulmyJndYpSkUu.jpg" alt="جوما"><div class="movie-title">جوما (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23201" class="btn-watch">Watch Now</a></div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/vHbPCLSMNC4Gz8tRvRvkTVAjyRZ.jpg" alt="الأميرة: ضل حيطة"><div class="movie-title">الأميرة: ضل حيطة (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23200" class="btn-watch">Watch Now</a></div><div class="movie-card"><img src="https://image.tmdb.org/t/p/w780/rzo8R5ClkajSkjXL4P6eWciTSjh.jpg" alt="في لحظة"><div class="movie-title">في لحظة (2025)</div><div class="rating">IMDB Rating: <span>0</span></div><a href="series.php?id=23199" class="btn-watch">Watch Now</a></div>        </div>
    </div>

</body></html>
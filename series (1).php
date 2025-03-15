<?php
if (isset($_GET['id'])) {
    $seriesId = intval($_GET['id']); // Ensure the ID is a valid integer
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://app.arabypros.com/api/season/by/serie/$seriesId/4F5A9C3D9A86FA54EACEDDD635185/d506abfd-9fe2-4b71-b979-feff21bcad13/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'User-Agent: okhttp/4.8.0'
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo 'cURL Error #:' . $err;
    } else {
        $seasonsData = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series Episodes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black; /* Changed to black */
            color: #fff; /* White text */
            font-family: 'Roboto', sans-serif; /* New Font */
        }
        .container {
            margin-top: 50px;
            background-color: rgba(35, 35, 35, 0.8); /* Semi-transparent background for container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #e50914; /* Red color for title */
        }
        .season-btn {
            background-color: #e50914; /* Button background color */
            color: #fff; /* Button text color */
            padding: 10px 20px; /* Button padding */
            border-radius: 5px; /* Rounded corners */
            text-align: center; /* Center the text */
            text-transform: uppercase; /* Transform text to uppercase */
            font-weight: bold; /* Bold font weight */
            margin: 5px; /* Margin between buttons */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth animation */
        }
        .season-btn:hover {
            background-color: #b00710; /* Darker red when hovered */
        }
        .episode-card {
            background-color: #222; /* Dark gray background */
            border-radius: 10px; /* Rounded corners */
            padding: 15px;
            transition: transform 0.3s; /* Smooth animation */
            overflow: hidden; /* Hide overflowing content */
            text-align: center; /* Center the text */
            margin-bottom: 20px; /* Margin for spacing between cards */
        }
        .episode-card:hover {
            transform: scale(1.05); /* Enlarge the card when hovered */
        }
        .episode-title {
            font-size: 1.25rem; /* Larger font size for episode title */
            font-weight: bold; /* Bold font weight */
            color: #e50914; /* Red color for episodes */
        }
        .btn-watch {
            background-color: #e50914; /* Button background color */
            color: #fff; /* Button text color */
            text-transform: uppercase; /* Transform text to uppercase */
            font-weight: bold; /* Bold font weight */
            border: none; /* No border */
            padding: 10px; /* Button padding */
            border-radius: 5px; /* Rounded corners */
            text-align: center; /* Center the text */
            transition: background-color 0.3s; /* Smooth animation */
            display: block; /* Display the button as a block element */
            width: 100%; /* Full-width button */
            margin-top: 10px; /* Gap between title and buttons */
        }
        .btn-watch:hover {
            background-color: #b00710; /* Button background color when hovered */
        }
        .no-seasons {
            text-align: center;
            font-size: 1.2rem; /* Slightly larger text */
            margin-top: 20px;
            color: #e50914; /* Red color for no seasons available */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Series Episodes</h1>

        <!-- Display Season Buttons -->
        <div class="text-center mb-4">
            <p>Select a Season:</p>
            <div class="d-flex flex-wrap justify-content-center">
                <?php if (is_array($seasonsData) && count($seasonsData) > 0): ?>
                    <?php foreach ($seasonsData as $season): ?>
                        <button class="season-btn" onclick="loadEpisodes(<?php echo htmlspecialchars(json_encode($season)); ?>)">
                            Season <?php echo htmlspecialchars($season['title']); ?>
                        </button>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-seasons">No seasons available for this series.</div>
                <?php endif; ?>
            </div>
        </div>

        <div id="episodeContainer" class="row" style="display: none;"></div>
        
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Back to Search</a>
        </div>
    </div>

    <script>
        function loadEpisodes(season) {
            const episodeContainer = document.getElementById('episodeContainer');
            episodeContainer.innerHTML = ''; // Clear previous episodes

            const episodes = season.episodes; // Get episodes from the selected season
            if (episodes && episodes.length > 0) {
                episodes.forEach(episode => {
                    const episodeCard = document.createElement('div');
                    episodeCard.className = 'col-md-4'; // Number of columns (3) in grid layout
                    episodeCard.innerHTML = `
                        <div class="episode-card">
                            <div class="episode-title">${episode.title}</div>
                            <p>Description: ${episode.description ? episode.description : 'No description available.'}</p>
                            <a href="links.php?id=${episode.id}" class="btn btn-watch">Watch Now</a>
                        </div>
                    `;
                    episodeContainer.appendChild(episodeCard);
                });
                episodeContainer.style.display = 'flex'; // Show the grid layout
            } else {
                episodeContainer.innerHTML = '<div class="text-center">No episodes available for this season.</div>';
            }
        }
    </script>
</body>
</html>

<?php 
    }
}
?>

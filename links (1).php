<?php
if (isset($_GET['id'])) {
    $id = urlencode($_GET['id']);
    $url = "https://app.arabypros.com/api/episode/source/by/{$id}/4F5A9C3D9A86FA54EACEDDD635185/d506abfd-9fe2-4b71-b979-feff21bcad13/";
    $headers = [
        'User-Agent: okhttp/4.8.0',
        'if-modified-since: Mon, 23 Dec 2024 21:42:48 GMT'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $links = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Episode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: rgba(20, 20, 20, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);
            text-align: center;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #e50914;
        }
        .embed-container {
            display: none;
            margin-top: 20px;
        }
        iframe {
            width: 100%;
            height: 315px;
            border-radius: 10px;
            border: none;
            background-color: #000;
        }
        .server-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .server-link {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #222;
            color: #fff;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            width: 120px;
            text-align: center;
            font-size: 14px;
        }
        .server-link i {
            margin-right: 8px;
            color: #e50914;
        }
        .server-link:hover {
            background-color: #e50914;
            color: #fff;
        }
        .no-results {
            font-size: 1.2rem;
            margin-top: 20px;
            color: #e50914;
        }
        .back-btn {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            width: 100%;
            transition: 0.3s;
        }
        .back-btn:hover {
            background-color: #e50914;
        }
        @media (max-width: 768px) {
            iframe {
                height: 250px;
            }
            .server-link {
                width: 100px;
                font-size: 12px;
                padding: 10px;
            }
        }
        @media (max-width: 480px) {
            iframe {
                height: 200px;
            }
            .server-link {
                width: 90px;
                font-size: 11px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-play-circle"></i> Watch Episode</h1>
        <div id="embed-container" class="embed-container">
            <iframe id="embed-frame" allowfullscreen></iframe>
        </div>
        
        <?php if (!empty($links)): ?>
            <p>Select a server to start watching:</p>
            <div class="server-container">
                <?php
                    $serverNumber = 1;
                    foreach ($links as $link):
                        if (isset($link['url']) && !empty($link['url'])):
                ?>
                        <div class="server-link" onclick="loadEmbedLink('<?php echo htmlspecialchars($link['url']); ?>')">
                            <i class="fas fa-server"></i> Server <?php echo $serverNumber++; ?>
                        </div>
                <?php
                        endif;
                    endforeach;
                ?>
            </div>
        <?php else: ?>
            <p class="no-results"><i class="fas fa-exclamation-triangle"></i> No links available for this episode.</p>
        <?php endif; ?>

        <div class="text-center">
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to search</a>
        </div>
    </div>

    <script>
        function loadEmbedLink(url) {
            const embedContainer = document.getElementById('embed-container');
            const embedFrame = document.getElementById('embed-frame');
            
            if (url) {
                embedFrame.src = url;
                embedContainer.style.display = 'block';
            } else {
                embedContainer.style.display = 'none';
            }
        }
    </script>
</body>
</html>

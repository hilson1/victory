<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House & Land</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .box {
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #3498db;
            color: white;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 10px;
            transition: transform 0.3s, background-color 0.3s;
        }
        .box:hover {
            background-color: #2980b9;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<button id="closeBtn" style="position: absolute; top: 20px; right: 20px; padding: 10px 15px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Close</button>
    <div class="container">
        <div class="box" id="house">HOUSE</div>
        <div class="box" id="land">LAND</div>
    </div>
    
    <script>
        document.getElementById("house").addEventListener("click", function() {
            window.location.href = "house.php";
        });

        document.getElementById("land").addEventListener("click", function() {
            window.location.href = "land.php";
        });
        document.getElementById("closeBtn").addEventListener("click", function() {
            window.location.href = "../index.html";
        });
    </script>

</body>
</html>

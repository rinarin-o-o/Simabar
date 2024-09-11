<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiMabar - Sistem Manajemen Barang</title>
    <style>
        body {
            background: linear-gradient(to bottom, #00b0ff, #004080);
            color: white;
            font-family: 'Outfit', sans-serif; /* Ensure the Outfit font is loaded */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: left;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 4em;
            margin-bottom: 0.2em;
            color: #007bff; /* Match logo color */
        }

        h2 {
            font-size: 1.5em;
            margin-bottom: 1em;
        }

        p {
            line-height: 1.5;
            max-width: 500px;
            margin: 0 auto 2em;
            font-size: 1.1em;
        }

        .logo {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            width: 300px;
            height: 300px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .button {
            background-color: #d9d9d9;
            color: black;
            border: none;
            padding: 1em 3em;
            border-radius: 8px;
            font-size: 1.5em;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .button:hover {
            background-color: #b3b3b3;
        }

        .button svg {
            margin-right: 10px;
            fill: black;
            width: 1.5em;
            height: 1.5em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SiMabar</h1>
        <h2>Sistem Manajemen Barang</h2>
        <p>
            SiMabar berguna untuk mendata aset atau inventaris barang, mengawasi perpindahan, penanggungjawab, dan penggunaannya serta menghitung penyusutan dan mengurangi risiko hilangnya aset.
        </p>
        <button class="button" onclick="window.location.href='login_admin.php'">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2h2v2h-2zm2.07-7.75L13 9V5h-2v4.28L8.93 9.25 8 10.34l4 4 4-4-.93-1.09z"/></svg>
    Login
</button>

    </div>
    <div class="logo">
        <img src="images/logo.png" alt="SiMabar Logo">
    </div>
</body>
</html>

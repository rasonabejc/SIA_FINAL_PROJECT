<!DOCTYPE html>
<html>
<head>
    <title>QR Code Scanner</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7; /* Light gray background */
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #wrapper {
            text-align: center;
            background-color: #ffffff; /* White background */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #reader {
            width: 320px;
            height: 320px;
            border: 2px solid #007bff; /* Blue border */
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            border-radius: 10px;
        }

        #scan-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #007bff; /* Blue scan line */
            animation: scan 2s infinite linear;
        }

        @keyframes scan {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(100%);
            }
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        #message {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1>Scan QR Code</h1>
        <div id="reader">
            <div id="scan-line"></div>
        </div>
        <div id="message"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@latest/dist/html5-qrcode.min.js"></script>
    <script>
        const config = {
            fps: 30,
            qrbox: 250
        }

        const scanner = new Html5QrcodeScanner("reader", config);

        const success = (data) => {
            document.getElementById('message').innerText = 'Successfully scanned: ' + data;
            scanner.clear();
            setTimeout(() => {
                location.reload(); // Refresh the page after a delay
            }, 3000); // 3 seconds delay
        }

        const error = (err) => {
            console.error(err);
        }

        scanner.render(success, error);
    </script>
</body>
</html>

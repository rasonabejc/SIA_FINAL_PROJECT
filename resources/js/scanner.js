// public/js/scanner.js

document.getElementById('start-scanner').addEventListener('click', function() {
    const video = document.getElementById('barcode-video');
    const result = document.getElementById('barcode-result');

    // Check if getUserMedia is supported
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
                scanBarcode();
            })
            .catch(function(error) {
                console.error('Error accessing camera:', error);
            });
    } else {
        console.error('getUserMedia is not supported');
    }

    function scanBarcode() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        // Set canvas dimensions to match video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        // Draw video frame onto canvas every 100ms
        setInterval(() => {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get image data from canvas
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            // Use a library like Quagga.js or zxing-js to decode barcode from image data
            const code = decodeBarcode(imageData);

            // Display barcode result
            if (code) {
                result.textContent = 'Barcode detected: ' + code;
            } else {
                result.textContent = 'No barcode detected';
            }
        }, 100);
    }

    // Function to decode barcode from image data (replace with actual implementation)
    function decodeBarcode(imageData) {
        // This is a placeholder function
        // You can use a library like Quagga.js or zxing-js to decode the barcode
        // Example:
        // const code = Quagga.decodeSingle({
        //     imageData: imageData,
        //     ...otherOptions
        // });
        // return code ? code.codeResult.code : null;
        return null; // Placeholder
    }
});

<!DOCTYPE html>
<html>
<head>
    <title>Download PDF</title>
</head>
<body>
    <h1>Your PDF is ready</h1>
    <p>If the download doesn't start automatically, <a id="download-link" href="{{ $pdfUrl }}">click here</a>.</p>

    <script>
        window.onload = function() {
            // Start the download
            window.location.href = "{{ $pdfUrl }}";

            // Redirect after a short delay
            setTimeout(function() {
                window.location.href = "{{ $redirectUrl }}";
            }, 10000);  // 2 seconds delay, adjust as needed
        };
    </script>
</body>
</html>

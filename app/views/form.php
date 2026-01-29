<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<form action="/upload" method="post" enctype="multipart/form-data" id="form">
    <input type="file" name="file">
    <button id="submit" type="submit">send</button>
</form>

<div style="width: 300px; border: 1px solid #ccc; margin-top: 10px;">
    <div id="progress-bar"
         style="width: 0%; height: 20px; background: green; color: white; text-align: center;">
        0%
    </div>
</div>

<div id="link_to_file" style="display: none">
    <a target="_blank" href="">File</a>
</div>


<script>
    $(document).ready(function () {

        let fakeProgress = 0;
        let interval = null;

        function startFakeProgress() {
            fakeProgress = 0;

            interval = setInterval(function () {
                if (fakeProgress < 90) {
                    fakeProgress += Math.random() * 5;
                    updateProgress(fakeProgress);
                }
            }, 300);
        }

        function finishProgress() {
            clearInterval(interval);
            updateProgress(100);
        }

        function updateProgress(value) {
            value = Math.min(100, Math.round(value));

            $('#progress-bar')
                .css('width', value + '%')
                .text(value + '%');
        }

        $('#form').on('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);

            startFakeProgress();

            $.ajax({
                url: '/upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    finishProgress();
                    console.log('Upload success:', response);
                    $('#link_to_file a').attr('href', response);
                    $('#link_to_file').show();
                },

                error: function () {
                    finishProgress();
                    alert('Upload failed');
                }
            });
        });
    });
</script>
</body>
</html>
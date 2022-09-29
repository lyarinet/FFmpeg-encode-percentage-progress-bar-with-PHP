<?php
if (file_exists('output.txt')) {
    unlink('output.txt');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>FFmpeg encode</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            setInterval(function () {
                $.get("progress.php", function (data) {
                    if (data === '') {
                        $('#progress-string').html(data);
                    } else {
                        $('#progress-string').html(`${data}%`);
                    }
                    $('#progressbar').attr('aria-valuenow', data).css('width', `${data}%`);
                });
            }, 1000);//1000 milliseconds = 1 second
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#make_smaller').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'run.php',
                    data: {
                        input: $('#input').val(),
                        size: $('#size').val(),
                        codec: $('#codec').val(),
                        preset: $('#preset').val(),
                        crf: $('#crf').val(),
                        output: $('#output').val()
                    },
                });
            });
        });
    </script>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="make_smaller" method="post">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="input">Input</label>
                                <input type="text" class="form-control" name="input" id="input" aria-describedby="input"
                                       placeholder="video.mp4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="size">Resize to</label>
                                <select class="form-control" name="size" id="size">
                                    <option value="0">No resize</option>
                                    <option value="1">240p</option>
                                    <option value="2">360p</option>
                                    <option value="3">480p</option>
                                    <option value="4">720p</option>
                                    <option value="5">1080p</option>
                                    <option value="6">1440p</option>
                                    <option value="7">2160p</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-lg-6">
                                <label for="codec">Codec</label>
                                <select class="form-control" id="codec" name="codec">
                                    <option value="1" selected>x264</option>
                                    <option value="2">x265</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="preset">Speed</label>
                                <select class="form-control" id="preset" name="preset">
                                    <option value="ultrafast">Ultrafast</option>
                                    <option value="superfast">Superfast</option>
                                    <option value="veryfast">Veryfast</option>
                                    <option value="faster">Faster</option>
                                    <option value="fast" selected>Fast</option>
                                    <option value="medium">Medium</option>
                                    <option value="slow">Slow</option>
                                    <option value="slower">Slower</option>
                                    <option value="veryslow">Veryslow</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-lg-6">
                                <label for="crf">crf</label>
                                <input type="number" class="form-control" name="crf" id="crf" aria-describedby="crf"
                                       placeholder="23" value="23">
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="output">Output</label>
                                <input type="text" class="form-control" name="output" id="output"
                                       aria-describedby="output"
                                       placeholder="out.mp4">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-green">Run</button>
                        </div>
                    </form>
                    <div<?php include_once('progress.php'); ?>
                    <div class="progress">
                        <div id="progressbar" class="progress-bar bg-info" role="progressbar" aria-valuenow="0"
                             aria-valuemin="0" aria-valuemax="100"><span id="progress-string"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
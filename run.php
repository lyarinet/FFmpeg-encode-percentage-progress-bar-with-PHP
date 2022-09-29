<?php
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $output = $_POST['output'];
    $preset = $_POST['preset'];
    $crf = $_POST['crf'];
    $size_int = $_POST['size'];
    if ($size_int == 0) {
        $scale = "";//No resize
    } elseif ($size_int == 1) {
        $scale = "-vf scale=352x240:flags=lanczos";
    } elseif ($size_int == 2) {
        $scale = "-vf scale=480x360:flags=lanczos";
    } elseif ($size_int == 3) {
        $scale = "-vf scale=640x480:flags=lanczos";
    } elseif ($size_int == 4) {
        $scale = "-vf scale=1280x720:flags=lanczos";
    } elseif ($size_int == 5) {
        $scale = "-vf scale=1920x1080:flags=lanczos";
    } elseif ($size_int == 6) {
        $scale = "-vf scale=2560x1440:flags=lanczos";
    } elseif ($size_int == 7) {
        $scale = "-vf scale=3840x2160:flags=lanczos";
    }
    if ($_POST['codec'] == 1){
        $codec = "libx264";
    } else {
        $codec = "libx265";
    }
    $command = "ffmpeg -i $input $scale -c:v $codec -preset $preset -crf $crf $output -y 1> output.txt 2>&1";
    shell_exec($command);
} else {
    echo "Did not come from the form";
    exit;
}
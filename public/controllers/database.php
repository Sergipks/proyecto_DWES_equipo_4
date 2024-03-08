<?php
//function para cargar el fichero .env
function loadEnv($file)
{
    if (!file_exists($file)) {
        throw new Exception('.env file not found');
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Ignore commented lines
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!array_key_exists($key, $_ENV)) {
            putenv("$key=$value"); // Set environment variable
            $_ENV[$key] = $value;
        }
    }
}
//inviocamos la function
loadEnv('../.env');
//asignamos los valores a variables
$server=getenv('IP');
$db=getenv('DATABASE');
$user=getenv('USUARIO');
$pwd=getenv('PASSWORD');
?>

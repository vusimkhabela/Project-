<?php
session_start();

drive();

 function drive(){
$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = $url_array[0];

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId('935952830744-5kk955cq472ar338ke28o66nqlhca35s.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri($url);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
if (isset($_GET['code'])) {
    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
    header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate("");
}
$pictures= array();
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$dir = dir('http://localhost/Project%202/Project--master/26978008_Proj2/');
while ($picture = $dir->read()) {
    if ($picture != '.' && $picture != '..' && pathinfo($picture, PATHINFO_EXTENSION) == 'sql') {
        $pictures[] = $picture;
    }
}
$dir->close();

        $client->setAccessToken($_SESSION['accessToken']);
        $service = new Google_DriveService($client);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $picture = new Google_DriveFile();
        
        foreach ($pictures as $picture_name) {
         
            $picture_path = './uploads/' . $tag . '/'. $picture_name;
            $mime_type = finfo_file($finfo, $picture_path);
            $picture->setTitle($picture_name);
            $picture->setDescription('This is a '.$mime_type.' document');
            $picture->setMimeType($mime_type);
            $service->files->insert(
                $picture,
                array(
                    'data' => file_get_contents($picture_path),
                    'mimeType' => $mime_type
                )
            );
            unlink($picture_path);
        
        }
        finfo_close($finfo);
        header('location: index.php');exit;
 
 }

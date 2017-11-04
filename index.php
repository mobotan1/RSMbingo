<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BF2</title>
    </head>
    <body>
        
<?
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Show all information, defaults to INFO_ALL
//phpinfo();

?>

<h2>
    <a href=#>Enter game code</a>
    <br> 
    or 
    <br>
    <a href=#>Create new game</a>

</h2>


<? if (2 == 2): ?>
    <h2>2=2</h2>
<? else: ?>
    <h2>2 != 2</h2>
<? endif; ?>

<?
$bucket = 'rsm-bingo';
$keyname = 'test.tst';

// Instantiate the client.
// $s3 = S3Client::factory();
$s3 = new Aws\S3\S3Client([
    'region'  => 'eu-west-1',
    'version' => 'latest'
]);

// Use the high-level iterators (returns ALL of your objects).
try {
    $objects = $s3->getIterator('ListObjects', array(
        'Bucket' => $bucket
    ));

    echo "Keys retrieved!\n<br>";
    foreach ($objects as $object) {
        echo $object['Key'] . "\n<br>";
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}

// Use the plain API (returns ONLY up to 1000 of your objects).
try {
    $result = $s3->listObjects(array('Bucket' => $bucket));

    echo "Keys retrieved!\n";
    foreach ($result['Contents'] as $object) {
        echo $object['Key'] . "\n<br>";
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n<br>";
}


// $filepath should be absolute path to a file on disk						
//$filepath = '*** Your File Path ***';
						
// Upload data.
$result = $s3->putObject(array(
    'Bucket' => $bucket,
    'Key'    => $keyname,
    'Body'   => 'Hello, world!'
));

echo $result['ObjectURL'];
?>
    
    </body>
</html>

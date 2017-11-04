<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo Game | Edit Bingo</title>
<meta name="description" content="Bingo card game"/>

<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/main.css" />
<link rel="stylesheet" type="text/css" href="media/css/bingo.css" />
<script type="text/javascript" src="media/js/render.js"></script>
<script type="text/javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="media/js/tooltip.js"></script>
<style type="text/css">
</style>
</head>
    
    
<?   

   
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $json =  json_encode($_POST);
       $phpObj = json_decode($json);
       var_dump($json);
       //echo $json . "<br>";
       var_dump($phpObj);
   }
   else{
       if( $_GET["uid"]) {
           $uid = $_GET['uid'];
       }
   }


// var_dump($phpObj);
// $myFile = "testFile.txt";
// file_put_contents($myFile, $phpObj);
?>
   

    
    
<body>
<div id="wrapper">
    
<script src="media/js/home.js"></script>

<div id="instructions">
    <h1>Cards</h1>
    <p>You can easily create a new card.</p>
    <p><strong>Instructions:</strong> 
    Type your words into the grid on the left. 
    You can give your game a title. </p> 
    <p>Then click the Generate button.</p> 
</div>

<div id="card-wrapper">  
    <p id="clear-link"><a href="#">Clear Card</a></p>
    <form action="<?php $_PHP_SELF ?>" method="post" id="save-form">
    <input type='hidden' name='csrfmiddlewaretoken' value='tQZ77eE7XU9D3EUlOkXDLcEdguKtrKBW' />
    <input type='hidden' name='uid' value='1' />
    <table class="card">
        <thead>
            <tr>
                <th colspan="4" class="colspan"><input id="name" maxlength="255" name="name" type="text" value="Untitled Bingo" /></th>
                <th><select id="id_size" name="size">
                        <option value="5">5x5</option>
                        <option value="4">4x4</option>
                        <option value="3">3x3</option>
                    </select>
                </th>
            </tr>
        </thead>
        <tbody>       
            <tr>        
                <td><textarea cols="40" id="id_word-0-0" name="word-0-0" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-0-1" name="word-0-1" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-0-2" name="word-0-2" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-0-3" name="word-0-3" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-0-4" name="word-0-4" rows="10" style=""></textarea></td> 
            </tr><tr>
                <td><textarea cols="40" id="id_word-1-0" name="word-1-0" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-1-1" name="word-1-1" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-1-2" name="word-1-2" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-1-3" name="word-1-3" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-1-4" name="word-1-4" rows="10" style=""></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-2-0" name="word-2-0" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-2-1" name="word-2-1" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-2-2" name="word-2-2" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-2-3" name="word-2-3" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-2-4" name="word-2-4" rows="10" style=""></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-3-0" name="word-3-0" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-3-1" name="word-3-1" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-3-2" name="word-3-2" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-3-3" name="word-3-3" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-3-4" name="word-3-4" rows="10" style=""></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-4-0" name="word-4-0" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-4-1" name="word-4-1" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-4-2" name="word-4-2" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-4-3" name="word-4-3" rows="10" style=""></textarea></td>
                <td><textarea cols="40" id="id_word-4-4" name="word-4-4" rows="10" style=""></textarea></td> 
            </tr>
        </tbody>
    </table>
    <div><a href="#" id="more-link"><strong>Paste in a list of words</strong></a></div>
    <div id="more">
        <p><strong>One word per line</strong></p>
        <textarea cols="40" id="id_extra_words" name="extra_words" rows="10"></textarea>
    </div>
    <label id="has-free-space"><input checked="checked" id="id_has_free_space" name="has_free_space" type="checkbox" /> The center square is the free space</label>
    <label><input id="id_has_column_affinity" name="has_column_affinity" type="checkbox" /> <acronym title="By default, Bingo will randomly scatter your items across all the columns. If you want to scatter your items within their column only (like in traditional bingo), check this box. When you generate your cards, the call list will include the column name">Shuffle items <em>only</em> within their column</acronym> </label>
    <input type="submit" name="submit" value="Generate" id="submit" />
    </form>
</div>

<div style="clear:both;"></div>
</div>

<?
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Show all information, defaults to INFO_ALL
// phpinfo();

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

    foreach ($objects as $object) {
        echo $object['Key'] . "\n<br>";
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}

// $filepath should be absolute path to a file on disk						
//$filepath = '*** Your File Path ***';
						
// Upload data.
$result = $s3->putObject(array(
    'Bucket' => $bucket,
    'Key'    => $keyname,
    'Body'   => 'Hello, world!',
    'ACL'          => 'public-read'
));

echo "<a href='" . $result['ObjectURL'] . "'>link</a>";
?>
    
    </body>
</html>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo | Edit</title>
<meta name="description" content="Bingo card game"/>

<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/main.css" />
<link rel="stylesheet" type="text/css" href="media/css/bingo.css" />
<script type="text/javascript" src="media/js/render.js"></script>
<script type="text/javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="media/js/tooltip.js"></script>
</head>
<body>
    
    
<?
    require 'vendor/autoload.php';
    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;

    // $myFile = "testFile.txt";
    // file_put_contents($myFile, $phpObj);
   // phpinfo();
    
    // Instantiate the client.
    $bucket = 'rsm-bingo';
    $configfile = 'config.json';
    $uid = 0;
    $is_update = FALSE; 
    $s3 = new Aws\S3\S3Client(['region'  => 'eu-west-1','version' => 'latest']);
    
    //var_dump($_POST);
    $FORM_DATA = array("uid" => "", "name" => "Untitled Bingo", "size" => "5",
        "word-0-0" => "", "word-0-1" => "", "word-0-2" => "", "word-0-3" => "", "word-0-4" => "",
        "word-1-0" => "", "word-1-1" => "", "word-1-2" => "", "word-1-3" => "", "word-1-4" => "",
        "word-2-0" => "", "word-2-1" => "", "word-2-2" => "", "word-2-3" => "", "word-2-4" => "",                
        "word-3-0" => "", "word-3-1" => "", "word-3-2" => "", "word-3-3" => "", "word-3-4" => "",
        "word-4-0" => "", "word-4-1" => "", "word-4-2" => "", "word-4-3" => "", "word-4-4" => "");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //echo "POST";        

        //Fill FORM_DATA var with data from _POST
        $FORM_DATA["uid"] = $_POST["uid"];
        $FORM_DATA["name"] = $_POST["name"];
        $FORM_DATA["size"] = $_POST["size"];
        $FORM_DATA["word-0-0"] = $_POST["word-0-0"];
        $FORM_DATA["word-0-1"] = $_POST["word-0-1"];
        $FORM_DATA["word-0-2"] = $_POST["word-0-2"];
        $FORM_DATA["word-0-3"] = $_POST["word-0-3"];
        $FORM_DATA["word-0-4"] = $_POST["word-0-4"];
        $FORM_DATA["word-1-0"] = $_POST["word-1-0"];
        $FORM_DATA["word-1-1"] = $_POST["word-1-1"];
        $FORM_DATA["word-1-2"] = $_POST["word-1-2"];
        $FORM_DATA["word-1-3"] = $_POST["word-1-3"];
        $FORM_DATA["word-1-4"] = $_POST["word-1-4"];
        $FORM_DATA["word-2-0"] = $_POST["word-2-0"];
        $FORM_DATA["word-2-1"] = $_POST["word-2-1"];
        $FORM_DATA["word-2-2"] = $_POST["word-2-2"];
        $FORM_DATA["word-2-3"] = $_POST["word-2-3"];
        $FORM_DATA["word-2-4"] = $_POST["word-2-4"];
        $FORM_DATA["word-3-0"] = $_POST["word-3-0"];
        $FORM_DATA["word-3-1"] = $_POST["word-3-1"];
        $FORM_DATA["word-3-2"] = $_POST["word-3-2"];
        $FORM_DATA["word-3-3"] = $_POST["word-3-3"];
        $FORM_DATA["word-3-4"] = $_POST["word-3-4"];
        $FORM_DATA["word-4-0"] = $_POST["word-4-0"];
        $FORM_DATA["word-4-1"] = $_POST["word-4-1"];
        $FORM_DATA["word-4-2"] = $_POST["word-4-2"];
        $FORM_DATA["word-4-3"] = $_POST["word-4-3"];
        $FORM_DATA["word-4-4"] = $_POST["word-4-4"];

        //var_dump($FORM_DATA);

        //UID numeric - means Update not Create
        if(is_numeric($FORM_DATA["uid"]) == FALSE || ($FORM_DATA["uid"]) < 1) {
            $is_update = FALSE; 
            
            // let's find the last saved UID of Bingo Card
            try {
                // Get the config file
                $res_s3 = $s3->getObject(array('Bucket'=>$bucket,'Key'=>$configfile));
                $res_uid = json_decode($res_s3->get("Body"));
                $uid = $res_uid->uid;
            } catch (S3Exception $e) {
                echo $e->getMessage() . "\n";
            }
            
            //increase it by 1
            $uid += 1;
            $FORM_DATA["uid"] = $uid;
            
            //save new config file
            $result = $s3->putObject(array(
                'Bucket' => $bucket, 
                'Key'    => $configfile, 
                'Body'   => '{"uid": ' . $uid . ' }'
            ));
        }   
        else{
            $uid = $FORM_DATA["uid"];
            $is_update = TRUE; 
        }
        
        
        //encoding the Form results to JSON
        $json_form = json_encode($FORM_DATA);  
       
        //save form data
        $result = $s3->putObject(array(
            'Bucket' => $bucket, 
            'Key'    => $uid . '.json', 
            'Body'   => $json_form
        ));
    }
   else{
       // let's find the UID of Bingo Card (it should be passed with GET method
       if(isset($_GET["uid"])) {
           //echo "GET";
           //is_numeric()
           $uid = $_GET['uid'];
           if ($s3->doesObjectExist($bucket, $uid . '.json') == TRUE){
               $res_s3 = $s3->getObject(array('Bucket'=>$bucket,'Key'=>$uid . '.json'));
               $Loaded_Data = json_decode($res_s3->get("Body"), true);    
               
               //Fill FORM_DATA var with data from _GET
               $FORM_DATA["uid"] = $Loaded_Data["uid"];
               $FORM_DATA["name"] = $Loaded_Data["name"];
               $FORM_DATA["size"] = $Loaded_Data["size"];
               $FORM_DATA["word-0-0"] = $Loaded_Data["word-0-0"];
               $FORM_DATA["word-0-1"] = $Loaded_Data["word-0-1"];
               $FORM_DATA["word-0-2"] = $Loaded_Data["word-0-2"];
               $FORM_DATA["word-0-3"] = $Loaded_Data["word-0-3"];
               $FORM_DATA["word-0-4"] = $Loaded_Data["word-0-4"];
               $FORM_DATA["word-1-0"] = $Loaded_Data["word-1-0"];
               $FORM_DATA["word-1-1"] = $Loaded_Data["word-1-1"];
               $FORM_DATA["word-1-2"] = $Loaded_Data["word-1-2"];
               $FORM_DATA["word-1-3"] = $Loaded_Data["word-1-3"];
               $FORM_DATA["word-1-4"] = $Loaded_Data["word-1-4"];
               $FORM_DATA["word-2-0"] = $Loaded_Data["word-2-0"];
               $FORM_DATA["word-2-1"] = $Loaded_Data["word-2-1"];
               $FORM_DATA["word-2-2"] = $Loaded_Data["word-2-2"];
               $FORM_DATA["word-2-3"] = $Loaded_Data["word-2-3"];
               $FORM_DATA["word-2-4"] = $Loaded_Data["word-2-4"];
               $FORM_DATA["word-3-0"] = $Loaded_Data["word-3-0"];
               $FORM_DATA["word-3-1"] = $Loaded_Data["word-3-1"];
               $FORM_DATA["word-3-2"] = $Loaded_Data["word-3-2"];
               $FORM_DATA["word-3-3"] = $Loaded_Data["word-3-3"];
               $FORM_DATA["word-3-4"] = $Loaded_Data["word-3-4"];
               $FORM_DATA["word-4-0"] = $Loaded_Data["word-4-0"];
               $FORM_DATA["word-4-1"] = $Loaded_Data["word-4-1"];
               $FORM_DATA["word-4-2"] = $Loaded_Data["word-4-2"];
               $FORM_DATA["word-4-3"] = $Loaded_Data["word-4-3"];
               $FORM_DATA["word-4-4"] = $Loaded_Data["word-4-4"];
               
               $is_update = TRUE; 
           }
       }
    }

    
    // Use the high-level iterators (returns ALL of your objects).
    //try { $objects = $s3->getIterator('ListObjects', array('Bucket' => $bucket));
    //    foreach ($objects as $object) {echo $object['Key'] . "\n<br>";}
    //} catch (S3Exception $e) { echo $e->getMessage() . "\n"; }

    // $filepath should be absolute path to a file on disk						
    //$filepath = '*** Your File Path ***';
						
    // Upload data.
    //$result = $s3->putObject(array('Bucket' => $bucket, 'Key'    => $configfile, 'Body'   => 'Hello, world!', 'ACL'          => 'public-read'));

    //echo "<a href='" . $result['ObjectURL'] . "'>link</a>";
?>
    
    
<div id="wrapper">
    
<script src="media/js/home.js"></script>

<div id="instructions">
    <h1>Cards</h1>
    <? if ($is_update === TRUE) { ?>
    <p>You can update this card.</p>
    <p><strong>Instructions:</strong> 
    Change any words in the grid on the left. 
    Update a title of the game.
    Then click the Update button.</p>  <br>
        
    <p>Or, you can create a new game</p>
    <form method="get" action="/edit.php">
        <input type="submit" name="p" value="New card" id="submit" />
    </form>
    
    
    <? } elseif ($is_update === FALSE) { ?>
    <p>You can create a new card.</p>
    <p><strong>Instructions:</strong> 
    Type your words into the grid on the left. 
    You can give your game a title.
    Then click the Generate button.</p>
    <? } ?>
    
    
    <h1>Load</h1>
    <p>You can load an existing card.</p>
    Type your game ID number: 
    <form action="<?php $_PHP_SELF ?>" method="get" id="load-form">
    <input type='text' name='uid' value='' maxlength="6" placeholder="Card ID" />
    <input type="submit" name="l" value="Load" id="submit" />
    </form>
    
    <h1>Play</h1>
    <form action="play.php" method="get" id="play-form">
        <p>Card ID: <input type='text' size=6 name='uid' value='<? print($FORM_DATA["uid"]); ?>' maxlength="6" placeholder="Card ID" /></p>
        <p>Name: <input type='text' size=11 name='pname' value='' maxlength="16" placeholder="Your name" /></p>
        <input type="submit" name="p" value="Play" id="submit" />
    </form>
</div>

<div id="card-wrapper">  
    <form action="<?php $_PHP_SELF ?>" method="post" id="save-form">
    <input type='hidden' name='csrfmiddlewaretoken' value='tQZ77eE7XU9D3EUlOkXDLcEdguKtrKBW' />
    <table class="card">
        <thead>
            <tr>
                <th />ID: <input type='text' name='uid' size=4 value='<? print($FORM_DATA["uid"]); ?>'readonly placeholder="-"></th>
                <th colspan="3" class="colspan"><input id="name" maxlength="64" name="name" type="text" value="<? print($FORM_DATA["name"]); ?>" /></th>
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
                <td><textarea cols="40" id="id_word-0-0" name="word-0-0" rows="10" style=""><? print($FORM_DATA["word-0-0"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-0-1" name="word-0-1" rows="10" style=""><? print($FORM_DATA["word-0-1"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-0-2" name="word-0-2" rows="10" style=""><? print($FORM_DATA["word-0-2"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-0-3" name="word-0-3" rows="10" style=""><? print($FORM_DATA["word-0-3"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-0-4" name="word-0-4" rows="10" style=""><? print($FORM_DATA["word-0-4"]); ?></textarea></td> 
            </tr><tr>
                <td><textarea cols="40" id="id_word-1-0" name="word-1-0" rows="10" style=""><? print($FORM_DATA["word-1-0"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-1-1" name="word-1-1" rows="10" style=""><? print($FORM_DATA["word-1-1"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-1-2" name="word-1-2" rows="10" style=""><? print($FORM_DATA["word-1-2"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-1-3" name="word-1-3" rows="10" style=""><? print($FORM_DATA["word-1-3"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-1-4" name="word-1-4" rows="10" style=""><? print($FORM_DATA["word-1-4"]); ?></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-2-0" name="word-2-0" rows="10" style=""><? print($FORM_DATA["word-2-0"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-2-1" name="word-2-1" rows="10" style=""><? print($FORM_DATA["word-2-1"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-2-2" name="word-2-2" rows="10" style=""><? print($FORM_DATA["word-2-2"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-2-3" name="word-2-3" rows="10" style=""><? print($FORM_DATA["word-2-3"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-2-4" name="word-2-4" rows="10" style=""><? print($FORM_DATA["word-2-4"]); ?></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-3-0" name="word-3-0" rows="10" style=""><? print($FORM_DATA["word-3-0"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-3-1" name="word-3-1" rows="10" style=""><? print($FORM_DATA["word-3-1"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-3-2" name="word-3-2" rows="10" style=""><? print($FORM_DATA["word-3-2"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-3-3" name="word-3-3" rows="10" style=""><? print($FORM_DATA["word-3-3"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-3-4" name="word-3-4" rows="10" style=""><? print($FORM_DATA["word-3-4"]); ?></textarea></td> 
            </tr><tr>                
                <td><textarea cols="40" id="id_word-4-0" name="word-4-0" rows="10" style=""><? print($FORM_DATA["word-4-0"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-4-1" name="word-4-1" rows="10" style=""><? print($FORM_DATA["word-4-1"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-4-2" name="word-4-2" rows="10" style=""><? print($FORM_DATA["word-4-2"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-4-3" name="word-4-3" rows="10" style=""><? print($FORM_DATA["word-4-3"]); ?></textarea></td>
                <td><textarea cols="40" id="id_word-4-4" name="word-4-4" rows="10" style=""><? print($FORM_DATA["word-4-4"]); ?></textarea></td> 
            </tr>
        </tbody>
    </table>
    
    <!--
    <div><a href="#" id="more-link"><strong>Paste in a list of words</strong></a></div>
    <div id="more">
        <p><strong>One word per line</strong></p>
        <textarea cols="40" id="id_extra_words" name="extra_words" rows="10"></textarea>
    </div>
    --> 
    
    <!--
    <label>
        <input id="id_has_column_affinity" name="has_column_affinity" type="checkbox" /> 
        <acronym title="By default, Bingo will randomly scatter your items across all the columns. If you want to scatter your items within their column only (like in traditional bingo), check this box. When you generate your cards, the call list will include the column name">Shuffle items <em>only</em> within their column</acronym> 
    </label>
    --> 
    
    <input type="submit" name="submit" value="<? if ($is_update == TRUE){ print("UPDATE");} else { print("Generate");} ?>" id="submit" />
    </form>
    
    <p id="clear-link"><a href="#">Clear Card</a></p>
</div>

<div style="clear:both;"></div>

    
    </body>
</html>

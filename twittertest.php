test twitter!
<?php
//this file will be used to experiment with fetching data automatically using 
//the frcfms feed.  This should allow for automatically getting information
//about match scores and penalties.
echo hello;
$opts = array(
    'http' => array(
        'method' => "POST",
        'content' => 'track=#FRCTEST',
    )
); 
$context = stream_context_create($opts);
$instream = fopen('http://keeganmann:keeg5tree@stream.twitter.com/1/statuses/filter.json', 'r', false, $context);
while (!feof($instream)) {
    if (!($line = stream_get_line($instream, 20000, "\n"))) {
        continue;
    } else {
        //print_r(json_decode($line));
        //echo $line;
        $tweet = json_decode($line);
        echo $tweet->{'text'} . "\n";
        flush();
    }
}
?>
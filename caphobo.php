<?php header("Content-type: text/xml");
echo "<CiscoIPPhoneDirectory>
<Title>Asterisk phonebook</Title>
<Prompt>Asterisk phone book entries</Prompt>";


$db = new SQLite3('/var/lib/asterisk/astdb.sqlite3');

$results = $db->query('SELECT * FROM astdb;');

while ($row = $results->fetchArray()) {
    //find
    $find='/cidname/';
   
    if(strpos($row['key'], $find)!==false) {
        echo '<DirectoryEntry>';
            echo '<Name>'.htmlspecialchars($row['value']).'</Name>';
            echo '<Telephone>'.str_replace($find, '', $row['key']).'</Telephone>';
        echo '</DirectoryEntry>';
    }
}

echo '</CiscoIPPhoneDirectory>';
?>

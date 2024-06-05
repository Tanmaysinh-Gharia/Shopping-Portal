<?php
$filename = "pincode/Pincode_30052019.csv";
$st_ct_pin = [];
// Open the file for reading
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Loop through each line in the file
    $data = fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $data is an array containing the fields of the line
        $state = $data[8];
        $city = $data[7];
        $city=strtoupper(str_replace(" ","",$city));
        $pin = $data[4];
        if (array_key_exists($state,$st_ct_pin))
            if(array_key_exists($city,$st_ct_pin[$state]))
                {
                    if (!in_array($pin,$st_ct_pin[$state][$city]))
                    array_push($st_ct_pin[$state][$city],$pin);
                }
            else
                $st_ct_pin[$state][$city]=[$pin]; 
        else
            $st_ct_pin[$state] = [$city => [$pin]];
}
    // Close the file
    fclose($handle);
} else {
    echo "Error opening the file.";
}

foreach ($st_ct_pin as $state => $cities) {
    
    foreach ($cities as $city => $pins) {
        ksort($cities);
        sort($pins);
    }
}
$states= array_keys($st_ct_pin);
?>

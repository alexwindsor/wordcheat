<?php
//echo '<pre>';
//print_r($_POST['letter']);
//echo '</pre>';
//
//die();




$letters = $places = [];

for ($i = 0; $i < 6; $i++) {
    for ($j = 0; $j < 5; $j++) {
        $letters[$i][$j] = $_POST['letters'][$i][$j] ?? null;
        $places[$i][$j] = $_POST['places'][$i][$j] ?? 0;
    }
}

$possible_words = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') $row = 0;

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['row'])) {

    $row = $_POST['row'];

    $wordlist = fopen("5_letter_words.txt", "r");

    print_r($letters[$row]);
    echo '<br><br>';

    while (($line = fgets($wordlist)) !== false) {

        // put each word in the list in a variable and also in an array of 5 letters
        $dict_word = trim($line);
        $dict_letters = str_split($dict_word);

        print_r($dict_letters);
        echo '<br>';

        $next_flag = false; // to indicate that we know to skip this word and move to next

        for ($i = 0; $i < 5; $i++) {

//            if (
//                ($places[$row][$i] == 0 && strpos($dict_word, $letters[$row][$i]) === true)
//                ||
//                ($places[$row][$i] == 1 && (
//                        $dict_letters[$i] == $letters[0][$i] || strpos($dict_word, $letters[$row][$i]) === false
//                    )
//                )
//                ||
//                ($places[$row][$i] == 2 && $dict_letters[$i] != $letters[$row][$i])
//            ) {
//                $next_flag = true;
//                break;
//            }

            if ($places[$row][$i] == 0 && strpos($dict_word, $letters[$row][$i]) === true) {
                $next_flag = true;
                break;
            }
//            elseif ($places[$row][$i] == 1 && (
//                    $dict_letters[$i] == $letters[0][$i] || strpos($dict_word, $letters[$row][$i]) === false
//                ) {
//                $next_flag = true;
//                break;
//            }





        }

        if ($next_flag === false) $possible_words[] = $dict_word;



    }

    $row++;

}



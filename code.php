<?php


$letters = $places = [];

for ($i = 0; $i < 6; $i++) {
    for ($j = 0; $j < 5; $j++) {
        $letters[$i][$j] = strtolower($_POST['letters'][$i][$j] ?? null);
        $places[$i][$j] = $_POST['places'][$i][$j] ?? 0;
    }
}

$possible_words = [];


if ($_SERVER['REQUEST_METHOD'] == 'GET') $row = 0;

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['row'])) {

    $row = $_POST['row'];

    // get list of excluded letters
    $excluded_letters = [];

    for ($i = 0; $i <= $row; $i++)
    {
        for ($j = 0; $j < 5; $j++)
        {
            if (in_array($letters[$i][$j], $excluded_letters)) continue;
            $exclude = false;
            if ($places[$i][$j] == 0) {
                $exclude = true;
                foreach ($letters[$i] as $key => $letter) {
                    if ($letter == $letters[$i][$j] && $places[$i][$key] > 0) {
                        $exclude = false;
                        break;
                    }
                }
            }
            if ($exclude === true) $excluded_letters[] = $letters[$i][$j];
        }
    }

    $wordlist = fopen("5_letter_words.txt", "r");

    while (($line = fgets($wordlist)) !== false) {

        // put each word in the list in a variable and also in an array of 5 letters
        $dict_word = trim($line);
        $dict_letters = str_split($dict_word);

        $next_flag = false; // to indicate that we know to skip this word and move to next

        // loop through the rows
        for ($i = 0; $i <= $row; $i++) {
            // loop through each letter in the dictionary word
            for ($j = 0; $j < 5; $j++) {

                if ($i == $row) {

                    if (
                        // make sure that the word has the known letters in the right place
                        ($places[$row][$j] == 2 && $dict_letters[$j] != $letters[$row][$j])
                        ||
                        // eliminate grey letters - they should not be in this position
                        ($places[$row][$j] == 0 && $letters[$row][$j] == $dict_letters[$j])
                        ||
                        // eliminate excluded letters from previous array
                        (in_array($dict_letters[$j], $excluded_letters))
                    ) {
                        $next_flag = true;
                        break;
                    }

                }

                // eliminate letters in the wrong place - they should be in the word but not in this position
                if ($places[$i][$j] == 1 && (
                        $dict_letters[$j] == $letters[$i][$j] || strpos($dict_word, $letters[$i][$j]) === false
                    )
                ) {
                    $next_flag = true;
                    break;
                }


            }

        }


        if ($next_flag === false) $possible_words[] = $dict_word;

    }

    $row++;

}


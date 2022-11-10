<?php




$letters = [$_POST['letter0'] ?? '', $_POST['letter1'] ?? '', $_POST['letter2'] ?? '', $_POST['letter3'] ?? '', $_POST['letter4'] ?? ''];
$place = [$_POST['place0'] ?? '', $_POST['place1'] ?? '', $_POST['place2'] ?? '', $_POST['place3'] ?? '', $_POST['place4'] ?? ''];

$unused_letters_string = $_POST['unused_letters'] ?? '';
$unused_letters = str_split($unused_letters_string);

$possible_words = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $possible_words = [];

  $wordlist = fopen("5_letter_words.txt", "r");

  while (($line = fgets($wordlist)) !== false) {

    // put each word in the list in a variable and also in an array of 5 letters
    $dict_word = trim($line);
    $dict_letters = str_split($dict_word);

    $next_flag = false; // to indicate that we know to skip this word and move to next

    // check that the word doesn't contain any letters in the list of unused letters
    foreach ($unused_letters as $unused_letter) {
      if (strpos($dict_word, $unused_letter) !== false) {
        $next_flag = true;
        break;
      }
    }
    if ($next_flag === true) continue;


    // there are 3 arrays used here, each with 5 keys

     for ($i = 0; $i < 5; $i++)
     {
       if ($letters[$i] == '') continue;

       if (
           ($place[$i] == 1 && $letters[$i] != $dict_letters[$i])
           ||
           ($place[$i] == 0 && $letters[$i] == $dict_letters[$i])
           ||
           ($place[$i] == 0 && strpos($dict_word, $letters[$i]) === false)
           )
            {
             $next_flag = true;
             break;
            }

     }

     if ($next_flag === true) continue;

      $possible_words[] = $dict_word;




  }


}




?>


<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>


<body class="m-5">

<h1 class="text-3xl">Wordle Cheat</h1>


<form method="post" autocomplete="off">

<div class="m-auto text-center">

    <table class="m-auto">
        <tr>
            <td></td>

            <td>
                <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase" name="letter0" value="<?=$letters[0]?>">
            </td>

            <td>
                <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase" name="letter1" value="<?=$letters[1]?>">
            </td>

            <td>
                <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase" name="letter2" value="<?=$letters[2]?>">
            </td>

            <td>
                <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase" name="letter3" value="<?=$letters[3]?>">
            </td>

            <td>
                <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase" name="letter4" value="<?=$letters[4]?>">
            </td>
        </tr>

        <tr>
            <td class="text-sm">
                correct place<br>
                incorrect place
            </td>

            <td>
                <input type="radio" name="place0" value="1" class="mb-2" <?= $place[0] == 1 ? ' checked' : '' ?>><br>
                <input type="radio" name="place0" value="0" <?= $place[0] == 0 ? ' checked' : '' ?>>
            </td>

            <td>
                <input type="radio" name="place1" value="1" class="mb-2" <?= $place[1] == 1 ? ' checked' : '' ?>><br>
                <input type="radio" name="place1" value="0" <?= $place[1] == 0 ? ' checked' : '' ?>>
            </td>

            <td>
                <input type="radio" name="place2" value="1" class="mb-2" <?= $place[2] == 1 ? ' checked' : '' ?>><br>
                <input type="radio" name="place2" value="0" <?= $place[2] == 0 ? ' checked' : '' ?>>
            </td>

            <td>
                <input type="radio" name="place3" value="1" class="mb-2" <?= $place[3] == 1 ? ' checked' : '' ?>><br>
                <input type="radio" name="place3" value="0" <?= $place[3] == 0 ? ' checked' : '' ?>>
            </td>

            <td>
                <input type="radio" name="place4" value="1" class="mb-2" <?= $place[4] == 1 ? ' checked' : '' ?>><br>
                <input type="radio" name="place4" value="0" <?= $place[4] == 0 ? ' checked' : '' ?>>
            </td>
    </tr>

    <tr>
      <td colspan="6">
        <input type="text" name="unused_letters" value="<?= $unused_letters_string ?>" placeholder="unused letters" class="text-xl w-full p-2 mt-5 border border-black rounded mr-5 uppercase">
      </td>
    </tr>

    </table>

    <br><br>

    <button type="submit" class="border border-black rounded p-3">FIND WORDS</button> <a href="/wordcheat" class="border border-black rounded p-4 ml-5">RESET</a>

</div>

    <?php
        if ($possible_words) {
    ?>

    <div class="mx-5">

        <?= count($possible_words) ?> Possible words for the above configuration :

        <br><br>

        <?php
            foreach ($possible_words as $possible_word) {
                echo $possible_word . '<br>';
            }


        }

        ?>


    </div>

</form>

</body>
</html>

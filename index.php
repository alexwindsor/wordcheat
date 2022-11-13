<?php
include 'code.php';
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body class="m-2 sm:m-4">

<form method="post" autocomplete="off">

<input type="hidden" name="row" value="<?= $row ?>">

<h1 class="text-3xl">Wordle Cheat</h1>

<div class="m-auto text-center">

    <table class="m-auto">
    <?php
    for ($i = 0; $i < 6; $i++) {

        $readonly = $i == $row ? '' : '  readonly="readonly"';

        ?>
            <tr>
                <td></td>

                <td>
                    <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase"<?= $i == $row ? ' id="box_1"' : '' ?> name="letters[<?= $i ?>][0]" value="<?= $letters[$i][0] ?>"<?= $readonly ?> required>
                </td>

                <td>
                    <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase"<?= $i == $row ? ' id="box_2"' : '' ?> name="letters[<?= $i ?>][1]" value="<?= $letters[$i][1] ?>"<?= $readonly ?> required>
                </td>

                <td>
                    <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase"<?= $i == $row ? ' id="box_3"' : '' ?> name="letters[<?= $i ?>][2]" value="<?= $letters[$i][2] ?>"<?= $readonly ?> required>
                </td>

                <td>
                    <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase"<?= $i == $row ? ' id="box_4"' : '' ?> name="letters[<?= $i ?>][3]" value="<?= $letters[$i][3] ?>"<?= $readonly ?> required>
                </td>

                <td>
                    <input type="text" maxlength="1" class="text-xl w-10 p-2 border border-black rounded mr-5 uppercase"<?= $i == $row ? ' id="box_5"' : '' ?> name="letters[<?= $i ?>][4]" value="<?= $letters[$i][4] ?>"<?= $readonly ?> required>
                </td>
            </tr>

            <tr>
                <td class="text-sm text-left">
                    <?= $row == $i ? 'correct place<br>incorrect place<br>letter not in word' : '' ?>
                </td>

                <td>
                    <input type="radio" name="places[<?= $i ?>][0]" value="2"<?= $row != $i && $places[$i][0] != 2 ? ' disabled' : '' ?><?= $places[$i][0] == 2 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][0]" value="1"<?= $row != $i && $places[$i][0] != 1 ? ' disabled' : '' ?><?= $places[$i][0] == 1 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][0]" value="0"<?= $row != $i && $places[$i][0] != 0 ? ' disabled' : '' ?><?= $places[$i][0] == 0 ? ' checked' : '' ?>>
                </td>

                <td>
                    <input type="radio" name="places[<?= $i ?>][1]" value="2"<?= $row != $i && $places[$i][1] != 2 ? ' disabled' : '' ?><?= $places[$i][1] == 2 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][1]" value="1"<?= $row != $i && $places[$i][1] != 1 ? ' disabled' : '' ?><?= $places[$i][1] == 1 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][1]" value="0"<?= $row != $i && $places[$i][1] != 0 ? ' disabled' : '' ?><?= $places[$i][1] == 0 ? ' checked' : '' ?>>
                </td>

                <td>
                    <input type="radio" name="places[<?= $i ?>][2]" value="2"<?= $row != $i && $places[$i][2] != 2 ? ' disabled' : '' ?><?= $places[$i][2] == 2 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][2]" value="1"<?= $row != $i && $places[$i][2] != 1 ? ' disabled' : '' ?><?= $places[$i][2] == 1 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][2]" value="0"<?= $row != $i && $places[$i][2] != 0 ? ' disabled' : '' ?><?= $places[$i][2] == 0 ? ' checked' : '' ?>>
                </td>

                <td>
                    <input type="radio" name="places[<?= $i ?>][3]" value="2"<?= $row != $i && $places[$i][3] != 2 ? ' disabled' : '' ?><?= $places[$i][3] == 2 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][3]" value="1"<?= $row != $i && $places[$i][3] != 1 ? ' disabled' : '' ?><?= $places[$i][3] == 1 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][3]" value="0"<?= $row != $i && $places[$i][3] != 0 ? ' disabled' : '' ?><?= $places[$i][3] == 0 ? ' checked' : '' ?>>
                </td>

                <td>
                    <input type="radio" name="places[<?= $i ?>][4]" value="2"<?= $row != $i && $places[$i][4] != 2 ? ' disabled' : '' ?><?= $places[$i][4] == 2 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][4]" value="1"<?= $row != $i && $places[$i][4] != 1 ? ' disabled' : '' ?><?= $places[$i][4] == 1 ? ' checked' : '' ?>><br>
                    <input type="radio" name="places[<?= $i ?>][4]" value="0"<?= $row != $i && $places[$i][4] != 0 ? ' disabled' : '' ?><?= $places[$i][4] == 0 ? ' checked' : '' ?>>
                </td>
            </tr>

            <?php
            }
        ?>

    </table>

    <br><br>

    <button type="submit" class="border border-black rounded p-3">FIND WORDS</button> <a href="/wordcheat" class="border border-black rounded p-4 ml-5">RESET</a>

</div>
</form>

<?php
if ($row > 0)
{
    if (count($possible_words) > 1)
    {
        echo count($possible_words) . ' possible words found :';
    }
    elseif (count($possible_words) === 1)
    {
        echo 'WORD FOUND: ';
    }
    elseif (count($possible_words) === 0)
    {
        echo 'No words found with the above combination, sorry...';
    }

    echo '<br><br>';

    foreach ($possible_words as $word) {

        echo '<span id="' . $word . '" class="found_word hover:underline">';
        echo $word;
        echo '</span><br>';

    }

}

?>

<script language="JavaScript">

    <?php
        for ($i = 1; $i <= 5; $i++) {
    ?>

    $('#box_<?= $i ?>').keyup(function () {
        $('#box_<?= $i + 1 ?>').focus();
        $('#box_<?= $i + 1 ?>').select();
    });

    <?php
        }
    ?>

    $('input[type="text"]').on('click', function () {
        $(this).select();
    });

    $('.found_word').click(function () {

        for (i = 0; i < 6; i++) {
            j = i + 1;
            $('#box_' + j).val(this.id.substr(i, 1));
        }

    });

</script>




</body>
</html>

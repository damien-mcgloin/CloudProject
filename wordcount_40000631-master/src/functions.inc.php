<?php
function wordcount($paragraph)
{

    //str_word_count function is used to check word count
    if ($paragraph == '') {
        throw new Exception('Enter a paragraph');
    } else {
        $count = 0;
        $count = str_word_count($paragraph);

        return $count;
    }

}

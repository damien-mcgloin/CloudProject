<?php
function keywordcount($paragraph, $word)
{

    $count = 0;

    // error handling used to return error messages to user
    if ($paragraph=='' && $word=='') {
      throw new Exception('Enter text and a keyword');
    } elseif ($paragraph == '') {
      throw new Exception('Enter a paragraph');
    } elseif ($word == '') {
      throw new Exception('Enter a keyword');
    } elseif (str_word_count($word) !== 1){
      throw new Exception ('Enter only one word');
    } else {

      // array is created for individual words in paragraph
      $paragrapharray = str_word_count($paragraph, 1);

      // new array and keyword are both set to lower case
      // array is looped through and values are compared with keyword
      foreach ($paragrapharray as $value) {
        if (strtolower($word) == strtolower($value)){
          $count+=1;
        }
      }

      return $count;

    }

}

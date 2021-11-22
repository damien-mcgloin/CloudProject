<?php
function check($paragraph, $word)
{
    ### Alternate method - this will return a ###
    ### match if the keyword is just one letter though ###

    #if (stripos($paragraph, $word) !== false)
    #    return 1;
    #else
    #    return 0;


    // error handling is used to return error message to user
    if ($paragraph=='' && $word=='') {
        throw new Exception('Enter text and a keyword');
      } elseif ($paragraph == '') {
        throw new Exception('Enter a paragraph');
      } elseif ($word == '') {
        throw new Exception('Enter a keyword');
      } elseif (str_word_count($word) !== 1){
        throw new Exception ('Enter only one word');
      } else {

        // array is created containing words in paragraph field
        $paragrapharray = str_word_count($paragraph, 1);
        $count = 0;

        // array and keyword are changed to lower case
        // array is looped through, values and keyword are compared
        foreach ($paragrapharray as $value) {
          if (strtolower($word) == strtolower($value)){
          $count+=1;
          }
        }

        if ($count > 0) {
          return 1;
        }
        else {
          return 0;
        }

      }

}

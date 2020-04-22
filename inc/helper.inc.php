<?php
function purify($dirty)
{
  $config = HTMLPurifier_Config::createDefault();
  $purifier = new HTMLPurifier($config);
  return $purifier->purify($dirty);
}


function clean($dirty, $stripTags = true, $encoding = 'UTF-8')
{
  if ($stripTags) {
    $dirty = strip_tags($dirty);
  }
  return htmlspecialchars(
    $dirty,
    ENT_QUOTES | ENT_HTML5,
    $encoding
  );
}

// clean("<p>Hallo Wie geht's Dir? Ist 3 > 4?</p> ")
// Hallo Wie geht's Dir? Ist 3 > 4?
// Hallo Wie geht&quot;s Dir? Ist 3 &gt; 4?

function pre_r($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

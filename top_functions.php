<?php
  #extract_subhash
  #hash_splice
  function hash_extract_array($in_hash, $keys)
  {
    $out_array = array();
    foreach ($keys as $key)
    {
      $out_array[] = $in[$key];
    }
    return $out_array
  }
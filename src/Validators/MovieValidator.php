<?php

namespace Validators;

use Validators\TokenValidator;
use Webmasters\Doctrine\ORM\Util\Datetime;

class MovieValidator extends TokenValidator
{

  public function validateTitle($title)
  {
    if (empty($title)) {
      $this->addError("The field \"Title\" is empty.");
    } elseif (strlen($title) < 3 || strlen($title) > 80) {
      $this->addError("The field length \"Title\" has to be between 3 and 80 characters.");
    }
  }
}

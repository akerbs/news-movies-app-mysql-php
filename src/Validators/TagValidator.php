<?php

namespace Validators;

use Webmasters\Doctrine\ORM\EntityValidator;

class TagValidator extends EntityValidator {

  public function validateTitle($title) {
   $tag = $this->getEntity();
    if (empty($title)) {
      $this->addError("The field \"Title\" ist empty.");
    } elseif ($this->getRepository()->findDuplicates($tag)) {
      $this->addError("The field \"Title\" already exists.");
    }
  }

}
<?php

namespace Validators;

use Webmasters\Doctrine\ORM\Util\Datetime;
use Webmasters\Doctrine\ORM\EntityValidator;

class ArticleValidator extends EntityValidator {
  
  public function validateTitle($title) {
    if (empty($title)) {
      $this->addError("The field \"Title\" is empty.");
    } elseif (strlen($title) < 3 || strlen($title) > 80) {
      $this->addError("The field length \"Title\" has to be between 3 and 80 characters.");
    }
  }

  // HOMEWORK = News, Tags, Teaser

  public function validatePublishAt($publishAt) {
    $now = new DateTime('now');  // liest das aktuelle Datum aus;
    if(empty($publishAt)) {
      $this->addError("The field \"Publish At\" is empty.");
    } elseif (!$publishAt->isValid()) {
      $this->addError("The field \"Publish At\" isn't correct.");
    } elseif (!$now->isValidClosingDate($publishAt)) {
      $this->addError("The field \"Publish At\" is in the past.");
    }
  }
}
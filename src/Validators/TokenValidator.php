<?php

namespace Validators;

use Webmasters\Doctrine\ORM\EntityValidator;

class TokenValidator extends EntityValidator
{
  protected $csrfTokenChecked = false;

  public function validateCsrfToken($template, $post)
  {
    $token = $post['csrf_token'] ?? '';
    $valid = !empty($token) && isValidateCsrfToken($token, $template);

    if (!$valid) {
      $this->addError('Security problem: invalid CSRF-Token.');
    }

    $this->csrfTokenChecked = true;

    return $this;
  }

  public function getErrors()
  {
    if (!$this->isCsrfTokenChecked()) {
      $this->addError('Security problem: No existing CSRF-Validation');
    }

    return parent::getErrors();
  }

  public function isValid()
  {
    return parent::isValid() && $this->isCsrfTokenChecked();
  }

  protected function isCsrfTokenChecked()
  {
    return $this->csrfTokenChecked === true;
  }
}

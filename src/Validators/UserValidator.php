<?php

namespace Validators;

use Webmasters\Doctrine\ORM\EntityValidator;

class UserValidator extends EntityValidator
{
  protected const PASSWORD_MIN_LENGTH = 12;

  public function validateFirstname($firstname)
  {
    if (empty($firstname)) {
      $this->addError('The field "Firstname" is empty.');
    }
  }

  public function validateLastname($lastname)
  {
    // fill me
  }

  public function validateUsername($username)
  {
    $user = $this->getEntity();

    if ($this->getRepository()->findDuplicateUsernames($user)) {
      $this->addError('The "Username" already exist.');
    }
  }

  public function validateEmail($email)
  {
    // filter-var 
    // https://www.php.net/manual/en/function.filter-var
  }

  public function validatePassword($password)
  {
    $entity = $this->getEntity();

    // Ermittlung aller benutzten Zeichen
    $usedChars = count_chars($password, 1);

    // Es kommt min. ein Buchstabe A-Z vor
    $hasLetters = $this->filterRegex($password, '/[A-Z]+/');

    // Es kommt min. ein Buchstabe a-z vor
    $hasSmallLetters = $this->filterRegex($password, '/[a-z]+/');

    // Es kommt min. eine Zahl vor
    $hasNumbers = $this->filterRegex($password, '/\d+/');

    // Es kommt min. ein Sonderzeichen vor
    $hasSpecialChars = $this->filterRegex($password, '/[_\W]+/');

    if (empty($password)) {
      $this->addError('The Password field is empty.');
    } elseif (strlen($password) < self::PASSWORD_MIN_LENGTH) {
      $this->addError(
        sprintf('The password should be at least% d characters long.', self::PASSWORD_MIN_LENGTH)
      );
    } elseif (count($usedChars) < (strlen($password) / 2)) {
      $this->addError('The password should contain at least 50 percent different characters.');
    } elseif (
      ($hasLetters === false) ||
      ($hasSmallLetters === false) ||
      ($hasNumbers === false) ||
      ($hasSpecialChars === false)
    ) {
      $this->addError('The password should contain uppercase letters, lowercase letters, numbers and special characters.');
    } elseif (
      $entity->getEmail() &&
      (stristr($password, $entity->getEmail()) !== false)
    ) {
      $this->addError('The password should not contain any private data.');
    }
  }

  protected function filterRegex($wert, $regex)
  {
    return filter_var(
      $wert,
      FILTER_VALIDATE_REGEXP,
      [
        'options' => ['regexp' => $regex]
      ]
    );
  }
}

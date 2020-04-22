<?php 

namespace Traits;

use Webmasters\Doctrine\ORM\Util\StringConverter;

trait ArrayMappable {
  public function mapFromArray(array $data = [], $camelize = true) {
    /*
    ['id' => 3, 'title' => 'Joker', 'release_year' =>  ]
    */
  
    foreach ($data as $key => $value) {

        if ($camelize) {
          $setterName = 'set' . StringConverter::camelize($key); 
          // z.B. release_year -> setReleaseYear
        } else {
          $setterName = 'set' . ucfirst($key); // z.B. setId | setTitle | setRelease_year
        }
        
        if (method_exists($this, $setterName)) {
            $this->$setterName($value); // z.B. setId(3) | setTitle('Joker')
        }
    }
  }

  public function mapToArray($withId = true, $decamelize = true) {
      $attributes = get_object_vars($this);

      $result = [];
      foreach ($attributes as $key => $value) {
        if ($decamelize) {
          $key = StringConverter::decamelize($key); 
          // z.B. releaseYear -> release_year | CreatedAt -> created_at
        }
        $result[$key] = $value;
      }

      if ($withId === false) {
          unset($result['id']);
      }

      return $result;
  }

}
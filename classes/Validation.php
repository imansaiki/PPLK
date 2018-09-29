<?php

/** nilai awal $_passed = false
 *
 */
class Validation
{

  private $_passed = false,
  $_errors = array();

  public function check($items= array())
  {
    foreach ($items as $item => $rules)
    {
      foreach ($rules as $rule => $rule_value)
      {
        // $rule adalah key dari bagian yang paling dalam
        switch ($rule)
        {
          case 'required':
          if(trim(Input::get($item)) == false && $rule_value == true)
          {
            $this->addError ("$item wajib diisi");
          }
            break;

          case 'min':
          // die(strlen(Input::get($item)) < $rule_value);
          if(strlen(Input::get($item)) < $rule_value)
          {
            $this->addError ("$item minimal $rule_value karakter");
          }
            break;

          case 'max':
          if(strlen(Input::get($item)) > $rule_value)
          {
            $this->addError ("$item maksimal $rule_value karakter");
          } break;

          default:
            // code...
            break;
        }
      }//.end second foreach
    }//.first foreach
    if (empty($this->_errors))
    {
      $this->_passed = true;
    }

// CHAINING METHOD: return $this = objnya sendiri
 // cara menyambungkan satu metode ke metode lain, harus mengembalikan obj dari kelasnya sendiri.
 // agar setelah mengambil metode check, dengan mengembalikan $this akan tetap kelas validation
    return $this;
  }

  private function addError($error)
  {
    $this->_errors[] = $error;
  }

  public function getErrors()
  {
    return $this->_errors;
  }

  public function getPassed()
  {
    return $this->_passed;
  }

}


 ?>
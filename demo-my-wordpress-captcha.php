<?php
Class DemoCaptchaWP {

  private $min;
  private $max;
  private $session_var;
  private $result;
  private $operand1;
  private $operand2;
  private $operator;
  private $op_symbols = array('+', '-', '*');

  function __construct($sess_var = 'math_captcha_result', $min_val = 0, $max_val = 10) {

    $this->min = ($min_val <= 0) ? 0 : $min_val;
    $this->max = ($max_val <= $this->min) ? 10 : $max_val;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if(empty($ip))
    {
      $ip = '';
    }
    if (!empty($sess_var)) {
      $this->session_var = $sess_var . $ip;
    } else {
      $this->session_var = 'math_captcha_result' . $ip;
    }
  }

  public function reset_captcha() {

    $this->operand1 = rand($this->min, $this->max);
    $this->operand2 = rand($this->min, $this->max);
    $this->operator = $this->op_symbols[rand(0, (count($this->op_symbols) - 1))];
    $this->compute_result();
    set_transient ($this->session_var, $this->result, 600);
  }

  private function compute_result() {

    switch ($this->operator) {
      case '+':
        $this->result = ($this->operand1 + $this->operand2);
        break;

      case '-':
        $this->result = ($this->operand1 - $this->operand2);
        break;

      case '*':
        $this->result = ($this->operand1 * $this->operand2);
        break;
    }
  }

  public function validate($val) 
  {
      $tr = get_transient($this->session_var);
      if($tr === false)
      {
          return FALSE;
      }
      if ($val == $tr) 
      {
          return TRUE;
      } 
      else 
      {
          return FALSE;
      }
  }

  public function get_captcha_text($format = '{operand1} {operator} {operand2}') {
    if (!empty($format)) {
      return str_replace(
          array('{operand1}', '{operand2}', '{operator}')
          , array($this->operand1, $this->operand2, $this->operator)
          , $format);
    } else {
      return sprintf("%d %s %d", $this->operand1, $this->operator, $this->operand2);
    }
  }

  public function sums_only_please(){
    $this->op_symbols = array('+');
  }
  
}
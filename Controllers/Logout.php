<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Logout
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    session_start();
    session_unset();
    session_destroy();
    header('location: ' . Base_URL() . '/login');
  }
}

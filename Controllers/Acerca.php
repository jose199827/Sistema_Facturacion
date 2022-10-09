<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Acerca extends Controllers
{
    public function __construct()
    { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
        parent::__construct();
        session_start();
    }
    //Se crea el método Nosotros
    public function acerca()
    {
        $data['page_tag'] = NOMBRE_EMPRESA;
        $data['page_title'] = NOMBRE_EMPRESA;
        $data['page_name'] = "Nosotros";
        /* $data['page_funtions_js'] = "funtions_login.js"; */
        $this->views->getView($this, "acerca", $data);
    }
}
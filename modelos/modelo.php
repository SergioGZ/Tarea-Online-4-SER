<?php

/**
 *   Clase 'modelo' que implementa el modelo de nuestra aplicación en una
 * arquitectura MVC. Se encarga de gestionar el acceso a la base de datos
 * en una capa especializada
 */
class modelo {

  //Atributo que contendrá la referencia a la base de datos 
  private $conexion;
  // Parámetros de conexión a la base de datos 
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $db = "bdblog";

  /**
   * Constructor de la clase que ejecutará directamente el método 'conectar()'
   */
  public function __construct() {
    $this->conectar();
  }

  /**
   * Método que realiza la conexión a la base de datos de usuarios mediante PDO.
   * Devuelve TRUE si se realizó correctamente y FALSE en caso contrario.
   * @return boolean
   */
  public function conectar() {
    try {
      $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return TRUE;
    } catch (PDOException $ex) {
      return $ex->getMessage();
    }
  }

  /**
   * Función que nos permite conocer si estamos conectados o no a la base de datos.
   * Devuelve TRUE si se realizó correctamente y FALSE en caso contrario.
   * @return boolean
   */
  public function estaConectado() {
    if ($this->conexion) :
      return TRUE;
    else :
      return FALSE;
    endif;
  }

  public function login($user)
    {
        $resultModelo = [
            "correcto" => false,
            "datos" => null,
            "error" => null,
        ];
        //Realizamos la consulta...
        try { //Preparamos la consulta...
            $sql = "SELECT * FROM usuarios where nick = '$user'";            
            $resultsquery = $this->conexion->query($sql);
            //Si la consulta se realizó correctamente...
            if ($resultsquery) {
                $resultModelo["correcto"] = true;
                $resultModelo["datos"] = $resultsquery->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {
            $resultModelo["error"] = $ex->getMessage();
        }

        return $resultModelo;
    }

    public function listadoEntradasAdmin() {
      $resultmodelo = [
          "correcto" => FALSE,
          "datos" => NULL,
          "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
        $sql = "SELECT usuarios.nick, entradas.*, categorias.* FROM entradas INNER JOIN usuarios ON entradas.usuario_id = usuarios.id INNER JOIN categorias ON entradas.categoria_id = categorias.id";
        // Hacemos directamente la consulta al no tener parámetros
        $resultsquery = $this->conexion->query($sql);
        //Supervisamos si la inserción se realizó correctamente... 
        if ($resultsquery) :
          $resultmodelo["correcto"] = TRUE;
          $resultmodelo["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
        endif; // o no :(
      } catch (PDOException $ex) {
        $resultmodelo["error"] = $ex->getMessage();
      }
  
      return $resultmodelo;
    }

    public function listadoEntradasUsuario($id) {
      $return = [
          "correcto" => FALSE,
          "datos" => NULL,
          "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
        $sql = "SELECT usuarios.nick, entradas.*, categorias.* FROM entradas INNER JOIN usuarios ON entradas.usuario_id = usuarios.id INNER JOIN categorias ON entradas.categoria_id = categorias.id WHERE usuario_id = $id";
        // Hacemos directamente la consulta al no tener parámetros
        $resultsquery = $this->conexion->query($sql);
        //Supervisamos si la inserción se realizó correctamente... 
        if ($resultsquery) :
          $return["correcto"] = TRUE;
          $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
        endif; // o no :(
      } catch (PDOException $ex) {
        $return["error"] = $ex->getMessage();
      }
  
      return $return;
    }

    public function addentrada($datos) {
      $return = [
          "correcto" => FALSE,
          "error" => NULL
      ];
  
      try {
        //Inicializamos la transacción
        $this->conexion->beginTransaction();
        //Definimos la instrucción SQL parametrizada 
        $sql = "INSERT INTO entradas(usuario_id,categoria_id,titulo,imagen,descripcion,fecha)
                           VALUES (:usuario_id,:categoria_id,:titulo,:imagen,:descripcion,:fecha)";
        // Preparamos la consulta...
        $query = $this->conexion->prepare($sql);
        // y la ejecutamos indicando los valores que tendría cada parámetro
        $query->execute([
            'usuario_id' => $datos["usuario_id"],
            'categoria_id' => $datos["categoria_id"],
            'titulo' => $datos["titulo"],
            'imagen' => $datos["imagen"],
            'descripcion' => $datos["descripcion"],
            'fecha' => $datos["fecha"]
        ]); //Supervisamos si la inserción se realizó correctamente... 
        if ($query) {
          $this->conexion->commit(); // commit() confirma los cambios realizados durante la transacción
          $return["correcto"] = TRUE;
        }// o no :(
      } catch (PDOException $ex) {
        $this->conexion->rollback(); // rollback() se revierten los cambios realizados durante la transacción
        $return["error"] = $ex->getMessage();
        //die();
      }
  
      return $return;
    }

    public function listarentrada($id) {
      $return = [
          "correcto" => FALSE,
          "datos" => NULL,
          "error" => NULL
      ];
  
      if ($id && is_numeric($id)) {
        try {
          $sql = "SELECT * FROM entradas WHERE id=:id";
          $query = $this->conexion->prepare($sql);
          $query->execute(['id' => $id]);
          //Supervisamos que la consulta se realizó correctamente... 
          if ($query) {
            $return["correcto"] = TRUE;
            $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
          }// o no :(
        } catch (PDOException $ex) {
          $return["error"] = $ex->getMessage();
          //die();
        }
      }
  
      return $return;
    }

    public function actentrada($datos) {
      $return = [
          "correcto" => FALSE,
          "error" => NULL
      ];
  
      try {
        //Inicializamos la transacción
        $this->conexion->beginTransaction();
        //Definimos la instrucción SQL parametrizada 
        $sql = "UPDATE entradas SET titulo= :titulo, descripcion= :descripcion, categoria_id= :categoria_id, fecha= :fecha, imagen= :imagen WHERE id=:id";
        $query = $this->conexion->prepare($sql);
        $query->execute([
            'id' => $datos["id"],
            'titulo' => $datos["titulo"],
            'descripcion' => $datos["descripcion"],
            'categoria_id' => $datos["categoria_id"],
            'fecha' => $datos["fecha"],
            'imagen' => $datos["imagen"]
        ]);
        //Supervisamos si la inserción se realizó correctamente... 
        if ($query) {
          $this->conexion->commit();  // commit() confirma los cambios realizados durante la transacción
          $return["correcto"] = TRUE;
        }// o no :(
      } catch (PDOException $ex) {
        $this->conexion->rollback(); // rollback() se revierten los cambios realizados durante la transacción
        $return["error"] = $ex->getMessage();
        //die();
      }
  
      return $return;
    }

  /**
   * Método que elimina el usuario cuyo id es el que se le pasa como parámetro 
   * @param $id es un valor numérico. Es el campo clave de la tabla
   * @return boolean
   */
  public function delentrada($id) {
    // La función devuelve un array con dos valores:'correcto', que indica si la
    // operación se realizó correctamente, y 'mensaje', campo a través del cual le
    // mandamos a la vista el mensaje indicativo del resultado de la operación
    $return = [
        "correcto" => FALSE,
        "error" => NULL
    ];
    //Si hemos recibido el id y es un número realizamos el borrado...
    if ($id && is_numeric($id)) {
      try {
        //Inicializamos la transacción
        $this->conexion->beginTransaction();
        //Definimos la instrucción SQL parametrizada 
        $sql = "DELETE FROM entradas WHERE id=:id";
        $query = $this->conexion->prepare($sql);
        $query->execute(['id' => $id]);
        //Supervisamos si la eliminación se realizó correctamente... 
        if ($query) {
          $this->conexion->commit();  // commit() confirma los cambios realizados durante la transacción
          $return["correcto"] = TRUE;
        }// o no :(
      } catch (PDOException $ex) {
        $this->conexion->rollback(); // rollback() se revierten los cambios realizados durante la transacción
        $return["error"] = $ex->getMessage();
      }
    } else {
      $return["correcto"] = FALSE;
    }

    return $return;
  }

  public function listausuario($id) {
    $return = [
        "correcto" => FALSE,
        "datos" => NULL,
        "error" => NULL
    ];

    if ($id && is_numeric($id)) {
      try {
        $sql = "SELECT * FROM usuarios WHERE id=:id";
        $query = $this->conexion->prepare($sql);
        $query->execute(['id' => $id]);
        //Supervisamos que la consulta se realizó correctamente... 
        if ($query) {
          $return["correcto"] = TRUE;
          $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
        }// o no :(
      } catch (PDOException $ex) {
        $return["error"] = $ex->getMessage();
        //die();
      }
    }

    return $return;
  }

}

<?php

require_once("../../models/ConexionModel.php");
/**
 * Los 7 métodos que suelen tener los controladores:
 * index: muestra la lista de todos los recursos.
 * create: muestra un formulario para ingresar un nuevo recurso. (luego manda a llamar al método store).
 * store: registra dentro de la base de datos el nuevo recurso.
 * show: muestra un recurso específico.
 * edit: muestra un formulario para editar un recurso. (luego manda a llamar al método update).
 * update: actualiza el recurso dentro de la base de datos.
 * destroy: elimina un recurso.
 */

class QuejaController
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConexionModel::getInstance()->getDatabaseInstance();
    }

    // listar preguntas 
    public function index(){
        $consulta = $this->conn->prepare("SELECT * from preguntas;");
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        foreach ($resultados as $resultado){
            echo "<a href='#' onclick=''>";
            // echo "<a>";
            echo "<b>Número de pregunta: </b>" . $resultado['id'] . "<br>";
            // echo "<b>ID Usuario: </b>" . $resultado['id_usuario'] . "<br>";
            echo "<b>Pregunta: </b>" . $resultado['texto_pregunta'] . "<br>";
            
            echo "<b>Creada en: </b>" . $resultado['creado_en'] . "<br>";
            echo "<b>Actualizada en: </b>" . $resultado['actualizado_en'] . "<br>";
            echo "<br>";

            if ($resultado['estado'] = 'pendiente') {
                echo "<h8><b>Estado: PENDIENTE</b></h8>";
            } else if ($resultado['estado'] = 'respondida') {
                echo "<h7><b>Estado: RESPONDIDA</b></h7>";
            }
            echo "<br>";
            echo "</a>";
            echo "<hr>";
        }
    }

    // lListar preguntas v2
    public function index2(){
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $consulta = $this->conn->prepare("SELECT * FROM preguntas WHERE id_usuario = :id_usuario;");
        $consulta->execute([":id_usuario" => $id_usuario]);
        $resultados = $consulta->fetchAll();
        foreach ($resultados as $resultado){
            echo "<a href='#' onclick=''>";
            echo "<b>Pregunta: </b>" . $resultado['texto_pregunta'] . "<br>";
            echo "<b>Creada en: </b>" . $resultado['creado_en'] . "<br>";
            echo "<b>Actualizada en: </b>" . $resultado['actualizado_en'] . "<br>";
            echo "<br>";
    
            if ($resultado['estado'] == 'pendiente') {
                echo "<h8><b>Estado: PENDIENTE</b></h8>";
            } else if ($resultado['estado'] == 'respondida') {
                echo "<h7><b>Estado: RESPONDIDA</b></h7>";
            }
            echo "<br><br>";
            echo "</a>";
            echo "<hr>";
        }
    }
    

    
    
    
    


    public function create()
    {
        require_once("../app/views/ingresos/create.php");
    }

    public function delete()
    {
        require_once("../app/views/ingresos/delete.php");
    }

    public function store($data)
    {
        try {
            $consulta = $this->conn->prepare("INSERT INTO quejas(id, ci, queja, estado, creado_en, actualizado_en) VALUES (:id, :ci, :queja, :estado, :creado_en, actualizado_en);");
            $consulta->bindValue(":id", $data['id']);
            $consulta->bindValue(":ci", $data['ci']);
            $consulta->bindValue(":queja", $data['queja']);
            $consulta->bindValue(":estado", $data['estado']);
            $consulta->bindValue(":creado_en", $data['creado_en']);
            $consulta->bindValue(":actualizado_en", $data['actualizado_en']);
            $consulta->execute();
            header("location: quejas");
        } catch (PDOException $e) {
            echo "Error al almacenar la queja: " . $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $consulta = $this->conn->prepare("SELECT * FROM preguntas WHERE id=:id;");
            $consulta->execute([":id" => $id]);
            $resultados = $consulta->fetch();
            if (!$resultados) {
                //Lanzamos una excepción zuculenta si no existe el valor
                throw new Exception("No se encontró el dato con ID: $id");
            }
            require_once("../app/views/preguntas/ingreso.php");
        } catch (Exception $e) {
            // Se captura la excepción
            echo "Se ha producido una excepción: " . $e->getMessage();
        }
    }

    public function edit()
    {
        try {
            $id = $_GET['slug'];
            $valor = explode("/", $id);
            $id = $valor[2];
            $id = (int) $id;
            $consulta = $this->conn->prepare("SELECT * FROM ingresos WHERE id=:id;");
            $consulta->execute([":id" => $id]);
            $resultados = $consulta->fetch();
            if (!$resultados) {
                //Lanzamos una excepción zuculenta si no existe el valor
                throw new Exception("No se encontró el dato con ID: $id");
            }
            // Acá mostramos el formulario, idem show
            require_once("../app/views/ingresos/edit.php");
        } catch (Exception $e) {
            // Se captura la excepción
            echo "Se ha producido una excepción: " . $e->getMessage();
        }
    }

    public function update($data)
    {
        try {
            echo "<script>alert('estoy aqui cabrones');</script>";
            $consulta = $this->conn->prepare("UPDATE preguntas SET 
            metodo_pago = :metodo_pago,
            tipo = :tipo,
            fecha_ingreso = :fecha_ingreso,
            cantidad = :cantidad,
            descripcion = :descripcion WHERE id=:id;");
            $consulta->execute([
                ":id" => $data['id'],
                ":metodo_pago" => $data['metodo_pago'],
                ":tipo" => $data['tipo'],
                ":fecha_ingreso" => $data['fecha_ingreso'],
                ":cantidad" => $data['cantidad'],
                ":descripcion" => $data['descripcion'],
            ]);
            header("location: /ingresos");
        } catch (PDOException $e) {
            echo "Error al actualizar el ingreso: " . $e->getMessage();
        }
    }

    public function destroy($data)
    {
        $id = $data['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $consulta = $this->conn->prepare("DELETE FROM ingresos WHERE id=:id;");
                $consulta->execute([":id" => $id]);
                header("location: /");
            } catch (PDOException $e) {
                echo "Error al eliminar el ingreso: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido";
        }
    }
}

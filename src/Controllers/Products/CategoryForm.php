<?php

namespace Controllers\Products;

use Controllers\PublicController;
use Views\Renderer;

class CategoryForm extends PublicController
{
    private $viewData = [];
    private $mode = "DSP";

    private $crf_token = "";

    private $categoryId = 0;
    private $categoryName = "";
    private $categorySmallDesc = "";
    private $categoryStatus = "ACT";

    private $isReadOnly = "readonly";

    private $hasErrors = false;
    private $errors = [];

    private $modeOptions = [
        "INS" => "Nueva Categoría",
        "UPD" => "Actualizando Categoría (%s %s)",
        "DEL" => "Eliminando Categoría (%s %s)",
        "DSP" => "Detalle de Categoría (%s %s)"
    ];

    private $categoryStatusOptions = [
        "ACT" => "Activo",
        "INA" => "Inactivo",
        "RTR" => "Retirar",
        "DSC" => "Descontinuado"
    ];

    private function throwError($message, $scope = "global")
    {
        $this->hasErrors = true;
        error_log($message);
        if (!isset($this->errors[$scope])) {
            $this->errors[$scope] = [];
        }
        $this->errors[$scope][] = $message;
    }

    private function cargar_datos()
    {
        $this->categoryId = isset($_GET["category_id"]) ? intval($_GET["category_id"]) : 0;
        $this->mode = isset($_GET["mode"]) ? $_GET["mode"] : "DSP";

        if ($this->categoryId > 0) {
            $categoria = \Dao\Productos\Categories::getCategory($this->categoryId);
            if ($categoria) {
                $this->categoryName = $categoria["category_name"];
                $this->categorySmallDesc = $categoria["category_small_desc"];
                $this->categoryStatus = $categoria["category_status"];
            }
        }
    }

    private function getPostData()
    {
        if (!$this->validateCsfrToken()) {
            $this->throwError("Error de aplicación, Token CSRF Inválido");
        }
        $tmp_mode = isset($_POST["mode"]) ? $_POST["mode"] : "DSP";
        if ($tmp_mode !== $this->mode) {
            $this->throwError("Error de aplicación, Modo de formulario incorrecto");
        }
        $tmp_category_id = isset($_POST["category_id"]) ? intval($_POST["category_id"]) : 0;
        if ($this->mode === "INS") {
            if ($tmp_category_id !== 0) {
                $this->throwError("No se puede insertar con un valor de categoria", "category_id_error");
            }
        } else {
            if ($tmp_category_id != $this->categoryId) {
                $this->throwError("Error de Aplicación, no se puede modificar el valor del Identificador de la Categoria");
            }
        }
        $this->categoryId = $tmp_category_id;

        $tmp_category_name = isset($_POST["category_name"]) ? $_POST["category_name"] : "";
        if (preg_match("/^\s*$/", $tmp_category_name)) {
            $this->throwError("Debe ingresar el nombre de la categoria", "category_name_error");
        }
        if (!preg_match("/^[a-zA-Z0-9áéíóúüÁÉÍÓÚÜñÑ ]*$/", $tmp_category_name)) {
            $this->throwError("El nombre de la categoria solo puede contener letras y números", "category_name_error");
        }
        $this->categoryName = $tmp_category_name;

        $tmp_categorySmallDesc = isset($_POST["category_small_desc"]) ? $_POST["category_small_desc"] : "";
        if (preg_match("/^\s*$/", $tmp_categorySmallDesc)) {
            $this->throwError("Debe ingresar la descripción de la categoria", "category_small_desc_error");
        }
        if (!preg_match("/^[a-zA-Z0-9áéíóúüÁÉÍÓÚÜñÑ ]*$/", $tmp_category_name)) {
            $this->throwError("La descripción de la categoria solo puede contener letras y números", "category_small_desc_error");
        }
        $this->categorySmallDesc = $tmp_categorySmallDesc;

        $tmp_categoryStatus = isset($_POST["category_status"]) ? $_POST["category_status"] : "";
        if (!isset($this->categoryStatusOptions[$tmp_categoryStatus])) {
            $this->throwError("Debe seleccionar un estado para la categoria");
        }
        $this->categoryStatus = $tmp_categoryStatus;
    }

    private function processAction()
    {
        switch ($this->mode) {
            case "INS":
                $inserted = \Dao\Productos\Categories::insertCategory(
                    $this->categoryName,
                    $this->categorySmallDesc,
                    $this->categoryStatus
                );
                if ($inserted) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=Products_CategoriesList",
                        "Categoria Guardada"
                    );
                } else {
                    $this->throwError("Error al insertar la categoria");
                }
                break;
            case "UPD":
                $updated = \Dao\Productos\Categories::updateCategory(
                    $this->categoryName,
                    $this->categorySmallDesc,
                    $this->categoryStatus,
                    $this->categoryId
                );
                if ($updated) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=Products_CategoriesList",
                        "Categoria Actualizada"
                    );
                } else {
                    $this->throwError("Error al actualizar la categoria");
                }
                break;
            case "DEL":
                $deleted = \Dao\Productos\Categories::deleteCategory($this->categoryId);
                if ($deleted) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=Products_CategoriesList",
                        "Categoria Eliminada"
                    );
                } else {
                    $this->throwError("Error al eliminar la categoria");
                }
                break;
        }
    }
    private function prepareViewData()
    {
        $viewData["mode"] = $this->mode;
        $viewData["modeDesc"] = sprintf($this->modeOptions[$this->mode], $this->categoryId, $this->categoryName);
        $viewData["category_id"] = $this->categoryId;
        $viewData["category_name"] = $this->categoryName;
        $viewData["category_small_desc"] = $this->categorySmallDesc;
        $viewData["category_status"] = $this->categoryStatus;

        if ($this->mode === "INS" || $this->mode === "UPD") {
            $this->isReadOnly = "";
        }
        $viewData["isReadOnly"] = $this->isReadOnly;

        $viewData["showAction"] = $this->mode !== "DSP";

        foreach ($this->categoryStatusOptions as $value => $text) {
            $viewData["category_status_list"][] = [
                "value" => $value,
                "text" => $text,
                "selected" => ($value === $this->categoryStatus) ? "selected" : ""
            ];
        }

        $this->crf_token = $this->csfrToken();
        $viewData["crf_token"] = $this->crf_token;
        $viewData["hasErrors"] = $this->hasErrors;
        $viewData["errors"] = $this->errors;

        $this->viewData = $viewData;
    }

    private function csfrToken()
    {
        $token = md5(uniqid(microtime(), true));
        $_SESSION["category_form_token"] = $token;
        return $token;
    }

    private function validateCsfrToken()
    {
        if (!isset($_POST["crf_token"])) {
            return false;
        }
        if ($_POST["crf_token"] !== $_SESSION["category_form_token"]) {
            return false;
        }
        return true;
    }

    public function run(): void
    {
        /*
            CargaInicial (GET)
                If Codigo > 0 then 
                    Buscar Categoria
                    Mostrar Datos
                Sino 
                    Mostrar Datos
            Postback (click a guardar)
                Obtener Datos del Formulario
                Validar Datos
                Si Datos Ok
                    Guardar Datos (INS, UPD, DEL)
                    Mostrar Mensaje
                    Redirigimos a la Lista
                Sino
                    Mostrar Mensaje de Error
                    Mostrar Datos
        */
        $this->cargar_datos();

        if ($this->isPostBack()) {
            $this->getPostData();
            if (!$this->hasErrors) {
                $this->processAction();
            }
        }

        $this->prepareViewData();
        Renderer::render("productos/categoryform", $this->viewData);
    }
}

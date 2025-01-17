<?php
namespace JAWA;


abstract class JAWAElementBuilder
{
    public static function buildFormElement($element, $name, $id = null, $class = null, $value = null, $additionalFields = '')
    {
        $details = '';
        $id = $id ? $id : $name;
        $details.= "id='{$id}' name='{$name}'";
        $details.= $class ? "class='{$class}' " : "";
        $details.= "value='{$value}'";
        $details.= $additionalFields;
        switch ($element){
            case "text":
                return "<input type='text' {$details}>";
                break;
            case "textarea":
                return "<textarea {$details}></textarea>";
                break;
            case "email":
                return "<input type='email' {$details}>";
                break;
            case "number":
                return "<input type='number' {$details}>";
                break;
            case "tel":
                return "<input type='tel' {$details}>";
                break;
            case "date":
                return "<input type='date' {$details}>";
                break;
            case "time":
                return "<input type='time' {$details}>";
                break;
            case "password":
                return "<input type='password' {$details}>";
                break;
            case "hidden":
                return "<input type='hidden' {$details}>";
                break;
            case "datetime-local":
                return "<input type='datetime-local' {$details}>";
                break;
            case "radio":
                return "<input type='radio' {$details}>";
                break;
            case "checkbox":
                return "<input type='checkbox' {$details}>";
                break;
            case "color":
                return "<input type='color' {$details}>";
                break;
            case "submit":
                return "<button type='submit'>{$name}</button>";
                break;
        }
    }

    public static function buildSelectBox($name, $options, $id = null, $class = null, $additionalFields = null)
    {
        $id = $id ? $id : $name;
        $string = "<select name='{$name}' id='{$id}'";
        $string.= $class ? " class='{$class}'" : '';
        $string.= $additionalFields ? " {$additionalFields}" : '';
        $string.= ">";
        foreach ($options as $key => $option){
            $string.= "<option value='{$key}'>{$option}</option>";
        }
        $string.= "</select>";
        return $string;
    }

    public static function buildModelForm(JAWAModel $model, $id = null)
    {
        $uri = explode("/", $_SERVER['REQUEST_URI'])[1];
        $string = "<form method='POST' action='/{$uri}/store'>";
        $formInputs = $model::columns();
        //return $formInputs;
        foreach ($formInputs as $name => $type) {
            if (strpos($type, "(")) {
                $type = substr_replace($type, '', strpos($type, "("));
            }
            $string.= "<label for='{$name}'>{$name}</label><br>";
            switch ($type){
                case "VARCHAR":
                case "CHAR":
                case "TINYTEXT":
                case "TEXT":
                case "BLOB":
                    $string.= self::buildFormElement("text", $name, $name).'<br>';
                    break;
                case "MEDIUMTEXT":
                case "LONGTEXT":
                case "MEDIUMBLOB":
                case "LONGBLOB":
                    $string.= self::buildFormElement("textarea", $name, $name).'<br>';
                    break;
                case "TINYINT":
                case "TINYINT":
                case "SMALLINT":
                case "MEDIUMINT":
                case "INT":
                case "BIGINT":
                case "DECIMAL":
                case "FLOAT":
                case "DOUBLE":
                    $string.= self::buildFormElement("number", $name, $name).'<br>';
                    break;
                case "BIT":
                case "BOOLEAN":
                    $string.= self::buildFormElement("radio", $name, $name."-Y");
                    $string.= self::buildFormElement("radio", $name, $name."-N").'<br>';
                    break;
                case "DATETIME":
                case "TIMESTAMP":
                    $string.= self::buildFormElement("datetime-local", $name, $name).'<br>';
                    break;
                case "DATE":
                    $string.= self::buildFormElement("date", $name, $name).'<br>';
                    break;
                case "TIME":
                    $string.= self::buildFormElement("time", $name, $name).'<br>';
                    break;
                case "ENUM":
                    //turn string: 'ENUM('value1', 'value2', 'value3') into an array: ['value1', 'value2', 'value3']
                    $values = explode(
                        ",",
                        str_replace(
                            ["'", "\"", ")", " ", "ENUM("],
                            "",
                            $model::columns()[$name]
                        )
                    ); //this chunk is unpleasant, please refactor

                    foreach ($values as $value){
                        $optionArray[$value] = $value;
                    }
                    $string.= self::buildSelectBox($name, $optionArray);
                    break;
            }
            $string.= "<br>";
        }
        $string.= self::buildFormElement("submit", "Submit");
        $string.= "</form><br>USE THIS AS A TEMPLATE FOR THE ACTUAL FORM";
        $string.= $id ? "<form method='post' action='/{$uri}/destroy/{$id}'>".self::buildFormElement("submit", "delete", null, null, "Delete")."</form>" : '';
        return $string;
    }
}
<?php
namespace JAWA;


abstract class JAWAElementBuilder
{
    public static function buildFormElement($element, $name, $id = null, $class = null, $value = null, $additionalFields = '')
    {
        $details = '';
        //id='{$id}' name='{$name}'
        if(!$id){
            $id = $name;
        }
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
                return "<input type='submit' {$details}>";
                break;
        }
    }

    public static function buildModelForm(JAWAModel $model)
    {
        $className = get_class($model);
        $string = "<form method='POST' action='{$className}'>";
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
            }
            $string.= "<br>";
        }
        $string.= self::buildFormElement("submit", "submit", null, null, "Submit");
        $string.= "</form>";
        return $string;
    }
}
<?php

namespace backend\models\validators;

use backend\models\Empresa;
use yii\validators\Validator;

class EmpresaPermitirCargaVentaParaleloValidator extends Validator
{
    /**
     * @param Empresa $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        if (class_exists('\backend\modules\contabilidad\MainModule')) {
            if ($model->permitir_carga_venta_paralelo == "")
                $model->addError($attribute, "No puede estar vacio");
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        $existe_contabilidad = class_exists('\backend\modules\contabilidad\MainModule');
        return <<<JS
        let existe_contabilidad = $existe_contabilidad;
if (existe_contabilidad && $("#empresa-$attribute").val() === "")
    messages.push(data.error);
JS;
    }

}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "estado_titulo".
 *
 * @property int $id
 * @property string $desc
 */
class EstadoTitulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_titulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'desc'], 'required'],
            [['id'], 'integer'],
            [['desc'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc' => 'Desc',
        ];
    }
}

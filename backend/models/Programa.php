<?php

namespace backend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "programa".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $desc
 *
 * @property ProgramaAsignatura[] $programaAsignaturas
 */
class Programa extends \yii\db\ActiveRecord
{
    public $asignaturas = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'desc', ], 'string'],
            [['asignaturas',],'safe'],
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
            'nombre' => 'Nombre',
            'desc' => 'Desc',
        ];
    }

    public function getAsignatura()
    {
        return $this->hasOne(Asignatura::class, ['id' => 'asignatura_id']);
    }

    /**
     * Gets query for [[Programa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrograma()
    {
        return $this->hasOne(Programa::class, ['id' => 'programa_id']);
    }
    
}

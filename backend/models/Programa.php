<?php

namespace backend\models;

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
            [['nombre', 'desc'], 'string'],
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

    /**
     * Gets query for [[ProgramaAsignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaAsignaturas()
    {
        return $this->hasMany(ProgramaAsignatura::class, ['programa_id' => 'id']);
    }
}

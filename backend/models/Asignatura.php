<?php

namespace backend\models;
use yii\helpers\ArrayHelper;


use Yii;

/**
 * This is the model class for table "asignatura".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $desc
 *
 * @property ProgramaAsignatura[] $programaAsignaturas
 */
class Asignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignatura';
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
        return $this->hasMany(ProgramaAsignatura::class, ['asignatura_id' => 'id']);
    }
    public static function getAsignaturas(){
        $active_query = Asignatura::find();
        return ArrayHelper::map($active_query->asArray()->all(), 'id', 'nombre');
    }
}

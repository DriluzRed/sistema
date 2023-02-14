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
            [['nombre', 'desc', 'asignaturas'], 'string'],
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
    // public function getProgramaAsignaturas()
    // {
    //     return $this->hasMany(ProgramaAsignatura::class, ['programa_id' => 'id']);
    // }
    public static function getProgramaLista(){
        $active_query = Programa::find();
        return ArrayHelper::map($active_query->asArray()->all(), 'id', 'nombre');
    }
    public function getAsignaturas(){
        $active_query = Asignatura::find();
        return ArrayHelper::map($active_query->asArray()->all(), 'id', 'nombre');
    }
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::class, ['id' => 'alumno_id'])
            ->viaTable('alumno_programa', ['programa_id' => 'id']);
    }
}

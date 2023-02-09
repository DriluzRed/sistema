<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumno_programa".
 *
 * @property int $id
 * @property int $alumno_id
 * @property int $programa_id
 * @property int $cohort
 * @property int $estado_programa_id
 * @property int $estado_titulo_id
 * @property string $resolution
 * @property string $resolution_date
 * @property string $promotion_year
 * @property string $seller
 * @property string $charge
 * @property Alumno $alumno
 * @property Programa $programa
 */
class AlumnoPrograma extends \yii\db\ActiveRecord
{
    // public $programas = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno_programa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cohort', 'estado_programa_id', 'estado_titulo_id', 'resolution', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'required'],
            [['id', 'cohort', 'estado_titulo_id'], 'integer'],
            [['resolution', 'estado_programa_id', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'string'],
            [['programa_id', 'alumno_id'], 'safe'],
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
            'alumno_id' => 'Alumno ID',
            'programa_id' => 'Programa ID',
            'cohort' => 'Cohort',
            'estado_programa_id' => 'Estado Programa ID',
            'estado_titulo_id' => 'Estado Titulo ID',
            'resolution' => 'Resolution',
            'resolution_date' => 'Resolution Date',
            'promotion_year' => 'Promotion Year',
            'seller' => 'Seller',
            'charge' => 'Charge',
        ];
    }
    public function getAlumno(){
        return $this->hasMany(Alumno::className(), ['id' => 'alumno_id']);
    }
    public function getPrograma(){
        return $this->hasMany(Programa::className(), ['id' => 'programas']);
    }
}

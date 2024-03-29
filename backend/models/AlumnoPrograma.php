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
            [['alumno_id'], 'required'],
            [['alumno_id', 'programa_id', 'cohort'], 'integer'],
            [['resolution', 'estado_programa_id', 'resolution_date', 'promotion_year', 'seller', 'charge', 'estado_titulo_id'], 'string'],
            [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['alumno_id' => 'id']],
            [['programa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programa::className(), 'targetAttribute' => ['programa_id' => 'id']],
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
            'programa_id' => 'Programa',
            'cohort' => 'Cohorte',
            'estado_programa_id' => 'Estado Programa',
            'estado_titulo_id' => 'Estado Titulo',
            'resolution' => 'Resolucion',
            'resolution_date' => 'Fecha de Resolucion',
            'promotion_year' => 'Año de Promocion',
            'seller' => 'Vendedor',
            'charge' => 'Cargo',
        ];
    }
    public function getAlumno()
    {
        return $this->hasOne(Alumno::class, ['id' => 'alumno_id']);
    }

    public function getPrograma()
    {
        return $this->hasOne(Programa::class, ['id' => 'programa_id']);
    }

    public function getEstadoPrograma()
    {
    return $this->hasOne(EstadoPrograma::class, ['id' => 'estado_programa_id']);
    }
    public function getEstadoTitulo()
    {
        return $this->hasOne(EstadoTitulo::class, ['id' => 'estado_titulo_id']);
    }
}
<?php

use common\helpers\PermisosHelpers;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;
use yiister\adminlte\widgets\Box;

/**
 * @var yii\web\View $this
 */
$this->title = 'Sistema Libro de Inscriptos y Matriculados';
?>


    <!-- <div class="panel">
        <i class="fa fa-bell">
            <bold>1</bold>
        </i>
        <div ng-app="app" ng-controller="coin">
            <p class="btc-price">{{priceGBP}}</p>
        </div>
    </div>
    -->
    
    <div class="all">
        <div class="starter-stats">
            <div class="contenedor">
            <div class="blok">
            <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Alumnos Inscriptos</p>
                    <p><?= $totalAlumnos ?></p>
                </div>
            </div>

            <div class="blok">
            <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Alumnos Graduados</p>
                    <p><?=$totalGraduados?></p>
                </div>
            </div>
            <div class="blok">
            <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Desmatriculados</p>
                    <p><?= $totalDesma ?></p>
                </div>
            </div>

            <div class="blok">
            <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Culminados</p>
                    <p><?= $totalCulminados ?></p>
                </div>
            </div>

            <div class="blok">
            <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Reinscriptos</p>
                    <p ><?= $totalInscriptos ?></p>
                </div>
            </div>
        </div>
        </div>
    </div>

    
   
<?php
$css = <<<CSS
@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700|Source+Sans+Pro:300,600");

.logo .logo {
	display: inline-block;
	color: #020202;
	font-size: 1.4em;
	font-weight: 700;
	font-family: "Source Sans Pro", sans-serif;
}
.contenedor{
    margin-top:5%;
    margin-left:10%;
   
    
   
}
.all .starter-stats .blok {
    
	background: #f1f5f9;
    border-radius: 30px;
    box-shadow: 5px 5px 5px #d7d8d9;
	float: left;
	margin-top: 50px;
    margin-left:30px;
    margin-right:30px;
	font-size: 25px;
	font-family: "Source Sans Pro", sans-serif;
	position: relative;
    width:25%;
    height:150px;
}

.blok i {
	border-radius: 50%;
	background-color: #1f396a;
	padding: 10px;

	color: white;
	display: inline-block;
	position: relative;
	top: -20px;
	margin-left: 20px;
	margin-right: 5px;
	font-size: 1.2em;
}

.blok .no {
	display: inline-block;
    margin-top:10px;
}

.blok .no p:first-child {
	font-weight: 700;
	font-size: 25px;
	position: relative;
	top: 8px;
}

.blok .no p:nth-child(2) {
	position: relative;
	top: -10px;
	font-size: 50px;
	font-weight: 700;
    margin-left:5px;
}

.gains {
	width: 80%;
	padding: 20px 8%;
	margin: 5px auto;
	background-color: yellow;
}



CSS;

$this->registerCss($css);

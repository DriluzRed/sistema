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
                    <p class="counter" data-target="<?= $totalAlumnos ?>"></p>
                </div>
            </div>

            <div class="blok">
                <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Alumnos Graduados</p>
                    <p class="counter" data-target="<?= $totalGraduados ?>"></p>
                </div>
            </div>
            <div class="blok">
                <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Desmatriculados</p>
                    <p class="counter" data-target="<?= $totalDesma ?>"></p>
                </div>
            </div>

            <div class="blok">
                <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Culminados</p>
                    <p class="counter" data-target="<?= $totalCulminados ?>"></p>
                </div>
            </div>

            <div class="blok">
                <i class="fa fa-tasks"></i>
                <div class="no">
                    <p>Reinscriptos</p>
                    <p class="counter" data-target="<?= $totalInscriptos ?>"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const counters = document.querySelectorAll(".counter");

    counters.forEach((counter) => {
        counter.innerText = "0";
        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            const increment = target / 500;
            if (count < target) {
                counter.innerText = `${Math.ceil(count + increment)}`;
                setTimeout(updateCounter, 1);
            } else counter.innerText = target;
        };
        updateCounter();
    });
</script>

<?php
$css = <<<CSS
@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700|Source+Sans+Pro:300,600");

body {
	font-family: "Lato", sans-serif;
}

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
	background: #d7d8d9 ;
	width: 30%;
	float: left;
	margin: 20px 1.5%;
	font-size: 1.1em;
	font-family: "Source Sans Pro", sans-serif;
	position: relative;
}

.blok i {
	border-radius: 50%;
	background-color: purple;
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
	font-size: 0.8em;
	position: relative;
	top: 8px;
}

.blok .no p:nth-child(2) {
	position: relative;
	top: -10px;
	font-size: 1.3em;
	font-weight: 700;
}

.gains {
	width: 80%;
	padding: 20px 8%;
	margin: 5px auto;
	background-color: yellow;
}



CSS;

$this->registerCss($css);

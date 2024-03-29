<?php

namespace Rmunate\BarraEntorno;

use Illuminate\Foundation\Application;

/**
 * Clase para Barra de Ambiente en Uso
 * --------------------------------------------
 * Desarrollado por: Raul Mauricio Uñate Castro
 * raulmauriciounate@gmail.com
 */

class EnvironmentBar {

    public static function bar (
        string $version = '1.0.0', 
        string $url_produccion = '#', 
        $empresa = "Altum Digital", 
        $rutaImagen = null
    ) {

        /* Imagen Barra */
        if (!empty($rutaImagen)) {
            $path = $rutaImagen;
            // Extensión de la imagen
            $type = pathinfo($path, PATHINFO_EXTENSION);
            // Cargando la imagen
            $data = file_get_contents($path);
            // Decodificando la imagen en base64
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            $logoBase64 = 'data:image/png;base64,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';
        }

        /* Version de PHP */
        $version_php = phpversion();

        /* Version de Laravel */
        $version_laravel = Application::VERSION;

        /* Protocolo */
        if (isset($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
            $url = strval($url);
            /* Protocolo */
            $protocolo = explode(':',$url)[0];
            $protocolo = strval($protocolo);
        } else {
            $protocolo = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'HTTP';
        }

        /*Version */
        $version = !empty($version) ? $version : '1.0.0';

        /* Url de Produccion */
        $url_produccion = !empty($url_produccion) ? $url_produccion : '#';

        /* Codigo HTML */
        $styles = "<style>

            /* Fuente */
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100;8..144,200;8..144,300;8..144,400;8..144,500;8..144,600;8..144,700;8..144,800;8..144,900;8..144,1000&display=swap');

            /* Estilos Globales de la Barra */
            .contenedor-env-bar {
                position: fixed;
                background-color: #F7F7F7;
                border-bottom: solid 2px #F08013;
                font-family: 'Roboto Flex', sans-serif !important;
                height: 28px !important;
                top: 0;
                left: 0;
                display: flex;
                z-index: 1000;
            }

            .ancho-borde-contenedor-env-bar{
                right: 0;
            }

            .ancho-force-ancho-borde-contenedor-env-bar {
                width: 40px;
            }

            /* Contenedor Logo */
            .contenedor-logo-env-bar {
                display: flex;
                cursor: pointer;
                align-items: center;
                padding-top: 4px;
                padding-bottom: 4px;
                padding-left: 8px;
            }

            /* Estilos del Logo */
            .logo-env-bar {
                max-width: 20px;
                margin: 0;
                padding: 0;
            }

            /* Separador */
            .separador-env-bar {
                margin-left: 10px;
                margin-right: 10px;
                border-left: solid 1px #cfcecd;
            }

            /* Contendor de los items */
            .contenedor-ver-env-bar {
                display: flex;
                align-items: center;
            }

            /* logo PHP */
            .logo-lenguaje-env-bar {
                margin-left: 5px;
                margin-right: 8px;
            }

            .logo-width-env-bar {
                width: 20px;
            }

            /* Nombre Lenguaje */
            .lenguaje-env-bar {
                font-size: 12px;
                font-weight: 900 !important;
                margin-right: 5px;
                color: #04488E;
            }

            /* Subtexto principal*/
            .version-env-bar {
                font-size: 12px;
                font-weight: 400 !important;
                margin-right: 5px;
            }

            /* Valor del subtexto*/
            .ambiente-env-bar{
                background-color: #f08013;
                border-radius: 5px;
                color: #FFFFFF;
                padding-right: 8px;
                padding-left: 8px;
                font-size: 90%;
                margin-left: 5px;
                margin-right: 5px;
            }

            .ambiente-env-bar:hover{
                background-color: #f79b3f;
                color: #FFFFFF;
                cursor: pointer;
            }

            .url-prod-env-bar{
                background-color: #04488e;
                border-radius: 5px;
                color: #FFFFFF;
                padding-right: 8px;
                padding-left: 8px;
                font-size: 90%;
                margin-left: 5px;
                margin-right: 5px;
            }

            .url-prod-env-bar:hover{
                background-color: #4380bd;
                border-radius: 5px;
                cursor: pointer;
            }

            .about-env-bar {
                background-color: #343435;
                border-radius: 5px;
                color: #FFFFFF;
                padding-right: 8px;
                padding-left: 8px;
                font-size: 90%;
                margin-left: 5px;
                margin-right: 5px;
            }

            .about-env-bar:hover{
                background-color: #575758;
                border-radius: 5px;
                cursor: pointer;
            }

            .items-env-bar-end {
                display: flex;
                right: 10px;
                top: 2px;
                position: fixed;
                margin: 0;
                padding: 0;
            }

            .tooltip-env-bar {
                position: relative;
                display: inline-block;
            }

            .tooltip-env-bar .tooltiptext-env-bar {
                position: fixed; /*Fijada*/
                visibility: hidden; /*Oculto por defecto*/
                width: 30%;/*Ancho Persistente*/
                top: 30px; /*Pegado a Arriba*/
                right: 4px; /*Pegado a la derecha*/
                font-size: 12px; /*Tamaño de Texto*/
                font-weight: 700;/*Ancho de Texto*/
                background-color: #FFFFFF; /*Color de Fondo*/
                border: solid 1px #f08013;/*Borde*/
                color: #000000;/*Color de Texto*/
                text-align: center;/*Centrado*/
                border-radius: 5px;/*Borde Redondeado*/
                padding: 5px 0;/*Margen Interno*/
                z-index: 1; /*Index*/
                margin-left: 0;/*Margen a la Izquierda*/
                opacity: 0.5;/*Opacidad*/
                transition: opacity 0.3s;/*Tiempo de la Trasicion*/
                font-family: 'Roboto Flex', sans-serif !important;
            }

            /*Mostrar Info Del Elemnto*/
            .tooltip-env-bar:hover .tooltiptext-env-bar {
                visibility: visible;
                opacity: 0.8;
            }

            .text-ambiente-env-bar {
                line-height: 1;
            }

            .img-toltip-env-bar {
                max-width: 100px;
            }

            .hidden-items-env-bar {
                visibility: hidden;
            }

        </style>";

        $body = '<div class="contenedor-env-bar ancho-borde-contenedor-env-bar" id="contenedor-env-bar">

            <div id="logo-env-bar" class="contenedor-logo-env-bar">
                <img  class="logo-env-bar" src="' . $logoBase64 .'" draggable="false" />
            </div>

            <div class="separador-env-bar"></div>

            <div class="contenedor-ver-env-bar">
                <span class="lenguaje-env-bar">' . $empresa .'</span>
            </div>

            <div class="separador-env-bar"></div>

            <div class="contenedor-ver-env-bar">
                <img draggable="false" class="logo-lenguaje-env-bar logo-width-env-bar" src="data:image/png;base64,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" />
                <span class="lenguaje-env-bar">PHP:</span>
                <span class="version-env-bar">v' . $version_php . '</span>
            </div>

            <div class="separador-env-bar"></div>

            <div class="contenedor-ver-env-bar">
                <img draggable="false" class="logo-lenguaje-env-bar logo-width-env-bar" src="data:image/png;base64,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" />
                <span class="lenguaje-env-bar">Laravel:</span>
                <span class="version-env-bar">v' . $version_laravel . '</span>
            </div>

            <div class="separador-env-bar"></div>

            <div class="contenedor-ver-env-bar">
                <img draggable="false" class="logo-lenguaje-env-bar logo-width-env-bar" src="data:image/png;base64,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" />
                <span class="lenguaje-env-bar">Protocolo:</span>
                <span class="version-env-bar">' . strtoupper($protocolo) . '</span>
            </div>

            <div class="separador-env-bar"></div>

            <div class="contenedor-ver-env-bar">
                <img draggable="false" class="logo-lenguaje-env-bar logo-width-env-bar" src="data:image/png;base64,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" />
                <span class="lenguaje-env-bar">Versión:</span>
                <span class="version-env-bar">v' . $version . '</span>
            </div>

            <div class="separador-env-bar"></div>

            <div class="items-env-bar-end">
                <div class="contenedor-ver-env-bar tooltip-env-bar">
                    <div class="ambiente-env-bar">
                        <span class="tooltiptext-env-bar">
                            <p class="text-ambiente-env-bar">Este es el ambiente sobre el cual se está ejecutando el Software, tenga presente que nuestros sistemas mostraran esta barra siempre que el ambiente en uso no sea el productivo.</p>
                        </span>
                        Ambiente De Desarrollo o QA
                    </div>
                </div>
                <div id="link-produccion" class="contenedor-ver-env-bar">
                    <div class="url-prod-env-bar tooltip-env-bar">
                        <span class="tooltiptext-env-bar">
                        <p class="text-ambiente-env-bar">Este link le llevara al ambiente productivo de este software.</p>
                        </span>
                        Ir al Ambiente Productivo
                    </div>
                </div>
                <div class="contenedor-ver-env-bar">
                    <div class="about-env-bar tooltip-env-bar">
                        <span class="tooltiptext-env-bar">
                            <p class="text-ambiente-env-bar">Este software es un desarrollo registrado de Altum Digital, desarrollamos Software a la medida.</p>
                            <img class="img-toltip-env-bar" src="data:image/png;base64,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" >
                        </span>
                        ?
                    </div>
                </div>
            </div>
        </div>';

        $script = "<script>

            /* Validar la Existencia de la Cookie */
            if(getCookie('environmentBarEnv')){
                /* Existe la Cookie - Ocultar*/
                changeEnvBar('hidden')
            } else {
                /* No Existe la Cookie - Mostrar */
                changeEnvBar('visible')
            }

            /* Leer Cookies */
            function getCookie(name){
                let cname = name+'=';
                let allCookies = document.cookie.split(';');
                for (let i = 0; i < allCookies.length; i++) {
                    let cookieI = allCookies[i].trim();
                    if (cookieI.indexOf(cname) === 0){
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            /* Determinar el comportamiento de acuerdo a la Cookie */
            function changeEnvBar(stEnvBar){

                /* Captura de Elmentos a Ocultar */
                const separadores = document.querySelectorAll('.separador-env-bar');
                const items = document.querySelectorAll('.contenedor-ver-env-bar');
                const botones = document.querySelectorAll('.items-env-bar-end');
                const body = document.getElementsByTagName('body');

                /* Definir nuevo estado del elemento */
                const visibility = (stEnvBar == 'hidden') ? 'hidden' : 'visible';

                /* Aplicar Estilos a los Separadores */
                separadores.forEach(separador => {
                    separador.style.visibility = visibility;
                });

                /* Aplicar Estilos a los Items */
                items.forEach((item, i) => {
                    item.style.visibility = visibility;
                });

                /* Aplicar Estilos a los Botones */
                botones.forEach(boton => {
                    boton.style.visibility = visibility;
                });

                /* Cambio Estado de la Barra */
                const contenedorBar = document.getElementById('contenedor-env-bar');
                if(visibility == 'visible') {
                    contenedorBar.classList.add('ancho-borde-contenedor-env-bar');
                    contenedorBar.classList.remove('ancho-force-ancho-borde-contenedor-env-bar')
                    body[0].style.marginTop = '28px';
                } else {
                    body[0].style.marginTop = '0px';
                    contenedorBar.classList.remove('ancho-borde-contenedor-env-bar');
                    contenedorBar.classList.add('ancho-force-ancho-borde-contenedor-env-bar')
                }
            }

            /* Ejecucion de Funciones Barra | Evento Click Sobre el Logo */
            const logoEnvBar = document.getElementById('logo-env-bar');
            logoEnvBar.addEventListener('click', function(){
                if(getCookie('environmentBarEnv')){
                    deleteCookie('environmentBarEnv')
                    changeEnvBar('visible');
                    location.reload();
                } else {
                    setCookie('environmentBarEnv')
                    changeEnvBar('hidden');
                    location.reload();
                }
            });

            /* MANEJO DE COOKIES */
            /* Crear Cookie */
            function setCookie(cname) {
                let timeCookie = new Date();
                timeCookie.setTime(timeCookie.getTime() + (1 * 24 * 60 * 60 * 1000));
                let expires = 'expires=' + timeCookie.toGMTString();
                document.cookie = cname + '=' + true + '; ' + expires;
            }

            function deleteCookie(cname) {
                document.cookie = cname + '=' + false + '; expires=Thu, 01-Jan-70 00:00:01 GMT;';
            }

            /* Accion Link de Produiccion */
            /* LINK DE PRODUCCIÓN */
            const linkEnvBar = document.getElementById('link-produccion');
            linkEnvBar.addEventListener('click', function(){
                window.location.href = '" . $url_produccion . "';
            });


        </script>";

        if (env('APP_DEBUG')) {
            return $styles.$body.$script;
        }

    }
}

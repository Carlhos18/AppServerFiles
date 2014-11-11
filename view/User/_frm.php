<?php echo $cabeza;?>
    <script type="text/javascript" src="<?php echo $url;?>web/js/evnt/usuario.js"></script>
    <script type="text/javascript">
       	<?php echo $grilla;?>
    </script>
    <script>
        $(function(){
            $("input[type=text]").addClass('campo_input');
        });
    </script>



    <div class="page-title">
        <ol class="breadcrumb">
            <li class="active page_title">
                <span class="title_icon">
                    <span class="user"></span>
                </span>
                <div class="Titulo">USUARIOS</div>          
            </li>
        </ol>

        <div class="div_container">
            <div id="state" ></div>
            <fieldset class="ui-widget-content ui-corner-all fieldset">
                <legend>Usuarios</legend>

                <table id="lsusuario"></table>
                <div id="pgusuario"></div>                    
            </fieldset>

            <fieldset class="ui-widget-content ui-corner-all fieldset">    
                <legend>Operaciones</legend>
                <a>
                    <button id="nuevo">Nuevo Usuario</button>
                </a>
                <a>
                    <button id="modificar">Modificar Usuario</button>
                </a>        
                <a>
                    <button id="eliminar">Anular Usuario</button>
                </a>

                <form id="form" method="post" style="display:none;" >
                    <fieldset class="ui-widget-content ui-corner-all">
                        <legend class="ui-widget-header ui-corner-all">[Datos]</legend>
                        <table border="0">
                           
                            <tr>
                                <td><label for="pf_id" class="required">Perfil</label></td>
                                <td><?php echo $perfil;?></td>
                            </tr>

                            <tr>
                                <td><label for="Tipo" class="required">Tipo</label></td>
                                <td>
                                    <select id="tipouser" name="tipouser" class="campo_input">
                                        <option value="">[SELECCIONE]</option>
                                        <option value="ALUMNO">ALUMNO</option>
                                        <option value="DOCENTE">DOCENTE</option>
                                    </select>

                                    <a>
                                        <button id="Search" class="search_botom">Buscar</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="usu_nombres" class="required">Nombres</label></td>
                                <td><input type='text' class="Input-KarEll" name='nombre_usuario' id='nombre_usuario' ></td>
                            </tr>
                            <tr>
                                <td><label for="usu_apellidos" class="required">Apellidos</label></td>
                                <td><input type='text' class="Input-KarEll" name='apellidos_usuario' id='apellidos_usuario' ></td>
                            </tr>

                            <tr>
                                <td><label for="Foto" class="required">Foto</label></td>
                                <td rowspan="3"><img src="web/image/anonimo.png" style="border:1px solid #dfdfdf;" width="100px" height="60px"></td>
                            </tr>

                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                            <tr>
                                <td><label for="usu_usuario" class="required">Usuario</label></td>
                                <td><input type="text" class="Input-KarEll" name="nick_usuario" class='texto' id="nick_usuario" /></td>
                            </tr>
                            <!--<tr>
                                <td><label for="usu_pass" class="required">Clave</label></td>
                                <td><input type='text' class="Input-KarEll" name='clave_usuario' id='clave_usuario'></td>
                            </tr>-->

                           
                        </table>
                        <span id="load"></span>
                        <input type="hidden" name="idusuario" id="idusuario" value="-1"/>
                    </fieldset>
                </form>
            </fieldset>
        </div>
    </div>
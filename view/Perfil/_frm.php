<?php echo $cabeza;?>
    <script type="text/javascript" src="<?php echo $url;?>web/js/evnt/perfil.js"></script>

    <script type="text/javascript">        
    	<?php echo $grilla;?>
    </script>

    <script>
        $(function(){
            $("input[type=text]").addClass('campo_input');
            $('#form').submit(function(){
                return false;
            });
        });
    </script>

    <div class="page-title">
        <ol class="breadcrumb">
            <li class="active page_title">
                <span class="title_icon">
                    <span class="perfil"></span>
                </span>
                <div class="Titulo">PERFIL</div>          
            </li>
        </ol>

        <div class="div_container">
            <div id="state"></div>
            <fieldset class='ui-widget-content ui-corner-all fieldset'>
                    <legend>Perfiles</legend>

                    <table id="lsperfil"></table>
                    <div id="pgperfil"></div>
                    
            </fieldset>

             <fieldset class="ui-widget-content ui-corner-all fieldset">
                
                    <legend>Operaciones</legend>
                    <a><button id="nuevo">Nuevo Perfil</button></a>
                    <a><button id="modificar">Modificar Perfil</button></a>
                    <a><button id="eliminar">Anular Perfil</button> </a>

              
                    <form id="form" method="post" style="display:none;" >
                        <fieldset class="ui-widget-content ui-corner-all">
                            <legend class="ui-widget-header ui-corner-all">[Datos]</legend>
                            <table>
                                <tr>
                                    <td><label for="perfil" >Perfil</label></td>
                                    <td><input class="Input-KarEll" type="text" name="perfil" id="perfil" /></td>
                                </tr>
                                
                            </table>
                            <span id="load"></span>
                            <input type="hidden" name="idperfil" id="idperfil" value="-1"/>
                        </fieldset>                    
                    </form>
            </fieldset>
        </div>
    </div>
    <?php echo $cabeza;?>
    <script type="text/javascript" src="<?php echo $url;?>web/js/evnt/modulos.js"></script>
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
                    <span class="modulos"></span>
                </span>
                <div class="Titulo">MODULOS</div>          
            </li>
        </ol>

        <div class="div_container">
            <div id="state" ></div>
            <fieldset class="ui-widget-content ui-corner-all fieldset  ">
                    <legend>Modulo</legend>

                    <table id="lsmodulos"></table>
                    <div id="pgmodulos"></div>
                    
            </fieldset>

            <fieldset class="ui-widget-content ui-corner-all fieldset">
            
                <legend>Operaciones</legend>
                <a>
                    <button id="nuevo">Nuevo Modulo</button>
                </a>
                <a>
                    <button id="modificar">Modificar Modulo</button>
                </a>        
                <a>
                    <button id="eliminar">Anular Modulo</button>
                </a>
          
                <form id="form" method="post" style="display:none;" >
                    <fieldset class="ui-widget-content ui-corner-all">
                        <legend class="ui-widget-header ui-corner-all">[Datos]</legend>
                        <table>
                            <tr>
                                <td><label for="" >Padre</label></td>
                                <td><?php echo $padre;?></td>
                            </tr>
                            <tr>
                                <td><label for="m_descripcion" class="required">Descripcion</label></td>
                                <td><input type='text' name='m_descripcion' id='m_descripcion' class="Input-KarEll"/></td>
                               
                            </tr>
                            <tr>
                                <td><label for="pf_descripcion" class="required">Url</label></td>
                                <td><input type='text' name='m_url' id='m_url' class="Input-KarEll"/></td>
                            </tr>
                            <tr>
                                <td><label for="m_orden" class="required">Orden</label></td>
                                <td><input type='text' name='m_orden' id='m_orden' class="Input-KarEll"/></td>
                            </tr>

                            <tr>
                                <td><label for="class_padre" >Clase</label></td>
                                <td><input type='text' name='class_padre' id='class_padre' class="Input-KarEll"/></td>
                            </tr>
                            
                        </table>
                        <span id="load"></span>
                        <input type="hidden" name="m_id" id="m_id" value="-1"/>
                    </fieldset>
                
                </form>
            </fieldset>
        </div>
    </div>
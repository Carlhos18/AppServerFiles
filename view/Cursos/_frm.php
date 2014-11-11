<?php echo $cabeza;?>
    <script type="text/javascript" src="<?php echo $url;?>web/js/evnt/cursos.js"></script>

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
                    <span class="curso"></span>
                </span>
                <div class="Titulo">CURSO</div>          
            </li>
        </ol>

        <div class="div_container">
            <div id="state"></div>
            <fieldset class='ui-widget-content ui-corner-all fieldset'>
                    <legend>Cursos</legend>

                    <table id="lscurso"></table>
                    <div id="pgcurso"></div>
                    
            </fieldset>

             <fieldset class="ui-widget-content ui-corner-all fieldset">
                    <legend>Operaciones</legend>
                    <!--<a><button id="nuevo" >Nuevo Curso</button></a>-->
                    <a><button id="modificar">Modificar Curso</button></a>
                    <a><div style="width:300px;"></div></a>

              
                    <form id="form" method="post" style="display:none;" >
                        <fieldset class="ui-widget-content ui-corner-all">
                            <legend class="ui-widget-header ui-corner-all">[Datos]</legend>
                            <table width="100%">
                                <tr>
                                    <td><label for="plancurricular" >Plan Curricular</label></td>
                                    <td colspan="3"><?php echo utf8_decode($Plancurricular); ?></td>
                                </tr>

                                <tr>
                                    <td><label for="Escuela" >Escuela</label></td>
                                    <td colspan="3"><?php echo utf8_decode($Escuela); ?></td>
                                </tr>

                                <tr>
                                    <td><label for="Facultad" >Facultad</label></td>
                                    <td colspan="3"><?php echo utf8_decode($Facultad); ?></td>
                                </tr>

                                <tr>
                                    <td><label for="Descripcion" >Descripcion</label></td>
                                    <td colspan="3"><textarea readonly="readonly" style="width:100%;height:40px;" class="campo_input" name="descripcioncurso" id="descripcioncurso"></textarea></td>
                                </tr>

                                <tr>
                                    <td><label for="Acronimo"  class="required">Acronimo</label></td>
                                    <td colspan="3"><input style="width:100%;"  type="text" name="acronimo" id="acronimo"></input></td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="Creditos">Creditos</label>
                                        <input style="width:50px;" type="text" readonly="readonly" name="creditos" id="creditos">
                                    </td>
                                    
                                    <td>
                                        <label for="TipoCurso">Tipo Curso</label>
                                        <input style="width:50px;" type="text" readonly="readonly" name="tipocurso" id="tipocurso">
                                    </td>

                                    <td>
                                        <label for="Ciclo">Ciclo</label>
                                        <input style="width:50px;" type="text" readonly="readonly" name="ciclo" id="ciclo">
                                    </td>

                                    <td>
                                        <label for="Codsira">Codigo Sira</label>
                                        <input style="width:50px;" type="text" readonly="readonly" name="codcursosira" id="codcursosira">
                                    </td>
                                </tr>

                                <!--<tr>
                                    <td>
                                        <label for="OrdenPlan">Orden Plan</label>
                                        <input style="width:50px;" type="text" name="ordensegunplan" id="ordensegunplan">
                                    </td>

                                    <td>
                                        <label for="requisitocreditos">Requisito Creditos</label>
                                        <input style="width:50px;" type="text" name="requisitocreditos" id="requisitocreditos">
                                    </td>

                                    <td>
                                        <label for="horasteoria">Horas Teoria</label>
                                        <input style="width:50px;" type="text" name="horasteoria" id="horasteoria">
                                    </td>

                                    <td>
                                        <label for="horaspractica">Horas Practica</label>
                                        <input style="width:50px;" type="text" name="horaspractica" id="horaspractica">
                                    </td>
                                </tr>-->
                                
                            </table>
                            <span id="load"></span>
                            <input type="hidden" name="codigocurso" id="codigocurso" />
                        </fieldset>                   
                    </form>
            </fieldset>
        </div>
    </div>
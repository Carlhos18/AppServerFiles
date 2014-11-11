<?php echo $cabeza;?>
    <script>
        $(function(){
            
            $("#list").jqGrid({
                url: 'index.php?controller=Auditoria&action=create_grid',
                datatype: "json",
                width:350,
                height: "auto",
                autowidth:true,
                colNames:['Usuario','User','Perfil'],
                colModel:[
                    {name:'usuario',index:'usuario', width:200},
                    {name:'nick_usuario',index:'nick_usuario', width:200},
                    {name:'perfil',index:'perfil', width:80, align:"left"}
                    ],
                caption: "Auditoria",
                viewrecords: true,
                altRows: false,
                rownumbers: true,
                sortname: 'idusuario',
                pager:'#pager',
                rowNum: 10,
                rowList:[10,15,20],
                subGrid: true,
                subGridOptions: {
                    "plusicon"  : "ui-icon-triangle-1-e",
                    "minusicon" : "ui-icon-triangle-1-s",
                    "openicon"  : "ui-icon-arrowreturn-1-e",
                    "reloadOnExpand" : false,
                    "selectOnExpand" : true
                },
                subGridRowExpanded: function(subgrid_id, row_id) {
                    var subgrid_table_id, pager_id;
                    subgrid_table_id = subgrid_id+"_t";
                    pager_id = "p_"+subgrid_table_id;
                    $("#"+subgrid_id).html("<table border='0' id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
					$("#"+subgrid_table_id).jqGrid({

						url: 'index.php?controller=Auditoria&action=view_subgrid&id='+row_id,
						datatype: "json",
						//caption: "Procesos Realizados",
						colNames: ['Action','Objeto','Nombre Objeto','Hora Accion','Direccion IP','Direccion Local'],
						colModel: [ {name:"accion_realizada",index:"accion_realizada",width:100},
									{name:"objeto",index:"objeto",width:120},
									{name:"nombre_objeto",index:"ruta",width:150,align:"right"},
									{name:"hora_accion",index:"hora_accion",width:160},
									{name:"direccion_ip",index:"direccion_ip",width:130,align:"center"},
									{name:"direccion_ip_local",index:"direccion_ip_local",width:150,align:"center"}
									], 
						rowNum:10,
						rowList:[10,15,20],
						width: '100%',
						height:'100%',
						viewrecords: true,
						sortname: 'hora_accion',
                        sortorder: "desc",
						pager: pager_id
					})/*.jqGrid("filterToolbar");*/
                }

            }).navGrid('#pager', { view: false, del: false, add: false, edit: false, search:false},
                {},//opciones edit
                {}, //opciones add
                {}, //opciones del
                {multipleSearch:false,closeAfterSearch: true, closeOnEscape: true}//opciones search
            ).jqGrid("filterToolbar");

            $("input[type=text]").addClass('campo_input');

        });


    </script>

    <fieldset class='ui-widget-content ui-corner-all fieldset'>
            <legend>Auditoria</legend>

            <table id='list'></table>
            <div id='pager'></div>
            
    </fieldset>
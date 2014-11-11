$(function () {
	$('#tree').jstree({
		'core' : {
			'data' : {
				'url' : 'index.php?controller=Gestiondocente&action=GetOperation&operation=get_node',
				'data' : function (node) {
					if (node.id=='#') {
						id=node.id;
					}else{
						id= Base64.decode(node.id);
					}								
					return { 'id' :id };
				}
			},
			'themes' : {
				'variant' : 'small',
				'stripes' : true,
				'responsive':false
			}
		},					
		'types' : {
			'default' : { 'icon' : 'folder' }
		},
		'plugins' : ['dnd','types','unique','wholerow','state']
		//'plugins' : ['dnd','types','unique','wholerow']
	})				
			.on('changed.jstree', function (e, data) {
				if(data && data.selected && data.selected.length) {
					$.get('index.php','controller=Gestiondocente&action=GetOperation&operation=get_content&id=' + Base64.decode(data.selected.join(':')), function (d) {
							//alert(d.content);
							$("#rename_button,#delete_button,#download_button").addClass('disabled');
							if (d.content == '/') {
								Load_tree('/','Gestiondocente');
								$('#ruta_auxiliar0').attr('value',d.content);
							}else{
								$('#ruta_auxiliar0').attr('value','/'+d.content);
								Load_tree(d.content,'Gestiondocente');
							}
							Load_Body(d.content,'Gestiondocente');

							$('#ruta_auxiliar').attr('value',d.content);
					});
				}else {

				}
			});
			
});
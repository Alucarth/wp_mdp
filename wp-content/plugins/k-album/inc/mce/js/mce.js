/* ----------------------------------------------------- */
/* This file for register button insert portfolio shortcode to TinyMCE
/* ----------------------------------------------------- */
(function() {
	tinymce.create('tinymce.plugins.k2t_pre_album_button', {
		init : function(ed, url) {
			title = 'k2t_pre_album_button';
			tinymce.plugins.k2t_pre_album_button.theurl = url;
			ed.addButton('k2t_pre_album_button', {
				title	:	'K Album shortcode',
				icon	:	' fa fa-image',
				type	:	'menubutton',
				/* List Button */
				menu: [
					/* --- Portfolio --- */   
					{	
						text: 'K Album',
						value: 'K Album',
						onclick: function() {
							ed.windowManager.open( {
								title: 'K Album',
								body: [
								{type	:	'textbox', name	:	'title', label					:	'Album title'},
								{type	:	'listbox', name	:	'filter', label					:	'Filter turn on', values: [{text: 'True', value: 'true'},{text: 'False', value: 'false'}], value: 'true'},				
								{type	:	'listbox', name	:	'filter_style', label			:	'Filter style', values: [{text: 'dropdown', value: 'dropdown'},{text: 'list', value: 'list'}], value: 'dropdown'},				
								{type	:	'textbox', name	:	'categories', label				:	'Categories of album'},
								{type	:	'textbox', name	:	'number', label					:	'Number of album'},
								{type	:	'listbox', name	:	'column', label					:	'Columns', values: [{text: '6 Columns', value: '6'},{text: '5 Columns', value: '5'},{text: '4 Columns', value: '4'},{text: '3 Columns', value: '3'},{text: '2 Columns', value: '2'}], value: '5'},
								
								],
								onsubmit: function( e ) {
									ed.insertContent( '[k2t-album title="'+ e.data.title +'" filter="'+ e.data.filter +'" filter_style="'+ e.data.filter_style +'" column="'+ e.data.column +'" categories="'+ e.data.categories +'" number="'+ e.data.number + '" /]');
								}
							});
						}
					},
				],
			});

		},
		createControl : function(n, cm) {
			return null;
		}
	});

	tinymce.PluginManager.add('k2t_pre_album_button', tinymce.plugins.k2t_pre_album_button);

})();
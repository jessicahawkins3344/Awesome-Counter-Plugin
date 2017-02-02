(function() {
   tinymce.create('tinymce.plugins.recentposts', {
      init : function(ed, url) {
         ed.addButton('recent_posts', {
            title : 'Recent posts',
            icon: false,
            onclick: function() {
                // Open a TinyMCE modal
                ed.windowManager.open({
                    title: 'Countimator',
                    body: [{
                        type: 'textbox',
                        name: 'icon',
                        label: 'Icon'
                    },{
                        type: 'textbox',
                        name: 'value',
                        label: 'Value of Counter'
                    },{
                        type: 'textbox',
                        name: 'title',
                        label: 'Title of Counter'
                    },{
                        type: 'textbox',
                        name: 'icon_size',
                        label: 'Icon_size - 20px, 2em etc.'
                    },{
                        type: 'textbox',
                        name: 'value_size',
                        label: 'Value Size'
                    },{
                        type: 'textbox',
                        name: 'title_size',
                        label: 'Title Size - 20px, 2em etc.'
                    },{
                        type: 'colorpicker',
                        name: 'value_color',
                        label: 'Value Color'
                    }],
                    onsubmit: function( e ) {
                        ed.insertContent( '[counter value="' + e.data.value + '" value_size="' + e.data.value_size+ '" value_color="' + e.data.value_color + '"]' );
                    }
                });
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      }
   });
   tinymce.PluginManager.add('recentposts', tinymce.plugins.recentposts);
})();
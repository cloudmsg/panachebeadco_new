// JavaScript Document

document.observe("dom:loaded", function() {
	
		var group = ['image','file'];
		
		Event.observe( $("venustheme_gallery_venustheme_gallery_source"),'change', function(){
			_update( this.value );																	
		} );
			 $$("#venustheme_gallery_venustheme_gallery_source option").each( function(item){
				group.push(item.value)	;		
			} );
		  $$("#venustheme_gallery_venustheme_gallery_source option").each( function(item){
			if( item.selected ){
				_update( item.value);
			}
			
		} );
		function _update( groupShow ){
			group.each( function(item){
					var groupName = 'venustheme_gallery_'+item+'_source_setting';
					var groupHeader = 'venustheme_gallery_'+item+'_source_setting-head';
					if( item==groupShow ){
						$(groupHeader).up('div.entry-edit-head').show();
						$(groupName).show();
						$(groupName+"-state").value = 1;
					} else {
						$(groupName+"-state").value = 0;
						$(groupHeader).up('div.entry-edit-head').hide();
						$(groupName).hide();
					}
			} );
		}
 
}); 
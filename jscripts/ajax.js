function ajax(file){

   this.ajaxObject = null;

   this.createAjax = function(){
	  try {
	  	this.ajaxObject = new XMLHttpRequest();
	  } catch (microsoft) {
	  	try {
			this.ajaxObject = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (othermicrosoft) {
	  		try {
				this.ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
		  	} catch (failed) {
				this.ajaxObject = false;
			}  
		 }
	   }
   };
   
   this.onload = function( object ){
	this.zml = object.responseText;
   };

   this.onloading = function( ){
   };
	
   this.openConnection = function( url, method ){
      var self = this;
      this.ajaxObject.onreadystatechange = function(){
	if( self.ajaxObject.readyState==1 ){
	    self.onloading();
         	 }
	if( self.ajaxObject.readyState==2 ){
	    self.onloading();
         	 }
	if( self.ajaxObject.readyState==3 ){
	    self.onloading();
         	 }
	 if( self.ajaxObject.readyState==4 ){
	    self.onload( self.ajaxObject );
         	 }
      };
      this.ajaxObject.open( method, url );
      this.ajaxObject.send(null);
   };
   
  this.createAjax();
}


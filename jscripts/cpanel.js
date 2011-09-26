var div1 = null, isloading = false;

/* highlighting rows */
function hl(r) {
  r.style.backgroundColor = '#ffffdd';
};

function uhl(r) {
  r.style.backgroundColor = '';
};

/* javascript "click" */
function go(u) {
  window.location=u; return false;
};

/* un-hide, hide */
function uh(id) {
  document.getElementById(id).style.display = "";
};

function h(id) { 
  document.getElementById(id).style.display = "none";
};

/* popups */
/* src is an element with an href attribute */
function email_popup(src) {
  var url = src.getAttribute('href');
  var target = '_blank';
  var features = 'location=0, statusbar=0, menubar=0, width=475, height=375';
  var win = window.open(url, target, features);
  win.focus();
  return win;
};

/* show item */
function showItem(item)	{
  document.getElementById(item).style.display='block';
};

/* hide item */
function hideItem(item) {
  document.getElementById(item).style.display='none';
};

/* toggle items */
function toggleItem(item) {
  if ((document.getElementById(item).style.display=='none') ||
      (document.getElementById(item).style.display=='')) {
    document.getElementById(item).style.display='block';
  } else {
    document.getElementById(item).style.display='none';
  }
};

/*switch items */
var currentItem="item1";

function switchItem(which) {
  switchItem2(currentItem, which);
  currentItem=which;
};

/* hide one item, show another */
function switchItem2(toHide,toShow) {
  hideItem(toHide);
  showItem(toShow);
};

/* event listener to close service dropdown */
document.onclick=function(event){
  if(document.getElementById('servicelist').style.display=="block"){
    hideItem('servicelist');
  }
};

/*disable an object*/
function disAble(item){
  document.getElementById(item).disabled=true;
};

/*enable an object*/
function enAble(item){
  document.getElementById(item).disabled=false;
};

/* toggle activate form element */
function toggleActivate(item){
  if (document.getElementById(item).disabled==true){
    document.getElementById(item).disabled=false;
  } else {
    document.getElementById(item).disabled=true;
  }
};

/* check a form element*/
function checkItem(item) {
  document.getElementById(item).checked=true;
};

/* uncheck a form element*/
function uncheckItem(item) {
  document.getElementById(item).checked=false;
};


/* select a radio button */
function selectRadioButton(formId, groupId, value) {
  var group = document.forms[formId][groupId];
  for (var i=0; i<group.length; i++) {
    if (group[i].value == value) {
      group[i].checked=true;
      return;
    }
  }
};

/* highlights a row if selected by a checkbox; if there is an existing
 * class set on the row (which may be setting a color manually) leave
 * the row alone.
 */
function hiLite(elem){
  if (!elem.parentNode.parentNode.className) {
    if (elem.checked==true){
      elem.parentNode.parentNode.style.background='#ffffcc';
    } else {
      elem.parentNode.parentNode.style.background='none';
    }
  }
};


/*for verify domain ownership page script*/
function contractall() {
  h("htmlverification");
  h("cnameverification");
  document.getElementById('verify').disabled = 'disabled';
};

function expandone() {
  var selectedItem =
      document.getElementById('settings')["verMethod"].value;
  contractall();
  if (document.getElementById(selectedItem)) {
    document.getElementById(selectedItem).style.display="block";
    document.getElementById('verify').removeAttribute('disabled');
    document.getElementById('verify').name=selectedItem;
  }
};

	
function expandone2() {
  if (document.getElementById) {
    var selectedItem =
        document.getElementById('settings')["verMethod2"].value;
    contractall();
    if (document.getElementById(selectedItem)) {
      document.getElementById(selectedItem).style.display="block";
      document.getElementById('verify2').removeAttribute('disabled');
    }
  }
};

/* Namespacing / Obj to attach functions to. */
var cbTbl = {};

/* Enable or disable the "Delete users" buttons after checkbox click */
function updateDeleteButtons(cb) {
  if (cbTbl.numberChecked(cb) == 0) {
    disAble('deleteT');
    disAble('deleteB');
  } else {
    enAble('deleteT');
    enAble('deleteB');
  }
}

/* Focus on an element */
function f(id) {
    document.getElementById(id).focus();
};

/* Delete, Suspend, Change name */
var dv = false;
var sv = false;

function d() { 
  h('sd'); 
  sv=false; 
  if (dv) {
    h('dd'); 
  } else {
    uh('dd'); 
  }
  dv = !dv;
};

function s() { 
  h('dd'); 
  dv=false; 
  if (sv) {
    h('sd');
  } else {
    uh('sd');
  }
  sv = !sv;
};

function cn() {
  if (dv) {
    dv=false; h('dd')
  }
  if (sv) {
    sv=false; h('sd')
  }
  h('displayName'); 
  uh('editName');
  h('changeNameLink'); 
  uh('changeName');
};

/* control over which elements have been touched */
var __tch = new Array();
var __touched = false;

function tch(id) {
  if (__tch[id]) __tch[id] = false;
  else __tch[id] = true;
    
  /* update touched */
  __touched = false;
  for(var i=0; i<__tch.length; i++) {
    if (__tch[i]) {
      __touched = true;
      break;
    }
  }
  // - update state of 'Save' button here based on __touched
};

/* Password Edit scripts */
/* Following value should be set when we have a 
   temporary password. */
var __temp_pass = true;
var __require_pass_change = true;

function editPass(setKey) {
  startEditOp('passEdit','passView',setKey);
  __require_pass_change = false;
  if (__temp_pass && document.c.requirePasswordChange.checked) {
    document.c.requirePasswordChange.click();
  }
};

function viewPass(setKey) {
  if (__temp_pass && !document.c.requirePasswordChange.checked) {
    document.c.requirePasswordChange.click();
  }
  __require_pass_change = __temp_pass;
  cancelEditOp('passEdit','passView',setKey);
};


//  CheckboxTable
//  
//  Code to handle (de)selecting checkboxes in a table alongwith
//  'select-all' functionality.
/* Copied, and slightly modified, from ... 
   Returns an array of Nodes under root for which the
   'filter' function p returns true. */
cbTbl.findNodes = function(root, p) {
  var rv = [];
  cbTbl.findNodes_(root, p, rv, false);
  return rv;
};

/* Copied, and slightly modified, from ... 
   Recursive helper for findNodes(). */
cbTbl.findNodes_ = function(root, p, rv, findOne) {
  if (root != null) {
    for (var i = 0; i < root.childNodes.length; i++) {
      var child = root.childNodes[i];
      if (child && p(child)) {
        rv.push(child);
        if (findOne) {
          return;
        }
      }
      cbTbl.findNodes_(child, p, rv, findOne);
    }
  }
};


/* The 'highlight' function that is our checkbox-click-handler. */
cbTbl.highlight = hiLite;

/* Returns whether the given node is a checkbox. */
cbTbl.isNodeACheckbox = function(node) {
  return node.nodeName.toLowerCase() == 'input' && 
         node.type.toLowerCase() == 'checkbox';
};

/* Climbs the dom to find a containing table, and returns this table node */
cbTbl.findContainingTable = function(node) {
  var tbl = node;
  while (tbl && tbl.nodeName.toLowerCase() != 'table') {
    tbl = tbl.parentNode;
  }  
  return tbl;
};

/* (De)Selects a single checkbox and updates the status of the
   'Select All' checkbox appropriately. */
cbTbl.selectOne = function(cb) {
  cbTbl.highlight(cb);  
  // Update status of 'Select All' checkbox appropriately.
  // The first ('Select All') cb should be selected IFF all the 
  // rest are checked,
  var tbl = cbTbl.findContainingTable(cb);
  var cbs = cbTbl.findNodes(tbl, cbTbl.isNodeACheckbox);
  var nChecked = 0;
  // Node: starting loop at 1 here cuz the 1st cb is 'Select All'.
  for (var i = 1; i < cbs.length; i++) {
    if (cbs[i].checked) {
      nChecked++;
    }
  }
  cbs[0].checked = (nChecked == (cbs.length - 1));
  cbTbl.highlight(cbs[0]);
};

/* (De)Selects all checkboxes in the containing table. */
cbTbl.selectAll = function(cb) {
  var tbl = cbTbl.findContainingTable(cb);
  var cbs = cbTbl.findNodes(tbl, cbTbl.isNodeACheckbox);
  // Set them all to the same state as 'cb'.
  // Note: starting loop at 0 here cuz the 1st cb is the 'Select All' 
  // which is the input arg to this method.
  for (var i = 1; i < cbs.length; i++) {
    if( !cbs[i].disabled ){
     cbs[i].checked = cb.checked;
     cbTbl.highlight(cbs[i]);
    }
  }
};

/* Determines the number of checkboxs currently selected. */
cbTbl.numberChecked = function(cb) {
  var tbl = cbTbl.findContainingTable(cb);
  var cbs = cbTbl.findNodes(tbl, cbTbl.isNodeACheckbox);
  var nChecked = 0;
  // Node: starting loop at 1 here cuz the 1st cb is 'Select All'.
  for (var i = 1; i < cbs.length; i++) {
    if (cbs[i].checked) {
      nChecked++;
    }
  }
  return nChecked;
};

var isset_map = {};
var required_setids;
var save_button;
function set_isset(val,opt_setid) {
  if (opt_setid) {
    isset_map[opt_setid] = val;
    var setelem = document.getElementById(opt_setid);
    if (setelem) {
      setelem.value = val;
    }
  }
  if (save_button) {
    save_button.disabled = !test_values_set(required_setids);
  }
};

function enable_isset_monitoring(msg,opt_savebtnid,opt_reqsetids) {
  window.onbeforeunload = function(oEvent) {
    if (!oEvent) {
      oEvent = window.event; // IE
    }
    if (msg && test_values_set()) {
      oEvent.returnValue = msg;
    }
  };
  if (opt_savebtnid) {
    save_button = document.getElementById(opt_savebtnid);
    if (save_button) {
      save_button.disabled = !test_values_set(opt_reqsetids);
    }
  }
  required_setids = opt_reqsetids;
};

function clear_isset_monitoring() {
  window.onbeforeunload = null;
};

function test_values_set(opt_setids) {
  // if opt_setids provided, then test to ensure all the setids
  // in that list are set
  if (opt_setids) {
    for (var i = 0; i < opt_setids.length; ++i) {
      if (!isset_map[opt_setids[i]]) {
        return false;
      }
    }
    return true;
  }

  // otherwise, return true if *any* value is set
  for (var setval in isset_map) {
    if (isset_map[setval]) {
      return true;
    }
  }
  return false;
};

/**
 * Starts an edit operation, opening up editItem and closing dispItem.
 * Optionally sets opt_setid elem to true
 */
function startEditOp(editItem,dispItem,opt_setid) {
  switchItem2(dispItem,editItem);
  set_isset(true,opt_setid);
};

/**
 * Cancels an edit operation, blanking out all input values found
 * in editItem, then switching its display w/ dispItem.
 * Uses cbTbl for traversing the DOM
 * @param editItem (String) ID of an elem containing edit fields
 * @param dispItem (String) ID of an elem displaying content
 * @param opt_setid ID of hidden elem indicating field is "set"/opened
 */
function cancelEditOp(editItem,dispItem,opt_setid) {
  switchItem2(editItem,dispItem);
  var editwrapper = document.getElementById(editItem);
  var inputElems = cbTbl.findNodes(editwrapper,
      function(node) {
        return node.nodeName.toLowerCase() == 'input' &&
               (!node.type || node.type.toLowerCase() != 'hidden') &&
               node.value;
      });
  for (var i = 0; i < inputElems.length; ++i) {
    var inputElem = inputElems[i];
    var newVal = '';
    if (inputElem.id) {
      var origElem = document.getElementById(inputElem.id + '.orig');
      newVal = (origElem && origElem.value) ? origElem.value : newVal;
    }
    inputElems[i].value = newVal;
  }
  set_isset(false,opt_setid);
};

/**
 * Sets a "watch" on a form input element which detects whether the value
 * repesented by the element has changed. If yes, isset for that element
 * will be set to true, otherwise false. If isset monitoring is enabled
 * for the page, then a save button may turn on/off and/or navigating
 * away from the page may trigger a warning.
 * @param inelemid (String) ID of DOM element that must be of type <input>
 *                 whose value is monitored
 * @param opt_setid (String) ID of a (likely hidden) isset element for
 *                  the field. Optional, but required for per-field monitoring
 * @param opt_initval (Object) Default 'start' value of the element - 
 *                     overrides whatever value it actually has (useful for
 *                     handling error forms)
 */
var watchListValues = {}; // id->original value for watched elements
function watchInputElement(inelemid,opt_setid,opt_initval) {
  var inelem = document.getElementById(inelemid);
  if (!inelem) {
    return;
  }
  var nnlower = inelem.nodeName.toLowerCase();
  if (nnlower != 'input' &&
      nnlower != 'textarea' &&
      nnlower != 'select' ||
      inelem.name == '') {
    // inelem must be specified, type input, and have a name specified
    return;
  }

  var hasinit = (typeof opt_initval != "undefined");
  var intype = nnlower == 'input' ? inelem.type.toLowerCase() : nnlower;
  var listenEvent = null;
  var listenerFn = null;
  if (intype == 'textarea' || intype == 'text' ||
      intype == 'file' || intype == 'password') {
    watchListValues[inelem.id] = hasinit ? opt_initval : inelem.value;
    listenEvent = 'keyup';
    listenerFn = function() {
      set_isset(watchListValues[inelem.id] != inelem.value, opt_setid);
    };
  } else if (intype == 'radio' || intype == 'checkbox') {
    watchListValues[inelem.id] = hasinit ? opt_initval : inelem.checked;
    listenEvent = 'click';
    listenerFn = function() {
      set_isset(watchListValues[inelem.id] != inelem.checked, opt_setid);
    };
  } else if (intype == 'select') {
    watchListValues[inelem.id] = hasinit ? opt_initval : inelem.selectedIndex;
    listenEvent = 'change';
    listenerFn = function() {
      set_isset(watchListValues[inelem.id] != inelem.selectedIndex, opt_setid);
    };
  }

  // attach as a listener to the element, possibly augmenting
  // the current listener
  var curListener = inelem['on' + listenEvent];
  inelem['on' + listenEvent] = function() {
    if (curListener) {
      curListener();
    }
    listenerFn();
  };

  if (hasinit) {
    // set isset values for forced initvals
    listenerFn();
  };
};

function setDataFromPage( page, id ){
	var obj = document.getElementById( id );
	var Ajax = new ajax();
	loading();
	Ajax.onload = function( object ){
		closeMessage();
		var text = object.responseText;
		obj.innerHTML =  text;
	}
	Ajax.openConnection( page + "&num="+Math.floor(Math.random()*11), "GET" );
}

String.prototype.trim = function() { return this.replace(/^\s+|\s+$/, ''); };


function execResponse( page, idx ){
	var Ajax = new ajax();
	Ajax.onloading = function(){
		if( !isloading )
			loading();
	}
	Ajax.onload = function( object ){
		var texto = object.responseText.trim();
		texto = texto.split( "|" );
		var obj = document.getElementById("ARTICLE_COLLECTION_SELECTION_" + idx );
		obj.parentNode.removeChild(obj);
		closeMessage();
	}
	Ajax.openConnection( page, "GET" );
}

function getResponse( page, idx ){
	var Ajax = new ajax();
	loading();
	Ajax.onload = function( object ){
		var texto = object.responseText.trim();
		if( texto == "1" ){
			var obj = document.getElementById("ARTICLE_COLLECTION_SELECTION_" + idx );
			obj.parentNode.removeChild(obj);
		}
		closeMessage();
	}
	Ajax.openConnection( page, "GET" );
}


function buyArticle( name, page ){
	if( confirm( "Deseas agregar a tu cotizacion el articulo " + name + "?" ) )
		setDataFromPage( page, "status" );
}

function deleteArticle( theForm, page ){
	if( confirm( "Deseas eliminar los articulos seleccionados?" ) )
	{
		for (i=0,n=theForm.elements.length;i<n;i++)
		        if (theForm.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && theForm.elements[i].checked == true){
				name = theForm.elements[i].name;
				id = name.substring( name.lastIndexOf( "_" )+1, name.lastIndexOf( "." ) );
				ids = name.substring( name.lastIndexOf( "." )+1 );
				execResponse( page + "?id=" + ids + "&idx=" + id, id );
			}
	}
	return false;
	
}

function deleteArticleAdmin( theForm, page ){
	if( confirm( "Deseas eliminar los articulos seleccionados?" ) )
	{
		for (i=0,n=theForm.elements.length;i<n;i++)
		        if (theForm.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && theForm.elements[i].checked == true){
				name = theForm.elements[i].name;
				id = name.substring( name.lastIndexOf( "_" )+1, name.lastIndexOf( "." ) );
				ids = name.substring( name.lastIndexOf( "." )+1 );
				getResponse( page + "?id=" + ids, id );
			}
	}
	return false;
	
}

function deleteCategory( theForm, page ){
	if( confirm( "Deseas eliminar las categorias seleccionadas?" ) )
	{
		for (i=0,n=theForm.elements.length;i<n;i++)
		        if (theForm.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && theForm.elements[i].checked == true){
				name = theForm.elements[i].name;
				id = name.substring( name.lastIndexOf( "_" )+1, name.lastIndexOf( "." ) );
				ids = name.substring( name.lastIndexOf( "." )+1 );
				getResponse( page + "?id=" + ids, id );
			}
	}
	return false;
	
}

function deleteSale( theForm, page ){
	if( confirm( "Deseas eliminar las ventas seleccionadas?" ) )
	{
		for (i=0,n=theForm.elements.length;i<n;i++)
		        if (theForm.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && theForm.elements[i].checked == true){
				name = theForm.elements[i].name;
				id = name.substring( name.lastIndexOf( "_" )+1, name.lastIndexOf( "." ) );
				ids = name.substring( name.lastIndexOf( "." )+1 );
				getResponse( page + "&sale=" + ids, id );
			}
	}
	return false;
	
}

function deleteUser( theForm, page ){
	if( confirm( "Deseas eliminar los usuarios seleccionados?" ) )
	{
		for (i=0,n=theForm.elements.length;i<n;i++)
		        if (theForm.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && theForm.elements[i].checked == true){
				name = theForm.elements[i].name;
				id = name.substring( name.lastIndexOf( "_" )+1, name.lastIndexOf( "." ) );
				ids = name.substring( name.lastIndexOf( "." )+1 );
				getResponse( page + "?user=" + ids, id );
			}
	}
	return false;
	
}

function validatePass( id1, id2 ){
	var i1 = document.getElementById( id1 );
	var i2 = document.getElementById( id2 );
	if( i1.value == i2.value && i1.value.trim()!="" && i2.value.trim()!="" ){
		return true;
	}else{
		alert( "Error: Los 2 campos de password no coinciden." );
		return false;
	}
}

function validatePass1( id1, id2 ){
	if(validatePass( id1, id2 ))
		alert( "Felicidades los 2 campos coinciden" );
}

// Mensaje cargando para cada acccion
function loading(){
	div1 = document.createElement( "div" );
	div1.style.position="absolute";
	div1.style.top="-5px";
	div1.style.left=(getBrowserSize()[0]/2-200)+ "px";
	div1.style.align="center";
	document.body.appendChild (div1);
	var loader = "<div align='center' class='msg'><div class='bl3l'><div class='br'><div class='tl'><div class='tr2'>";
	loader +="<img src='./images/loading.gif'> Procesando...";
	loader +="</div></div></div></div></div>";
	div1.innerHTML = loader;
	isloading = true;
}

function closeMessage()
{	
	try{
		div1.parentNode.removeChild(div1);
	}catch(e){}
	isloading=false;
}

function getBrowserSize(){
    	var bodyWidth = document.documentElement.clientWidth;
    	var bodyHeight = document.documentElement.clientHeight;
    	
		var bodyWidth, bodyHeight; 
		if (self.innerHeight){ // all except Explorer 
		 
		   bodyWidth = self.innerWidth; 
		   bodyHeight = self.innerHeight; 
		}  else if (document.documentElement && document.documentElement.clientHeight) {
		   // Explorer 6 Strict Mode 		 
		   bodyWidth = document.documentElement.clientWidth; 
		   bodyHeight = document.documentElement.clientHeight; 
		} else if (document.body) {// other Explorers 		 
		   bodyWidth = document.body.clientWidth; 
		   bodyHeight = document.body.clientHeight; 
		} 
		return [bodyWidth,bodyHeight];		
		
	}
	
	function goto(url){
    document.location=url;
	}
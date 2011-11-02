//Editor code by khoa ;))

//var editor = null;
//var idTextArea = null;
var flag = null;
var isEmo = "idbtnEmoticon";
var iscolor = "idbtnFontColor";
var isbg = "idbtnBackColor";
var http = null;
function getData(id,idTextArea){
	document.getElementById(id).value = document.getElementById(idTextArea).contentWindow.document.body.innerHTML;
}

function Editor(_instance,_id,data,_contain,_width,_height,_content){	
	this.editor=null;
	this.idTextArea = _id;
	this.is = _instance;
	this.contain = _contain;
	this.content = _content;
	this.width = _width;
	this.height = _height;
	this.baseURL = document.getElementsByTagName('base')[0].href;
	//onclick="'+this.is+'.doFormat(\'bold\');"
	this.render=function(){
		var se = '<iframe id="'+this.idTextArea+'" style="width:'+this.width+'px;height:'+this.height+'px;overflow:auto;"></iframe><input type="hidden" name="'+data+'" id="'+data+'">';	
		var s = '<table>';
		s+='<tr height="20">';
		s+='<td>';		
		for(var i=0;i<this.button.length;i++){
			s+='<span id="'+this.button[i][0]+'" style="position:relative;"></span><img id="'+this.button[i][1]+'" src="'+this.button[i][3]+'" title="'+this.button[i][2]+'" onclick="'+this.button[i][4]+'" onmouseover="'+this.button[i][5]+'" onmouseout="'+this.button[i][6]+'" />';
		}
		s+='</td>';
		s+='</tr>';
		s+='<tr><td align="center">'+se+'</td></tr>';
		s+='</table>';
		document.getElementById(this.contain).innerHTML=s;		
		this.editor=document.getElementById(this.idTextArea).contentWindow.document;
		this.editor.designMode='on';
		this.editor.open();
		this.editor.write('<html><head><base href='+ this.baseURL +'></head><body>'+this.content+'</body></html>');
		this.editor.close();
	};
	
	this.setActionButton=function(_id,_func,_event){
		var el = document.getElementById(_id);
		if(el.addEventListener){
		  el.addEventListener(_event, new Function(_func), false); 
		} 
		else if (el.attachEvent){
		  el.attachEvent('on'+_event, new Function(_func));   
		}
	};
	
	this.doFormat=function(a,b){		
		//if(document.getElementById(editor)!=null){
		if(this.editor.queryCommandEnabled(a)){
			if(!b){b=null;}
			this.editor.execCommand(a,false,b);
			 
			document.getElementById(this.idTextArea).focus();
		  }
		//}
	};
	
	this.addLink=function(){
		var aLink=prompt('Enter or paste a link :', '');
		if(aLink){
			this.doFormat('CreateLink',  aLink);
		}	
	};
	
	this.unFormat=function(){
		this.doFormat('removeformat');
		this.doFormat('unlink');	
	};
	
	this.insertImage=function(){
		var s = '';
		var range = document.createElement('div');
		with(range.style){
			position='absolute';
			top='10px';
			left='-50px';
			zindex='1000';
			border='1px solid gray';
			background='white';
			width='900px';
			height='650px';	
		}
		range.id='divcenter';
		var s='';
		s+='<fieldset><legend>File Browser</legend><div class="title"><span>Files</span></div><div class="titleimage"><span>Image</span></div><div class="titledetail"><span>Details</span></div><div class="cls"></div><div class="files" id="files"></div><div class="showimage" id="showimage"></div><div class="details" id="details"></div></fieldset<fieldset><legend>Properties</legend><table><tr><td><label>Image URL<label></td><td><input type="text" id="tbximageurl" name="tbximageurl" width="25" /></td></tr><tr><td><label>Decription</label></td><td><input type="text" name="tbxdecription" id="tbxdecription" width="25" /></td></tr><tr><td><label>Dimensions</label></td><td><input type="text" id="tbxwidth" name="tbxwidth" width="10" /> x <input type="text" name="tbxheight" id="tbxheight" width="10" >  <input type="checkbox" name="chbxpro" id="chbxpro" checked>Proportional</td></tr><tr><td><label>Align</label></td><td><select name="cbxalign" id="cbxalign"><option value="">Not set</option><option value="left">Left</option><option value="center">Center</option><option value="right">Right</option></select></td></tr></table></fieldset><div class="cls"></div><div id="idnoteupload"></div><fieldset class="upload"><legend>Upload</legend><form action="upload.php" method="post" enctype="multipart/form-data" name="frmupload"><input type="file" id="btnupload" name="btnupload" /><input type="submit" name="btnsubmit" name="btnsubmit" value="upload" /></form></fieldset><div class="button"><input type="button" name="btnrefresh" id="btnrefresh" value="Refresh" /><input type="button" name="btninsert" id="btninsert" value="Insert" onclick="'+this.is+'.hide_i(\''+this.is+'idbtnInsertImage\');" /><input type="button" name="btncancel" id="btncancel" value="Cancel" onclick="'+this.is+'.hide(\''+this.is+'idbtnInsertImage\');" /></div>';
		range.innerHTML = s;
		document.getElementById(this.is+'idbtnInsertImage').appendChild(range);
		window.onload=this.reloadroot();
	}
	
	this.createajax = function(){
		var td=navigator.appName;
		var dd;
		if(td == "Microsoft Internet Explorer"){
			dd = new ActiveXObject("Microsoft.XMLHTTP");	
		}else{
			dd = new XMLHttpRequest();
		}
		return dd;
	}
	
	this.reloadroot = function(){
		http = this.createajax();
		document.getElementById("files").innerHTML="<img src='image/loading2.gif' />";
		http.open("get","root.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
		http.onreadystatechange=this.process;
		http.send(null);
	}
	
	this.upload = function(){
		var file = document.getElementById("btnupload").value;
		http = this.createajax();
		http.open("get","upload.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
		http.onreadystatechange=this.process_upload;
		http.send(null);
	}
	this.process_upload = function(){
		if(http.readyState == 4 && http.status == 200){
			this.reloadroot();
		}
	}
	this.process = function(){
		if(http.readyState == 4 && http.status == 200){
			var kq=http.responseText;
			document.getElementById("files").innerHTML = kq;
		}	
	}
	this.insertIcon=function(url){
		document.getElementById(this.idTextArea).contentWindow.focus();
		if(url){
			this.doFormat('InsertImage',  url);
		}
	}
	
	this.Emoticons=function(){
		var range =  document.createElement('div');
		with(range.style){
			position='absolute';
			top='10px';
			left='0px';
			zindex='3';
			margin='2px';
			padding='2px';
			borderWidth='1px';
			borderStyle='solid';
			borderColor='#cccccc';
			background='#ffffff';
			cursor='default';
		};
		range.id="rangesmile";
		var s = "";
		var x,y=0;
		var path = "image/smile/";
		s+='<table>';
		for(var i=0;i<12;i++){
			x=y;
			s+='<tr>';
			for(var j=0;j<4;j++){				
				s+='<td height="25" align="center" title="'+this.iconSmile[x+j][0]+'"><div id="icon'+y+'" onmouseover="'+this.is+'.setStyle(\'icon'+y+'\',\'SmileOn\')" onmouseout="'+this.is+'.setStyle(\'icon'+y+'\',\'SmileOut\');"><img src='+path+this.iconSmile[x+j][2]+' onclick="'+this.is+'.insertIcon(\''+path+this.iconSmile[x+j][2]+'\');'+this.is+'.hide(\''+this.is+'idbtnEmoticon\');"></td>';
				y++;
			}
			s+='</tr>';
		}
		s+="</table>";
		flag = "idbtnEmoticon";
		range.innerHTML=s;	
		document.getElementById(this.is+'idbtnEmoticon').appendChild(range);
	};
	
	this.hide=function(idParent){
		if(idParent!=null)
			document.getElementById(idParent).removeChild(document.getElementById(idParent).firstChild);
	}
	this.hide_i=function(idParent){
		document.getElementById(this.idTextArea).contentWindow.focus();
		url = document.getElementById("tbximageurl").value;
		if(url){
			this.doFormat('InsertImage',  url);
		}
		if(idParent!=null)
			document.getElementById(idParent).removeChild(document.getElementById(idParent).firstChild);
	}
	
	this.hidefix=function(){alert(document.getElementById(isEmo).firstChild);
		if(document.getElementById(isEmo).firstChild!=null){
			document.getElementById(isEmo).removeChild(document.getElementById(isEmo).firstChild);	
		}
		/*if(document.getElementById(iscolor).firstChild!=null){
			document.getElementById(iscolor).removeChild(document.getElementById(iscolor).firstChild);
		}
		if(document.getElementById(isbg).firstChild!=null){
			document.getElementById(isbg).removeChild(document.getElementById(isbg).firstChild);
		}*/
	}
	
	this.table=function(){
		var range = document.createElement('div');
		range.id="idtable";
		with(range.style){
			position='absolute';	
			top='10px';
			left='0px';
			zindex='1';
			background='white';
			border='1px solid orange';
			padding='2px';
		}
		var s = '<table>';
		s+='<tr><td align="center"><label style="color:blue;">Number of Row</label></td><td align="center"><label style="color:blue;">Number Of Column</label></td></tr>';
		s+='<tr><td align="center"><input type="text" name="tbxRow" id="tbxRow" width="20" style="border:1px solid blue;" /></td><td align="center"><input type="text" id="tbxCol" name="tbxCol" width="20" style="border:1px solid blue;" /></td></tr>';
		s+='<tr><td align="center"><label style="color:blue;">Row Width(px)</label></td><td align="center"><label style="color:blue;">Column Height(px)</label></td></tr>';
		s+='<tr><td align="center"><input type="text" name="tbxWidth" id="tbxWidth" width="20" style="border:1px solid blue;" /></td><td align="center"><input type="text" id="tbxHeight" name="tbxHeight" width="20" style="border:1px solid blue;" /></td></tr>';
		s+='<tr><td align="center"><label style="color:blue;">Align</label></td></tr>';
		s+='<tr><td align="center"><select id="cbxAlign" style="border:1px solid blue;"><option value="" style="color:blue;">None</option><option value="left" style="color:blue;">Left</option><option value="center" style="color:blue;">Center</option><option value="right" style="color:blue;">Right</option></select></td></tr>';
		s+='<tr><td align="center"><input type="button" name="btnok" style="background:white;color:blue;border:1px solid blue;" onclick="'+this.is+'.insertTable(document.getElementById(\'tbxRow\').value,document.getElementById(\'tbxCol\').value,document.getElementById(\'tbxWidth\').value,document.getElementById(\'tbxHeight\').value,document.getElementById(\'cbxAlign\').value);" value="Submit" /></td><td align="center"><input type="button" name="btnCancel" onclick="'+this.is+'.hide(\''+this.is+'idbtnTable\');" value="Cancel" style="background:white;color:blue;border:1px solid blue;" /></td></tr>';
		s+='</table>';
		range.innerHTML=s;
		flag="idbtnTable";
		document.getElementById(this.is+'idbtnTable').appendChild(range);
	}
	
	this.insertTable=function(row,col,width,height,align){
		if(isNaN(row)||isNaN(col)||isNaN(width)||isNaN(height)){
			alert("data must be a number !");
		}else{
			var s = '<table border="1">';
			for(var i=0;i<row;i++){
				s+='<tr height="'+height+'">';
				for(var j=0;j<col;j++){
					s+='<td width="'+width+'" style="border:1px solid blue;" align='+align+'></td>';	
				}
				s+='</tr>';	
			}
			s+='</table>';
			s+='<br />';
			this.doFormat('insertHTML',s);
			this.hide(''+this.is+'idbtnTable');
		}
	}
	
	this.fontColor=function(){
		var colorRange = document.createElement('div');
		colorRange.id="color_range";
		with(colorRange.style){
			position='absolute';
			top='10px';
			left='0px';
			zindex='1';
			background='white';
			border='1px solid black';
			padding='2px';			
		}
		var s = '';
		var y=0;
		s+="<table>";
		for(var i=0;i<12;i++){
			s+="<tr>";
			for(var j=0;j<12;j++){
				s+='<td title="'+this.colors[y][0]+'"><div id="idfontcolor'+y+'" onclick="'+this.is+'.doFormat(\'forecolor\',\''+this.colors[y][1]+'\');'+this.is+'.hide(\''+this.is+'idbtnFontColor\');" style="background-color:'+this.colors[y][1]+';width:10px;height:10px;border:1px solid gray;" onmouseover="'+this.is+'.setStyle(\''+this.is+'idfontcolor'+y+'\',\'colorOn\')" onmouseout="'+this.is+'.setStyle(\''+this.is+'idfontcolor'+y+'\',\'colorOut\')"></div></td>';
				y++;
			}
			s+="</tr>";	
		}
		s+="</table>";
		colorRange.innerHTML = s;
		flag = "idbtnFontColor";
	document.getElementById(this.is+'idbtnFontColor').appendChild(colorRange);	
	};
	
	this.backGroundColor=function(){
		var colorRange_bg = document.createElement('div');
		colorRange_bg.id="color_range_bg";
		with(colorRange_bg.style){
			position='absolute';
			top='10px';
			left='0px';
			zindex='1';
			background='white';
			border='1px solid black';
			padding='2px';			
		}
		var s = '';
		var y=0;
		s+="<table>";
		for(var i=0;i<12;i++){
			s+="<tr>";
			for(var j=0;j<12;j++){
				s+='<td title="'+this.colors[y][0]+'"><div id="idfontcolor'+y+'" onclick="'+this.is+'.doFormat(\'hilitecolor\',\''+this.colors[y][1]+'\');'+this.is+'.hide(\''+this.is+'idbtnBackColor\');" style="background-color:'+this.colors[y][1]+';width:10px;height:10px;border:1px solid gray;" onmouseover="'+this.is+'.setStyle(\''+this.is+'idfontcolor'+y+'\',\'colorOn\')" onmouseout="'+this.is+'.setStyle(\''+this.is+'idfontcolor'+y+'\',\'colorOut\')"></div></td>';
				y++;
			}
			s+="</tr>";	
		}
		s+="</table>";
		colorRange_bg.innerHTML = s;
		flag = "idbtnBackColor";
		document.getElementById(this.is+'idbtnBackColor').appendChild(colorRange_bg);	
	};
	
	this.setStyle=function(id,color){
		document.getElementById(id).className = color;
	};
	
	this.button=[//idspan id tooltip iamge function
		[''+this.is+'idbtnBold',''+this.is+'btnBold', 'Bold', 'image/btnbold.gif', this.is+'.doFormat(\'bold\')', this.is+'.setStyle(\''+this.is+'btnBold\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnBold\',\'emotionOut\')'],
		[''+this.is+'idbtnItablic',''+this.is+'btnItalic', 'Italic', 'image/btnitalic.gif', this.is+'.doFormat(\'italic\')', this.is+'.setStyle(\''+this.is+'btnItalic\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnItalic\',\'emotionOut\')'],
		[''+this.is+'idbtnUnderline',''+this.is+'btnUnderline', 'Underline', 'image/btnunderline.gif', this.is+'.doFormat(\'underline\')', this.is+'.setStyle(\''+this.is+'btnUnderline\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnUnderline\',\'emotionOut\')'],
		[''+this.is+'idbtnStrikethrought',''+this.is+'btnStrikethrought','Strikethrough','image/btnStrikethrough.gif',this.is+'.doFormat(\'StrikeThrough\')', this.is+'.setStyle(\''+this.is+'btnStrikethrought\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnStrikethrought\',\'emotionOut\')'],
		[''+this.is+'idbtnSuperscript',''+this.is+'btnSuperscript', 'Super Script', 'image/btnSuperscript.gif', this.is+'.doFormat(\'superscript\')', this.is+'.setStyle(\''+this.is+'btnSuperscript\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnSuperscript\',\'emotionOut\')'],
		[''+this.is+'idbtnSubscript',''+this.is+'btnSubscript', 'Sub Script', 'image/btnsubscript.gif', this.is+'.doFormat(\'subscript\')', this.is+'.setStyle(\''+this.is+'btnSubscript\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnSubscript\',\'emotionOut\')'],
		[''+this.is+'idbtnIndentMore',''+this.is+'btnIndentMore', 'Indent', 'image/btnindent.gif', this.is+'.doFormat(\'indent\')', this.is+'.setStyle(\''+this.is+'btnIndentMore\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnIndentMore\',\'emotionOut\')'],
		[''+this.is+'idbtnOutdentMore',''+this.is+'btnOutdentMore', 'Outdent', 'image/btnoutdent.gif', this.is+'.doFormat(\'outdent\')', this.is+'.setStyle(\''+this.is+'btnOutdentMore\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnOutdentMore\',\'emotionOut\')'],
		[''+this.is+'idbtnAlignLeft',''+this.is+'btnAlignLeft', 'Align Left', 'image/btnLeft.gif', this.is+'.doFormat(\'justifyleft\')', this.is+'.setStyle(\''+this.is+'btnAlignLeft\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnAlignLeft\',\'emotionOut\')'],
		[''+this.is+'idbtnAlignCenter',''+this.is+'btnAlignCenter', 'Align Center', 'image/btnCenter.gif', this.is+'.doFormat(\'justifycenter\')', this.is+'.setStyle(\''+this.is+'btnAlignCenter\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnAlignCenter\',\'emotionOut\')'],
		[''+this.is+'idbtnAlignRight',''+this.is+'btnAlignRight', 'Align Right', 'image/btnRight.gif', this.is+'.doFormat(\'justifyright\')', this.is+'.setStyle(\''+this.is+'btnAlignRight\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnAlignRight\',\'emotionOut\')'],
		[''+this.is+'idbtnAlignJustify',''+this.is+'btnAlignJustify', 'Align Justify', 'image/btnfull.gif', this.is+'.doFormat(\'justifyfull\')', this.is+'.setStyle(\''+this.is+'btnAlignJustify\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnAlignJustify\',\'emotionOut\')'],
		[''+this.is+'idbtnOrderedList',''+this.is+'btnOrderedList', 'Ordered List', 'image/btnNumber.gif', this.is+'.doFormat(\'insertorderedlist\')', this.is+'.setStyle(\''+this.is+'btnOrderedList\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnOrderedList\',\'emotionOut\')'],
		[''+this.is+'idbtnBulletedList',''+this.is+'btnBulletedList', 'Bulleted List', 'image/btnList.gif', this.is+'.doFormat(\'insertunorderedlist\')', this.is+'.setStyle(\''+this.is+'btnBulletedList\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnBulletedList\',\'emotionOut\')'],
		[''+this.is+'idbtnInsertImage',''+this.is+'btnInsertImage', 'Insert Image', 'image/btnimage.gif', this.is+'.insertImage()', this.is+'.setStyle(\''+this.is+'btnInsertImage\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnInsertImage\',\'emotionOut\')'],
		[''+this.is+'idbtnInsertLink',''+this.is+'btnInsertLink', 'Insert Link', 'image/btnHyperlink.gif', this.is+'.addLink()', this.is+'.setStyle(\''+this.is+'btnInsertLink\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnInsertLink\',\'emotionOut\')'],
		[''+this.is+'idbtnEmoticon',''+this.is+'btnEmoticon','Smile','image/btnsmile.gif',this.is+'.Emoticons()', this.is+'.setStyle(\''+this.is+'btnEmoticon\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnEmoticon\',\'emotionOut\')'],
		[''+this.is+'idbtnFontColor',''+this.is+'btnFontColor', 'Font Color', 'image/btnfontcolor.gif', this.is+'.fontColor()', this.is+'.setStyle(\''+this.is+'btnFontColor\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnFontColor\',\'emotionOut\')'],
		[''+this.is+'idbtnBackColor',''+this.is+'btnBackColor', 'Background Color', 'image/btnBackColor.gif', this.is+'.backGroundColor()', this.is+'.setStyle(\''+this.is+'btnBackColor\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnBackColor\',\'emotionOut\')'],
		[''+this.is+'idbtnTable',''+this.is+'btnTable','Table','image/btnTable.gif',this.is+'.table();',this.is+'.setStyle(\''+this.is+'btnTable\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnTable\',\'emotionOut\')'],
		[''+this.is+'idbtnUnformat',''+this.is+'btnUnformat','Remove Formatting','image/btnDelete.gif',this.is+'.unFormat()', this.is+'.setStyle(\''+this.is+'btnUnformat\',\'emotionOn\')',this.is+'.setStyle(\''+this.is+'btnUnformat\',\'emotionOut\')'],		
	];
	
	this.iconSmile=[
		['happy',':)','1.gif'],
		['sad',':(','2.gif'],
		['rose','@};-','3.gif'],
		['coffee','~O)','4.gif'],	
		['batting eyelashes',';;)','5.gif'],
		['big hug','>:D<','6.gif'],
		['confused',':-/','7.gif'],
		['love struck',':x','8.gif'],
		['blushing',':">','9.gif'],
		['tongue',':P','10.gif'],
		['surprise',':-O','11.gif'], 
		['cool','B-)','12.gif'],
		['crying',':((','13.gif'],
		['laughing',':))','14.gif'],
		['straight face',':|','15.gif'],
		['don\'t tell anyone',':-$','16.gif'],
		['yawn','(:|','17.gif'],
		['thinking',':-?','18.gif'],
		['d\'oh','#-o','19.gif'],
		['applause','=D>','20.gif'],
		['angel','O:)','21.gif'],
		['daydreaming','8->','22.gif'],
		['kiss',':-*','23.gif'],
		['angry','X(','24.gif'],
		['worried',':-S','25.gif'],
		['waiting',':-w','26.gif'],
		['I don\'t know',':-??','27.gif'],
		['shame on you','[-X','28.gif'],
		['whistling',':-"','29.gif'],
		['praying','[-O<','30.gif'],
		['winking','	;)','31.gif'],
		['big grin',':D','32.gif'],
		['','','33.gif'],
		['','','34.gif'],
		['','','35.gif'],
		['','','36.gif'],
		['','','37.gif'],
		['','','38.gif'],
		['','','39.gif'],
		['','','40.gif'],
		['','','41.gif'],
		['','','42.gif'],
		['','','52.gif'],
		['','','53.gif'],
		['','','66.gif'],
		['','','101.gif'],
		['','','102.gif'],
		['','','111.gif'],
	];
	
	this.colors=[	
		['AliceBlue','#F0F8FF'],
		['AntiqueWhite','#FAEBD7'],
		['Aqua','#00FFFF'],
		['Aquamarine','#7FFFD4'],
		['Azure','#F0FFFF'],
		['Beige','#F5F5DC'],
		['Bisque','#FFE4C4'],
		['Black','#000000'],
		['BlanchedAlmond','#FFEBCD'],
		['Blue','#0000FF'],
		['BlueViolet','#8A2BE2'],
		['Brown','#A52A2A'],
		['BurlyWood','#DEB887'], 
		['CadetBlue','#5F9EA0'],
		['Chartreuse','#7FFF00'],
		['Chocolate','#D2691E'],
		['Coral','#FF7F50'],
		['CornflowerBlue','#6495ED'],
		['Cornsilk','#FFF8DC'],
		['Crimson','#DC143C	'],
		['Cyan','#00FFFF'],
		['DarkBlue','#00008B'], 
		['DarkCyan','#008B8B'],
		['DarkGoldenRod','#B8860B'],
		['DarkGray','#A9A9A9'],
		['DarkGrey','#A9A9A9'],
		['DarkGreen','#006400'], 
		['DarkKhaki','#BDB76B'],
		['DarkMagenta','#8B008B'],
		['DarkOliveGreen','#556B2F'], 
		['Darkorange','#FF8C00'],
		['DarkOrchid','#9932CC'],
		['DarkRed','#8B0000'],
		['DarkSalmon','#E9967A'], 
		['DarkSeaGreen','#8FBC8F'],
		['DarkSlateBlue','#483D8B'], 
		['DarkSlateGray','#2F4F4F'],
		['DarkSlateGrey','#2F4F4F'],
		['DarkTurquoise','#00CED1'],
		['DarkViolet','#9400D3'],
		['DeepPink','#FF1493'],
		['DeepSkyBlue','#00BFFF'], 
		['DimGray','#696969 '],
		['DodgerBlue','#1E90FF'], 
		['FireBrick','#B22222'],
		['FloralWhite','#FFFAF0'],
		['ForestGreen','#228B22'],
		['Fuchsia','#FF00FF'],
		['Gainsboro','#DCDCDC'], 
		['GhostWhite','#F8F8FF'],
		['Gold','#FFD700'],
		['GoldenRod','#DAA520'],
		['Gray','#808080'],
		['Grey','#808080'],
		['Green','#008000'], 
		['GreenYellow','#ADFF2F'],	 
		['HoneyDew','#F0FFF0'],
		['HotPink','#FF69B4'],
		['IndianRed','#CD5C5C'], 
		['Indigo','#4B0082'],
		['Ivory','#FFFFF0'],
		['Khaki','#F0E68C'],
		['Lavender','#E6E6FA'],
		['LavenderBlush','#FFF0F5'],
		['LawnGreen','#7CFC00'],
		['LemonChiffon','#FFFACD'],
		['LightBlue','#ADD8E6'],
		['LightCoral','#F08080'],
		['LightCyan','#E0FFFF'],
		['LightGoldenRodYellow','#FAFAD2'],
		['LightGray','#D3D3D3'],
		['LightGrey','#D3D3D3'],
		['LightGreen','#90EE90'],
		['LightPink','#FFB6C1'],
		['LightSalmon','#FFA07A'],
		['LightSeaGreen','#20B2AA'], 
		['LightSkyBlue','#87CEFA'],
		['LightSlateGray','#778899'], 
		['LightSteelBlue','#B0C4DE'],
		['LightYellow','#FFFFE0'],
		['Lime','#00FF00'],
		['LimeGreen','#32CD32'],
		['Linen','#FAF0E6'],
		['Magenta','#FF00FF'],
		['Maroon','#800000'],
		['MediumAquaMarine','#66CDAA'],
		['MediumBlue','#0000CD'],
		['MediumOrchid','#BA55D3'],
		['MediumPurple','#9370D8'],
		['MediumSeaGreen','#3CB371'], 
		['MediumSlateBlue','#7B68EE'],
		['MediumSpringGreen','#00FA9A'], 
		['MediumTurquoise','#48D1CC'],
		['MediumVioletRed','#C71585'],
		['MidnightBlue','#191970'],
		['MintCream','#F5FFFA'],
		['MistyRose','#FFE4E1'],
		['Moccasin','#FFE4B5'],
		['NavajoWhite','#FFDEAD'], 
		['Navy','#000080'],
		['OldLace','#FDF5E6'], 
		['Olive','#808000'],
		['Oliv	eDrab','#6B8E23'], 
		['Orange','#FFA500'],
		['OrangeRed','#FF4500'], 
		['Orchid','#DA70D6'],
		['PaleGoldenRod','#EEE8AA'],
		['PaleGreen','#98FB98'],
		['PaleTurquoise','#AFEEEE'], 
		['PaleVioletRed','#D87093'],
		['PapayaWhip','#FFEFD5'],
		['PeachPuff','#FFDAB9'],
		['Peru','#CD853F'],
		['Pink','#FFC0CB'],
		['Plum','#DDA0DD'],
		['PowderBlue','#B0E0E6'],
		['Purple','#800080'],
		['Red','#FF0000'],
		['RosyBrown','#BC8F8F'],
		['RoyalBlue','#4169E1'],
		['SaddleBrown','#8B4513'],
		['Salmon','#FA8072'],
		['SandyBrown','#F4A460'], 
		['SeaGreen','#2E8B57'],
		['SeaShell','#FFF5EE'],
		['Sienna','#A0522D'],
		['Silver','#C0C0C0'],
		['SkyBlue','#87CEEB'],
		['SlateBlue','#6A5ACD'], 
		['SlateGray','#708090'],
		['SlateGrey','#708090'],
		['Snow','#FFFAFA'],
		['SpringGreen','#00FF7F'],
		['SteelBlue','#4682B4'],
		['Tan','#D2B48C'],
		['Teal','#008080'],
		['Thistle','#D8BFD8'], 
		['Tomato','#FF6347'],
		['Turquoise','#40E0D0'],
		['Violet','#EE82EE'],
		['Wheat','#F5DEB3'],
		['White','#FFFFFF'],
		['WhiteSmoke','#F5F5F5'], 
		['Yellow','#FFFF00'],
		['YellowGreen','#9ACD32'],
	];
	
};

function onmouse(id, name){
	document.getElementById(id).className = name;
}

function show_image(src,width,height){
	document.getElementById('showimage').innerHTML='<img src="'+src+'" width="'+width+'" height="'+height+'" />';
}

function show_detail(name, width, height, type, size, date, src, drc){
	document.getElementById("details").innerHTML = '<ul><li>Name : '+name+'</li><li> Dimension : '+width+' x '+height+'</li><li>Type : '+type+'</li><li>Size : '+size+' KB</li><li>Modified : '+date+'</li></ul>'; 
	document.getElementById("tbximageurl").value = src;
	document.getElementById("tbxwidth").value = width;
	document.getElementById("tbxheight").value = height;
	document.getElementById("tbxdecription").value = drc;
}
function accessfolder(src){
	//http = this.createajax();
	document.getElementById("files").innerHTML="<img src='image/loading2.gif' />";
	http.open("post","root.php",true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
	http.onreadystatechange=this.process;
	http.send("src="+src);
}
function process(){
	if(http.readyState == 4 && http.status == 200){
		var kq=http.responseText;
		document.getElementById("files").innerHTML = kq;
	}	
}
if(typeof _STNS!="undefined"&&!_STNS.UI){
_STNS.UI={UNIUID:0,DOMEVENTS:["mouseover","mouseout","mousemove","mousedown","mouseup","click","keypress","keydown","keyup","dblclick"],foGetUIById:function(id){
var o;
while(id){
if(o=_STNS.UI.oUIs[id]){
return o;
}
id=id.substr(0,id.lastIndexOf("_"));
}
},fsGetUid:function(){
this.iIdNo++;
if(_STNS.UI.UNIUID){
return "stUI"+_STNS.UI.UNIUID+this.iIdNo;
}else{
if(window.name){
return "stUI"+(_STNS.fsTranD2X(36,(new Date).getTime()))+this.iIdNo;
}else{
return "stUI"+this.iIdNo;
}
}
},iIdNo:0,oUIs:{},fbDmEnt:function(e,o){
var _5=o.id,ob,r=-1;
if(!_5){
return true;
}
if(ob=_STNS.UI.foGetUIById(_5)){
if(ob.fbGetEnt){
r=ob.fbGetEnt(e,o);
}
}
return r;
},fsGetEnt:function(o,t,n,_b){
var s;
if(n==null){
var n="";
}
if(!_b){
var _b="";
}
if(o._oEs[t+n]&&o._oEs[t+n].length){
for(var i=0;i<_STNS.UI.DOMEVENTS.length;i++){
if(_STNS.UI.DOMEVENTS[i]==t){
return "on"+t+"='return "+_b+"_STNS.UI.fbDmEnt(event,this)'";
}
}
}
return "";
}};
with(_STNS.UI){
_STNS.UI.CUIObj=_STNS.Class();
CUIObj.register("UI/CUIObj");
CUIObj.construct=function(){
this._oMs={};
this._oEs={};
this.oParent=null;
this.sUid=_STNS.UI.fsGetUid();
this.fbGetEnt=_STNS.fbTrue();
with(_STNS.UI.CUIObj){
this.fvDestroy=fvDestroy;
this.fvGetMsg=fvGetMsg;
this.fbSetMsg=fbSetMsg;
this.fbAttachEnt=fbAttachEnt;
this.fbDetachEnt=fbDetachEnt;
this.fbDetachAll=fbDetachAll;
this.fbFireEnt=fbFireEnt;
this.fbCheckEnt=fbCheckEnt;
this.foClone=foClone;
}
_STNS.UI.oUIs[this.sUid]=this;
this.sSelf="_STNS.UI.oUIs['"+this.sUid+"']";
};
CUIObj.fvDestroy=function(){
delete _STNS.UI.oUIs[this.sUid];
};
CUIObj.fvGetMsg=function(m,d){
var f,r=true;
if(f=this._oMs[m]){
if(typeof f=="string"){
f=_STNS.ffGetFun(f);
}
if(f){
r=f.call(this,d);
}
}
if(r==true&&this.oParent){
this.oParent.fvGetMsg(m,d);
}
};
CUIObj.fbSetMsg=function(m,f){
if(typeof f!="function"&&typeof f!="string"){
_STNS.fvThrow(new Error("Attach invalid function to "+t+" message."));
return false;
}
this._oMs[m]=f;
return true;
};
CUIObj.fbCheckEnt=function(t){
if(this._oEs[t]){
return true;
}
};
CUIObj.fbAttachEnt=function(t,f){
if(typeof f!="function"&&typeof f!="string"){
_STNS.fvThrow(new Error("Attach invalid function to "+t+" event."));
return false;
}
if(this._oEs[t]){
for(var i=0;i<this._oEs[t].length;i++){
if(this._oEs[t][i]==f){
return -1;
}
}
this._oEs[t].push(f);
}else{
this._oEs[t]=[f];
}
return true;
};
CUIObj.fbDetachEnt=function(t,f){
var i;
if(this._oEs[t]&&this._oEs[t].length){
for(i=0;i<this._oEs[t].length;i++){
if(this._oEs[t][i]==f){
delete this._oEs[t][i];
}
}
}
};
CUIObj.fbDetachAll=function(){
for(var i in this._oEs){
if(this._oEs[i].length){
this._oEs[i].length=0;
}
delete this._oEs[i];
}
};
CUIObj.fbFireEnt=function(t,as){
var i,r=true,f,tmp;
if(!this._oEs[t]||!this._oEs[t].length){
return -1;
}
for(i=0;i<this._oEs[t].length;i++){
if(!this._oEs[t][i]){
continue;
}
f=this._oEs[t][i];
if(typeof f=="string"){
f=_STNS.ffGetFun(f);
}
if(f){
tmp=f.call(this,as);
if(!tmp){
r=tmp;
}
}
}
return r;
};
CUIObj.foClone=function(){
var o={};
for(var i in this){
o[i]=this[i];
}
o.sUid=_STNS.UI.fsGetUid();
_STNS.UI.oUIs[o.sUid]=o;
o.sSelf="_STNS.UI.oUIs['"+o.sUid+"']";
return o;
};
}
}
if(typeof _STNS.UI.CUIMenu=="undefined"){
with(_STNS.UI){
_STNS.UI.CUIMenu=_STNS.Class(_STNS.UI.CUIObj);
CUIMenu.register("UI/CUIObj>CUIMenu");
CUIMenu.construct=function(){
this.sJsPth="";
this.sVer=0;
this.iTyp=0;
this.aPopups=[];
this.sId=0;
this.iNid=-1;
this.iX=0;
this.iY=0;
this.iWid=0;
this.iHei=0;
this.iHal=0;
this.sImgPth=0;
this.sLnkPre=0;
this.sBlank=0;
this.iClk=0;
this.bClked=0;
this.iStat=0;
this.iDelaySV=250;
this.iDelaySH=0;
this.iDelayHd=1000;
this.iDelayTk=0;
this.bHdPopup=true;
this.aHdTags=[];
this.bRTL=false;
this.aCursors=[];
this.sSiteRoot="";
this.bRunEff=true;
this.iTracks=0;
this.iTrackLevel=-1;
this.oTracks={};
this.aScBars=[];
this.aMaxSizes=[-1,-1];
this.iScType=0;
this.bCfm=false;
this.bCfShow=false;
this.sTarFm="";
this.sSrcFm="";
this.iCfX=0;
this.iCfY=0;
this.iCfD=0;
this.oFocus=0;
this.OutItem=0;
this.bTab=false;
this.oSel=0;
this.bOver=0;
this.iTab=0;
this.iTabHei="";
this.bHL=0;
this.bWe=0;
with(_STNS.UI.CUIMenu){
this.fvDestroy=fvDestroy;
this.fsGetImg=fsGetImg;
this.fsGetLnk=fsGetLnk;
this.fsGetHTML=fsGetHTML;
this.fsGetImgTag=fsGetImgTag;
this.fsGetEnt=fsGetEnt;
this.fsGetStyle=fsGetStyle;
this.fdmGetTarFm=fdmGetTarFm;
this.fsGetSrcFm=fsGetSrcFm;
this.fbShow=fbShow;
this.foInsTab=foInsTab;
this.fbDelPopup=fbDelPopup;
this.fvMvto=fvMvto;
this.fnGsp=fnGsp;
this.fvSsc=fvSsc;
this.fbTrack=fbTrack;
this.fbCkLnk=fbCkLnk;
this.fbClick=fbClick;
this.fbKeydown=fbKeydown;
}
};
CUIMenu.MOUSEOVER=1;
with(CUIMenu){
CUIMenu.MAXSTATE=MOUSEOVER;
}
CUIMenu.ALIGNS=["left","center","right"];
CUIMenu.VALGINS=["top","middle","bottom"];
CUIMenu.REPEATS=["no-repeat","repeat-x","repeat-y","repeat"];
CUIMenu.BORDERS=["none","solid","double","dotted","dashed","groove","ridge","outset","inset"];
CUIMenu.fsGetHTML=function(){
var s="";
if(this.aPopups.length){
if(this.bTab){
var p=this.aPopups[0],m=this,_r=_STNS;
with(this.aPopups[0]){
var p1=this.aPopups[1];
s+="<table cellpadding=0 cellspacing=0";
s+=" id='"+sUid+"_menu' ";
s+="align="+_r.UI.CUIMenu.ALIGNS[m.iHal]+" ";
s+=m.fsGetStyle("tb",0,(iWid&&iWid!=-1?"width:"+_r.fsGetLen("tb",iWid,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1)+";":"")+(iHei&&iHei!=-1?"height:"+_r.fsGetLen("tb",iHei,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1,0)+";":""));
s+=">";
s+="<tr "+m.fsGetStyle("tr",0)+">"+"<td "+m.fsGetStyle("td",0)+">";
s+=fsGetHTML();
s+="</td></tr>";
var fs="";
if(p1){
if(_STNS.bIsIE&&(p1.iOpac<100&&p1.iOpac>-1||_STNS.oNav.version>=5.5&&p1.iShadow&&p1.iSdSize)){
fs="filter:"+(p1.iOpac<100&&p1.iOpac>-1?"Alpha(opacity="+p1.iOpac+") ":"")+(_STNS.oNav.version>=5.5&&p1.iShadow&&p1.iSdSize?(p1.iShadow==1?"progid:DXImageTransform.Microsoft.dropshadow(color="+p1.sSdClr+",offx="+iSdSize+",offy="+iSdSize+",positive=1)":"progid:DXImageTransform.Microsoft.Shadow(color="+p1.sSdClr+",direction=135,strength="+iSdSize+")"):"")+";";
}else{
if(_STNS.oNav.name=="gecko"&&_STNS.oNav.version>=20060414){
fs=p1.iOpac<100&&iOpac>-1?"-moz-opacity:"+p1.iOpac/100+";":"";
}
}
}
s+="<tr "+m.fsGetStyle("tr",0)+">"+"<td id='"+sUid+"_tb2' "+m.fsGetStyle("td",0,(m.bTab?fs:"")+("height:"+m.iTabHei+"px;")+(p1?(p1.iBdStyle>0&&p1.iBdWid>0?"border-width:"+p1.iBdWid+"px"+";border-style:"+_r.UI.CUIMenu.BORDERS[p1.iBdStyle]+";border-color:"+p1.sBdClr+";":"")+((p1.sBgClr?"background-color:"+p1.sBgClr+";":"")+(p1.sBgImg?"background-image:url("+p1.sBgImg+");background-repeat:"+_r.UI.CUIMenu.REPEATS[p1.iBgRep]+";":"")):""))+">"+"<div style=\"visibility:hidden;font-size:1pt;line-height:1pt;\">1<div></td>"+"</tr>";
s+="</table>";
return s;
}
}else{
return this.aPopups[0].fsGetHTML();
}
}
return "";
};
CUIMenu.fsGetImg=function(s){
if(!s){
return "";
}
if(!_STNS.fbIsAbsPth(s)){
s=this.sImgPth+s;
}
if((s.charAt(0)=="/")&&_STNS.bLocal&&this.sSiteRoot){
s=this.sSiteRoot+s;
}
if(s&&_STNS.bBufImg){
var p=_STNS.fsGetAbsPth(s);
if(!_STNS.oImgs[p]){
_STNS.oImgs[p]=1;
}
}
return s;
};
CUIMenu.fsGetLnk=function(l){
if(!_STNS.fbIsAbsPth(l)){
l=this.sLnkPre+l;
}
if((l.charAt(0)=="/")&&_STNS.bLocal&&this.sSiteRoot){
l=this.sSiteRoot+l;
}
if(!l.toLowerCase().indexOf("javascript:")){
l+=";void(0)";
}
l=_STNS.fsGetAbsPth(l);
return l;
};
CUIMenu.fvDestroy=function(){
for(var i=0;i<this.aPopups.length;i++){
this.aPopups[i].fvDestroy();
}
_STNS.UI.CUIObj.fvDestroy.call(this);
};
CUIMenu.fnGsp=function(d){
if(d<5){
return d;
}
return Math.round(d/2);
};
CUIMenu.fvMvto=function(xy,p){
var w=p.iStat&_STNS.UI.CUIPopup.CROSSFRAME?this.fdmGetTarFm():window,l=_STNS.fdmGetEleById(p.sUid+"_dv",w);
if(l){
l.style.left=xy[0]+"px";
l.style.top=xy[1]+"px";
}
};
CUIMenu.fvSsc=function(){
if(typeof (this.fvMvto)=="undefined"||!_STNS.bLoaded){
return;
}
var m=this;
var e,p=m.aPopups[0],xy=[eval(m.iX),eval(m.iY)],xs,ys;
e=_STNS.fdmGetEleById(p.sUid);
var pos=_STNS.faGetElePos(e);
var dx=xy[0]-pos[0],dy=xy[1]-pos[1];
if(dx||dy){
xs=this.fnGsp(Math.abs(dx));
ys=this.fnGsp(Math.abs(dy));
var x=dx>0?pos[0]+xs:pos[0]-xs,y=dy>0?pos[1]+ys:pos[1]-ys;
this.fvMvto([x,y],p);
}
};
CUIMenu.fbShow=function(){
_STNS.fvLoadLib();
if(_STNS.bLoaded){
var o=document.body,w="beforeEnd";
_STNS.fbInsHTML(o,w,this.fsGetHTML());
this.aPopups[0].fbInit();
this.aPopups[0].fbShow();
}else{
if(STM_BIMG){
_STNS.fvBufImgs();
}
if(this.iTracks&&(!this.iTyp||this.iTyp==1)){
_STNS.fvAddCk(new Function(this.sSelf+".fbTrack()"));
}
if(!this.iTyp){
var s="<script type='text/javascript' language='javascript1.2'>"+this.aPopups[0].sSelf+".fbShow();"+this.aPopups[0].sSelf+".fbInit();</script>";
document.write(this.fsGetHTML()+s);
if(this.bTab){
this.foInsTab();
}
}else{
if(this.iTyp==1){
var t=this,p=this.aPopups[0];
if(isNaN(this.iX)||isNaN(this.iY)){
_STNS.fvAddCk(new Function(this.sSelf+".fvSsc()"));
}else{
var pos=p.faGetXY();
t.iX=pos[0];
t.iY=pos[1];
}
p.fbShow();
}else{
if(this.iTyp==3){
var t=this,p=this.aPopups[0];
document.oncontextmenu=function(e){
var s,pos;
if(!e){
e=window.event;
pos=_STNS.faCP2PP([e.clientX,e.clientY]);
}else{
if(e.pageX){
pos=[e.pageX,e.pageY];
}else{
pos=_STNS.faCP2PP([e.clientX,e.clientY]);
}
}
t.iX=pos[0];
t.iY=pos[1];
p.fbHide();
p.fbShow();
p.fbHide(t.iDelayHd);
return false;
};
}
}
}
}
};
CUIMenu.fsGetImgTag=function(s,w,h,b,id,f,nw,nh){
if(!s){
s=this.sBlank;
}
if(f){
s=_STNS.fsGetAbsPth(s);
}
if(!s||!w||!h){
return "";
}
if(nw&&nh){
if(w==-1&&h==-1){
w=nw,h=nh;
}else{
if(w==-1&&h!=-1){
w=Math.floor(nw*h/nh);
}else{
if(w!=-1&&h==-1){
h=Math.floor(nh*w/nw);
}
}
}
}
return "<img class='stimg' "+(_STNS.bIsFX?"style=\"-moz-outline-style:none;\"":"")+" src=\""+s+"\""+(w==-1?"":" width="+w)+(h==-1?"":" height="+h)+" border="+(b?b:0)+(id?" id='"+id+"'":"")+">";
};
CUIMenu.fsGetEnt=function(o,t,n,f){
var sfm="";
if(f){
var sfm=this.fsGetSrcFm();
if(sfm){
sfm+=".";
}else{
sfm="";
}
}
return _STNS.UI.fsGetEnt(o,t,n,sfm);
};
CUIMenu.fsGetStyle=function(t,f,c){
var s="",_r=_STNS;
if(!f&&_r.bShield){
if(_r.oDefCSS[t]){
s="class='st"+t+"'";
}
if(c){
s+=" style=\""+c+"\"";
}
}else{
if(!c&&_r.oDefCSS[t]){
s="style=\""+_r.oDefCSS[t]+"\"";
}else{
if(_r.oDefCSS[t]){
s="style=\"";
var a=_r.foCss2Obj(c),b=_r.foCss2Obj(_r.oDefCSS[t]);
for(var i in b){
if(typeof a[i]=="undefined"){
a[i]=b[i];
}
}
s+=_r.fsObj2Css(a);
s+="\"";
}
}
}
return s;
};
CUIMenu.fsGetSrcFm=function(){
var s="",a=this.sSrcFm?("parent."+this.sTarFm).split("."):this.sTarFm.split("."),n=[],f=0;
for(var j=0;j<a.length;j++){
s+=a[j];
if(a[j]!="parent"){
if(a[j]=="window"){
continue;
}
if(!f){
if(n.length){
n[n.length-1]="parent";
}
f=1;
}
n.push("parent");
}else{
n.push(eval(s).name);
}
s+=".";
}
s="";
for(var j=n.length-2;j>=0;j--){
s+=n[j]+".";
}
if(this.sSrcFm){
s+=this.sSrcFm;
}else{
s+="parent";
}
return s;
};
CUIMenu.fdmGetTarFm=function(){
var j,s=this.sSrcFm?"parent."+this.sTarFm:this.sTarFm,w;
try{
w=eval(s);
return w;
}
catch(e){
return;
}
};
CUIMenu.fbTrack=function(){
var _r=_STNS,_c=_r.UI.CUIMenu,is={},ps=[],_ic=_r.UI.CUIItem,d=0,it,ts=[];
if(this.iDelayTk>0){
this.iDelayTk-=_r.nCkTime;
return false;
}
if(this.iStat&_c.MOUSEOVER){
return false;
}
if(this.oFocus){
return false;
}
var c=this.iTracks&33554432;
if(this.bTab){
if(this.bHL){
this.bHL=0;
}
for(var i=0;i<this.aPopups.length;i++){
for(var j=0;j<this.aPopups[i].aItems.length;j++){
var n=this.aPopups[i].aItems[j];
if(n._sTLnk&&n._sTLnk!="#_nolink"){
if(this.fbCkLnk(n._sTLnk,n.sTar,c,window)){
this.bHL=1;
is[n.sUid]=n;
ps[i]=1;
if(i==0&&n.oSubPopup){
for(var k=0;k<n.oSubPopup.aItems.length;k++){
var nn=n.oSubPopup.aItems[k];
if(nn._sTLnk&&nn._sTLnk!="#_nolink"&&this.fbCkLnk(nn._sTLnk,nn.sTar,c,window)){
is[nn.sUid]=nn;
ps[n.oSubPopup.iNid]=1;
break;
}
}
}
break;
}
}
}
if(this.bHL){
break;
}
}
if(!this.bHL){
return false;
}
}
if(!this.bTab){
for(var i=0;i<this.aPopups.length;i++){
for(var j=0;j<this.aPopups[i].aItems.length;j++){
it=this.aPopups[i].aItems[j];
if(it._sTLnk&&it._sTLnk!="#_nolink"&&this.fbCkLnk(it._sTLnk,it.sTar,c,window)){
is[it.sUid]=it;
ps[i]=1;
}
}
}
}
if(this.iTracks&16777216){
for(var i in is){
is[i].sLnk="#_nolink";
is[i].fbSetCursor(this.aCursors[0]);
}
}
if(this.iTracks&67108864){
for(var i in is){
it=is[i];
while(it){
ts.push(it);
it=it.oParPopup.oParItem;
}
}
for(var i=0;i<ts.length;i++){
if(!is[ts[i].sUid]){
is[ts[i].sUid]=ts[i];
}
}
}
for(var i in this.oTracks){
if(!is[i]){
if((this.iTracks&16777216)&&this.oTracks[i]._sTLnk&&this.oTracks[i]._sTLnk!="#_nolink"){
this.oTracks[i].sLnk=this.oTracks[i]._sTLnk;
this.oTracks[i].fbSetCursor(this.aCursors[1]);
}
this.oTracks[i].fbUpDate(this.oTracks[i].iStat&(_ic.MAXSTATE-this.TRACK_STYLE-_ic.TRACK));
delete this.oTracks[i];
}
}
if(this.bTab){
if(this.oSel){
this.oSel.fbSetOut();
if(this.oSel.oParPopup&&this.oSel.oParPopup.oParItem){
this.oSel.oParPopup.oParItem.fbSetOut();
}
}
}
for(var i in is){
if(this.bTab&&is[i].oSubPopup){
if(!(is[i].oSubPopup.iStat&_r.UI.CUIPopup.SHOW)){
is[i].oSubPopup.fbShow();
}
}
if(is[i].iStat&_ic.TRACK){
continue;
}
is[i].fbUpDate(is[i].iStat|_ic.TRACK_STYLE|_ic.TRACK);
if(this.bTab){
for(var k=0;k<this.aPopups[0].aItems.length;k++){
var pp=this.aPopups[0].aItems[k].oSubPopup;
if(pp&&is[i].fbRotItem()!=this.aPopups[0].aItems[k].fbRotItem()){
pp.fbHide();
}
}
this.oSel=is[i];
is[i].fbSetOver();
}
this.oTracks[i]=is[i];
}
if(this.iTracks&134217728){
for(var i=this.aPopups.length-1;i>0;i--){
if(ps[i]&&this.aPopups[i].oParPopup){
ps[this.aPopups[i].oParPopup.iNid]=1;
}else{
if(typeof ps[i]=="undefined"){
ps[i]=0;
}
}
}
for(var i=1;i<ps.length;i++){
if(ps[i]&&(!(this.iTracks&268435456)||(this.iTracks&268435456)&&this.aPopups[i].iDepth<this.iTrackLevel)){
if(!(this.aPopups[i].iStat&_STNS.UI.CUIPopup.SHOW)){
this.aPopups[i].fbShow(d);
d+=(this.aPopups[i].sShEff?this.aPopups[i].iEffDur:0)+300;
}
}else{
if(this.aPopups[i].iStat&_STNS.UI.CUIPopup.SHOW){
this.aPopups[i].fbHide();
}
}
}
this.iDelayTk=d+1000;
}
};
CUIMenu.fbCkLnk=function(h,t,c,w){
if(!t){
w=w;
}else{
if(t=="_self"){
w=w;
}else{
if(t=="_parent"){
w=w.parent;
}else{
if(t=="_top"){
w=w.top;
}else{
if(w.frames[t]){
w=w.frames[t];
}else{
if(w.parent.frames[t]){
w=w.parent.frames[t];
}else{
return false;
}
}
}
}
}
}
var u=w.location.href;
if(!c){
u=u.toLowerCase();
h=h.toLowerCase();
}
return u&&h&&(u==h||u==h+"/"||u==h+"#"||STM_ILINK&&u==h.substr(0,Math.max(0,h.indexOf("?")))||STM_ILOC&&h==u.substr(0,Math.max(0,u.indexOf("?"))));
};
CUIMenu.foInsTab=function(){
var p=this.aPopups[0];
for(var i=0;i<p.aItems.length;i++){
if(typeof p.aItems[i].sTxt!="undefined"){
var pi=p.aItems[i];
if(pi){
pi.fbSetOver();
if(pi.oSubPopup){
pi.oSubPopup.fbShow();
}
return true;
}
}
}
};
CUIMenu.fbDelPopup=function(p){
};
CUIMenu.fbClick=function(_7b){
for(var k=0;k<_STNS._aStMenus.length;k++){
var m=_STNS._aStMenus[k];
if(m.bTab){
m.oFocus=0;
continue;
}
if(!(m.iStat&_STNS.UI.CUIMenu.MOUSEOVER)){
var o=m.oFocus;
if(o){
o.fbFireEnt("mouseout");
if(_STNS.UI.CUICanvas){
return;
}
var p=o.oParPopup,pp=o,d=p.iDepth;
if(d>=1){
for(var i=d;i>0;i--){
pp=pp.oParPopup;
pp.fbHide();
}
}
var ri=o.fbRotItem(),si=ri.oSubPopup;
if(si){
si.fbHide();
}
ri.fbFireEnt("mouseout");
m.oFocus=0;
}
}
}
};
CUIMenu.fbKeydown=function(_85){
var e=_85?_85:window.event;
if(e.altKey&&e.keyCode==113){
if(typeof (_STNS.index)=="undefined"){
_STNS.index=0;
}else{
if(_STNS.index<_STNS._aStMenus.length-1){
_STNS.index++;
}else{
_STNS.index=0;
}
}
var x=_STNS.index,_r=_STNS,m=_r._aStMenus[x],p=m.aPopups[0],o=m.oFocus;
m.bRunEff=false;
m.fbClick();
if(o){
o.fbFireEnt("mouseout");
}
if(m.iClk&1){
m.bClked=true;
}
if(m.bTab){
if(m.oSel){
m.oSel.fbFireEnt("mouseover");
m.oSel.fbSetfs();
m.oFocus=m.oSel;
}
m.bRunEff=true;
return;
}
for(var j=0;j<p.aItems.length;j++){
if(typeof p.aItems[j].sTxt!="undefined"){
var i=p.aItems[j];
break;
}
}
if(i){
if(i.oSubPopup){
i.oSubPopup.fbHide();
}
if(!_STNS.UI.CUICanvas){
i.fbSetOver();
if(i.oSubPopup){
i.oSubPopup.fbShow();
}
}
i.fbSetfs();
}
if(_STNS.UI.CUICanvas&&m.oFocus){
m.oFocus.fbSetfs();
m.oFocus.fbFireEnt("mousedown",8);
}
m.bRunEff=true;
}
};
_STNS.UI.CUIPopup=_STNS.Class(_STNS.UI.CUIObj);
CUIPopup.register("UI/CUIObj>CUIPopup");
CUIPopup.construct=function(){
this._tTid=0;
this.iTyp=0;
this.iNid=-1;
this.aItems=[];
this.sId=0;
this.iDirect=1;
this.iWid=-1;
this.iHei=-1;
this.iOffX=0;
this.iOffY=0;
this.iSpace=0;
this.iPad=0;
this.sBgClr="";
this.sBgImg="";
this.iBgRep=0;
this.iBdStyle=0;
this.iBdWid=0;
this.sBdClr="";
this.iZid=1000;
this.iStat=0;
this.oParItem=0;
this.oParMenu=0;
this.oParPopup=0;
this.iHal=0;
this.iDepth=0;
this.iOpac=100;
this.iShadow=0;
this.iSdSize=0;
this.sSdClr="";
this.iEffDur=0;
this.bShInit=false;
this.bHdInit=false;
this.sShEff=0;
this.iShEff=-1;
this.sHdEff=0;
this.iHdEff=-1;
this.iShEffect=0;
this.iHdEffect=0;
this.aRounds=[];
this.aRWids=[];
this.aRHeis=[];
this.aRdb=[];
this.aRBgClrs=[];
this.aRBgImgs=[];
this.aRBgReps=[];
this.aCorners=[];
this.aCorWHs=[];
this.aScBars=[];
this.iMaxSize=-1;
this.iScr=0;
this.bflg=true;
this.bMul=false;
this.iMl=2;
this.sMBgClrs="#000000";
this.sMOpc=0;
this.iMSpc=1;
this.sMBgImgs="";
this.sMBgReps="no-repeat";
with(_STNS.UI.CUIPopup){
this.fsGetHTML=fsGetHTML;
this.fbGetEnt=fbGetEnt;
this.fbSetOver=fbSetOver;
this.fbSetOut=fbSetOut;
this.fbCreate=fbCreate;
this.fbInit=fbInit;
this.fbShow=fbShow;
this.fbShowX=fbShowX;
this.fbHide=fbHide;
this.fbHideX=fbHideX;
this.fbOnShow=fbOnShow;
this.fbOnHide=fbOnHide;
this.faGetXY=faGetXY;
this.foInsItem=foInsItem;
this.fbDelItem=fbDelItem;
this.fvDestroy=fvDestroy;
this.faGetSwh=faGetSwh;
this.fvScr=fvScr;
this.fvClearScr=fvClearScr;
this.fbCheckClkSet=fbCheckClkSet;
this.fvHdWels=fvHdWels;
this.fvShWels=fvShWels;
this.fvWtag=fvWtag;
this.fbWover=fbWover;
}
};
CUIPopup.CROSSFRAME=1;
CUIPopup.SHOW=2;
CUIPopup.MOUSEOVER=4;
with(CUIPopup){
CUIPopup.MAXSTATE=CROSSFRAME|SHOW|MOUSEOVER;
}
CUIPopup.VERTICAL=1;
CUIPopup.STATIC=2;
CUIPopup.DIRECTION_LEFT=1;
CUIPopup.DIRECTION_RIGHT=2;
CUIPopup.DIRECTION_UPLEFT=3;
CUIPopup.DIRECTION_DOWNLEFT=4;
CUIPopup.DIRECTION_UPRIGHT=5;
CUIPopup.DIRECTION_DOWNRIGHT=6;
CUIPopup.fsGetHTML=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,m=this.oParMenu,_mc=_r.UI.CUIMenu,s="",scs,its,cf=this.iStat&_c.CROSSFRAME,fs="",v=this.iTyp&_c.VERTICAL,sc=this.aScBars.length?this.aScBars:m.aScBars,_99=m.iWid&&!this.iNid&&!v;
with(this){
var _9a=_9b=isAllSW=0,_9c,_9d=_r.bIsSF&&this.bMul;
for(var i=0;i<aItems.length;i++){
if(aItems[i].iWid&&aItems[i].iWid!=-1){
_9a++;
}
}
_9b=aItems.length-_9a;
if(_9b){
_9c=Math.ceil(100/_9b)+"%";
}
isAllSW=_9a==aItems.length;
if(this.bMul){
_9d?this.tr=[]:"";
var _9f=bMul?v?1:0:0,_a0=bMul?!v?1:0:0,_ml=iMl,_a2=iMSpc,_a3=aItems.length,_a4=Math.ceil(aItems.length/_ml),_a5=Math.floor(aItems.length/_ml),_a6=_a4==_a5?0:aItems.length%_ml,_a7=aItems.length<_ml?aItems.length:_ml;
}
if(_a0){
var _9b=0,_9c,a=[];
for(var i=0;i<_a7;i++){
var per=false;
for(var j=i;j<=(i+1+_a7*(_a4-1));j+=_a7){
if(aItems[j]){
if(aItems[j].iWid!="100%"){
per=true;
break;
}
}
}
if(!per){
_9b++;
a.push(i);
}
}
if(_9b){
_9c=Math.ceil(100/_9b)+"%";
}
}
its="<table cellpadding=0 cellspacing="+iSpace+(!this.iNid&&m.iHal?" align='"+_mc.ALIGNS[m.iHal]:"")+"' id='"+sUid+"_body' "+m.fsGetStyle("tb",cf,(m.bTab&&iDepth>0?_r.bIsOP&&_r.oNav.version>=9.5?m.iTabHei?"height:"+m.iTabHei+"px;":"":"height:100%;":"")+(_99?bMul?_9b?"width:100%;":"":isAllSW?"":"width:100%;":""))+">";
if(_a0){
var _tc=0;
for(var c=0;c<_a4;c++){
its+="<tr "+m.fsGetStyle("tr",cf)+">";
for(var j=_tc;j<_tc+_a7;j++){
if(_a3>0){
if(!c){
var ad=false;
for(var t=0;t<a.length;t++){
j==a[t]?ad=true:"";
}
}
its+="<td "+(_9d?"id='"+sUid+"_td"+aItems[j].iNid+"' ":"")+(typeof (aItems[j].sTxt)=="undefined"?"align=center ":"align=left")+m.fsGetStyle("td",cf,((aItems[j].iWid&&aItems[j].iWid!=-1&&aItems[j].iWid!="100%"&&!aItems[j].iTyp&&typeof (aItems[j].sTxt)!="undefined")?"width:1px;":!c?ad&&_99?"width:"+_9c+";":"":""))+" valign='middle'>"+aItems[j].fsGetHTML()+"</td>";
if(_9d){
if(!this.tr[c]){
this.tr[c]=[];
}
this.tr[c].push(aItems[j].iNid);
}
_a3--;
}
}
_tc=_tc+_a7;
its+="</tr>";
_a3>0&&_a2>0?its+="<tr "+m.fsGetStyle("tr",cf)+"><td colspan="+_a7+" style=\""+(sMBgClrs?"background-color:"+sMBgClrs+";":"")+"background-image:url("+(cf?_r.fsGetAbsPth(sMBgImgs):sMBgImgs)+");background-repeat:"+sMBgReps+";background-position:center;height:"+_a2+"px"+"\"></td></tr>":"";
}
}else{
if(_9f){
var _af=_r.bIsFX&&_r.oNav.version<=20021130;
_tprs=_a4==_a5?0:aItems.length%_ml;
for(var c=0;c<_a7;c++){
its+="<tr "+m.fsGetStyle("tr",cf)+">";
var _b0=0;
for(var j=0;j<(_a6==0?_a4:_tprs>0?_a4:_a5);j++){
if(_a3>0){
_b0=j==0?c:_b0+_a7;
its+="<td "+(_9d?"id='"+sUid+"_td"+aItems[_b0].iNid+"' ":"")+m.fsGetStyle("td",cf,(aItems[_b0].iWid&&aItems[_b0].iWid!=-1&&aItems[_b0].iWid!="100%"?"width:1px;":""))+" valign='middle'>"+aItems[_b0].fsGetHTML()+"</td>";
if(_9d){
if(!this.tr[c]){
this.tr[c]=[];
}
this.tr[c].push(aItems[_b0].iNid);
}
_a3--;
}
c==0&&j<_a4-1&&_a2>0?(its+="<td rowspan="+_a7+" style=\""+(sMBgClrs?"background-color:"+sMBgClrs+";":"")+"background-image:url("+(cf?_r.fsGetAbsPth(sMBgImgs):sMBgImgs)+");background-repeat:"+sMBgReps+";background-position:center;\"><div style='width:"+_a2+"px;'></div></td>"):"";
}
_tprs>0?_tprs--:"";
its+="</tr>";
}
}else{
for(var j=0;j<aItems.length;j++){
if(_99){
its+=(v?"<tr "+m.fsGetStyle("tr",cf)+">":"")+"<td "+m.fsGetStyle("td",cf,(aItems[j].iWid&&aItems[j].iWid!=-1?"":"width:"+_9c+";"))+">"+aItems[j].fsGetHTML()+"</td>"+(v?"</tr>":"");
}else{
its+=(v?"<tr "+m.fsGetStyle("tr",cf)+">":"")+"<td "+m.fsGetStyle("td",cf)+">"+aItems[j].fsGetHTML()+"</td>"+(v?"</tr>":"");
}
}
}
}
its+="</table>";
scs=sc[0]&&sc[1]?("<table cellpadding=0 cellspacing=0 "+"id='"+sUid+"_scfm' "+m.fsGetStyle("tb",cf)+">"+(v?"<tr "+m.fsGetStyle("tr",cf)+">":"")+"<td id='"+sUid+"_sc0' "+m.fsGetStyle("td",cf)+">"+sc[0].fsGetHTML()+"</td>"+(v?"</tr>":"")+"<td "+m.fsGetStyle("td",cf,"valign:middle;")+">"+"<div id='"+sUid+"_scc' "+m.fsGetStyle("dv",cf)+">"+its+"</div>"+"</td>"+(v?"<tr "+m.fsGetStyle("tr",cf)+">":"")+"<td id='"+sUid+"_sc1' "+m.fsGetStyle("td",cf)+">"+sc[1].fsGetHTML()+"</td>"+(v?"</tr>":"")+"</table>"):its;
if(_STNS.bIsIE&&(iOpac<100&&iOpac>-1||_STNS.oNav.version>=5.5&&iShadow&&iSdSize)){
fs="filter:"+(iOpac<100&&iOpac>-1?"Alpha(opacity="+iOpac+") ":"")+(_STNS.oNav.version>=5.5&&iShadow&&iSdSize?(iShadow==1?"progid:DXImageTransform.Microsoft.dropshadow(color="+sSdClr+",offx="+iSdSize+",offy="+iSdSize+",positive=1)":"progid:DXImageTransform.Microsoft.Shadow(color="+sSdClr+",direction=135,strength="+iSdSize+")"):"")+";";
}else{
if(_STNS.oNav.name=="gecko"&&_STNS.oNav.version>=20060414){
fs=iOpac<100&&iOpac>-1?"-moz-opacity:"+iOpac/100+";":"";
}
}
s+=(iTyp&_c.STATIC?"":"<div "+"id='"+sUid+"_dv' "+m.fsGetStyle("dv",cf,"visibility:hidden;"+((!m.bTab?"position:absolute;":"")+(m.bTab?"width:100%;":"")+"left:0px;"+"top:-9999px;"+"z-index:"+iZid+";"))+">")+"<table cellpadding=0 cellspacing=0"+" id='"+sUid+"' "+m.fsGetStyle("tb",cf,(!m.bTab||(m.bTab&&iDepth==0)?fs:"")+(((iTyp&_c.STATIC)&&!(_r.bIsOP&&_r.oNav.version<9))?"visibility:hidden;":"")+(!m.bTab||(m.bTab&&iDepth==0)?(iBdStyle>0&&iBdWid>0?"border-width:"+iBdWid+"px;border-style:"+_mc.BORDERS[iBdStyle]+";border-color:"+sBdClr+";":""):"")+(m.bTab?"width:100%;height:100%;":(!m.iTyp&&iWid&&iWid!=-1?"width:"+_r.fsGetLen("tb",iWid,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1)+";":"")+(!m.iTyp&&iHei&&iHei!=-1?"height:"+_r.fsGetLen("tb",iHei,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1,0)+";":"")))+" "+(!m.iTyp&&!this.iNid&&m.iHal?"align="+_mc.ALIGNS[m.iHal]:"")+" "+m.fsGetEnt(this,"mouseover","",cf)+" "+m.fsGetEnt(this,"mouseout","",cf)+">"+(aRHeis[0]&&aRHeis[0]!=-1||(aRHeis[0]==-1&&(aCorners[0]||aCorners[1]||aRounds[0]))?"<tr "+m.fsGetStyle("tr",cf)+">"+(aRWids[3]&&aRWids[3]!=-1||(aRWids[3]==-1&&(aCorners[0]||aCorners[3]||aRounds[3]))?"<td "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRWids[3]&&aRWids[3]!=-1?"width:"+_r.fsGetLen("td",aRWids[3])+";":"width:1px;")+(aRHeis[0]&&aRHeis[0]!=-1?"height:"+_r.fsGetLen("td",aRHeis[0],0,0,1,0)+";":""))+">"+m.fsGetImgTag(aCorners[0],aRWids[3],aRHeis[0],0,null,cf,aCorWHs[0],aCorWHs[1])+"</td>":"")+"<td id='"+sUid+"d0' "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRBgClrs[0]?"background-color:"+aRBgClrs[0]+";":"")+(aRBgImgs[0]?"background-image:url("+(cf?_r.fsGetAbsPth(aRBgImgs[0]):aRBgImgs[0])+");background-repeat:"+_mc.REPEATS[aRBgReps[0]]:""))+">"+m.fsGetImgTag(aRounds[0],aRWids[0],aRHeis[0],0,null,cf)+"</td>"+(aRWids[1]&&aRWids[1]!=-1||(aRWids[1]==-1&&(aCorners[1]||aCorners[2]||aRounds[1]))?"<td "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRWids[1]&&aRWids[1]!=-1?"width:"+_r.fsGetLen("td",aRWids[1])+";":"width:1px;")+(aRHeis[0]&&aRHeis[0]!=-1?"height:"+_r.fsGetLen("td",aRHeis[0],0,0,1,0)+";":""))+">"+m.fsGetImgTag(aCorners[1],aRWids[1],aRHeis[0],0,null,cf,aCorWHs[2],aCorWHs[3])+"</td>":"")+"</tr>":"")+"<tr "+m.fsGetStyle("tr",cf)+">"+(aRWids[3]&&aRWids[3]!=-1||(aRWids[3]==-1&&(aCorners[0]||aCorners[3]||aRounds[3]))?"<td id='"+sUid+"d3' "+m.fsGetStyle("td",cf,"width:1px;font-size:1px;"+(aRBgClrs[3]?"background-color:"+aRBgClrs[3]+";":"")+(aRBgImgs[3]?"background-image:url("+(cf?_r.fsGetAbsPth(aRBgImgs[3]):aRBgImgs[3])+");background-repeat:"+_mc.REPEATS[aRBgReps[3]]:""))+">"+m.fsGetImgTag(aRounds[3],aRWids[3],aRHeis[3],0,null,cf)+"</td>":"")+"<td "+m.fsGetStyle("td",cf,(_99&&_STNS.bIsOP&&_STNS.oNav.version<=7.54?"width:100%;":"")+(m.iTab&&iDepth>0&&m.iTabHei?"height:"+(m.iTabHei-2*m.aPopups[1].iBdWid)+"px;":"")+(!m.iTab||(m.iTab&&iDepth==0)?((sBgClr?"background-color:"+sBgClr+";":"")+(sBgImg?"background-image:url("+(cf?_r.fsGetAbsPth(sBgImg):sBgImg)+");background-repeat:"+_mc.REPEATS[iBgRep]+";":"")):""))+">"+scs+"</td>"+(aRWids[1]&&aRWids[1]!=-1||(aRWids[1]==-1&&(aCorners[1]||aCorners[2]||aRounds[1]))?"<td id='"+sUid+"d1' "+m.fsGetStyle("td",cf,"width:1px;font-size:1px;"+(aRBgClrs[1]?"background-color:"+aRBgClrs[1]+";":"")+(aRBgImgs[1]?"background-image:url("+(cf?_r.fsGetAbsPth(aRBgImgs[1]):aRBgImgs[1])+");background-repeat:"+_mc.REPEATS[aRBgReps[1]]:""))+">"+m.fsGetImgTag(aRounds[1],aRWids[1],aRHeis[1],0,null,cf)+"</td>":"")+"</tr>"+(aRHeis[2]&&aRHeis[2]!=-1||(aRHeis[2]==-1&&(aCorners[3]||aCorners[2]||aRounds[2]))?"<tr "+m.fsGetStyle("tr",cf)+">"+(aRWids[3]&&aRWids[3]!=-1||(aRWids[3]==-1&&(aCorners[0]||aCorners[3]||aRounds[3]))?"<td "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRWids[3]&&aRWids[3]!=-1?"width:"+_r.fsGetLen("td",aRWids[3])+";":"width:1px;")+(aRHeis[2]&&aRHeis[2]!=-1?"height:"+_r.fsGetLen("td",aRHeis[2],0,0,1,0)+";":""))+">"+m.fsGetImgTag(aCorners[3],aRWids[3],aRHeis[2],0,null,cf,aCorWHs[6],aCorWHs[7])+"</td>":"")+"<td id='"+sUid+"d2' "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRBgClrs[2]?"background-color:"+aRBgClrs[2]+";":"")+(aRBgImgs[2]?"background-image:url("+(cf?_r.fsGetAbsPth(aRBgImgs[2]):aRBgImgs[2])+");background-repeat:"+_mc.REPEATS[aRBgReps[2]]:""))+">"+m.fsGetImgTag(aRounds[2],aRWids[2],aRHeis[2],0,null,cf)+"</td>"+(aRWids[1]&&aRWids[1]!=-1||(aRWids[1]==-1&&(aCorners[1]||aCorners[2]||aRounds[1]))?"<td "+m.fsGetStyle("td",cf,"font-size:1px;"+(aRWids[1]&&aRWids[1]!=-1?"width:"+_r.fsGetLen("td",aRWids[1])+";":"width:1px;")+(aRHeis[2]&&aRHeis[2]!=-1?"height:"+_r.fsGetLen("td",aRHeis[2],0,0,1,0)+";":""))+">"+m.fsGetImgTag(aCorners[2],aRWids[1],aRHeis[2],0,null,cf,aCorWHs[4],aCorWHs[5])+"</td>":"")+"</tr>":"")+"</table>"+(iTyp&_c.STATIC?m.iHal==2&&(_r.bIsIE||_r.bIsOP)?"<br clear='both'/>":"":"</div>"+(!m.bTab&&m.bWe?"<iframe id="+sUid+"_iframe"+" style='position:absolute;left:0px;top:-9999px;width:1px;height:1px;z-index:999;filter:Alpha(opacity=0)'></iframe>":""));
}
return s;
};
CUIPopup.fbGetEnt=function(e,o){
var et=e.type||e,oid=o.id,_r=_STNS,_c=_r.UI.CUIPopup;
with(this){
switch(et){
case "mouseover":
if(!o._ov&&((_r.bIsIE&&e.srcElement&&_r.fbIsPar(o,e.srcElement))||(!_r.bIsIE&&e.target&&_r.fbIsPar(o,e.target)))){
o._ov=1;
this.iStat|=_c.MOUSEOVER;
return fbFireEnt("mouseover");
}
break;
case "mouseout":
if(o._ov&&((_r.bIsIE&&(!e.toElement||!_r.fbIsPar(o,e.toElement)))||!_r.bIsIE&&(!e.relatedTarget||!_r.fbIsPar(o,e.relatedTarget)))){
o._ov=0;
this.iStat&=_c.MAXSTATE-_c.MOUSEOVER;
return fbFireEnt("mouseout");
}
break;
case "keydown":
return fbFireEnt("keydown",e.keyCode);
default:
return fbFireEnt(et);
}
}
return true;
};
CUIPopup.fvDestroy=function(){
for(var i=0;i<this.aItems.length;i++){
this.aItems[i].fvDestroy();
}
_STNS.UI.CUIObj.fvDestroy.call(this);
};
CUIPopup.fbCreate=function(w){
if(!w){
w=window;
}
var s,d=w.document,_c=_STNS.UI.CUIPopup;
try{
if(w!=window){
this.iStat|=_c.CROSSFRAME;
for(var i=0;i<this.aItems.length;i++){
this.aItems[i].iStat|=this.aItems[i].getClass().CROSSFRAME;
}
for(var j=0;j<this.aScBars.length;j++){
this.aScBars[j].iStat|=_STNS.UI.CUIItem.CROSSFRAME;
}
}
if(this.oParMenu.bTab){
var tb2=_STNS.fdmGetEleById(this.oParPopup.sUid+"_tb2",w);
tb2.innerHTML=this.fsGetHTML();
}else{
_STNS.fbInsHTML(d.body,"afterBegin",this.fsGetHTML());
}
return true;
}
catch(e){
if(w!=window){
this.iStat&=_c.MAXSTATE-_c.CROSSFRAME;
for(var i=0;i<this.aItems.length;i++){
this.aItems[i].iStat&=_STNS.UI.CUIItem.MAXSTATE-_STNS.UI.CUIItem.CROSSFRAME;
}
}
return false;
}
};
CUIPopup.fbShow=function(d){
var _r=_STNS,_c=_r.UI.CUIPopup,s=this.iStat&_c.SHOW,m=this.oParMenu;
clearTimeout(this._tTid);
if(s&&!this.oParMenu.bTab){
return true;
}
if(!d){
return this.fbOnShow();
}else{
if(d){
this._tTid=setTimeout(this.sSelf+".fbShow()",d);
}
}
return true;
};
CUIPopup.fbOnShow=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,m=this.oParMenu,w=this.iNid&&m.bCfm?m.fdmGetTarFm():window,f=false,e;
if(!(e=_r.fdmGetEleById(this.sUid,w))){
if(!w&&m.bCfm&&!m.bCfShow){
return false;
}
f=this.fbCreate(w);
if(f){
this.bShInit=false;
this.bHdInit=false;
this.fbInit();
e=_r.fdmGetEleById(this.sUid,w);
}
}
if(!e&&!f&&m.bCfm&&m.bCfShow){
w=window;
if(!(e=_r.fdmGetEleById(this.sUid))){
f=this.fbCreate();
if(f){
this.bShInit=false;
this.bHdInit=false;
this.fbInit();
e=_r.fdmGetEleById(this.sUid);
}
}
}
if(this.aScBars!=""){
this.faGetSwh();
}
if(!m.bTab&&m.aHdTags.length){
this.fvHdWels();
}
if(e){
if(this.bHdInit&&this.sHdEff&&typeof this.sHdEff=="object"&&_STNS.EFFECT){
this.sHdEff.fbStop();
}
if(STM_bIE8RC&&this.iHdEffect==1){
_r.fdmGetEleById(this.sUid,w).style.visibility="visible";
}
if(!(this.iTyp&_c.STATIC)){
var pos=this.faGetXY(1);
e=_STNS.bIsIE?e.parentElement:e.parentNode;
if(m.bRunEff&&this.sShEff&&typeof this.sShEff=="string"&&_STNS.EFFECT){
var flt=_STNS.EFFECT.foGetEff(this.sShEff,this.sUid+"_dv",w,this.iEffDur,this.iShEff);
if(flt){
this.sShEff=flt;
if(this.sShEff.fbSet()){
this.sShEff.fbApply();
this.sShEff.fbSetStyle("left:"+pos[0]+"px;top:"+pos[1]+"px;visibility:visible;");
this.sShEff.fbPlay();
this.iStat|=_c.SHOW;
this.bShInit=true;
return f;
}else{
this.sShEff.fbDel();
this.sShEff="";
}
}
}else{
if(m.bRunEff&&typeof this.sShEff=="object"){
var tf=true;
if(this.sShEff.dmWin!=w||!this.bShInit){
tf=this.sShEff.fbSet();
if(tf){
this.bShInit=true;
}
}
if(tf){
this.sShEff.fbApply();
this.sShEff.fbSetStyle("left:"+pos[0]+"px;top:"+pos[1]+"px;visibility:visible;");
this.sShEff.fbPlay();
this.iStat|=_c.SHOW;
return f;
}
}
}
e.style.left=pos[0]+"px";
e.style.top=pos[1]+"px";
e.style.visibility="visible";
}else{
if(m.bRunEff&&this.sShEff&&typeof this.sShEff=="string"&&_STNS.EFFECT){
var flt=_STNS.EFFECT.foGetEff(this.sShEff,this.sUid,w,this.iEffDur,this.iShEff);
if(flt){
this.sShEff=flt;
if(this.sShEff.fbSet()){
this.sShEff.fbApply();
this.sShEff.fbSetStyle("visibility:visible;");
this.sShEff.fbPlay();
this.iStat|=_c.SHOW;
this.bShInit=true;
return f;
}else{
this.sShEff.fbDel();
this.sShEff="";
}
}
}else{
if(m.bRunEff&&typeof this.sShEff=="object"){
var tf=true;
if(this.sShEff.dmWin!=w||!this.bShInit){
tf=this.sShEff.fbSet();
if(tf){
this.bShInit=true;
}
}
if(tf){
this.sShEff.fbApply();
this.sShEff.fbSetStyle("visibility:visible;");
this.sShEff.fbPlay();
this.iStat|=_c.SHOW;
return f;
}
}
}
}
e.style.visibility=!(_r.bIsOP&&_r.oNav.version<9)?"visible":"";
}
m.bRunEff=true;
this.iStat|=_c.SHOW;
return f;
};
CUIPopup.fbShowX=function(d){
var _r=_STNS,_c=_r.UI.CUIPopup,s=this.iStat&_c.SHOW,m=this.oParMenu;
if(s){
clearTimeout(this._tTid);
return true;
}else{
if(!d){
var ps=[],p=this;
while(p){
ps.push(p);
p=p.oParItem?p.oParItem.oParPopup:0;
}
for(var i=ps.length-1;i>=0;i--){
ps[i].fbShow();
}
}else{
if(d){
this._tTid=setTimeout(this.sSelf+".fbShowX()",d);
}
}
}
return true;
};
CUIPopup.fbHide=function(d){
var _r=_STNS,_c=_r.UI.CUIPopup,_ic=_r.UI.CUIItem,s=this.iStat&_c.SHOW,m=this.oParMenu;
clearTimeout(this._tTid);
if(m.iClk&4){
if(!this.iDepth&&(this.iStat&_c.MOUSEOVER)){
return true;
}
}
if(!s){
d=0;
}
if(!d){
return this.fbOnHide();
}else{
if(d){
this._tTid=setTimeout(this.sSelf+".fbHide()",d);
}
}
return true;
};
CUIPopup.fbHideX=function(d,b,e,f){
var _r=_STNS,_c=_r.UI.CUIPopup,_ic=_r.UI.CUIItem,s=this.iStat&_c.SHOW,m=this.oParMenu,tp,pp=this,pi;
if(typeof f=="undefined"){
f=0;
}
if(e==null){
e=-1;
}
if(!d){
while(pp&&pp.iDepth<=b&&pp.iDepth>e){
clearTimeout(pp._tTid);
tp=pp;
if(pi=pp.oParItem){
pi.fbUpDate(pi.iStat&(_ic.MAXSTATE-_ic.MOUSEOVER_STYLE));
}
pp=pp.oParPopup;
}
if(m.bHdPopup||f){
if(tp){
tp.fbHide();
}else{
for(var i=0;i<this.aItems.length;i++){
if(this.aItems[i].oSubPopup){
this.aItems[i].oSubPopup.fbHide();
}
}
}
}
m.iStat&=_r.UI.CUIMenu.MAXSTATE-_r.UI.CUIMenu.MOUSEOVER;
m.bClked=false;
}
if(d){
this._tTid=setTimeout(this.sSelf+".fbHideX(0,"+b+","+e+","+f+")",d);
}
return true;
};
CUIPopup.fbOnHide=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,_ic=_r.UI.CUIItem,cf=this.iStat&_c.CROSSFRAME,w=cf?this.oParMenu.fdmGetTarFm():window,e,i,m=this.oParMenu;
for(i=0;i<this.aItems.length;i++){
if(this.aItems[i].oSubPopup){
this.aItems[i].oSubPopup.fbHide();
this.aItems[i].fbUpDate(this.aItems[i].iStat&(_ic.MAXSTATE-_ic.MOUSEOVER_STYLE));
}
}
if(!(this.iStat&_c.SHOW)){
return true;
}
if(!m.bTab&&m.aHdTags.length){
this.fvShWels();
}
if(e=_r.fdmGetEleById(this.sUid,w)){
if(this.bShInit&&this.sShEff&&typeof this.sShEff=="object"&&_STNS.EFFECT){
this.sShEff.fbStop();
}
if(this.iTyp&_c.STATIC){
if(m.bRunEff&&this.sHdEff&&typeof this.sHdEff=="string"&&_STNS.EFFECT){
var flt=_STNS.EFFECT.foGetEff(this.sHdEff,this.sUid,w,this.iEffDur,this.iHdEff);
if(flt){
this.sHdEff=flt;
if(this.sHdEff.fbSet()){
this.sHdEff.fbApply();
this.sHdEff.fbSetStyle("visibility:hidden;");
this.sHdEff.fbPlay();
this.iStat&=_c.MAXSTATE-_c.SHOW;
this.bHdInit=true;
return true;
}else{
this.sHdEff.fbDel();
this.sHdEff="";
}
}
}else{
if(m.bRunEff&&typeof this.sHdEff=="object"){
var tf=true;
if(this.sHdEff.dmWin!=w||!this.bHdInit){
tf=this.sHdEff.fbSet();
if(tf){
this.bHdInit=true;
}
}
if(tf){
this.sHdEff.fbApply();
this.sHdEff.fbSetStyle("visibility:hidden;");
this.sHdEff.fbPlay();
this.iStat&=_c.MAXSTATE-_c.SHOW;
return true;
}
}
}
e.style.visibility="hidden";
}else{
var pos=this.faGetXY(1);
if(m.bRunEff&&this.sHdEff&&typeof this.sHdEff=="string"&&_STNS.EFFECT){
var flt=_STNS.EFFECT.foGetEff(this.sHdEff,this.sUid+"_dv",w,this.iEffDur,this.iHdEff);
if(flt){
this.sHdEff=flt;
if(this.sHdEff.fbSet()){
this.sHdEff.fbApply();
this.sHdEff.fbSetStyle("left:"+pos[0]+"px;top:"+pos[1]+"px;visibility:hidden;");
if(STM_bIE8RC&&this.iHdEffect==1){
_r.fdmGetEleById(this.sUid,w).style.visibility="hidden";
}
this.sHdEff.fbPlay();
this.iStat&=_c.MAXSTATE-_c.SHOW;
this.bHdInit=true;
return true;
}else{
this.sHdEff.fbDel();
this.sHdEff="";
}
}
}else{
if(m.bRunEff&&typeof this.sHdEff=="object"){
var tf=true;
if(this.sHdEff.dmWin!=w||!this.bHdInit){
tf=this.sHdEff.fbSet();
if(tf){
this.bHdInit=true;
}
}
if(tf){
this.sHdEff.fbApply();
this.sHdEff.fbSetStyle("left:"+pos[0]+"px;top:"+pos[1]+"px;visibility:hidden;");
if(STM_bIE8RC&&this.iHdEffect==1){
_r.fdmGetEleById(this.sUid,w).style.visibility="hidden";
}
this.sHdEff.fbPlay();
this.iStat&=_c.MAXSTATE-_c.SHOW;
return true;
}
}
}
if(_STNS.bIsIE){
e.parentElement.style.visibility="hidden";
}else{
e.parentNode.style.visibility="hidden";
}
}
}
this.iStat&=_c.MAXSTATE-_c.SHOW;
return true;
};
CUIPopup.fbCheckClkSet=function(){
if(!(p.oParMenu.iStat&_STNS.UI.CUIMenu.MOUSEOVER)){
p.oParMenu.bClked=false;
}
return true;
};
CUIPopup.fbSetOver=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,_ic=_r.UI.CUIItem,p=this,m=this.oParMenu;
m.bOver=1;
if(m.CP){
m.CP=this;
}
this.oParMenu.iStat|=_r.UI.CUIMenu.MOUSEOVER;
if((m.iClk&1)&&!(m.iClk&2)&&!m.bClked){
return true;
}
while(p){
clearTimeout(p._tTid);
if(!m.bTab){
if(p.oParItem){
p.oParItem.fbUpDate(p.oParItem.iStat|_ic.MOUSEOVER_STYLE);
}
}
p=p.oParPopup;
}
return true;
};
CUIPopup.fbSetOut=function(){
var m=this.oParMenu,_r=_STNS;
m.bOver=0;
m.OutPopup=this;
if(m.bTab){
if(m.iTab==1&&this.iDepth==1){
var _ic=_r.UI.CUIItem;
for(var i=0;i<this.aItems.length;i++){
var pi=this.aItems[i];
if(typeof pi.sTxt!="undefined"){
pi.fbUpDate(pi.iStat&(_ic.MAXSTATE-_ic.MOUSEOVER_STYLE));
}
}
}
m.iStat&=_r.UI.CUIMenu.MAXSTATE-_r.UI.CUIMenu.MOUSEOVER;
m.bClked=false;
return true;
}
if(m.iTyp==3){
this.fbHideX(m.iDelayHd,this.iDepth);
}else{
if(m.iTyp==2&&STM_AHCM){
this.fbHideX(m.iDelayHd,this.iDepth);
}else{
this.fbHideX(m.iDelayHd,this.iDepth,0);
}
}
return true;
};
CUIPopup.fbInit=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,e,t,m=this.oParMenu,w=this.iStat&_c.CROSSFRAME?m.fdmGetTarFm():window;
if(this.bMul&&_r.bIsSF){
if(this.tr){
for(var i=0;i<this.tr.length;i++){
var _104=0,e;
for(var j=0;j<this.tr[i].length;j++){
e=_r.fdmGetEleById(this.sUid+"_td"+this.tr[i][j],w);
_104=Math.max(_104,e.offsetHeight);
}
this.tr[i].Maxtd=_104;
}
}
}
for(var i=0;i<this.aItems.length;i++){
this.aItems[i].fbInit();
}
for(var j=0;j<this.aScBars.length;j++){
this.aScBars[j].fbInit();
}
e=_r.fdmGetEleById(this.sUid,w);
if(e){
if(this.iHei=="100%"){
e.style.height=e.offsetParent.offsetHeight;
}
}
var _106=[_STNS.fiGetEleWid(_STNS.fdmGetEleById(this.sUid,w))+this.iSdSize,_STNS.fiGetEleHei(_STNS.fdmGetEleById(this.sUid,w))+this.iSdSize],_107=[_STNS.fiGetEleWid(_STNS.fdmGetEleById(this.sUid+"_body",w)),_STNS.fiGetEleHei(_STNS.fdmGetEleById(this.sUid+"_body",w))];
this.MaxScrWH=_106;
this.MaxDvWH=_107;
var sc=this.aScBars;
for(var i=0;i<2;i++){
if(sc[i]){
sc[i].img0=sc[i].aImgs[0];
sc[i].img1=sc[i].aImgs[1];
}
}
};
CUIPopup.faGetXY=function(f){
var _r=_STNS,_c=_r.UI.CUIPopup,pi=this.oParItem,m=this.oParMenu,e,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window,ip,iw=ih=0,pw,ph,x,y,cl=_r.fiGetCL(w),ct=_r.fiGetCT(w),cw=_r.fiGetCW(w),ch=_r.fiGetCH(w);
if(this.iTyp&_c.STATIC){
return [0,0];
}
if(!this.iNid){
x=eval(m.iX);
y=eval(m.iY);
if(!x){
x=0;
}
if(!y){
y=0;
}
return [x,y];
}
if(pi&&(e=_r.fdmGetEleById(pi.sUid,pi.iStat&_r.UI.CUIItem.CROSSFRAME?w:window))){
ip=_r.faGetElePos(e);
iw=_r.fiGetEleWid(e);
ih=_r.fiGetEleHei(e);
}else{
ip=[0,0];
}
e=_r.fdmGetEleById(this.sUid+"_dv",w);
if(e){
pw=_r.fiGetEleWid(e);
ph=_r.fiGetEleHei(e);
}else{
return [0,0];
}
switch(this.iDirect){
case _c.DIRECTION_LEFT:
x=ip[0]-pw;
y=ip[1];
break;
case _c.DIRECTION_RIGHT:
x=ip[0]+iw;
y=ip[1];
break;
case _c.DIRECTION_UPLEFT:
x=ip[0];
y=ip[1]-ph;
break;
case _c.DIRECTION_DOWNLEFT:
x=ip[0];
y=ip[1]+ih;
break;
case _c.DIRECTION_UPRIGHT:
x=ip[0]+iw-pw;
y=ip[1]-ph;
break;
case _c.DIRECTION_DOWNRIGHT:
x=ip[0]+iw-pw;
y=ip[1]+ih;
break;
}
if(cf&&this.oParPopup&&!this.oParPopup.iNid){
switch(m.iCfD){
case 0:
x+=cl;
y=ct;
break;
case 1:
x+=cl;
y=ct+ch-ph;
break;
case 2:
x=cl;
y+=ct;
break;
case 3:
x=cl+cw-pw;
y+=ct;
break;
}
x+=m.iCfX;
y+=m.iCfY;
if(m.sSrcFm){
var wcl=_STNS.fiGetCL(),wct=_STNS.fiGetCT();
if(!m.iCfD||m.iCfD==1){
x-=wcl;
}
if(m.iCfD==2||m.iCfD==3){
y-=wct;
}
}
}
x+=this.iOffX;
y+=this.iOffY;
if(f&&this.iNid){
if(STM_RTL&&_STNS.bIsIE&&_STNS.oNav.version>5){
cl=cw+cl-w.document.body.scrollWidth;
}
if(x+pw>cl+cw){
x=cw+cl-pw;
}
if(y+ph>ct+ch){
y=ct+ch-ph;
}
if(x<cl-this.iSdSize){
x=cl-this.iSdSize;
}
if(y<ct-this.iSdSize){
y=ct-this.iSdSize;
}
}
return [x,y];
};
CUIPopup.foInsItem=function(){
};
CUIPopup.fbDelItem=function(){
};
CUIPopup.faGetSwh=function(){
var _r=_STNS,_c=_r.UI.CUIPopup,v=this.iTyp&_c.VERTICAL,m=this.oParMenu,p=this,sc=this.aScBars.length?this.aScBars:m.aScBars,pd=this.iDirect,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window,f=false,e,_pi,pi=this.oParItem,ip,iw=ih=0;
this._sc=_r.fdmGetEleById(this.sUid+"_scc",w);
this._body=_r.fdmGetEleById(this.sUid+"_body",w);
this._pop=_r.fdmGetEleById(this.sUid,w);
this._sc.scrollTop=0;
this._sc.scrollLeft=0;
var sw=sc[0]&&sc[1]?[sc[0].iImgWid+2*sc[0].iImgBd+2*sc[0].iBdWid,sc[1].iImgWid+2*sc[1].iImgBd+2*sc[1].iBdWid]:[0,0],sh=sc[0]&&sc[1]?[sc[0].iImgHei+2*sc[0].iImgBd+2*sc[0].iBdWid,sc[1].iImgHei+2*sc[1].iImgBd+2*sc[1].iBdWid]:[0,0];
var d0=_r.fdmGetEleById(this.sUid+"d0",w),d1=_r.fdmGetEleById(this.sUid+"d1",w),d2=_r.fdmGetEleById(this.sUid+"d2",w),d3=_r.fdmGetEleById(this.sUid+"d3",w);
dec0=d0?[_r.fiGetEleWid(d0),_r.fiGetEleHei(d0)]:[0,0];
dec1=d1?[_r.fiGetEleWid(d1),_r.fiGetEleHei(d1)]:[0,0];
dec2=d2?[_r.fiGetEleWid(d2),_r.fiGetEleHei(d2)]:[0,0];
dec3=d3?[_r.fiGetEleWid(d3),_r.fiGetEleHei(d3)]:[0,0];
var dh=dec0[1]+dec2[1]+2*(p.iBdWid+p.iSdSize),dw=dec1[0]+dec3[0]+2*(p.iBdWid+p.iSdSize);
if(pi&&(_pi=_r.fdmGetEleById(pi.sUid,pi.iStat&_r.UI.CUIItem.CROSSFRAME?w:window))){
ip=_r.faGetElePos(_pi);
iw=_r.fiGetEleWid(_pi);
ih=_r.fiGetEleHei(_pi);
}else{
ip=[0,0];
}
var _134=_r.fiGetEleWid(this._body),_135=_r.fiGetEleHei(p._body);
if(!v){
var _136=this.MaxDvWH[0]+dw,_137=p.MaxScrWH[1]-dh;
CWid=_r.fiGetCW(w),CHei=_r.fiGetCH(w),CScrL=_r.fiGetCL(w);
if(cf){
if(this.oParPopup&&!this.oParPopup.iNid){
if(_138){
if(pd==1){
CWid=p.iOffX-CScrL;
}
if(pd==2){
CWid=CWid-p.iOffX;
}
}
}else{
if(pd==1){
CWid=ip[0]-CScrL+p.iOffX;
}
if(pd==2){
CWid=CWid+CScrL-ip[0]-iw-p.iOffX;
}
}
}else{
if(pd==1){
CWid=ip[0]-CScrL+p.iOffX;
}
if(pd==2){
CWid=CWid+CScrL-ip[0]-iw-p.iOffX;
}
}
var _138=this.aScBars[0].iScD;
_r.fdmGetEleById(p.sUid+"_sc0",w).style.display="";
_r.fdmGetEleById(p.sUid+"_sc1",w).style.display="";
if(_138&&_136>_138){
this._sc.style.width=(_138-(p.MaxScrWH[0]-_134))>=0?(_138-(p.MaxScrWH[0]-_134))+"px":"1px";
this._sc.style.height=_137+"px";
this._sc.style.overflow="hidden";
if(_r.bIsOP&&_r.oNav.version>=9){
var _139=_r.fdmGetEleById(this.sUid+"_dv",w);
if(_139){
_139.style.width=_139.childNodes[0].offsetWidth+"px";
}
}
}else{
if(!_138&&_136>CWid){
this._sc.style.width=(CWid-(p.MaxScrWH[0]-_134))>=0?(CWid-(p.MaxScrWH[0]-_134))+"px":"1px";
this._sc.style.height=_137+"px";
this._sc.style.overflow="hidden";
if(_r.bIsOP&&_r.oNav.version>=9){
var _139=_r.fdmGetEleById(this.sUid+"_dv",w);
if(_139){
_139.style.width=_139.childNodes[0].offsetWidth+"px";
}
}
}else{
this._sc.style.height=p.MaxDvWH[1]+"px";
this._sc.style.width=_134+"px";
_r.fdmGetEleById(p.sUid+"_sc0",w).style.display="none";
_r.fdmGetEleById(p.sUid+"_sc1",w).style.display="none";
}
}
}else{
var _137=p.MaxDvWH[1]+dh,_136=this.MaxScrWH[0]-dw;
CWid=_r.fiGetCW(w),CHei=_r.fiGetCH(w),CScrT=_r.fiGetCT(w);
if(cf){
if(this.oParPopup&&!this.oParPopup.iNid){
if(_13a){
if(pd==3){
CHei=p.iOffY-CScrT;
}
if(pd==4){
CHei=CHei-p.iOffY;
}
}
}else{
if(pd==3){
CHei=ip[1]-CScrT+p.iOffY;
}
if(pd==4){
CHei=CHei-ip[1]-ih-p.iOffY+CScrT;
}
}
}else{
if(pd==3){
CHei=ip[1]-CScrT+p.iOffY;
}
if(pd==4){
CHei=CHei-ip[1]-ih-p.iOffY+CScrT;
}
}
var _13a=this.aScBars[0].iScD;
_r.fdmGetEleById(p.sUid+"_sc0",w).parentNode.style.display="";
_r.fdmGetEleById(p.sUid+"_sc1",w).parentNode.style.display="";
if(_13a&&_137>_13a){
this._sc.style.height=(_13a-(p.MaxScrWH[1]-_135))>=0?(_13a-(p.MaxScrWH[1]-_135))+"px":"1px";
this._sc.style.width=_136+"px";
this._sc.style.overflow="hidden";
}else{
if(!_13a&&_137>CHei){
this._sc.style.height=(CHei-(p.MaxScrWH[1]-_135))>=0?(CHei-(p.MaxScrWH[1]-_135))+"px":"1px";
this._sc.style.width=_136+"px";
this._sc.style.overflow="hidden";
}else{
this._sc.style.height=_135+"px";
_r.bIsIE?this._sc.style.width=p.MaxDvWH[0]+"px":"";
_r.fdmGetEleById(p.sUid+"_sc0",w).parentNode.style.display="none";
_r.fdmGetEleById(p.sUid+"_sc1",w).parentNode.style.display="none";
}
}
}
_r.fiGetEleWid(_r.fdmGetEleById(this.sUid+"_dv",w));
for(var i=0;i<2;i++){
var oSc=_r.fdmGetEleById(p.sUid+"_sc"+i,w);
if(oSc){
oSc.onmouseover=Function(this.sSelf+".fvScr("+this.sSelf+",100,"+i+")");
oSc.onmousedown=Function(this.sSelf+".fvScr("+this.sSelf+",10,"+i+")");
oSc.onmouseup=Function(this.sSelf+".fvScr("+this.sSelf+",100,"+i+")");
oSc.onmouseout=Function(this.sSelf+".fvClearScr("+this.sSelf+")");
}
}
var te0,te1;
te0=sc[0]?_r.fdmGetEleById(sc[0].sUid+"_img",w):0;
te1=sc[1]?_r.fdmGetEleById(sc[1].sUid+"_img",w):0;
te0?te0.src=cf?_r.fsGetAbsPth(sc[0].img0):sc[0].img0:"";
te1?te1.src=cf?_r.fsGetAbsPth(sc[1].img1):sc[1].img1:"";
};
CUIPopup.fvScr=function(p,sp,d){
if(this.tScr){
clearTimeout(this.tScr);
}
var _r=_STNS,_c=_r.UI.CUIPopup,v=p.iTyp&_c.VERTICAL,cf=p.iStat&_c.CROSSFRAME,m=p.oParMenu,sc=p.aScBars.length?p.aScBars:m.aScBars,te0,te1,w=p.iStat&_c.CROSSFRAME?m.fdmGetTarFm():window,scc=_r.fdmGetEleById(p.sUid+"_scc",w),cw=p.MaxDvWH[0]-_r.fiGetEleWid(scc,w),ch=p.MaxDvWH[1]-_r.fiGetEleHei(scc,w);
te0=sc[0]?_r.fdmGetEleById(sc[0].sUid+"_img",w):0;
te1=sc[1]?_r.fdmGetEleById(sc[1].sUid+"_img",w):0;
if(cf){
sc[0].img0=_r.fsGetAbsPth(sc[0].img0);
sc[0].img1=_r.fsGetAbsPth(sc[0].img1);
sc[1].img0=_r.fsGetAbsPth(sc[1].img0);
sc[1].img1=_r.fsGetAbsPth(sc[1].img1);
}
if(v){
if(d){
scc.scrollTop+=4;
if(scc.scrollTop>=ch){
te1.src=sc[1].img0;
}else{
te0.src=sc[0].img1;
te1.src=sc[1].img1;
}
}else{
scc.scrollTop-=4;
if(scc.scrollTop<=0){
te0.src=sc[0].img0;
}else{
te0.src=sc[0].img1;
te1.src=sc[1].img1;
}
}
}else{
if(d){
scc.scrollLeft+=4;
if(scc.scrollLeft>=cw){
te1.src=sc[1].img0;
}else{
te0.src=sc[0].img1;
te1.src=sc[1].img1;
}
}else{
scc.scrollLeft-=4;
if(scc.scrollLeft<=0){
te0.src=sc[0].img0;
}else{
te0.src=sc[0].img1;
te1.src=sc[1].img1;
}
}
}
this.tScr=setTimeout(this.sSelf+".fvScr("+this.sSelf+","+sp+","+d+")",sp);
};
CUIPopup.fvClearScr=function(p){
if(this.tScr){
clearTimeout(this.tScr);
}
};
CUIPopup.fvHdWels=function(){
var _r=_STNS,m=this.oParMenu;
for(var i=0;i<m.aHdTags.length;i++){
if(m.bWe){
var _c=_r.UI.CUIPopup,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window;
p=_r.fdmGetEleById(this.sUid,w);
if(!p||(!this.oParMenu.iTyp&&!this.iNid)){
return false;
}
var pos=this.faGetXY(p),pw=_STNS.fiGetEleWid(p),ph=_STNS.fiGetEleHei(p);
var ifr=_r.fdmGetEleById(this.sUid+"_iframe",w);
if(!ifr){
return;
}
ifr.style.left=pos[0];
ifr.style.top=pos[1];
ifr.style.width=pw+"px";
ifr.style.height=ph+"px";
ifr.style.visibility="visible";
}else{
this.fvWtag(m.aHdTags[i],-1,this);
}
}
};
CUIPopup.fvShWels=function(){
var _r=_STNS,m=_r._aStMenus[_r._aStMenus.length-1];
for(var i=0;i<m.aHdTags.length;i++){
if(m.bWe){
var _c=_r.UI.CUIPopup,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window;
var ifr=_r.fdmGetEleById(this.sUid+"_iframe",w);
if(ifr){
ifr.style.visibility="hidden";
}
}else{
this.fvWtag(m.aHdTags[i],1,this);
}
}
};
CUIPopup.fvWtag=function(tg,c,p){
var _r=_STNS,m=this.oParMenu,_c=_r.UI.CUIPopup,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window,d=w.document;
var es=!_r.bIsIE?d.getElementsByTagName(tg):d.all.tags(tg);
p=_r.fdmGetEleById(p.sUid,w);
for(var j=0;j<es.length;++j){
var f=0,e=es.item(j),a;
if((tg=="object"||tg=="embed")&&!(_r.bIsOP||_r.bIsMIE)){
if(a=e.getAttribute("wmode")){
if(a.toLowerCase()=="transparent"||a.toLowerCase()=="opaque"){
continue;
}
}
}
for(var t=e.offsetParent;t;t=t.offsetParent){
if(t.id&&t.id.indexOf("stUI")>=0){
f=1;
}
}
if(f){
continue;
}else{
if(p&&this.fbWover(e,p)){
if(_r.bIsOP&&tg=="applet"){
var v;
if(v=parseInt(e.getAttribute("visLevel"))){
e.setAttribute("visLevel",v+c);
v+=c;
}else{
e.setAttribute("visLevel",c);
v=c;
}
if(v==-1){
if(e.getAttribute("visSave")){
e.setAttribute("visSave",e.style.visibility);
}
e.style.visibility="hidden";
if(typeof (p.mywehd)!="undefined"&&p.mywehd(e)){
return;
}
}else{
if(!v){
var bv=e.getAttribute("visSave");
e.style.visibility=bv?bv:"";
if(typeof (p.mywesh)!="undefined"&&p.mywesh(e)){
return;
}
}
}
}else{
if(e.visLevel){
e.visLevel+=c;
}else{
e.visLevel=c;
}
if(e.visLevel==-1){
if(typeof e.visSave=="undefined"){
e.visSave=e.style.visibility;
}
e.style.visibility="hidden";
if(typeof (p.mywehd)!="undefined"&&p.mywehd(e)){
return;
}
}else{
if(!e.visLevel){
e.style.visibility=e.visSave;
if(typeof (p.mywesh)!="undefined"&&p.mywesh(e)){
return;
}
}
}
}
}
}
}
};
CUIPopup.fbWover=function(e,p){
if(!p||(!this.oParMenu.iTyp&&!this.iNid)){
return false;
}
var l=0,t=0,w=e.offsetWidth,h=e.offsetHeight,pos=this.faGetXY(p),pw=_STNS.fiGetEleWid(p),ph=_STNS.fiGetEleHei(p);
w?(e._wd=w):(w=e._wd);
h?(e._ht=h):(h=e._ht);
while(e){
l+=e.offsetLeft,t+=e.offsetTop,e=e.offsetParent;
}
return l<pw+pos[0]&&l+w>pos[0]&&t<ph+pos[1]&&t+h>pos[1];
};
_STNS.UI.CUISeparator=_STNS.Class(_STNS.UI.CUIObj);
CUISeparator=_STNS.Class(_STNS.UI.CUIObj);
CUISeparator.register("UI/CUIObj>CUISeparator");
CUISeparator.construct=function(){
this.iNid=-1;
this.iTyp=-1;
this.iWid=-1;
this.iHei=-1;
this.sImg=0;
this.iImgWid=-1;
this.iImgHei=-1;
this.sBgClr=0;
this.sBgImg=0;
this.iBgRep=0;
this.oParMenu=0;
this.oParPopup=0;
this.sId=0;
this.iStat=0;
with(_STNS.UI.CUISeparator){
this.fsGetHTML=fsGetHTML;
this.fbInit=fbInit;
}
};
CUISeparator.CROSSFRAME=1;
with(CUISeparator){
CUISeparator.MAXSTATE=CROSSFRAME;
}
CUISeparator.fsGetHTML=function(){
var s,m=this.oParMenu,_r=_STNS,_mc=_r.UI.CUIMenu,_c=_r.UI.CUISeparator,cf=this.iStat&_c.CROSSFRAME;
with(this){
s="<table cellpadding=0 cellspacing=0 "+"id='"+sUid+"' "+m.fsGetEnt(this,"click","",cf)+" "+m.fsGetEnt(this,"mousedown","",cf)+" "+m.fsGetStyle("tb",cf,"font-size:1pt;line-height:1pt;"+(iWid&&iWid!=-1?"width:"+_r.fsGetLen("tb",iWid)+";":"")+(iHei&&iHei!=-1?"height:"+_r.fsGetLen("tb",iHei,0,0,1,0)+";":"")+(sBgClr?"background-color:"+sBgClr+";":"")+(sBgImg?"background-image:url("+(cf?_r.fsGetAbsPth(sBgImg):sBgImg)+");background-repeat:"+_mc.REPEATS[iBgRep]+";":""))+"><td align='center' valign='middle'>"+(iImgWid&&iImgHei?m.fsGetImgTag(sImg,iImgWid,iImgHei,0,"",cf):"&nbsp;")+"</td></table>";
}
return s;
};
CUISeparator.fbInit=function(){
var _r=_STNS,w=this.oParPopup.iStat&_r.UI.CUIPopup.CROSSFRAME?this.oParMenu.fdmGetTarFm():window,p=this.oParPopup,e=_r.fdmGetEleById(this.sUid,w);
if(e&&this.iHei=="100%"){
if(_r.bIsSF){
if(!p.bMul){
e.style.height=e.offsetParent.offsetParent.offsetHeight-2*p.iSpace+"px";
}else{
var _184=0;
for(var i=0;i<p.tr.length;i++){
for(var j=0;j<p.tr[i].length;j++){
if(p.tr[i][j]==this.iNid){
_184=p.tr[i].Maxtd;
break;
}
}
if(_184){
break;
}
}
e.style.height=_184+"px";
}
}else{
if(_STNS.bIsIE&&!_STNS.bLoaded&&!this.oParPopup.iNid){
_STNS.fbAddLoad(new Function("var i;if(i=_STNS.fdmGetEleById('"+this.sUid+"'))i.style.height=i.offsetParent.offsetHeight+'px';"));
}else{
if(e.offsetParent){
e.style.height=e.offsetParent.offsetHeight+"px";
}else{
_STNS.fbAddLoad(new Function("var i;if(i=_STNS.fdmGetEleById('"+this.sUid+"'))if(i.offsetParent&&i.offsetParent.offsetHeight)i.style.height=i.offsetParent.offsetHeight+'px';else{i.style.height='expression(this.offsetParent.offsetheight+\"px\")'}"));
}
}
}
}
return true;
};
_STNS.UI.CUIItem=_STNS.Class(_STNS.UI.CUIObj);
CUIItem.register("UI/CUIObj>CUIItem");
CUIItem.construct=function(){
this.iTyp=0;
this.sId=0;
this.iNid=-1;
this.iWid=-1;
this.iHei=-1;
this.sTxt="";
this.sFTxt="";
this.aImgs=[];
this.iImgWid=-1;
this.iImgHei=-1;
this.iImgBd=0;
this.sLnk=this._sTLnk="#_nolink";
this.sTar="";
this.sStatus="";
this.sTip="";
this.aIcos=[];
this.iIcoWid=-1;
this.iIcoHei=-1;
this.iIcoBd=0;
this.aArrs=[];
this.iArrWid=-1;
this.iArrHei=-1;
this.iArrBd=0;
this.iHal=0;
this.iVal=1;
this.aBgClrs=[];
this.aBgImgs=[];
this.aBgReps=[];
this.iBdStyle=0;
this.iBdWid=0;
this.aBdClrs=[];
this.aFnts=[];
this.aDecos=[];
this.aFntClrs=[];
this.oParMenu=0;
this.oParPopup=0;
this.oSubPopup=0;
this.iStat=0;
this.iLeftWid=0;
this.iRightWid=0;
this.iScD=0;
this.iPad=0;
this.bScr=false;
this.aLTab=[];
this.aRTab=[];
this.iLTabWid=-1;
this.iRTabWid=-1;
this.iITabHei=-1;
with(_STNS.UI.CUIItem){
this.fsGetHTML=fsGetHTML;
this.fbGetEnt=fbGetEnt;
this.fbSetStatus=fbSetStatus;
this.fbReStatus=fbReStatus;
this.fbSetOver=fbSetOver;
this.fbSetOut=fbSetOut;
this.fbInit=fbInit;
this.fbShowSub=fbShowSub;
this.fbHideSub=fbHideSub;
this.fbSetFnt=fbSetFnt;
this.fbSetBg=fbSetBg;
this.fbSetCursor=fbSetCursor;
this.fbUpDate=fbUpDate;
this.fbOpenLnk=fbOpenLnk;
this.fbCkClk=fbCkClk;
this.fbEnter=fbEnter;
this.fbEsc=fbEsc;
this.fbUp=fbUp;
this.fbDown=fbDown;
this.fbLeft=fbLeft;
this.fbRight=fbRight;
this.faItems=faItems;
this.fbNxtItem=fbNxtItem;
this.fbRotItem=fbRotItem;
this.fbPopFirItem=fbPopFirItem;
this.fbSetFocus=fbSetFocus;
this.fbSetfs=fbSetfs;
this.fbBlur=fbBlur;
this.fbFOver=fbFOver;
}
};
CUIItem.SHIFTKEY=1;
CUIItem.CTRLKEY=2;
CUIItem.ALTKEY=4;
CUIItem.MOUSEOVER=1;
CUIItem.MOUSEOVER_STYLE=1227133512;
CUIItem.TRACK=2;
CUIItem.TRACK_STYLE=2454267024;
CUIItem.CROSSFRAME=4;
CUIItem.CUR_ICON=56;
CUIItem.ICON_BIT=3;
CUIItem.CUR_ARROW=448;
CUIItem.ARROW_BIT=6;
CUIItem.CUR_FONT=1584;
CUIItem.FONT_BIT=9;
CUIItem.CUR_COLOR=28672;
CUIItem.COLOR_BIT=12;
CUIItem.CUR_DECORATION=229376;
CUIItem.DECORATION_BIT=15;
CUIItem.CUR_BGCOLOR=1835008;
CUIItem.BGCOLOR_BIT=18;
CUIItem.CUR_BGIMAGE=14680064;
CUIItem.BGIMAGE_BIT=21;
CUIItem.CUR_BGREPEAT=117440521;
CUIItem.BGREPEAT_BIT=24;
CUIItem.CUR_BORDERCOLOR=939527096;
CUIItem.BORDERCOLOR_BIT=27;
CUIItem.CUR_IMAGE=7516192768;
CUIItem.IMAGE_BIT=30;
with(CUIItem){
CUIItem.MAXSTATE=MOUSEOVER|TRACK|CROSSFRAME|CUR_ICON|CUR_ARROW|CUR_FONT|CUR_COLOR|CUR_DECORATION|CUR_BGCOLOR|CUR_BGIMAGE|CUR_BGREPEAT|CUR_BORDERCOLOR|CUR_IMAGE;
}
CUIItem.fsGetHTML=function(){
var s="",icos,arrs,ltab,rtab,_r=_STNS,m=this.oParMenu,p=this.oParPopup,_mc=_STNS.UI.CUIMenu,_c=_STNS.UI.CUIItem,cf=this.iStat&_c.CROSSFRAME,bKQ=_r.bIsKQ;
with(this){
icos=!bScr&&iIcoWid&&iIcoHei?"<td id='"+sUid+"_ico'"+m.fsGetStyle("td",cf,"width:"+(iLeftWid?iLeftWid:iIcoWid)+"px")+" "+(m.bRTL?" align='right'":" align='left'")+">"+m.fsGetImgTag(aIcos[(iStat&_c.CUR_ICON)>>>_c.ICON_BIT],iIcoWid,iIcoHei,iIcoBd,sUid+"_icoImg",cf)+"</td>":"";
arrs=!bScr&&iArrWid&&iArrHei?"<td id='"+sUid+"_arr' "+m.fsGetStyle("td",cf,"width:"+(iRightWid?iRightWid:iArrWid)+"px")+" "+(m.bRTL?" align='left'":" align='right'")+">"+m.fsGetImgTag(aArrs[(iStat&_c.CUR_ARROW)>>>_c.ARROW_BIT],iArrWid,iArrHei,iArrBd,sUid+"_arrImg",cf)+"</td>":"";
ltab=aLTab[0]||aLTab[1]?"<td id='"+sUid+"_ltab' "+m.fsGetStyle("td",cf,"width:"+iLTabWid+"px;")+" align=\"right\" valign=\"middle\" >"+m.fsGetImgTag(aLTab[0],iLTabWid,iITabHei,0,sUid+"_ltabImg",cf)+"</td>":"";
rtab=aRTab[0]||aRTab[1]?"<td id='"+sUid+"_rtab' "+m.fsGetStyle("td",cf,"width:"+iRTabWid+"px;")+" align=\"left\" valign=\"middle\" >"+m.fsGetImgTag(aRTab[0],iRTabWid,iITabHei,0,sUid+"_rtabImg",cf)+"</td>":"";
s+=(!bKQ?"<a tabIndex=100 "+(STM_KEY==1&&_r.bIsIE?"hidefocus=true":"")+" "+m.fsGetEnt(this,"click","",cf)+" "+m.fsGetEnt(this,"keydown","",cf)+" "+m.fsGetEnt(this,"mouseover","link",cf)+" "+m.fsGetEnt(this,"mouseout","link",cf)+" "+m.fsGetEnt(this,"mousemove","link",cf)+" "+(_sTLnk?"href=\""+(_sTLnk=="#_nolink"?"#":_sTLnk.replace(/\"/g,"&quot;"))+"\" ":"")+"target='"+sTar+"' "+"id='"+sUid+"_lnk' "+m.fsGetStyle("a",cf,(STM_KEY==1?_r.bIsFX?"-moz-outline-style:none;":"outline:none;":"")+"text-decoration:none;"+(sLnk=="#_nolink"?(_r.bIsFX&&m.aCursors[0]=="hand"?"":"cursor:"+m.aCursors[0]):(_r.bIsFX&&m.aCursors[1]=="hand"?"":"cursor:"+m.aCursors[1])))+">":"");
s+="<table cellspacing=0 "+m.fsGetEnt(this,"mouseover","",cf)+" "+m.fsGetEnt(this,"mouseout","",cf)+" "+m.fsGetEnt(this,"dblclick","",cf)+" "+m.fsGetEnt(this,"mousedown","",cf)+" "+m.fsGetEnt(this,"mousemove","",cf)+" "+" cellpadding=\"0px\" "+(sTip?"title=\""+sTip+"\" ":"")+"id=\""+sUid+"\" "+m.fsGetStyle("tb",cf,(iWid&&iWid!=-1?"width:"+_r.fsGetLen("tb",iWid,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1)+";":m.bTab&&this.oParPopup.iDepth==1&&_r.bIsOP&&_r.oNav.version<9.5?"width:1px;":"")+(iHei&&iHei!=-1?"height:"+_r.fsGetLen("tb",iHei,0,iBdStyle>0&&iBdWid>0?iBdWid:0,1,0)+";":"")+(iBdStyle>0&&iBdWid>0?"border-width:"+iBdWid+"px;border-style:"+_mc.BORDERS[iBdStyle]+";border-color:"+aBdClrs[(iStat&_c.CUR_BORDERCOLOR)>>>_c.BORDERCOLOR_BIT]+";":""))+">";
s+=ltab;
s+="<td id='"+sUid+"_itd' nowrap "+" align='"+_mc.ALIGNS[iHal]+"'"+" valign='"+_mc.VALGINS[iVal]+"' "+m.fsGetStyle("td",cf,(iHei!="100%"&&iHei!=-1?"height:"+_r.fsGetLen("tb",iHei,0,0,1,0)+";":"")+(m.bTab?"width:100%;":"")+(aBgClrs[(iStat&_c.CUR_BGCOLOR)>>>_c.BGCOLOR_BIT]?"background-color:"+aBgClrs[(iStat&_c.CUR_BGCOLOR)>>>_c.BGCOLOR_BIT]+";":"")+(aBgImgs[(iStat&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]?"background-image:url("+(cf?_r.fsGetAbsPth(aBgImgs[(iStat&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]):aBgImgs[(iStat&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT])+");":"")+(_mc.REPEATS[aBgReps[(iStat&_c.CUR_BGREPEAT)>>>_c.BGREPEAT_BIT]]?"background-repeat:"+_mc.REPEATS[aBgReps[(iStat&_c.CUR_BGREPEAT)>>>_c.BGREPEAT_BIT]]+";":""))+">";
s+="<table cellspacing=0 "+m.fsGetEnt(this,"mouseover","",cf)+" "+m.fsGetEnt(this,"mouseout","",cf)+" "+m.fsGetEnt(this,"dblclick","",cf)+" "+m.fsGetEnt(this,"mousedown","",cf)+" "+m.fsGetEnt(this,"mousemove","",cf)+" "+" cellpadding="+iPad+" "+" id='"+sUid+"_itb' "+m.fsGetStyle("tb",cf,"width:100%;height:100%;"+(_STNS.bIsOP&&_STNS.oNav.version>=9&&_STNS.oNav.version<9.5?"text-decoration:"+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]?(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&1?"underline ":"")+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&2?"line-through ":"")+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&4?"overline ":""):"none")+";":""))+">";
s+=(m.bRTL?arrs:icos);
s+="<td id='"+sUid+"_cnt' nowrap "+m.fsGetStyle("td",cf,"font-size:1pt;")+" align='"+_mc.ALIGNS[iHal]+"'"+" valign='"+_mc.VALGINS[iVal]+"'"+">";
s+=(bKQ?"<a tabIndex=100 "+m.fsGetEnt(this,"click","",cf)+" "+m.fsGetEnt(this,"keydown","",cf)+" "+m.fsGetEnt(this,"mouseover","link",cf)+" "+m.fsGetEnt(this,"mouseout","link",cf)+" "+m.fsGetEnt(this,"mousemove","link",cf)+" "+(_sTLnk?"href=\""+(_sTLnk=="#_nolink"?"#":_sTLnk.replace(/\"/g,"&quot;"))+"\" ":"")+"target='"+sTar+"' "+"id='"+sUid+"_lnk' "+m.fsGetStyle("a",cf,"text-decoration:none;"+(sLnk=="#_nolink"?(_r.bIsFX&&m.aCursors[0]=="hand"?"":"cursor:"+m.aCursors[0]):(_r.bIsFX&&m.aCursors[1]=="hand"?"":"cursor:"+m.aCursors[1])))+">":"");
s+=" "+"<span id='"+sUid+"_txt' "+m.fsGetStyle("sp",cf,(aFntClrs[(iStat&_c.CUR_COLOR)>>>_c.COLOR_BIT]?"color:"+aFntClrs[(iStat&_c.CUR_COLOR)>>>_c.COLOR_BIT]+";":"")+(aFnts[(iStat&_c.CUR_FONT)>>>_c.FONT_BIT]?"font:"+aFnts[(iStat&_c.CUR_FONT)>>>_c.FONT_BIT]+";":"")+"text-decoration:"+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]?(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&1?"underline ":"")+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&2?"line-through ":"")+(aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&4?"overline ":""):"none")+";")+">"+(iTyp==2?m.fsGetImgTag(aImgs[(iStat&_c.CUR_IMAGE)>>>_c.IMAGE_BIT],iImgWid,iImgHei,iImgBd,sUid+"_img",cf):sTxt)+"</span>";
s+=(bKQ?"</a>":"");
s+="</td>";
s+=(m.bRTL?icos:arrs);
s+="</table>";
s+="</td>";
s+=rtab;
s+="</table>";
s+=(!bKQ?"</a>":"");
}
return s;
};
CUIItem.fbGetEnt=function(e,o){
var et=e.type||e,oid=o.id,_r=_STNS,_c=_r.UI.CUIItem,as,r;
with(this){
switch(et){
case "mouseover":
if(!o._ov&&((_r.bIsIE&&e.srcElement&&_r.fbIsPar(o,e.srcElement))||(!_r.bIsIE&&e.target&&_r.fbIsPar(o,e.target)))){
o._ov=1;
if(oid==this.sUid+"_lnk"){
if(_STNS.bIsOP&&this.oParMenu.iTab==2){
fbFireEnt("mouseoverlink");
}else{
return fbFireEnt("mouseoverlink");
}
}
this.iStat|=_c.MOUSEOVER;
return fbFireEnt("mouseover");
}
break;
case "mouseout":
if(o._ov&&((_r.bIsIE&&(!e.toElement||!_r.fbIsPar(o,e.toElement)))||!_r.bIsIE&&(!e.relatedTarget||!_r.fbIsPar(o,e.relatedTarget)))){
o._ov=0;
if(oid==this.sUid+"_lnk"){
return fbFireEnt("mouseoutlink");
}
this.iStat&=_c.MAXSTATE-_c.MOUSEOVER;
if(this.oParMenu.iTab==2&&this.oParPopup.iDepth==0){
var m=this.oParMenu,w=this.iStat&_c.CROSSFRAME?this.oParMenu.fdmGetTarFm():window;
m.OutItem=this;
if(!_STNS.UI.CUICanvas&&m.oFocus&&m.oFocus==this){
var o=_r.fdmGetEleById(this.sUid+"_lnk",w);
if(o){
o.blur();
}
m.oFocus=0;
}
return true;
}
return fbFireEnt("mouseout");
}
break;
case "click":
as=0;
if(e.shiftKey){
as|=1;
}
if(e.ctrlKey){
as|=2;
}
if(e.altKey){
as|=4;
}
as|=8;
if(_r.bIsIE&&e.srcElement&&e.srcElement.id&&!e.srcElement.id.indexOf(this.sUid+"_arr")||!_r.bIsIE&&e.target&&e.target.id&&!e.target.id.indexOf(this.sUid+"_arr")){
return fbFireEnt("clickarrow",as);
}
return fbFireEnt("click",as);
case "keydown":
switch(e.keyCode){
case 9:
return false;
case 13:
return fbFireEnt("pressEnter");
case 27:
return fbFireEnt("pressEsc");
case 37:
return fbFireEnt("pressLeft");
case 38:
return fbFireEnt("pressUp");
case 39:
return fbFireEnt("pressRight");
case 40:
return fbFireEnt("pressDown");
}
break;
case "mousedown":
as=0;
if(e.shiftKey){
as|=1;
}
if(e.ctrlKey){
as|=2;
}
if(e.altKey){
as|=4;
}
as|=e.button*8;
return fbFireEnt("mousedown",as);
default:
return fbFireEnt(et,as);
}
}
return true;
};
CUIItem.fbSetStatus=function(){
if(this.sStatus){
top.status=this.sStatus;
}else{
if(this.sLnk&&this.sLnk!="#_nolink"){
top.status=_STNS.fsGetAbsPth(this.sLnk);
}
}
return true;
};
CUIItem.fbReStatus=function(){
top.status="";
return true;
};
CUIItem.fbSetOver=function(){
var _r=_STNS,_c=_r.UI.CUIItem,p=this.oParPopup,sp=this.oSubPopup,_ic=_r.UI.CUIItem,m=this.oParMenu;
if(!(m.iClk&4)&&!_STNS.UI.CUICanvas){
for(var i=0;i<p.aItems.length;i++){
if(p.aItems[i].oSubPopup&&i!=this.iNid){
p.aItems[i].oSubPopup.fbHide();
p.aItems[i].fbUpDate(p.aItems[i].iStat&(_ic.MAXSTATE-_ic.MOUSEOVER_STYLE));
}
}
}
if((m.iClk&4)&&!_STNS.UI.CUICanvas){
if(m.OutItem&&this.oParPopup!=m.OutItem.oParPopup){
for(var i=0;i<m.aPopups.length;i++){
for(var j=0;j<m.aPopups[i].aItems.length;j++){
if(m.aPopups[i].aItems[j]!=this){
if(m.aPopups[i].aItems[j].oSubPopup){
if(m.aPopups[i].aItems[j].oSubPopup._tTid){
clearTimeout(m.aPopups[i].aItems[j].oSubPopup._tTid);
}
if(m.aPopups[i].aItems[j].oParPopup.iDepth==this.oParPopup.iDepth&&m.aPopups[i].aItems[j].oSubPopup){
m.aPopups[i].aItems[j].fbFireEnt("mouseout");
m.aPopups[i].aItems[j].oSubPopup.fbHide();
}
}else{
m.aPopups[i].aItems[j].fbFireEnt("mouseout");
}
}
}
}
if(sp){
clearTimeout(sp._tTid);
}
}
}
if((m.iClk&1)&&!(m.iClk&2)&&!m.bClked){
return true;
}
this.fbUpDate(this.iStat|_c.MOUSEOVER_STYLE);
if(m.bTab){
if(m.iStat&_r.UI.CUIMenu.MOUSEOVER){
for(var i=0;i<m.aPopups.length;i++){
for(var j=0;j<m.aPopups[i].aItems.length;j++){
var ci=m.aPopups[i].aItems[j];
if(typeof ci.sTxt!="undefined"){
if(!(ci==this||(this.oParPopup&&ci==this.oParPopup.oParItem))){
ci.fbUpDate(ci.iStat&(_c.MAXSTATE-m.TRACK_STYLE-_c.TRACK));
}
}
}
}
}
if(!m.oSel){
m.oSel=this;
}
if(m.oSel.fbRotItem()!=this.fbRotItem()){
if(m.oSel.oParItem){
m.oSel.oParItem.fbSetOut();
}
m.oSel.fbSetOut();
}else{
if(m.oSel.oParPopup.iDepth==this.oParPopup.iDepth&&m.oSel!=this){
m.oSel.fbSetOut();
}else{
if(m.oSel.oParPopup.iDepth>this.oParPopup.iDepth){
m.oSel.fbSetOut();
}
}
}
m.oSel=this;
}
return true;
};
CUIItem.fbSetOut=function(){
var _r=_STNS,_c=_r.UI.CUIItem,m=this.oParMenu,w=this.iStat&_c.CROSSFRAME?this.oParMenu.fdmGetTarFm():window;
m.OutItem=this;
if(!_STNS.UI.CUICanvas&&m.oFocus&&m.oFocus==this){
var o=_r.fdmGetEleById(this.sUid+"_lnk",w);
if(o){
o.blur();
}
m.oFocus=0;
}
this.fbUpDate(this.iStat&(_c.MAXSTATE-_c.MOUSEOVER_STYLE));
return true;
};
CUIItem.fbSetFnt=function(f){
var _r=_STNS,e,w=this.iStat&_c.CROSSFRAME?this.oParMenu.fdmGetTarFm():window;
e=_r.fdmGetEleById(this.sUid+"_txt",w);
if(e){
e.style.font=f;
}
};
CUIItem.fbSetBg=function(c,i,r){
var _r=_STNS,e,w=this.iStat&_c.CROSSFRAME?this.oParMenu.fdmGetTarFm():window;
e=_r.fdmGetEleById(this.sUid,w);
if(e){
e.style.background=c+" "+"url("+i+") "+r;
}
};
CUIItem.fbSetCursor=function(c){
var _r=_STNS,e,w=this.iStat&_r.UI.CUIItem.CROSSFRAME?this.oParMenu.fdmGetTarFm():window;
e=_r.fdmGetEleById(this.sUid+"_lnk",w);
if(e){
if(_STNS.bIsFX&&c=="hand"){
e.style.cursor="";
}else{
e.style.cursor=c;
}
}
};
CUIItem.fbOpenLnk=function(a){
var _r=_STNS,sk=a&_r.UI.CUIItem.SHIFTKEY,_c=_r.UI.CUIItem,e,p=this.oParPopup,m=this.oParMenu,cf=this.iStat&_c.CROSSFRAME,w=cf?m.fdmGetTarFm():window,e;
var sp=this.oSubPopup,scf=sp?(sp.iStat&_r.UI.CUIPopup.SHOW)&&(sp.iStat&_r.UI.CUIPopup.CROSSFRAME):0;
if(this.sLnk&&this.sLnk!="#_nolink"){
if(_r.bIsSF&&!m.bTab){
this.fbSetOut();
}
e=_STNS.fdmGetEleById(this.sUid+"_lnk",w);
if(cf||scf){
m.bRunEff=false;
this.fbSetOut();
if(m.iTyp==3){
p.fbHideX(0,p.iDepth,-1,1);
}else{
if(m.iTyp==2&&STM_AHCM){
p.fbHideX(0,p.iDepth,-1,1);
}else{
p.fbHideX(0,p.iDepth,0,1);
}
}
m.bRunEff=true;
}
if(_r.bIsIE&&e){
e.click();
}
return true;
}else{
return false;
}
};
CUIItem.fbInit=function(){
var _r=_STNS,_c=_r.UI.CUIItem,e,p=this.oParPopup,m=this.oParMenu,w=this.iStat&_c.CROSSFRAME?m.fdmGetTarFm():window;
if(e=_r.fdmGetEleById(this.sUid,w)){
if(e&&this.iHei=="100%"){
if(_r.bIsSF){
if(!p.bMul){
e.style.height=e.offsetParent.offsetParent.offsetHeight-2*p.iSpace+"px";
}else{
var _1ca=0;
for(var i=0;i<p.tr.length;i++){
for(var j=0;j<p.tr[i].length;j++){
if(p.tr[i][j]==this.iNid){
_1ca=p.tr[i].Maxtd;
break;
}
}
if(_1ca){
break;
}
}
e.style.height=_1ca+"px";
}
}else{
if(_STNS.bIsIE&&!_STNS.bLoaded&&!this.oParPopup.iNid){
_STNS.fbAddLoad(new Function("var i;if(i=_STNS.fdmGetEleById('"+this.sUid+"'))i.style.height=i.offsetParent.offsetHeight+'px';"));
}else{
if(e.offsetParent){
e.style.height=e.offsetParent.offsetHeight+"px";
}else{
_STNS.fbAddLoad(new Function("var i;if(i=_STNS.fdmGetEleById('"+this.sUid+"'))i.style.height=i.offsetParent.offsetHeight+'px';"));
}
}
}
}
if(m.iWid&&!this.oParPopup.iNid&&(!this.iWid||this.iWid==-1)){
e.style.width="100%";
}
}
return true;
};
CUIItem.fbShowSub=function(){
var _r=_STNS,_cp=_r.UI.CUIPopup,_ic=_r.UI.CUIItem,p=this.oParPopup,m=this.oParMenu;
if((m.iClk&1)&&!m.bClked){
return true;
}
for(var i=0;i<p.aItems.length;i++){
if(p.aItems[i].oSubPopup&&i!=this.iNid){
p.aItems[i].oSubPopup.fbHide();
p.aItems[i].fbUpDate(p.aItems[i].iStat&(_ic.MAXSTATE-_ic.MOUSEOVER_STYLE));
}
}
if(this.oSubPopup){
if(arguments[0]&&(arguments[0]&8)){
this.oSubPopup.fbShow();
}else{
this.oSubPopup.fbShow(p.iTyp&_cp.VERTICAL?m.iDelaySV:m.iDelaySH);
}
}
return true;
};
CUIItem.fbHideSub=function(){
var _r=_STNS,_cp=_r.UI.CUIPopup,p=this.oParPopup,m=this.oParMenu;
if(this.oSubPopup&&m.bHdPopup){
this.oSubPopup.fbHide(m.iDelayHd);
}
return true;
};
CUIItem.fbUpDate=function(s){
var d=this.iStat^s,_r=_STNS,_mc=_r.UI.CUIMenu,_c=_r.UI.CUIItem,te,cf=this.iStat&_c.CROSSFRAME,e,w=cf?this.oParMenu.fdmGetTarFm():window;
e=_STNS.fdmGetEleById(this.sUid,w);
with(this){
if(e){
if((d&_c.CUR_BORDERCOLOR)&&aBdClrs[(iStat&_c.CUR_BORDERCOLOR)>>>_c.BORDERCOLOR_BIT]!=aBdClrs[(s&_c.CUR_BORDERCOLOR)>>>_c.BORDERCOLOR_BIT]){
e.style.borderColor=aBdClrs[(s&_c.CUR_BORDERCOLOR)>>>_c.BORDERCOLOR_BIT];
}
if(te=_r.fdmGetEleById(sUid+"_itd",w)){
if((d&_c.CUR_BGCOLOR)&&aBgClrs[(iStat&_c.CUR_BGCOLOR)>>>_c.BGCOLOR_BIT]!=aBgClrs[(s&_c.CUR_BGCOLOR)>>>_c.BGCOLOR_BIT]){
te.style.backgroundColor=aBgClrs[(s&_c.CUR_BGCOLOR)>>>_c.BGCOLOR_BIT];
}
if((d&_c.CUR_BGREPEAT)&&aBgReps[(iStat&_c.CUR_BGREPEAT)>>>_c.BGREPEAT_BIT]!=aBgReps[(s&_c.CUR_BGREPEAT)>>>_c.BGREPEAT_BIT]){
te.style.backgroundRepeat=_mc.REPEATS[aBgReps[(s&_c.CUR_BGREPEAT)>>>_c.BGREPEAT_BIT]];
}
if((d&_c.CUR_BGIMAGE)&&aBgImgs[(iStat&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]!=aBgImgs[(s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]){
te.style.backgroundImage="url("+(aBgImgs[(s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]?(cf?_r.fsGetAbsPth(aBgImgs[(s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]):aBgImgs[(s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT]):(cf?_r.fsGetAbsPth(oParMenu.sBlank):oParMenu.sBlank))+")";
}
var lTab=_r.fdmGetEleById(sUid+"_ltabImg",w),rTab=_r.fdmGetEleById(sUid+"_rtabImg",w);
var _1e2=((s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT)?aLTab[1]:aLTab[0];
var _1e3=((s&_c.CUR_BGIMAGE)>>>_c.BGIMAGE_BIT)?aRTab[1]:aRTab[0];
if(lTab){
lTab.src=_1e2?_1e2:oParMenu.sBlank;
}
if(rTab){
rTab.src=_1e3?_1e3:oParMenu.sBlank;
}
}
if(te=_r.fdmGetEleById(sUid+"_txt",w)){
if((d&_c.CUR_FONT)&&aFnts[(iStat&_c.CUR_FONT)>>>_c.FONT_BIT]!=aFnts[(s&_c.CUR_FONT)>>>_c.FONT_BIT]){
te.style.font=aFnts[(s&_c.CUR_FONT)>>>_c.FONT_BIT];
}
if((d&_c.CUR_COLOR)&&aFntClrs[(iStat&_c.CUR_COLOR)>>>_c.COLOR_BIT]!=aFntClrs[(s&_c.CUR_COLOR)>>>_c.COLOR_BIT]){
te.style.color=aFntClrs[(s&_c.CUR_COLOR)>>>_c.COLOR_BIT];
}
if((d&_c.CUR_DECORATION)&&aDecos[(iStat&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]!=aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]){
te.style.textDecoration=aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]?(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&1?"underline ":"")+(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&2?"line-through ":"")+(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&4?"overline ":""):"none";
if(_STNS.bIsOP&&_STNS.oNav.version>=9&&_STNS.oNav.version<9.5){
e.style.textDecoration=aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]?(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&1?"underline ":"")+(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&2?"line-through ":"")+(aDecos[(s&_c.CUR_DECORATION)>>>_c.DECORATION_BIT]&4?"overline ":""):"none";
}
}
}
if((d&_c.CUR_ICON)&&aIcos[(iStat&_c.CUR_ICON)>>>_c.ICON_BIT]!=aIcos[(s&_c.CUR_ICON)>>>_c.ICON_BIT]){
if(te=_r.fdmGetEleById(sUid+"_icoImg",w)){
te.src=aIcos[(s&_c.CUR_ICON)>>>_c.ICON_BIT]?(cf?_r.fsGetAbsPth(aIcos[(s&_c.CUR_ICON)>>>_c.ICON_BIT]):aIcos[(s&_c.CUR_ICON)>>>_c.ICON_BIT]):(cf?_r.fsGetAbsPth(oParMenu.sBlank):oParMenu.sBlank);
}
}
if((d&_c.CUR_ARROW)&&aArrs[(iStat&_c.CUR_ARROW)>>>_c.ARROW_BIT]!=aArrs[(s&_c.CUR_ARROW)>>>_c.ARROW_BIT]){
if(te=_r.fdmGetEleById(sUid+"_arrImg",w)){
te.src=aArrs[(s&_c.CUR_ARROW)>>>_c.ARROW_BIT]?(cf?_r.fsGetAbsPth(aArrs[(s&_c.CUR_ARROW)>>>_c.ARROW_BIT]):aArrs[(s&_c.CUR_ARROW)>>>_c.ARROW_BIT]):(cf?_r.fsGetAbsPth(oParMenu.sBlank):oParMenu.sBlank);
}
}
if(!bScr&&(d&_c.CUR_IMAGE)&&aImgs[(iStat&_c.CUR_IMAGE)>>>_c.IMAGE_BIT]!=aImgs[(s&_c.CUR_IMAGE)>>>_c.IMAGE_BIT]){
if(te=_r.fdmGetEleById(sUid+"_img",w)){
te.src=aImgs[(s&_c.CUR_IMAGE)>>>_c.IMAGE_BIT]?(cf?_r.fsGetAbsPth(aImgs[(s&_c.CUR_IMAGE)>>>_c.IMAGE_BIT]):aImgs[(s&_c.CUR_IMAGE)>>>_c.IMAGE_BIT]):(cf?_r.fsGetAbsPth(oParMenu.sBlank):oParMenu.sBlank);
}
}
}
iStat=s;
}
};
CUIItem.fbCkClk=function(){
var m=this.oParMenu;
if(!m.bClked){
m.bClked=true;
if(m.iClk&1){
if(this.oSubPopup){
this.oSubPopup.fbShow();
}
}
if(!(m.iClk&2)){
this.fbSetOver();
}
}
return true;
};
CUIItem.fbEnter=function(){
var o=this,s=o.oSubPopup,m=o.oParMenu;
if(o._sTLnk=="#_nolink"){
if(s&&!m.bTab){
m.bRunEff=false;
if(s.iStat&_STNS.UI.CUIPopup.SHOW){
s.fbHide();
}else{
if(!(m.iClk&4)){
s.fbShow();
}
}
m.bRunEff=true;
}
return false;
}
if(_STNS.bIsSF){
var p=o.oParPopup,pp=o,d=p.iDepth;
if(d>=1){
for(var i=d;i>0;i--){
pp=pp.oParPopup;
pp.fbHide();
pp.oParItem.fbSetOut();
}
}else{
if(d==0){
o.fbSetOut();
}
}
m.iStat&=_STNS.UI.CUIMenu.MAXSTATE-_STNS.UI.CUIMenu.MOUSEOVER;
m.oFocus=0;
}
};
CUIItem.fbEsc=function(){
var _r=_STNS,o=this,m=o.oParMenu,s=o.oSubPopup,p=o.oParPopup,pi=p.oParItem,dp=p.iDepth;
m.bRunEff=false;
if(s&&(s.iStat&_r.UI.CUIPopup.SHOW)){
if(!m.bTab){
s.fbHide();
}
m.bRunEff=true;
return false;
}
if(dp){
o.fbFireEnt("mouseout");
if(!m.bTab){
p.fbHide();
}else{
this.fbSetOut();
}
pi.fbSetfs();
}else{
o.fbFireEnt("mouseout");
_r.fdmGetEleById(o.sUid+"_lnk").blur();
}
m.bRunEff=true;
return false;
};
CUIItem.fbUp=function(){
var _r=_STNS,o=this,m=o.oParMenu,p=o.oParPopup,pi=p.oParItem,dp=p.iDepth,v=p.iTyp&_STNS.UI.CUIPopup.VERTICAL,f=m.iClk&4;
if((m.iClk&1)&&!m.bClked){
return false;
}
m.bRunEff=false;
var a=o.faItems();
if(a[2]==1&&dp>=1){
o.fbFireEnt("mouseout");
pi.fbFireEnt("mousedown",8);
pi.fbFOver();
if(p.iStat&_r.UI.CUIPopup.SHOW){
if(!m.bTab){
p.fbHide();
}
}
}else{
if(v){
var nI=o.fbNxtItem(0);
if(nI!=o){
o.fbFireEnt("mouseout");
if(f){
if(o.oSubPopup){
o.oSubPopup.fbHide();
}
}
nI.fbFOver();
}
}else{
if(o.oSubPopup&&(o.oSubPopup.iStat&_r.UI.CUIPopup.SHOW)){
if(!m.bTab){
o.oSubPopup.fbHide();
}
}else{
if(dp){
o.fbFireEnt("pressEsc");
}
}
}
}
m.bRunEff=true;
return false;
};
CUIItem.fbDown=function(){
var _r=_STNS,o=this,m=o.oParMenu,p=o.oParPopup,dp=p.iDepth,v=p.iTyp&_STNS.UI.CUIPopup.VERTICAL,f=m.iClk&4;
if((m.iClk&1)&&!m.bClked){
return false;
}
m.bRunEff=false;
if(v){
var a=o.faItems();
if(a[2]==1){
m.bRunEff=true;
return false;
}
var nI=o.fbNxtItem(1),fI=nI.fbPopFirItem();
o.fbFireEnt("mouseout");
if(f){
if(o.oSubPopup){
o.oSubPopup.fbHide();
}
}
nI.fbFOver();
}else{
if(o.oSubPopup){
var fI=o.fbPopFirItem();
o.oSubPopup.fbShow();
if(fI){
if(_r.bIsSF&&_r.oNav.version<523.12){
o.fbBlur();
}
fI.fbFOver();
}
}
}
m.bRunEff=true;
return false;
};
CUIItem.fbLeft=function(){
var _r=_STNS,o=this,m=o.oParMenu,p=o.oParPopup,pi=p.oParItem,dp=p.iDepth,v=p.iTyp&_STNS.UI.CUIPopup.VERTICAL,f=m.iClk&4;
if((m.iClk&1)&&!m.bClked){
return false;
}
m.bRunEff=false;
var a=o.faItems();
if(a[2]==1&&dp>1){
o.fbFireEnt("mouseout");
pi.fbFireEnt("mousedown",8);
pi.fbFOver();
if(p.iStat&_r.UI.CUIPopup.SHOW){
p.fbHide();
}
}else{
if(!v){
var nI=o.fbNxtItem(0);
if(nI!=o){
if(!m.bTab){
o.fbSetOut();
}else{
var _c=_r.UI.CUIItem;
for(var i=0;i<p.aItems.length;i++){
if(typeof p.aItems[i].sTxt!="undefined"){
var pi=p.aItems[i];
pi.fbUpDate(pi.iStat&(_c.MAXSTATE-m.TRACK_STYLE-_c.TRACK));
}
}
}
if(f){
if(o.oSubPopup){
o.oSubPopup.fbHide();
}
}
nI.fbFOver();
}
}else{
if(o.oSubPopup&&(o.oSubPopup.iStat&_r.UI.CUIPopup.SHOW)){
o.oSubPopup.fbHide();
}else{
if(dp){
o.fbFireEnt("pressEsc");
}
}
}
}
m.bRunEff=true;
return false;
};
CUIItem.fbRight=function(){
var _r=_STNS,o=this,m=o.oParMenu,p=o.oParPopup,dp=p.iDepth,v=p.iTyp&_STNS.UI.CUIPopup.VERTICAL,f=m.iClk&4;
if((m.iClk&1)&&!m.bClked){
return false;
}
m.bRunEff=false;
if(!v){
var a=o.faItems();
if(a[2]==1){
m.bRunEff=true;
return false;
}
var nI=o.fbNxtItem(1),fI=nI.fbPopFirItem();
if(!m.bTab){
o.fbSetOut();
}else{
var _c=_r.UI.CUIItem;
for(var i=0;i<p.aItems.length;i++){
if(typeof p.aItems[i].sTxt!="undefined"){
var pi=p.aItems[i];
pi.fbUpDate(pi.iStat&(_c.MAXSTATE-m.TRACK_STYLE-_c.TRACK));
}
}
}
if(f){
if(o.oSubPopup){
o.oSubPopup.fbHide();
}
}
nI.fbFOver();
}else{
if(o.oSubPopup){
var fI=o.fbPopFirItem();
o.oSubPopup.fbShow();
if(fI){
if(_r.bIsSF&&_r.oNav.version<523.12){
o.fbBlur();
}
fI.fbFOver();
}
}else{
var pi=p.oParItem;
if(dp>1&&!pi.oParPopup.iTyp){
if(pi.faItems()[2]>1){
var npi=pi.fbNxtItem(1);
o.fbFireEnt("mouseout");
if(f){
pi.fbFireEnt("mouseout");
if(pi.oSubPopup){
pi.oSubPopup.fbHide();
}
}
npi.fbFOver();
}
m.bRunEff=true;
return false;
}else{
if(m.aPopups[0].iTyp&_STNS.UI.CUIPopup.VERTICAL){
m.bRunEff=true;
return false;
}
}
var rI=o.fbRotItem();
if(rI.faItems()[2]>1){
var nI=rI.fbNxtItem(1),fI=nI.fbPopFirItem();
o.fbFireEnt("mouseout");
if(f){
rI.fbFireEnt("mouseout");
if(rI.oSubPopup){
rI.oSubPopup.fbHide();
}
}
nI.fbFOver();
}
}
}
m.bRunEff=true;
return false;
};
CUIItem.faItems=function(){
var fst=lst=x=y=0,p=this.oParPopup;
for(var i=0;i<p.aItems.length;i++){
if(typeof p.aItems[i].sTxt!="undefined"){
x++;
}
}
for(var j=0;j<p.aItems.length;j++){
if(typeof p.aItems[j].sTxt!="undefined"){
y++;
if(y==1){
fst=p.aItems[j];
}
if(y==x){
lst=p.aItems[j];
}
}
}
return [fst,lst,x];
};
CUIItem.fbNxtItem=function(n){
var nI,o=this,p=o.oParPopup,a=o.faItems();
if(a[2]<2){
return o;
}
var f=a[0],l=a[1];
if(n){
if(o==l){
nI=f;
}else{
for(var j=o.iNid+1;j<p.aItems.length;j++){
nI=p.aItems[j];
if(typeof nI.sTxt!="undefined"){
break;
}
}
}
}else{
if(o==f){
nI=l;
}else{
for(var j=o.iNid-1;j>=0;j--){
nI=p.aItems[j];
if(typeof nI.sTxt!="undefined"){
break;
}
}
}
}
return nI;
};
CUIItem.fbRotItem=function(){
var o=this,p=o.oParPopup,ppi=p;
for(var k=0;k<p.iDepth-1;k++){
ppi=ppi.oParPopup;
}
var P0i=ppi.oParItem;
if(p.iDepth==0){
P0i=o;
}
return P0i;
};
CUIItem.fbPopFirItem=function(){
var o=this,p=o.oSubPopup;
if(p){
var a;
for(var i=0;i<p.aItems.length;i++){
if(typeof p.aItems[i].sTxt!="undefined"){
return p.aItems[i];
}
}
}
return false;
};
CUIItem.fbSetFocus=function(){
var o=this,m=o.oParMenu,e=m.oFocus,_r=_STNS,p=o.oParPopup,a=o.faItems(),w=o.iStat&_r.UI.CUIItem.CROSSFRAME?o.oParMenu.fdmGetTarFm():window;
if(o==e){
return;
}
if(o.oSubPopup){
clearTimeout(o.oSubPopup._tTid);
}
if(e&&e!=p.oParItem){
e.fbFireEnt("mouseout");
}
o.fbFireEnt("mouseover");
if(!(m.iClk&4)){
o.fbSetfs();
}
return true;
};
CUIItem.fbSetfs=function(){
var o=this,m=o.oParMenu,_r=_STNS,w=o.iStat&_r.UI.CUIItem.CROSSFRAME?m.fdmGetTarFm():window;
var e=_r.fdmGetEleById((_r.bIsIE&&_r.oNav.version<5.5)?o.sUid:o.sUid+"_lnk",w);
if(e){
m.oFocus=o;
e.focus();
}
};
CUIItem.fbBlur=function(){
var w=this.iStat&_STNS.UI.CUIItem.CROSSFRAME?this.oParMenu.fdmGetTarFm():window,e=_STNS.fdmGetEleById(this.sUid+"_lnk",w);
if(e){
e.blur();
}
};
CUIItem.fbFOver=function(){
var o=this;
o.fbSetOver();
if(o.oSubPopup){
o.oSubPopup.fbShow();
}
o.fbSetfs();
};
}
if(!_STNS._aStMenus){
_STNS._aStMenus=[];
}
STM_FILTER=1;
STM_SCROLL=1;
STM_RTL=0;
STM_AHCM=0;
STM_SMSC=1;
STM_BIMG=1;
STM_ILOC=0;
STM_ILINK=0;
STM_KEY=(_STNS.bIsIE||_STNS.bIsFX||_STNS.bIsSF)?1:0;
STM_bIE8RC=_STNS.bIsIE?(_STNS.oNav.version=="8.0"&&navigator.appMinorVersion=="Release Candidate 1"&&_STNS.sDocMd=="css1")?1:0:0;
function stm_bm(a){
var jsp,ss,jsr;
if(document.getElementsByTagName){
ss=document.getElementsByTagName("script");
}else{
if(document.all.tags){
ss=document.all.tags("script");
}
}
for(var j=0;j<ss.length;j++){
jsr=ss[j].src;
if(jsr&&jsr.indexOf("stmenu.js")!=-1){
jsp=jsr.substring(0,jsr.indexOf("stmenu.js"));
break;
}
}
if(jsp==null){
jsp=_STNS.sLibPth;
}
var _r=_STNS,n=_r._aStMenus.length,m;
m=_r._aStMenus[n]=new _r.UI.CUIMenu;
with(m){
sJsPth=jsp;
iNid=n;
sId=a[0];
sVer=a[1];
sSiteRoot=a[1]>=800?a[23]:"";
sImgPth=a[2]?a[2].charAt(a[2].length-1)!="/"?a[2]+"/":a[2]:"";
sBlank=fsGetImg(a[3]);
bTab=a[4]==4?1:0;
iTyp=a[4]==4?0:a[4];
iX=a[5];
iY=a[6];
iHal=a[7];
iClk=a[4]==4?(a[24]==1?6:2):a[8];
iDelaySV=a[9];
iDelaySH=a[10];
iDelayHd=a[11];
if(a[12]&&(_r.bIsIE&&_r.oNav.platform!=="Mac"||_r.oNav.name=="konqueror")){
aHdTags.push("select");
}
if(a[13]){
aHdTags.push("object","embed","applet");
}
if(a[14]&&(_r.bIsIE&&_r.oNav.version<5.5||_r.bIsOP||_r.oNav.name=="konqueror")){
aHdTags.push("iframe");
}
sLnkPre=a[15]?a[15].charAt(a[15].length-1)!="/"?a[15]+"/":a[15]:"";
iWid=a[16];
iTracks=a[17];
bRTL=a[18];
bHdPopup=a[19];
iTrackLevel=a[20];
aCursors[0]=_STNS.fbIsFile(a[21])?"url("+_STNS.fsGetAbsPth(m.fsGetImg(a[21]))+"),default":a[21];
aCursors[1]=_STNS.fbIsFile(a[22])?"url("+_STNS.fsGetAbsPth(m.fsGetImg(a[22]))+"),auto":a[22];
iTab=a[4]==4?a[24]:0;
iTabHei=a[25]?a[25]:"";
bWe=_STNS.bIsIE&&_STNS.oNav.version>=5.5&&(a[13]||a[14])?1:0;
}
m.__open=true;
return m;
}
function stm_bp(id,a,pid){
var _r=_STNS,m=_r._aStMenus[_r._aStMenus.length-1];
if(!m||!m.__open){
return;
}
if(pid){
for(var i=0;i<m.aPopups.length;i++){
if(m.aPopups[i].sId==pid){
a=_r.faJoinA(a,m.aPopups[i].__args);
break;
}
}
}
var pp=0;
for(var i=m.aPopups.length-1;i>=0;i--){
if(m.aPopups[i].__open){
pp=m.aPopups[i];
break;
}
}
if(pp&&!pp.aItems.length){
return;
}
var pi=pp?pp.aItems[pp.aItems.length-1]:0,n=m.aPopups.length,p=new _r.UI.CUIPopup;
with(p){
sId=id;
iNid=n;
iTyp=a[0];
iDirect=a[1];
iOffX=a[2];
iOffY=a[3];
iSpace=a[4];
iPad=a[5];
iOpac=a[8];
if(STM_FILTER&&!m.bTab){
sShEff=a[9];
if(sShEff=="stEffect(\"slip\")"){
iShEff="_stDirection:"+a[1];
}else{
if(sShEff=="stEffect(\"rect\")"){
iShEff=a[20]&&a[21]?"border-style:"+_r.UI.CUIMenu.BORDERS[a[20]]+";border-width:"+a[21]+";border-color:"+a[22]:"border-style:solid;border-width:1px;border-color:#999999";
}else{
iShEff=a[10];
}
}
sHdEff=a[11];
if(sHdEff=="stEffect(\"slip\")"){
iHdEff="_stDirection:"+a[1];
}else{
if(sHdEff=="stEffect(\"rect\")"){
iHdEff=a[20]&&a[21]?"border-style:"+_r.UI.CUIMenu.BORDERS[a[20]]+";border-width:"+a[21]+";border-color:"+a[22]:"border-style:solid;border-width:1px;border-color:#999999";
}else{
iHdEff=a[12];
}
}
if(sHdEff){
if(sHdEff=="stEffect(\"slip\")"||sHdEff=="stEffect(\"rect\")"){
iHdEffect=2;
}else{
iHdEffect=1;
}
}
iEffDur=(110-a[13])*10;
}
iShadow=a[14];
iSdSize=_r.bIsIE&&_r.oNav.version>=5.5?a[15]:0;
sSdClr=a[16];
sBgClr=a[17];
sBgImg=m.fsGetImg(a[18]);
iBgRep=a[19];
iBdStyle=a[20];
iBdWid=a[21];
sBdClr=a[22];
aRounds[0]=a[23]?m.fsGetImg(a[23]):0;
aRHeis[0]=a[24]?a[24]:0;
aRWids[0]=a[25]?a[25]:0;
aRdb[0]=a[26]?a[26]:0;
aRBgClrs[0]=a[27]?a[27]:0;
aRBgImgs[0]=a[28]?m.fsGetImg(a[28]):0;
aRBgReps[0]=a[29]?a[29]:0;
aRounds[1]=a[30]?m.fsGetImg(a[30]):0;
aRHeis[1]=a[31]?a[31]:0;
aRWids[1]=a[32]?a[32]:0;
aRdb[1]=a[33]?a[33]:0;
aRBgClrs[1]=a[34]?a[34]:0;
aRBgImgs[1]=a[35]?m.fsGetImg(a[35]):0;
aRBgReps[1]=a[36]?a[36]:0;
aRounds[2]=a[37]?m.fsGetImg(a[37]):0;
aRHeis[2]=a[38]?a[38]:0;
aRWids[2]=a[39]?a[39]:0;
aRdb[2]=a[40]?a[40]:0;
aRBgClrs[2]=a[41]?a[41]:0;
aRBgImgs[2]=a[42]?m.fsGetImg(a[42]):0;
aRBgReps[2]=a[43]?a[43]:0;
aRounds[3]=a[44]?m.fsGetImg(a[44]):0;
aRHeis[3]=a[45]?a[45]:0;
aRWids[3]=a[46]?a[46]:0;
aRdb[3]=a[47]?a[47]:0;
aRBgClrs[3]=a[48]?a[48]:0;
aRBgImgs[3]=a[49]?m.fsGetImg(a[49]):0;
aRBgReps[3]=a[50]?a[50]:0;
aCorners[0]=a[51]?m.fsGetImg(a[51]):0;
aCorners[1]=a[52]?m.fsGetImg(a[52]):0;
aCorners[2]=a[53]?m.fsGetImg(a[53]):0;
aCorners[3]=a[54]?m.fsGetImg(a[54]):0;
aCorWHs=[a[55],a[56],a[57],a[58],a[59],a[60],a[61],a[62]];
oParMenu=m;
oParItem=pi;
oParPopup=pp;
iZid=pp?pp.iZid+pi.iNid+3:1000;
iDepth=pp?pp.iDepth+1:0;
if(!iNid){
iWid=m.iWid;
}
if(pi){
pi.oSubPopup=p;
}
fbAttachEnt("mouseover",fbSetOver);
fbAttachEnt("mouseout",fbSetOut);
if(!n&&!m.iTyp){
iTyp|=_r.UI.CUIPopup.STATIC;
}
if(p.sShEff||p.sHdEff){
_STNS.fvInc(_STNS.fsGetAbsPth(m.sJsPth+"steffie.js"));
_STNS.fvInc(_STNS.fsGetAbsPth(m.sJsPth+"steffrect.js"));
_STNS.fvInc(_STNS.fsGetAbsPth(m.sJsPth+"steffslip.js"));
}
}
p.__args=a;
p.__open=true;
m.aPopups.push(p);
return p;
}
function stm_bpx(id,pid,a){
return stm_bp(id,a,pid);
}
function stm_ai(id,a,wid,hei,pid){
var _r=_STNS,m=_r._aStMenus[_r._aStMenus.length-1];
if(!m||!m.__open){
return;
}
var pp;
for(var i=m.aPopups.length-1;i>=0;i--){
if(m.aPopups[i].__open){
pp=m.aPopups[i];
break;
}
}
if(!pp){
return;
}
if(pid){
for(var i=0;i<m.aPopups.length;i++){
for(var j=0;j<m.aPopups[i].aItems.length;j++){
if(m.aPopups[i].aItems[j].sId==pid){
a=_r.faJoinA(a,m.aPopups[i].aItems[j].__args);
break;
}
}
}
}
var it,n=pp.aItems.length;
if(a[0]==6){
it=new _r.UI.CUISeparator;
with(it){
sId=id;
iNid=n;
sBgClr=a[2];
sImg=m.fsGetImg(a[3]);
iImgWid=a[4];
iImgHei=a[5];
if(pp.iTyp&_r.UI.CUIPopup.VERTICAL){
iTyp=1;
iWid="100%";
iHei=Math.max(a[1],a[5]);
}else{
iTyp=0;
iWid=Math.max(a[1],a[4]);
iHei="100%";
}
oParMenu=m;
oParPopup=pp;
}
}else{
it=new _r.UI.CUIItem;
with(it){
sId=id;
iNid=n;
iTyp=a[0];
sFTxt=a[1].replace(/\r\n/g,"\\r\\n");
sTxt=!a[0]?_r.fsGetHTMLEnti(a[1]).replace(/\r\n/g,"<br>"):a[1];
aImgs[0]=m.fsGetImg(a[2]);
aImgs[1]=m.fsGetImg(a[3]);
iImgWid=a[4];
iImgHei=a[5];
iImgBd=a[6];
sLnk=_sTLnk=a[7]?m.fsGetLnk(a[7]):"#_nolink";
sTar=a[8];
sStatus=a[9];
sTip=_r.fsGetHTMLEnti(a[10],1);
aIcos[0]=m.fsGetImg(a[11]);
aIcos[1]=m.fsGetImg(a[12]);
iIcoWid=a[13];
iIcoHei=a[14];
iIcoBd=a[15];
aArrs[0]=m.fsGetImg(a[16]);
aArrs[1]=m.fsGetImg(a[17]);
iArrWid=a[18];
iArrHei=a[19];
iArrBd=a[20];
iHal=a[21];
iVal=a[22];
aBgClrs[0]=a[24]?"":a[23];
aBgClrs[1]=a[26]?"":a[25];
aBgImgs[0]=m.fsGetImg(a[27]);
aBgImgs[1]=m.fsGetImg(a[28]);
aBgReps[0]=a[29];
aBgReps[1]=a[30];
iBdStyle=a[31];
iBdWid=a[32];
aBdClrs[0]=a[33];
aBdClrs[1]=a[34];
aFntClrs[0]=a[35];
aFntClrs[1]=a[36];
aFnts[0]=a[37];
aFnts[1]=a[38];
aDecos[0]=a[39];
aDecos[1]=a[40];
aLTab[0]=m.fsGetImg(a[41]);
aLTab[1]=m.fsGetImg(a[42]);
aRTab[0]=m.fsGetImg(a[43]);
aRTab[1]=m.fsGetImg(a[44]);
iLTabWid=a[45];
iRTabWid=a[46];
iITabHei=a[47];
oParPopup=pp;
oParMenu=m;
iPad=pp.iPad;
iWid=wid?wid:(pp.iTyp&_r.UI.CUIPopup.VERTICAL?"100%":-1);
iHei=hei?hei:(pp.iTyp&_r.UI.CUIPopup.VERTICAL?-1:"100%");
if(!m.bTab){
fbAttachEnt("mouseout",fbSetOut);
}else{
if(m.iTab==2){
fbAttachEnt("mouseout",fbSetOut);
}
}
if(m.iTab!=1){
fbAttachEnt("mouseover",fbSetOver);
}
fbAttachEnt("mouseoverlink",fbSetStatus);
fbAttachEnt("mouseoutlink",fbReStatus);
fbAttachEnt("pressEnter",fbEnter);
fbAttachEnt("pressEsc",fbEsc);
fbAttachEnt("pressUp",fbUp);
fbAttachEnt("pressDown",fbDown);
fbAttachEnt("pressLeft",fbLeft);
fbAttachEnt("pressRight",fbRight);
if(m.iClk&1){
fbAttachEnt("click",fbCkClk);
fbAttachEnt("mouseover",fbShowSub);
fbAttachEnt("clickarrow",fbCkClk);
}else{
if(m.iClk&4){
fbAttachEnt("click",fbShowSub);
fbAttachEnt("clickarrow",fbShowSub);
if(m.iTab==1){
fbAttachEnt("clickarrow",fbSetOver);
fbAttachEnt("click",fbSetOver);
}
}else{
fbAttachEnt("mouseover",fbShowSub);
fbAttachEnt("clickarrow",fbShowSub);
}
}
fbAttachEnt("clickarrow",_STNS.fbFalse);
fbAttachEnt("click",fbOpenLnk);
if(STM_KEY){
fbAttachEnt("keydown",_STNS.fbTrue);
fbAttachEnt("mousemove",fbSetFocus);
fbAttachEnt("mousemove",_STNS.fbTrue);
}
if(m.iTracks&1){
if(m.iTracks&2){
aFntClrs[2]=aFntClrs[1];
}else{
aFntClrs[2]=aFntClrs[0];
}
aFntClrs[3]=aFntClrs[1];
if(m.iTracks&4){
aFnts[2]=aFnts[1];
aDecos[2]=aDecos[1];
}else{
aFnts[2]=aFnts[0];
aDecos[2]=aDecos[0];
}
aFnts[3]=aFnts[1];
aDecos[3]=aDecos[1];
if(m.iTracks&8){
aBgClrs[2]=aBgClrs[1];
}else{
aBgClrs[2]=aBgClrs[0];
}
aBgClrs[3]=aBgClrs[1];
if(m.iTracks&16){
aBgImgs[2]=aBgImgs[1];
aBgReps[2]=aBgReps[1];
}else{
aBgImgs[2]=aBgImgs[0];
aBgReps[2]=aBgReps[0];
}
aBgImgs[3]=aBgImgs[1];
aBgReps[3]=aBgReps[1];
if(m.iTracks&32){
aBdClrs[2]=aBdClrs[1];
}else{
aBdClrs[2]=aBdClrs[0];
}
aBdClrs[3]=aBdClrs[1];
if(m.iTracks&64){
aIcos[2]=aIcos[1];
}else{
aIcos[2]=aIcos[0];
}
aIcos[3]=aIcos[1];
if(m.iTracks&128){
aImgs[2]=aImgs[1];
}else{
aImgs[2]=aImgs[0];
}
aImgs[3]=aImgs[1];
if(m.iTracks&256){
aArrs[2]=aArrs[1];
}else{
aArrs[2]=aArrs[0];
}
aArrs[3]=aArrs[1];
}
}
}
it.__args=a;
pp.aItems.push(it);
return it;
}
function stm_aix(id,pid,a,wid,hei){
return stm_ai(id,a,wid,hei,pid);
}
function stm_ep(){
var m=_STNS._aStMenus[_STNS._aStMenus.length-1];
if(!m||!m.__open){
return;
}
var p;
for(var i=m.aPopups.length-1;i>=0;i--){
if(m.aPopups[i].__open){
p=m.aPopups[i];
break;
}
}
if(!p){
return;
}
if(p.aItems.length){
if(!p.bMul){
if(p.iTyp&_STNS.UI.CUIPopup.VERTICAL){
var lw=0,rw=0;
for(var i=0;i<p.aItems.length;i++){
if(p.aItems[i].iIcoWid>lw&&p.aItems[i].iIcoHei){
lw=p.aItems[i].iIcoWid;
}
if(p.aItems[i].iArrWid>rw&&p.aItems[i].iArrHei){
rw=p.aItems[i].iArrWid;
}
}
if(!p.bMul&&lw){
for(var i=0;i<p.aItems.length;i++){
if(!p.aItems[i].iIcoWid||!p.aItems[i].iIcoHei){
p.aItems[i].iIcoWid=lw;
p.aItems[i].iIcoHei=1;
p.aItems[i].aIcos=[];
}
p.aItems[i].iLeftWid=lw;
}
}
if(!p.bMul&&rw){
for(var i=0;i<p.aItems.length;i++){
if(!p.aItems[i].iArrWid||!p.aItems[i].iArrHei){
p.aItems[i].iArrWid=rw;
p.aItems[i].iArrHei=1;
p.aItems[i].aArrs=[];
}
p.aItems[i].iRightWid=rw;
}
}
}
}else{
var _r=_STNS,_c=_r.UI.CUIPopup,m=p.oParMenu,_mc=_r.UI.CUIMenu,v=p.iTyp&_c.VERTICAL;
if(p.bMul){
var _mlc=p.bMul?v?1:0:0,_mlr=p.bMul?!v?1:0:0,_ml=p.iMl,_278=p.iMSpc,_279=p.aItems.length,_27a=Math.ceil(p.aItems.length/_ml),_27b=Math.floor(p.aItems.length/_ml),_27c=_27a==_27b?0:p.aItems.length%_ml,_stp=p.aItems.length<_ml?p.aItems.length:_ml;
}
var _27e=[];
if(_mlr){
var _tc=0,_27e=[];
for(var c=0;c<_27a;c++){
n=0;
for(var j=_tc;j<_tc+_stp;j++){
if(_279>0){
if(!_27e[n]){
_27e[n]=[];
}
_27e[n][c]=j;
n++;
}
_279--;
}
_tc=_tc+_stp;
}
}else{
if(_mlc){
_tprs=_27a==_27b?0:p.aItems.length%_ml;
for(var c=0;c<_stp;c++){
var _mli=0,n=0;
for(var j=0;j<(_27c==0?_27a:_tprs>0?_27a:_27b);j++){
if(_279>0){
_mli=j==0?c:_mli+_stp;
if(!_27e[n]){
_27e[n]=[];
}
_27e[n][c]=_mli;
_279--;
n++;
}
}
_tprs>0?_tprs--:"";
}
}
}
for(var j=0;j<_27e.length;j++){
var lw=0,rw=0;
for(var i=0;i<_27e[j].length;i++){
if(p.aItems[_27e[j][i]].iIcoWid>lw&&p.aItems[_27e[j][i]].iIcoHei){
lw=p.aItems[_27e[j][i]].iIcoWid;
}
if(p.aItems[_27e[j][i]].iArrWid>rw&&p.aItems[_27e[j][i]].iArrHei){
rw=p.aItems[_27e[j][i]].iArrWid;
}
}
if(lw){
for(var i=0;i<_27e[j].length;i++){
if(!p.aItems[_27e[j][i]].iIcoWid||!p.aItems[_27e[j][i]].iIcoHei){
p.aItems[_27e[j][i]].iIcoWid=lw;
p.aItems[_27e[j][i]].iIcoHei=1;
p.aItems[_27e[j][i]].aIcos=[];
}
p.aItems[_27e[j][i]].iLeftWid=lw;
}
}
if(rw){
for(var i=0;i<_27e[j].length;i++){
if(!p.aItems[_27e[j][i]].iArrWid||!p.aItems[_27e[j][i]].iArrHei){
p.aItems[_27e[j][i]].iArrWid=rw;
p.aItems[_27e[j][i]].iArrHei=1;
p.aItems[_27e[j][i]].aArrs=[];
}
p.aItems[_27e[j][i]].iRightWid=rw;
}
}
}
}
delete p.__open;
}else{
var pi=p.oParItem;
if(pi){
pi.oSubPopup=null;
pi.aArrs.length=0;
pi.iArrWid=0;
pi.iArrHei=0;
}
m.aPopups.pop();
p.fvDestroy();
}
}
function stm_em(){
var m=_STNS._aStMenus[_STNS._aStMenus.length-1];
if(!m||!m.__open){
return;
}
if(m.aPopups.length){
delete m.__open;
for(var i=0;i<m.aPopups.length;i++){
delete m.aPopups[i].__args;
for(var j=0;j<m.aPopups[i].aItems.length;j++){
delete m.aPopups[i].aItems[j].__args;
}
}
_STNS.fvLoadLib();
m.fbShow();
}else{
_STNS._aStMenus.pop();
m.fvDestroy();
}
if(STM_KEY){
var _r=_STNS;
if(_r.bIsIE){
document.attachEvent("onclick",m.fbClick);
}else{
document.addEventListener("click",m.fbClick,true);
}
if(!_STNS.addKD&&m.iTyp!=3){
if(_r.bIsIE){
document.attachEvent("onkeydown",m.fbKeydown);
}else{
document.addEventListener("keydown",m.fbKeydown,true);
}
}
_STNS.addKD=true;
}
}
function stm_cf(a,m){
var m=_STNS._aStMenus[_STNS._aStMenus.length-1];
if(!m||!m.__open){
return;
}
m.bCfm=true;
m.iCfD=a[0];
m.iCfX=a[1];
m.iCfY=a[2];
m.sTarFm=a[3];
m.sSrcFm=a[4];
m.bCfShow=a[5];
}
function stm_sc(n,a){
if(STM_SCROLL){
var _r=_STNS,m=_r._aStMenus[_r._aStMenus.length-1];
if(!m||!m.__open){
return;
}
n?m.iScType|=2:m.iScType|=1;
var bSC=((_r.bIsIE&&_r.oNav.version<5)||_r.bIsMIE||(_r.bIsFX&&_r.oNav.version<20040804)||(_r.bIsOP&&_r.oNav.version<9)||_r.bIsSF||(_r.oNav.name=="konqueror"&&_r.oNav.version>=3));
for(var i=1;i<m.aPopups.length;i++){
var it=[],pp=m.aPopups[i],v=pp.iTyp&_STNS.UI.CUIPopup.VERTICAL;
if(pp.bMul||n^v||bSC){
continue;
}
for(var j=0;j<2;j++){
it[j]=new _r.UI.CUIItem;
with(it[j]){
bScr=true;
sId=j;
iNid=pp.aScBars.length;
iTyp=2;
sTxt="";
iHal=1;
iVal=1;
aBgClrs[0]=a[0];
aBgClrs[1]=a[1];
aBgImgs[0]=m.fsGetImg(a[2]);
aBgImgs[1]=m.fsGetImg(a[3]);
aBgReps[0]=a[4];
aBgReps[1]=a[5];
iBdStyle=a[6];
iBdWid=a[7];
aBdClrs[0]=a[8];
aBdClrs[1]=a[9];
aImgs[0]=j==0?m.fsGetImg(a[10]):m.fsGetImg(a[15]);
aImgs[1]=j==0?m.fsGetImg(a[11]):m.fsGetImg(a[16]);
iImgWid=j==0?a[12]:a[17];
iImgHei=j==0?a[13]:a[18];
iImgBd=j==0?a[14]:a[19];
iScD=a[20]?a[21]:0;
oParPopup=pp;
oParMenu=m;
iWid="100%";
iHei="100%";
fbAttachEnt("mouseover",fbSetOver);
fbAttachEnt("mouseout",fbSetOut);
fbAttachEnt("click",_STNS.fbFalse);
}
it[j].__args=a;
pp.aScBars[j]=it[j];
}
}
}
}
function stm_mc(l,a){
var _r=_STNS,_298,m=_r._aStMenus[_r._aStMenus.length-1];
if(!m||!m.__open){
return;
}
var pp=0;
for(var i=m.aPopups.length-1;i>=0;i--){
if(m.aPopups[i].__open){
pp=m.aPopups[i];
break;
}
}
switch(a[5]){
case 1:
_298="repeat-x";
break;
case 2:
_298="repeat-y";
break;
case 3:
_298="repeat";
break;
default:
_298="no-repeat";
}
pp.bMul=m.bTab?false:true,pp.iMl=a[0],pp.sMBgClrs=a[2]?"":a[1],pp.sMOpc=a[2],pp.iMSpc=a[3],pp.sMBgImgs=a[4]?m.fsGetImg(a[4]):"",pp.sMBgReps=_298?_298:"no-repeat";
for(var i=0;i<pp.aItems.length;i++){
pp.aItems[i].iWid==-1?pp.aItems[i].iWid="100%":"";
pp.aItems[i].iHei==-1?pp.aItems[i].iHei="100%":"";
}
}
function stgcl(w){
return _STNS.fiGetCL(w);
}
function stgct(w){
return _STNS.fiGetCT(w);
}
function stgcw(w){
return _STNS.fiGetCW(w);
}
function stgch(w){
return _STNS.fiGetCH(w);
}
function stgMe(n){
for(var j=0;j<_STNS._aStMenus.length;j++){
if(_STNS._aStMenus[j].sId==n){
return _STNS._aStMenus[j];
}
}
return false;
}
function hideMenu(n){
var m;
if(m=stgMe(n)){
var p=m.aPopups[0];
p.fbHide();
}
}
function showFloatMenuAt(n,x,y){
var m;
if(m=stgMe(n)){
m.iX=x;
m.iY=y;
var p=m.aPopups[0];
var s,pos=p.faGetXY(1);
m.iX=pos[0];
m.iY=pos[1];
p.fbHide();
p.fbShow();
}
}
}


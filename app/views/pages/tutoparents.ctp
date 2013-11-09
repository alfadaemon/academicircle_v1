<?php
/**
 * File name: tutoparents.ctp
 * Project: academicircle
 * Creation: May 18, 2011
 *
 * @author lfaraya
 */
?>
<center><OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="1020" HEIGHT="592" CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=7,0,0,0">
<PARAM NAME=movie VALUE="parents.swf">
<PARAM NAME=play VALUE=true>
<PARAM NAME=loop VALUE=false>
<PARAM NAME=wmode VALUE=transparent>
<PARAM NAME=quality VALUE=low>
<EMBED SRC="../files/parents.swf" WIDTH=1020 HEIGHT=592 quality=low loop=false wmode=transparent TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
</EMBED>
</OBJECT></center>
<SCRIPT>
	obj=document.getElementsByTagName('object');
	for (var i=0; i<obj.length; ++i)
		obj[i].outerHTML=obj[i].outerHTML;
</script>

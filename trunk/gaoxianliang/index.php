<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head> 
<title>在线代码高亮---www.xiaofengsky.com</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Language" content="zh-CN" /> 
<link rel="stylesheet" href="css/basicd8b0.css" type="text/css"/> 
<script type="text/javascript" src='jquery/jquery-1.7.2.js'></script>
<link rel="stylesheet" href='css/bootstrap.min.css'/>
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="header">
	<div class="wrapper">
		<div id="logo" class="texthidden" href="/">
			<h1>在线工具</h1>
		</div>
	</div>
</div>
<link id="css" rel="stylesheet" type="text/css" href="styles/shCoreDefault.css"/>
<script type="text/javascript" src="jquery/jquery.cookies.2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/shCore.js"></script>
<script type="text/javascript" src="scripts/shBrushAll.js"></script>
<script>
 var cookieOptions = {
    hoursToLive: 30 * 24
  }
var REGX_HTML_ENCODE = /"|&|'|<|>|[\x00-\x20]|[\x7F-\xFF]|[\u0100-\u2700]/g;
function encodeHtml(s){
      return (typeof s != "string") ? s :
          s.replace(REGX_HTML_ENCODE,
                    function($0){
                        var c = $0.charCodeAt(0), r = ["&#"];
                        c = (c == 0x20) ? 0xA0 : c;
                        r.push(c); r.push(";");
                        return r.join("");
                    });
}
function change(type){    //更改样式
    var css=document.getElementById("css"); 
    if ("default"==type)
    	css.setAttribute("href","/styles/shCoreDefault.css"); 
    if ("emacs"==type)
    	css.setAttribute("href","/styles/shCoreEmacs.css"); 
	if ("django"==type)
    	css.setAttribute("href","/styles/shCoreDjango.css");
	if ("eclipse"==type)
    	css.setAttribute("href","/styles/shCoreEclipse.css");
	if ("fadetogrey"==type)
    	css.setAttribute("href","/styles/shCoreFadeToGrey.css");
	if ("mdultra"==type)
    	css.setAttribute("href","/styles/shCoreMDUltra.css");
	if ("midnight"==type)
    	css.setAttribute("href","/styles/shCoreMidnight.css");
	if ("rdark"==type)
    	css.setAttribute("href","/styles/shCoreRDark.css");
	render();
} 
$(document).ready(function (){
	if(jQuery.cookies.get("lang_type")){
		$("#code_type").val(jQuery.cookies.get("lang_type"));
	}
	$('#to_html').cookieFill(cookieOptions);
	$('#gutter').cookieFill(cookieOptions);
	if(jQuery.cookies.get("style_type")){
		$(":radio").removeAttr("checked");
		$(":radio[value=" + jQuery.cookies.get("style_type") + "]").attr("checked","checked");
		change(jQuery.cookies.get("style_type"));
	}
	$("#html_div").hide();
	SyntaxHighlighter.all();
	$(":radio").click(function (){
		change($(this).val());	
	});
	$("#to_html").click(function (){
    	if($("#to_html").attr("checked")){
			toHTML();
    		$("#html_div").show();
		}
    	else{
    		$("#html_div").hide();
		}
	});
	$("#gutter").click(function (){
		render();
	});
	$('#to_html').cookieBind();
	$('#gutter').cookieBind();
});

function render(){
	$("#result_div").empty();
	$("#result_div").prepend("<pre>"+encodeHtml($("#code_source").val())+"</pre>");
	var class_v="brush :"+$("#code_type").val()+";";
	if("checked"!=$("#gutter").attr("checked"))
		class_v=class_v+"gutter: false;";
	$("#result_div pre").addClass(class_v);
	SyntaxHighlighter.highlight();
	toHTML();
	jQuery.cookies.set("style_type",$(':radio[checked="checked"]').val(),cookieOptions);
	jQuery.cookies.set("lang_type",$('#code_type').val(),cookieOptions);
}
function toHTML(){
	var html="<link rel='stylesheet' type='text/css' href='http://code.xiaofengsky.com/";
	html=html+$("#css").attr("href");
	html=html+"'/>";
	html=html+$(".syntaxhighlighter").parent().html();
	$("#html_div textarea").val(html);
	if($("#to_html").attr("checked"))
	{
		$("#html_div").show();
	}
	else{
		$("#html_div").hide();
	}
}
</script>
<div id="mainContent" class="tool_content wrapper">
	<div class="toolName">在线代码高亮</div>
	<div class="toolUsing clearfix">
	</div>
	<div class="topBar">
    <textarea id="code_source">&lt;?php
echo &quot;Hello, World!&quot;;
?&gt;</textarea>
	</div>
	<div class="operateTB">
		<form class="form-inline">
			<select id="code_type" class="span2">
			    <option value="php">PHP</option>
    			<option value="js">Javascript</option>
				<option value="xml">HTML/XML</option>
    			<option value="java">Java</option>
    			<option value="c">C/C++/Objectiv-C</option>
    			<option value="ruby">Ruby</option>
    			<option value="csharp">C#</option>
    			<option value="css">CSS</option>
    			<option value="delphi">Delphi</option>
    			<option value="erlang">Erlang</option>
    			<option value="groovy">Groovy</option>
    			<option value="javafx">JavaFX</option>
    			<option value="perl">Perl</option>
    			<option value="powershell">PowerShell</option>
    			<option value="python">Python</option>
    			<option value="scala">Scala</option>
    			<option value="sql">SQL</option>
    			<option value="vb">VB</option>
    		    <option value="as3">AS3</option>
    			<option value="bash">Bash</option>
    			<option value="coldfusion">ColdFusion</option>
    			<option value="diff">Diff</option>
    			<option value="plain">Plain</option>
    			<option value="sass">Sass</option>
			</select>
            <label class="checkbox"><input type="checkbox" id="gutter" checked="checked"/>显示行号</label>
			<label class="checkbox"><input type="checkbox" id="to_html"/>生成HTML</label>
			<button type="button" class="btn btn-primary" onclick="render();"><i class="icon-chevron-down icon-white"></i>高亮</button><p>
    		<label class="radio"><input type="radio" name="higilight_style" checked="checked" value="default"/>默认样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="emacs"/>Emacs样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="eclipse"/>Eclipse样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="django"/>Django样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="fadetogrey"/>FadeToGrey样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="mdultra"/>MDUltra样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="midnight"/>Midnight样式</label>
    		<label class="radio"><input type="radio" name="higilight_style" value="rdark"/>RDark样式</label>
		</form>
	</div>
	<div class="bottomBar clearfix">
		<div id='html_div'>
			<textarea id='html' onclick='this.focus();this.select();'>
			</textarea>
		</div>
		<div id="result_div">
    	<pre class='brush: js;'>
&lt;?php
echo &quot;Hello, World!&quot;;
?&gt;
    	</pre>
		</div>

	</div>
</div>
<div id="footer">
	<p class="wrapper">
		在线代码高亮 由 <a href="http://www.baidu.com/" target="_blank">百度</a> 提供服务器  <a href="/">普通版</a> <a href="my.php">纯代码版</a>  <script type="text/javascript" src="http://tajs.qq.com/stats?sId=270473446" charset="UTF-8"></script>
	</p>
</div>
</body>
</html>
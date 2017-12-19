<html dir="ltr"><head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/unit1.php?css=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/rpcl-bin/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/unit1.php?js=1"></script>
</head>
<body id="Page1">
<form id="Page1_form" name="Page1_form" method="post" action="/unit1.php"><input name="serverevent" value="" type="hidden"><input name="serverparams" value="" type="hidden"><input id="Button1SubmitEvent" name="Button1SubmitEvent" value="" type="hidden">
<table id="Page1_table"><tbody><tr><td>
<div id="Label1_outer">
<div id="Label1">Label1</div>
</div>
<div id="Button1_outer">
<input name="Button1" value="Button1" onclick="return Button1ClickWrapper(event, $('#Button1SubmitEvent').get(0), 'Button1_Button1Click')" tabindex="0" id="Button1" type="submit">
</div>
<div id="ComboBox1_outer">
<select name="ComboBox1" id="ComboBox1" size="1" tabindex="0"></select>
</div>
<div id="RadioButton1_outer">
<table id="RadioButton1_table"><tbody><tr><td>
<input name="RadioButton1" value="RadioButton1" tabindex="0" id="RadioButton1" type="radio">
</td><td>
<span id="RadioButton1_caption" onclick="return RadioButtonClick(document.forms[0].RadioButton1, 'RadioButton1');">RadioButton1</span>
</td></tr></tbody></table>

</div>
<div id="CheckBox1_outer">
<span id="CheckBox1_p"><input name="CheckBox1" value="CheckBox1" tabindex="0" id="CheckBox1" type="checkbox"></span><span id="CheckBox1_l"><label for="CheckBox1">CheckBox1</label></span>
</div>
</td></tr></tbody></table>
</form>


</body></html>
/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.height = 832;
	config.filebrowserUploadUrl="/Tools/upImg";
	config.removeButtons = 'Language,Flash,Iframe,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Print';
	config.font_names = '微软雅黑/Microsoft YaHei;宋体/SimSun;新宋体/NSimSun;仿宋/FangSong;楷体/KaiTi;仿宋_GB2312/FangSong_GB2312;'+  
        '楷体_GB2312/KaiTi_GB2312;黑体/SimHei;微软正黑/Microsoft JhengHei;'+  
        'Arial Black/Arial Black;'+ config.font_names;
	config.filebrowserBrowseUrl        ='/Public/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl='/Public/ckfinder/ckfinder.html';
	config.filebrowserFlashBrowseUrl ='/Public/ckfinder/ckfinder.html';
	//config.filebrowserImageUploadUrl='/Public/ckfinder/core/connector/php/connector.php?command=QuickUpload&amp;type=Images';
	//config.filebrowserFlashUploadUrl ='/Public/ckfinder/core/connector/php/connector.php?command=QuickUpload&amp;type=Flash';
};